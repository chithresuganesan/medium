
@extends('layouts.myapp')

@section('navbar')
  @include('comman.navbar-items')
@endsection

@yield('sidebar')

@section('content')

  <div class="container">
      <div class="row justify-content-center pt-5">
          <div class="col-md-3">
              <div class="card text-center">
                  <div class="card-header">Your Post</div>
                  <div class="card-body">
                    <h2>03</h2>
                  </div>
              </div>
          </div>
          <div class="col-md-3">
              <div class="card text-center">
                  <div class="card-header">Comments</div>
                  <div class="card-body">
                    <h2>03</h2>
                  </div>
              </div>
          </div>
          <div class="col-md-3">
              <div class="card text-center">
                  <div class="card-header">Likes</div>
                  <div class="card-body">
                    <h2>03</h2>
                  </div>
              </div>
          </div>
      </div>


  </div>
  @endsection
