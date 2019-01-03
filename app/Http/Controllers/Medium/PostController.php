<?php

namespace App\Http\Controllers\Medium;

use App\Category;
use App\Post;
use App\Bookmark;
use App\Like;
use App\Follow;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index()
    {
      return view('medium.index');
    }

    public function addcategory(Request $request)
    {

       $category = New Category;
       $category->category = $request->new_category;
       $category->save();
       return back();
    }

    public function create()
    {
      $categories = Category::get();
      return view('medium.create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
       $post = new Post;
       $post->user_id = auth()->user()->id;
       $post->category_id = $request->category_id;
       $post->title = $request->title;
       $post->caption_type = $request->caption_type;
       if($request->caption_type == 'image') {
         if($request->hasFile('caption_path')) {
           $post->caption_path = $request->caption_path->store('images');
         }
       }
       else {
         $post->caption_path = $request->caption_path;
       }
       $post->description = $request->description;
       $post->status = 'pending';
       $post->save();
       return redirect()->route('post.show');
    }

    public function showtable()
    {
      $posts = Post::get();
      return view('medium.showtable', ['posts' => $posts]);
    }

    public function edit(Post $post)
    {
        $categories = Category::get();
       return  view('medium.edit',
       ['editpost'=> $post],
       ['categories'=> $categories]
     );
    }

    public function update(Request $request, Post $post)
    {

      $post->category_id = $request->category_id;
      $post->title = $request->title;
      $post->caption_type = $request->caption_type;
      if($request->caption_type == 'image') {
        if($request->hasFile('caption_path')) {
          $post->caption_path = $request->caption_path->storeAs('images');
        }
      }
      else {
        $post->caption_path = $request->caption_path;
      }
      $post->description = $request->description;
      $post->save();
      return redirect()->back();
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return back();
    }

    public function pending()
    {
      $posts = Post::where('status', 'pending')->get();
      return view('medium.pending', ['posts' => $posts]);
    }

    public function published()
    {
       $posts = Post::where('status', 'publish')->get();
       return view('medium.published', ['posts' => $posts]);
    }

    public function draft()
    {
      $posts = Post::where('status', 'draft')->get();
      return view('medium.draft', ['posts' => $posts]);
    }

    public function mypost()
    {
      $posts = Post::where('user_id', auth()->user()->id)->get();
      return view('medium.mypost', ['posts' => $posts]);
    }

    public function mybookmark()
    {
      $bookmarks = Bookmark::where('user_id', auth()->user()->id)->get();
      return view('medium.bookmark', ['bookmarks' => $bookmarks]);
    }

    public function myfollow()
    {
      $follows = Follow::where('user_id', auth()->user()->id)->get();
      return view('medium.followers', ['follows' => $follows]);
    }

    public function draftbookmark(Bookmark $bookmark)
    {
        $bookmark->delete();
        return back();
    }
    public function draftfollow(Follow $follow)
    {
        $follow->delete();
        return back();
    }

    public function activePublish(Post $post)
    {
      $post->status = 'publish';
      $post->save();
      return back();
    }

    public function draftPublish(Post $post)
    {
      $post->status = 'draft';
      $post->save();
      return back();
    }

    public function pendingPublish(Post $post)
    {
      $post->status = 'pending';
      $post->save();
      return back();
    }


    // public function allcount()
    // {
    //   $pendingcount = Post::where('status', 'pending')->count();
    //   $publishcount = Post::where('status', 'published')->count();
    //   $draftcount = Post::where('status', 'draft')->count();
    //   $mycount = Post::where('user_id', auth()->user()->id)->count();
    //   return view('comman.adminlink', [
    //     'pending_count' => $pendingcount,
    //     'publish_count' => $publishcount,
    //     'draft_count' => $draftcount,
    //     'my_count' => $mycount,
    //   ]);
    // }
}
