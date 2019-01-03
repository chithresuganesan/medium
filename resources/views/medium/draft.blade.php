
@extends('layouts.myapp')

@section('navbar')
  @include('comman.navbar-items')
@endsection

@yield('sidebar')


@section('content')
  <div class="container">
      <div class="row justify-content-center pt-5">
          <div class="col-md-12">
            @yield('adminlink')
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
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse ($posts as $index => $post)
                          <tr>
                            <th>{{ $index + 1 }}</th>
                            <th>{{ $post->category->category }}</th>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->user->name }}</td>
                            <td>
                            <a href="{{ route('post.activePublish', ['post' => $post->id ]) }}" class="btn btn-success btn-sm">Publish</a>
                            </td>
                          </tr>
                        {{-- @empty ($posts)
                      @endempty --}}
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

  @endsection
