<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Blog;
use Illuminate\Support\Facades\Log;

class BlogController extends Controller
{
    public function create()
    {
        return view('blog.create');
    }
    public function store(Request $request)
    {
        // dd($request->all());
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:100',
            'blog_type' => 'required|in:T,V',
            'categories' => 'required|array',
            // 'categories.*' => 'integer',
            'is_premium' => 'required|in:0,1',
            'description' => 'required|string|max:200',
            'blog_content' => 'nullable|string',
            'file' => 'nullable|file|mimes:mp4,mkv,avi|max:10240',
            'status' => 'required|in:1,2', 
        ]);

        // dd($request->all());

        // dd('dnsa');

        $data = [
            'posted_by' => auth()->id(),
            'title' => $request->title,
            'blog_type' => $request->blog_type,
            'category_ids' => json_encode($request->categories),
            'is_premium' => $request->is_premium,
            'description' => $request->description,
            'blog_content' => $request->blog_content,
            'is_active' => 1,
            'total_likes' => 0,
            'total_comments' => 0,
            'total_views' => 0,
            'status' => $request->input('status'), 
            'created_datetime' => now(),
            'updated_datetime' => now(),
        ];


        
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('videos', $filename, 'public');
            $data['media'] = json_encode(['path' => $path]);
        } else {
            $data['media'] = json_encode([]);
        }
        DB::table('blogs')->insert($data);




        return redirect()->back()->with('success', 'Blog saved successfully!');
    }




    public function blogsDetails()
    {
        $blogDetails = Blog::showBlog();
        return view('Blogs.blogs')
            ->with('blogDetails', $blogDetails);
    }

    public function destroy($id)
    {
        Blog::deleteBlog($id);
        return redirect()->route('blogs')->with('success', 'Blog deleted successfully!');
    }

    public function blogCardShow($id)
    {
        // dd($id);
        // $blog = Blog::findBlogById($id);

        //    $blog= DB::table('blogs')
        //             ->select(
        //                 'title',
        //                 'blog_id',
        //                 'posted_by',
        //                 'category_ids',
        //                 'description',
        //                 'blog_content',
        //                 'updated_datetime'
        //             )
        //             ->where('blog_id',$id)
        //             ->first();
        $blog = DB::table('blogs')->first();

        // dd($blog);

        // dd($blog);
        return view('Blogs.edit')->with('blog', $blog);
    }

    public function approve($id)
    {
        DB::table('blogs')
            ->where('blog_id', $id)
            ->update(['status' => 3, 'updated_datetime' => now()]); // Approved

        return redirect()->route('pending.blogs')->with('success', 'Blog approved successfully.');
    }

    public function reject($id)
    {
        DB::table('blogs')
            ->where('blog_id', $id)
            ->update(['status' => 4, 'updated_datetime' => now()]); // Denied

        return redirect()->route('pending.blogs')->with('error', 'Blog denied.');
    }

    public function pendingBlogs()
    {
        // Fetch all blogs with status 'Submitted'
        $blogs = DB::table('blogs')
            ->where('status', 2)
            ->get();

        return view('admin.blogs_pending')->with('blogs', $blogs);
    }


}
