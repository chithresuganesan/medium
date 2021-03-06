
@extends('layouts.myapp')

@section('navbar')
  @include('comman.navbar-items')
@endsection

@yield('sidebar')


@section('content')
  <div class="container">
      <div class="row justify-content-center pt-5">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">{{ __('Update Post') }}</div>

                  <div class="card-body">
                      <form method="POST" action="{{ route('post.update', ['post' => $editpost]) }}">
                          @csrf
                          <div class="form-group row">
                              <label for="category" class="col-sm-4 col-form-label text-md-right">{{ __('Category') }}</label>

                              <div class="col-md-4">
                                <select class="form-control" name="category_id">
                                  @foreach ($categories as $key => $category)
                                    <option value="{{ $category->id }}" {{
                                    $editpost->category->id == $category->id ? 'selected' : '' }} >{{ $category->category }}</option>
                                  @endforeach
                                </select>
                                  @if ($errors->has('category'))
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('category') }}</strong>
                                      </span>
                                  @endif
                              </div>
                              <button type="button" data-backdrop="static" class="btn btn-primary" data-toggle="modal" data-target="#addCategory" >Add Category</button>
                          </div>

                          <div class="form-group row">
                              <label for="title" class="col-md-4 col-form-label text-md-right">Post Title</label>

                              <div class="col-md-6">
                                  <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ $editpost->title }}" required>

                                  @if ($errors->has('title'))
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('title') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="title" class="col-md-4 col-form-label text-md-right">Post Caption</label>
                              <div class="col-md-6">
                                <select id="caption_type" class="form-control" name="caption_type">
                                  <option value="">No Caption</option>
                                  <option {{ $editpost->caption_type=="image" ? 'selected' : '' }} value="image">Image</option>
                                  <option {{ $editpost->caption_type=="video" ? 'selected' : '' }} value="video">Video</option>
                                </select>
                              </div>
                          </div>


                          <div class="form-group row">
                              <label for="image" class="col-md-4 col-form-label text-md-right">Post Image</label>

                              <div class="col-md-6">
                          <input type="file" class="form-control" name="caption_path">
                              </div>
                          </div>


                          <div class="form-group row">
                          <label for="caption_path" class="col-md-4 col-form-label text-md-right">Video Url</label>
                              <div class="col-md-6">
                          <input type="text" class="form-control" name="caption_path" value="{{ $editpost->caption_type == "video" ?  $editpost->caption_path   : '' }}">
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="title" class="col-md-4 col-form-label text-md-right">Post Description</label>

                              <div class="col-md-6">
                            <textarea name="description" rows="5" cols="80" class="form-control">{{ $editpost->description }}</textarea>
                              </div>
                          </div>

                          <div class="form-group row mb-0">
                              <div class="col-md-8 offset-md-4">
                                  <button type="submit" class="btn btn-primary">
                                    Create Post
                                  </button>
                              </div>
                          </div>
                      </form>

        <div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="addCategorylabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addCategorylabel">Add New Category</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="" action="{{ route('post.addcategory') }}" method="post">
                    @csrf()
                <div class="form-group">
                  <label for="newcategory" class="col-form-label">Category:</label>
                  <input type="text" class="form-control" name="new_category" id="newcategory">
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Create</button>
            </div>
          </div>
        </form>
        </div>
      </div>
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
