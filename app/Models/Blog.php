<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blogs';

    public static function createBlog($data)
    {
        $data['posted_by'] = Auth::id();
        $data['created_datetime'] = now();
        $data['updated_datetime'] = now();

        DB::table('blogs')->insert($data);
        return DB::getPdo()->lastInsertId();
    }

    public static function showBlog($perPage = 12)
    {
        $blogs = DB::table('blogs')
            ->where('status', 2)
            ->get();


        return DB::table('blogs')
            ->select(
                'blog_id',
                'posted_by',
                'category_ids',
                'title',
                'description',
                'blog_content',
                'created_datetime',
                'updated_datetime'
            )
            ->where('status', 3)
            ->paginate($perPage);
        ;
    }

    public static function deleteBlog($id)
    {
        // dd($id);
        DB::table('blogs')->where('blog_id', $id)->delete();
    }

    public static function findBlogById($id)
    {
        // dd($id);
         return DB::table('blogs')
                ->select(
                    'title',
                    'blog_id',
                    'posted_by',
                    'category_ids',
                    'description',
                    'blog_content',
                    'updated_datetime'
                )
                ->where('blog_id',$id)
                ->get();
    }

    public static function updateBlog($id, $data)
    {
        return DB::table('blogs')
            ->where('blog_id', $id)
            ->update($data);
    }
}

