<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminUser extends Model
{
    use HasFactory;

    protected $table = 'admin_users';

    public static function getSubAdmins()
    {
        return DB::table('admin_users')->where('admin_type', 'N')->get();
    }

    public static function getAllAdmins()
    {
        return DB::table('admin_users')->get();
    }

    // public static function getAdmins($admin_type = null)
    // {
    //     // If admin_type is 'S', return all admins, otherwise return only sub-admins
    //     if ($admin_type === 'S') {
    //         return DB::table('admin_users')->get();
    //     } else {
    //         return DB::table('admin_users')->where('admin_type', 'N')->get();
    //     }
    // }

  
}
