
@extends('layouts.myapp')

@section('navbar')
  @include('comman.navbar-items')
@endsection

@yield('sidebar')

@section('content')
  <div class="container">
      <div class="row justify-content-center pt-5">
          <div class="col-md-12">
            @if(auth()->user()->role == 'admin')
            @yield('adminlink')
            @endif
            <br><br>
              <div class="card">
                  {{-- <div class="card-header">{{ __('Create Post') }}</div> --}}

                  <div class="card-body p-0">
                    <table class="table table-striped mb-0">
                      <thead class="thead-dark">
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Category</th>
                          <th scope="col">Post Title</th>
                          <th scope="col">Post Author</th>
                          <th scope="col">Status</th>
                          <th scope="col">Post On</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse ($posts as $index => $post)
                          <tr>
                            <th>{{ $index + 1 }}</th>
                            <th>{{ $post->category->category }}</th>
                            <td>{{ str_limit($post->title, 40) }}</td>
                            <td>{{ $post->user->name }}</td>
                            <td>
                              <span class="badge {{$post->status == 'pending' ? 'badge-warning' : 'badge-success' }}">
                                {{ ucfirst($post->status) }}
                              </span>
                              </td>
                            <td>{{ $post->created_at->format('M d - Y') }}</td>
                            <td>

                            @if ($post->user->id == auth()->user()->id)
                              <a href="{{ route('post.edit', ['post' => $post])}}" class="btn btn-info btn-sm">Edit</a> |
                              <a href="{{ route('post.destroy', ['post' => $post])}}" class="btn btn-danger btn-sm">Delete</a>
                             @else

                                <a href="{{ route('post.activePublish', ['post' => $post->id ]) }}" class="btn btn-success btn-sm">Publish</a> |
                                <a href="{{ route('post.draftPublish', ['post' => $post->id ]) }}" class="btn btn-danger btn-sm">Draft</a>

                              @endif
                            </td>
                          @empty
                          <td colspan="10" class="text-center">No Blog</td>
                          @endforelse
                      </tbody>
                    </table>
                  </div>
              </div>
          </div>
      </div>
  </div>

  @push('scripts')
    <script type="text/javascript">

    $("#caption_type").on('change', function () {
    alert($(this).val());
     });

    </script>
  @endpush
  @endsection
