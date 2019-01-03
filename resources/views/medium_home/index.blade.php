@extends('layouts.myapp')



@section('search')
  <div class="input-group">
   <input  type="text" id="search-data" name="searchData" placeholder="Search for Blog Title" onkeypress="searchData()" class="form-control" autocomplete="off" />
 </div>
</br>
</br>
 <div style="position:absolute;top: 50px;z-index:999;width:616px;" id="search-result">
  </div>
@endsection

@section('navbar')
  @include('comman.navbar-items')
@endsection


@section('content')
<div class="container">
    <div class="row  pt-5">
        <div class="col-md-9">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/">
                 All
                {{-- ({{ count($categories) }}) --}}
              </a>
              </li>
               @foreach ($posts->unique('category_id') as $key => $post)
              <li class="breadcrumb-item">

                <a href="{{ route('post.postview', ['category' => $post->category->id]) }}">{{ $post->category->category }}
                   {{-- ({{ count($category->posts) }}) --}}
                 </a>
              </li>
            @endforeach
            </ol>
          </nav>

          @forelse ($posts as $key => $post)
            <div class="card">
              @if ($post->caption_type == "image")
                <img class="card-img-top" src="data:image/jpeg;base64,{{ base64_encode(\Storage::get($post->caption_path)) }}" alt="Card image cap">
              @elseif ($post->caption_type == "video")
                 <div class="embed-responsive embed-responsive-21by9">
                   <video controls="true">
                     <source src="{{ $post->caption_path }}" type="video/mp4" />
                   </video>
              </div>

              @endif
              <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <blockquote class="blockquote mb-0">
                 <footer class="blockquote-footer">Posted by <cite title="Source Title">
                   <a href="?author={{ $post->user->id }}">{{ ucfirst($post->user->name) }}</a>
                 </cite></footer>
               </blockquote>
                <p class="card-text">{{ str_limit($post->description, 200) }}</p>
                <a href="{{ route('post.viewpost', ['post' => $post])}}" class="btn btn-primary">Read More...</a>


              </div>

              <div class="card-footer pt-1 pb-1">
               <small class="text-muted">Last updated {{ $post->updated_at->diffForHumans()}}</small>
               <div class="float-right">
               <i class="material-icons text-muted"> thumb_up_alt</i><small class="text-muted">
                 @php
                  $like = 0;
                 foreach ($post->likes as $key => $value){
                     if($value->status == 1) {
                       $like += $value->status;
                       echo "1";
                     }
                   }
                @endphp
               </small>
           </div>
             </div>
            </div><br>
          @empty
             <h5 class="card-title">No Blog</h5>
          @endforelse
        </div>

        <div class="col-md-3">
          <li class="list-group-item"><strong>Recent Post</strong></li>
          @foreach ($recents as $key => $recent)
         <li class="list-group-item d-flex justify-content-between align-items-center">
           <a href="?filterpost={{ $recent->id }}">{{ $recent->title }}</a>
         </li>
         @endforeach
          <br>
         <li class="list-group-item"><strong>Sorted By</strong></li>
       <li class="list-group-item d-flex justify-content-between align-items-center">
         <a href="?sortby=asc">A-Z</a>
         <a href="?sortby=desc">Z-A</a>
       </li>
        <br>
        {{-- {{ $post->viewcount->max('count') }} --}}

        <li class="list-group-item"><strong>Popular Post</strong></li>
        @foreach ($populars as $key => $popular)
       <li class="list-group-item d-flex justify-content-between align-items-center">
         <a href="?filterpost={{ $popular->id }}">{{ $popular->title }}</a>
       </li>
       @endforeach

        </div>

    </div>
</div>
@endsection
