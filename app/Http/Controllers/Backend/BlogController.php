<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\Blog;
use App\Models\Blog_category;
use App\Models\Blog_tag;
use App\Models\Comment;
use App\Models\ImagePreset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\ImageGenTrait;
use Carbon\Carbon;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $path = "upload/blog/thumbnail/";
    public $image_preset;
    public $image_preset_main;
    use ImageGenTrait;
    public function __construct()
    {
        $this->image_preset = ImagePreset::whereIn('id', [4])->get();
        $this->image_preset_main = ImagePreset::find(11);
    }
    public function index()
    {
        $blog = Blog::latest()->get();
        return view('backend.post.all_post', compact('blog'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $blog_cat = Blog_category::pluck('category_name', 'id');
        $post_tags = Blog_tag::pluck('tag_name', 'id');
        return view('backend.post.add_post', compact('blog_cat', 'post_tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'post_title' => 'required|unique:blogs|max:200',
        ]);
        $post_tag = $request->post_tags;
        $post_tags = implode(",", $post_tag);
        $image = $request->file('post_image');
        $save_url = $this->imageGenrator($image, $this->image_preset_main, $this->image_preset, $this->path);

        Blog::insert([
            'blogcat_id' => $request->blogcat_id,
            'user_id' => Auth::user()->id,
            'post_title' => $request->post_title,
            'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
            'post_image' =>  $save_url,
            'short_descp' => $request->short_descp,
            'long_descp' => $request->long_descp,
            'post_tags' => $post_tags,
        ]);
        $notification = array(
            'message' => 'Blog Added Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        $blog_cat = Blog_category::pluck('category_name', 'id');
        $post_tags = Blog_tag::pluck('tag_name', 'id');
        return view('backend.post.edit_post', compact('blog', 'blog_cat', 'post_tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'post_title' => 'required|max:200',
        ]);
        $post_tag = $request->post_tags;
        $post_tags = implode(",", $post_tag);
        $image = $request->file('post_image');
        $save_url = $this->imageGenrator($image, $this->image_preset_main, $this->image_preset, $this->path);

        $blog->update([
            'blogcat_id' => $request->blogcat_id,
            'post_title' => $request->post_title,
            'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
            'post_image' =>  $save_url,
            'short_descp' => $request->short_descp,
            'long_descp' => $request->long_descp,
            'post_tags' => $post_tags,

        ]);
        $notification = array(
            'message' => 'Blog Category Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        $img = explode('.', $blog->post_image);
        $small_img = $img[0] . "_thumb." . $img[1];
        if (file_exists($blog->post_image)) {
            unlink($blog->post_image);
        }
        if (file_exists($small_img)) {
            unlink($small_img);
        }
        $notification = array(
            'message' => 'Blog Deleted successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
    public function BlogDetails($slug)
    {

        $blog = Blog::where('post_slug', $slug)->first();
        $tags = $blog->post_tags;
        $tags_all = explode(',', $tags);

        $bcategory = Blog_category::latest()->get();
        $dpost = Blog::latest()->limit(3)->get();

        return view('frontend.blog.blog_details', compact('blog', 'tags_all', 'bcategory', 'dpost'));
    } // End Method

    public function BlogCatList($id)
    {

        $blog = Blog::where('blogcat_id', $id)->paginate(3);
        $breadcat = Blog_category::where('id', $id)->first();
        $bcategory = Blog_category::latest()->get();
        $dpost = Blog::latest()->limit(3)->get();

        return view('frontend.blog.blog_cat_list', compact('blog', 'breadcat', 'bcategory', 'dpost'));
    } // End Method
    public function BlogList()
    {

        $blog = Blog::latest()->get();
        $bcategory = Blog_category::latest()->get();
        $dpost = Blog::latest()->limit(3)->get();

        return view('frontend.blog.blog_list', compact('blog', 'bcategory', 'dpost'));
    } // End Method
    public function StoreComment(Request $request)
    {

        $pid = $request->post_id;

        Comment::insert([
            'user_id' => Auth::user()->id,
            'post_id' => $pid,
            'parent_id' => null,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Comment Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method

    public function AdminBlogComment()
    {

        $comment = Comment::where('parent_id', null)->latest()->get();
        return view('backend.comment.comment_all', compact('comment'));
    } // End Method
    public function AdminCommentReply($id)
    {

        $comment = Comment::where('id', $id)->first();
        return view('backend.comment.reply_comment', compact('comment'));
    } // End Method

    public function ReplyMessage(Request $request)
    {

        $id = $request->id;
        $user_id = $request->user_id;
        $post_id = $request->post_id;

        Comment::insert([
            'user_id' => $user_id,
            'post_id' => $post_id,
            'parent_id' => $id,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Reply Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method
}
