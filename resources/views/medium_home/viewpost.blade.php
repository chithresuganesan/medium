@extends('layouts.myapp')


@section('navbar')
  @include('comman.navbar-items')
@endsection

@push('styles')
<style media="screen">
  .material-icons {
    font-size: 40px;
    margin-left: 12px;
    cursor: pointer;
  }
</style>
@endpush
@section('content')


@include('comman.shared')

<div class="container">

    <div class="row justify-content-center pt-5">
        <div class="col-md-10">
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
                   <a href="#">{{ ucfirst($post->user->name) }}</a>
                 </cite></footer>
               </blockquote>
                <p class="card-text">{{ $post->description }}</p>
               <h5 class="card-title text-info">Comments</h5>
            <form class="" action="{{ route('post.viewcomment',['comment' => $post]) }}" method="post">
              @csrf()
              <div class="form-group">

               <textarea class="form-control" name="comment" id="exampleFormControlTextarea1" placeholder="Give on your Comments........" rows="3"></textarea>
             </div>
             <div class="form-group row mb-0">
                 <div class="col-md-6 offset-md-5">
                     <button type="submit" class="btn btn-primary">
                         {{ __('Submit') }}
                     </button>
                 </div>
             </div>
            </form>
            @forelse ($post->comments as  $comment)
              <div class="card-body p-0">
                <h6 class="card-title">{{ ucfirst($comment->user->name) }}</h6>
                <p class="card-text">{{ ucfirst($comment->comment) }}</p>
              </div><hr>
            @empty
          <p class="card-text">No Comments</p>
            @endforelse
              </div>
            </div><br>

        </div>
    </div>
</div>

<!-- Model -->

<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Login</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>

      <div class="modal-body">
        <iframe src="{{ route('login') }}" id="info" frameBorder="0" class="iframe" name="info" height="444px" width="100%"></iframe>
      </div>

    </div>
  </div>
</div>


@endsection

@push('scripts')
  <script>
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('#bookmark').click(function() {
$.ajax({
    url: '{{ route('post.bookmark') }}',
    type: 'POST',
    data: {
      'post_id' : '{{ $post->id }}' },
    dataType: 'JSON',
    success: function (data) {
      if(data['status'] == 1) {
        $('#bookmark').html('bookmark');
        $('#bookmark').addClass('text-danger');
        $('#bookmark').removeClass('text-muted');
      }
      else {
        $('#bookmark').addClass('text-muted');
        $('#bookmark').removeClass('text-danger');
        $('#bookmark').html('bookmark_border');
      }
    }
});
});

$('#follow').click(function() {
$.ajax({
    url: '{{ route('post.follow') }}',
    type: 'POST',
    data: {
      'post_id' : '{{ $post->id }}', 'followers_id' : '{{ $post->user_id }}' },
    dataType: 'JSON',
    success: function (data) {
      if(data['status'] == 1) {
        $('#follow').html('people');
        $('#follow').addClass('text-danger');
        $('#follow').removeClass('text-muted');
      }
      else {
        $('#follow').removeClass('text-danger');
        $('#follow').addClass('text-muted');
        $('#follow').html('people_outline');
      }
    }
});
});

$('#checkbox').click(function() {

$.ajax({
    url: '{{ route('post.like') }}',
    type: 'POST',
    data: {
      'post_id' : '{{ $post->id }}' },
    dataType: 'JSON',
    success: function (data) {
      if(data['status'] == 1) {
        $('#checkbox').html('UnLike');
        $('#checkbox').removeClass('btn-success');
        $('#checkbox').addClass('btn-info');
      }
      else {
        $('#checkbox').addClass('btn-success');
        $('#checkbox').removeClass('btn-info');
        $('#checkbox').html('Like');
      }
    }
});
});

  </script>
@endpush
