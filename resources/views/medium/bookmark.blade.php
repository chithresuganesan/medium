
@extends('layouts.myapp')

@section('navbar')
  @include('comman.navbar-items')
@endsection
@yield('sidebar')

@section('content')
  <div class="container">
      <div class="row justify-content-center pt-5">
          <div class="col-md-12">
            <br><br>
              <div class="card">
                  <div class="card-body p-0">
                    <table class="table table-striped mb-0">
                      <thead class="thead-dark">
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Post Title</th>
                          <th scope="col">Post Author</th>
                          <th scope="col">Status</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse ($bookmarks as $index => $bookmark)
                          <tr>
                            <th>{{ $index + 1 }}</th>
                            <td>{{ $bookmark->post->title }}</td>
                            <td>{{ $bookmark->user->name }}</td>
                              <td>
                                <span class="badge {{$bookmark->status == 1 ? 'badge-success' : 'badge-info' }}">
                                  {{ $bookmark->status == 1 ? 'Bookmarked now' : 'UnBookmark' }}
                                </span>
                              </td>
                              <td>
                                <a href="{{ route('post.viewpost', ['post' => $bookmark->post_id ]) }}" class="btn btn-info btn-sm">View</a>
                                 |
                                 <a href="{{ route('post.draftbookmark', ['bookmark' => $bookmark->id ]) }}" class="btn btn-danger btn-sm">Remove</a>

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

  @endsection
