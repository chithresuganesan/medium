<?php

namespace App\Http\Controllers\Medium;

use App\Category;
use App\Post;
use App\Comment;
use App\Viewcount;
use App\Bookmark;
use App\Like;
use App\Follow;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{

  // public function __construct()
  // {
  //     $this->middleware('auth');
  // }

    public function index()
    {
        $type = app('request');

        return Like::select('status')->with('post')->groupBy('status')->get();

        $subOneWeek=Carbon::now()->subWeek();
        $categories = Category::get();

        $recents = Post::where('updated_at', '>', $subOneWeek)->where('status', 'publish')->get();


        //
        // $popular = \DB::table('posts')
        //     ->join('viewcounts', 'posts.id', '=', 'viewcounts.post_id')
        //     ->join('likes', 'posts.id', '=', 'likes.post_id')
        //     ->select('viewcounts.count', 'likes.post_id')
        //     ->withCount('count');
        $maxcount = Viewcount::whereRaw('count = (select max(`count`) from viewcounts)')->first();

        $populars = Post::where('id', isset($maxcount->post_id))->where('status', 'publish')->get();


        if(isset($type)) {
          $posts = Post::where('status', 'publish');
        }

        if($type->category) {
          $posts = Post::where('category_id', $type->category);
        }

        if($type->author) {
          $posts = Post::where('user_id', $type->author);
        }

        if($type->filterpost) {
          $posts = Post::where('id', $type->filterpost);
        }

        if($type->sortby == 'asc' || $type->sortby == 'desc' ) {
          $posts = Post::orderBy('id', $type->sortby);
        }

        $posts = $posts->where('status', 'publish')->paginate(10);
        return view('medium_home.index', [
          'posts' => $posts,
          'categories' => $categories,
          'recents' => $recents,
          'populars' => $populars
        ]);
    }

    public function viewpost(Post $post)
    {
      $viewcount = Viewcount::firstOrCreate(
        ['post_id' => $post->id],
        ['count' => 1])->increment('count', 1);

      if(isset(auth()->user()->id)){
      $bookmark_status = optional(Bookmark::where('user_id', auth()->user()->id)
      ->where('post_id', $post->id)->first())->status;

      $like_status =  optional(Like::where('user_id', auth()->user()->id)
      ->where('post_id', $post->id)->first())->status;

      $follow_status =  optional(Follow::where('user_id', auth()->user()->id)
      ->where('post_id', $post->id)->first())->status;

      return view('medium_home.viewpost', [
        'post' => $post,
        'bookmark_status' => $bookmark_status,
        'like_status' => $like_status,
        'follow_status' => $follow_status,
      ]);

    }
       return view('medium_home.viewpost', [
         'post' => $post,
       ]);
    }

    public function viewcomment(Request $request, Post $post)
    {
       $comment = new Comment;
       $comment->user_id = 1;
       $comment->post_id = $post->id;
       $comment->comment = $request->comment;
       $comment->save();
       return back();
    }

    public function bookmark(Request $request)
    {
      $value = optional(Bookmark::where('user_id', auth()->user()->id)
      ->where('post_id', $request->post_id)->first());

      $bookmark = Bookmark::updateOrCreate(
        ['post_id' => $request->post_id, 'user_id' => auth()->user()->id],
        ['status' => $value->status == 1 ? 0 : 1]);
        return response()->json(['status' => $bookmark->status]);
    }


    public function like(Request $request)
    {
        $value = optional(Like::where('user_id', auth()->user()->id)
        ->where('post_id', $request->post_id)->first());

        $like = Like::updateOrCreate(
        ['post_id' => $request->post_id, 'user_id' => auth()->user()->id],
        ['status' => $value->status == 1 ? 0 : 1]);
        return response()->json(['status' => $like->status]);
    }

    public function follows(Request $request)
    {
        $value = optional(Follow::where('user_id', auth()->user()->id)
        ->where('post_id', $request->post_id)->first());

        $follow = Follow::updateOrCreate(
        ['post_id' => $request->post_id, 'user_id' => auth()->user()->id, 'followers_id' => $request->followers_id],
        ['status' => $value->status == 1 ? 0 : 1]);
        return response()->json(['status' => $follow->status]);
    }

    public function searchajax(Request $request)
    {
        $filters = Post::where('status', 'publish')->where('title', 'like', '%' . $request->postdata . '%')->get();
        return view('comman.searchajax', ['filters' => $filters]);
    }
}
