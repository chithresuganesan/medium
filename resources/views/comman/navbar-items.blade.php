

<nav class="navbar navbar-expand-md navbar-light bg-white navbar-border">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">
          Blog Application
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav pl-5 col-md-6">
             @yield('search')
            </ul>

            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                        @if (Route::has('register'))
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="{{ route('post.index') }}">
                              Dashboard
                          </a>
                          <a class="dropdown-item" href="{{ route('changepassword') }}">
                              Change Password
                          </a>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
@section('sidebar')
<div class="sidebar">
  <ul class="list-group">
    <li class="list-group-item border-0">
      <a href="{{ route('post.index')}}"><i class="material-icons text-muted" data-toggle="tooltip" data-placement="right" title="Dashboard" >
      dashboard</i>
    </a>
    </li>
    <li class="list-group-item border-right-0">
      <a href="{{ route('post.create')}}"><i class="material-icons text-muted" data-toggle="tooltip" data-placement="right" title="Create" >
      create</i>
    </a>
  </li>

  <li class="list-group-item border-right-0">
    <a href="{{ route('post.mypost')}}"><i class="material-icons text-muted" data-toggle="tooltip" data-placement="right" title="Post" >
    list</i>
  </a>
  </li>


  <li class="list-group-item border-right-0">
    <a href="{{ route('post.mybookmark') }}"><i class="material-icons text-muted" data-toggle="tooltip" data-placement="right" title="Bookmarked" >
    bookmark</i>
  </a>
  </li>

    <li class="list-group-item border-right-0">
      <a href="{{ route('post.myfollows') }}"><i class="material-icons text-muted" data-toggle="tooltip" data-placement="right" title="Followers" >
      how_to_reg</i>
    </a>
    </li>


  </ul>
</div>
@endsection

@section('adminlink')
<a href="{{ route('post.show') }}" class="btn btn-secondary btn-sm">All</a>
<a href="{{ route('post.mypost') }}" class="btn btn-warning btn-sm">My Post </a>
<a href="{{ route('post.pending') }}" class="btn btn-info btn-sm">Pending</a>
<a href="{{ route('post.published')}}" class="btn btn-success btn-sm">Published</a>
<a href="{{ route('post.draft') }}" class="btn btn-danger btn-sm">Draft</a>
@endsection

@push('scripts')
  <script>
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
    function searchData(e) {
      var data = $('#search-data').val();
      if(!data){
        $('#search-result').html(""); 
      }
      $.ajax({
        type : "POST",
        url : "{{ route('post.searchajax') }}",
        data : { 'postdata' : data },
        success : function(response){
        document.getElementById('search-result').innerHTML=response;
        }
      });
    }
  </script>
@endpush
