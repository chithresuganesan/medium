
$.ajaxSetup({
  headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

// Bookmark

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

// Followed
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


// like
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
