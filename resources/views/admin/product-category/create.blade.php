@extends('admin.layout.master')
@section('title')
Create Product Category
@endsection
@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/admin/productcategories') }}">Back</a></li>
    <li class="breadcrumb-item active" aria-current="page">Create Product Category</li>
  </ol>
</nav>
<div class="row justify-content-center">
  <div class="col-lg-10 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Create Product Category</h4>
        <form class="cmxform" id="signupForm" method="post" action="{{ route('productcategories.store') }}" enctype="multipart/form-data">
         @csrf
          <fieldset>
            <div class="form-group">
              <label for="name">Name</label>
              <input id="name" class="form-control @error('name') is-invalid @enderror first" name="name" autocomplete="off" placeholder="Name" value="{{ old('name') }}" type="text">
               @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
              <label for="icon">Icon Name</label>
              <input id="icon" class="form-control @error('icon') is-invalid @enderror first" name="icon" autocomplete="off" placeholder="Icon Name" value="{{ old('icon') }}" type="text">
               @error('icon')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
              <label for="slug">Slug</label>
              <input id="slug" class="form-control @error('slug') is-invalid @enderror second" name="slug" autocomplete="off" placeholder="Slug" value="{{ old('slug') }}" type="text">
               @error('slug')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
              <label for="image">Image</label>
              <input id="image" class="form-control @error('image') is-invalid @enderror" name="image" autocomplete="off" type="file">
                @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <input class="btn btn-primary" type="submit" value="Submit">
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('other-scripts')
<script>
  $(".first").on('keyup',function(){
    $(".second").val($(this).val());
});
</script>
@endpush