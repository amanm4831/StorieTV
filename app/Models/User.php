<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public static function getAllVerifiedUsers()
    {
        return DB::table('users')
            ->join('users_profile', 'users.user_id', '=', 'users_profile.user_id')
            ->join('user_statistics', 'users.user_id', '=', 'user_statistics.user_id')
            ->where('users.is_verified', 1)
            ->select(
                'users_profile.user_id',
                'users_profile.full_name',
                'users_profile.user_name',
                'users_profile.dob',
                'users_profile.bio',
                'users_profile.keywords',
                'users_profile.characteristics',
                'user_statistics.total_followers',
                'user_statistics.total_following',
                'user_statistics.total_collabs',
                'users_profile.created_datetime',
                DB::raw("CONCAT(users_profile.country_code, ' ', users_profile.phone_number) as contact_info")
            )
            ->get();
    }

    public static function getUserDetails($id)
    {
        return DB::table('users')
            ->join('users_profile', 'users_profile.user_id', '=', 'users.user_id')
            ->join('user_statistics', 'users.user_id', '=', 'user_statistics.user_id')
            ->where('users.user_id', $id)
            ->select(
                'users.email_id',
                'users_profile.full_name',
                'users_profile.user_name',
                'users_profile.country_code',
                'users_profile.phone_number',
                'users_profile.dob',
                'users_profile.bio',
                'users_profile.keywords',
                'users_profile.characteristics',
                'users_profile.profile_image_full_url',
                'users_profile.created_datetime',
                'user_statistics.total_followers',
                'user_statistics.total_following',
                'user_statistics.total_collabs',
                DB::raw("CONCAT(users_profile.country_code, ' ', users_profile.phone_number) as contact_info")
            )
            ->first();
    }

    public static function getUserStatistics()
    {
        return DB::table('users')
            ->join('user_statistics', 'users.user_id', '=', 'user_statistics.user_id')
            ->join('users_profile', 'users.user_id', '=', 'users_profile.user_id')
            ->select(
                'users.user_id',
                'users.email_id',
                'users_profile.profile_image_thumbnail as profile_image_full_url',
                'users_profile.full_name',
                'users_profile.user_name',
                'user_statistics.total_followers',
                'user_statistics.total_following',
                'user_statistics.total_collabs',
                'users.updated_datetime'
            )
            ->get();
    }

    public static function getFollowers($user_id)
    {
        return DB::table('users_followers')
            ->join('users', 'users_followers.follow_by', '=', 'users.user_id')
            ->where('users_followers.follow_to', $user_id)
            ->select('users.email_id')
            ->get();
    }

    public static function getFollowing($user_id)
    {
        return DB::table('users_followers')
            ->join('users', 'users_followers.follow_to', '=', 'users.user_id')
            ->where('users_followers.follow_by', $user_id)
            ->select('users.email_id')
            ->get();
    }

    public static function blockUser($id)
    {
        return DB::table('blocked_users')->insert([
            'blocked_by' => auth()->id(),
            'blocked_to' => $id,
            'created_at' => now(),
        ]);
    }
    public static function getFollowersWithNames($userId)
    {
        return DB::table('users_followers')
            ->join('users', 'users_followers.follow_by', '=', 'users.user_id')
            ->join('users_profile', 'users.user_id', '=', 'users_profile.user_id')
            ->select('users.email_id', 'users_profile.user_name')
            ->where('users_followers.follow_to', $userId)
            ->where('users_followers.is_accepted', 1)
            ->get();
    }

    public static function getUserSearchData($searchIn, $searchType, $suggestionText, $isVerified, $startDate, $endDate, $limitFlag)
    {
        $response = DB::table('users')
                ->join('users_profile', 'users_profile.user_id', '=', 'users.user_id')
                ->where('users.is_verified', 1)
                ->select(
                    'users.user_id',
                    'users.email_id',
                    'users_profile.user_name',
                    'users_profile.full_name',
                    'users_profile.bio',
                    'users_profile.dob',
                    'users_profile.characteristics',
                    'users_profile.keywords',
                    'users.created_datetime',
                    DB::raw("CONCAT(users_profile.country_code, ' ', users_profile.phone_number) as contact_info")
                );

        for ($i = 0; $i < count($searchIn); $i++) {
            if ($searchIn[$i] == 'created_datetime') {
                if (!empty($startDate[$i]) && !empty($endDate[$i])) {
                    $response = $response->whereBetween('users.created_datetime', [$startDate[$i], $endDate[$i]]);
                }
            } elseif ($searchIn[$i] == 'user_name') {
                if ($searchType[$i] == 'contains' && !empty($suggestionText[$i])) {
                    $response = $response->where('users_profile.user_name', 'LIKE', '%' . $suggestionText[$i] . '%');
                }
                if ($searchType[$i] == 'begins_with' && !empty($suggestionText[$i])) {
                    $response = $response->where('users_profile.user_name', 'LIKE', $suggestionText[$i] . '%');
                }
                if ($searchType[$i] == 'exact_match' && !empty($suggestionText[$i])) {
                    $response = $response->where('users_profile.user_name', '=', $suggestionText[$i]);
                }
                if ($searchType[$i] == 'ends_with' && !empty($suggestionText[$i])) {
                    $response = $response->where('users_profile.user_name', 'LIKE', '%' . $suggestionText[$i]);
                }
            } else {
                if ($searchType[$i] == 'contains' && !empty($suggestionText[$i])) {
                    $response = $response->where($searchIn[$i], 'LIKE', '%' . $suggestionText[$i] . '%');
                }
                if ($searchType[$i] == 'begins_with' && !empty($suggestionText[$i])) {
                    $response = $response->where($searchIn[$i], 'LIKE', $suggestionText[$i] . '%');
                }
                if ($searchType[$i] == 'exact_match' && !empty($suggestionText[$i])) {
                    $response = $response->where($searchIn[$i], '=', $suggestionText[$i]);
                }
                if ($searchType[$i] == 'ends_with' && !empty($suggestionText[$i])) {
                    $response = $response->where($searchIn[$i], 'LIKE', '%' . $suggestionText[$i]);
                }
            }
        }

        $response = $response
                ->limit($limitFlag)
                ->orderBy('users.user_id', 'DESC')
                ->get();


            // dd($response);

            return $response;
        }
    }

