@extends('admin.layout.master')
@section('title')
Create Product
@endsection
@section('content')
<div class="row justify-content-center">
  <div class="col-lg-10 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Create Product</h4>
        <form class="cmxform" id="signupForm" method="post" action="" enctype="multipart/form-data">
         @csrf
          <fieldset>
            <div class="form-group">
              <label>Select Product Category </label>
              <select name="category_id"  id="category_id" class="form-control">
                  <option selected disabled>Select</option>
                  @foreach ($categories as $category)
                  <option value="{{$category->id}}">{{$category->name}}</option>
                  @endforeach
              </select>
              @if ($errors->has('category_id'))
                  <span class="help-block">
                      <strong>{{ $errors->first('category_id') }}</strong>
                  </span>
              @endif
            </div>
            <div class="form-group">
              <label for="name">Name</label>
              <input id="name" class="form-control @error('name') is-invalid @enderror" name="name" autocomplete="off" placeholder="Name" value="{{ old('name') }}" type="text">
               @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
              <label for="slug">Slug</label>
              <input id="slug" class="form-control @error('slug') is-invalid @enderror" name="slug" autocomplete="off" placeholder="Slug" value="{{ old('slug') }}" type="text">
               @error('slug')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label>Product Quantity</label>
                <input type="number" name="quantity" class="form-control">
            </div>
            <div class="form-group">
                <label>Product Price</label>
                <input type="number" name="price" class="form-control">
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control" id="description"  required></textarea>
            </div>
            <div class="form-group">
                <label>Details</label>
                <textarea name="details" class="form-control" id="details"  required></textarea>
            </div>
            <div class="form-group">
                <label>Product Discount</label>
                <input type="number" name="percent_off" class="form-control">
            </div>~
            <div class="form-group">
                <label>Product Weight</label>
                <input type="number" name="weight" class="form-control">
            </div>
            <div class="form-group colorpicker colorpicker-component">
                <input type="text" value="#00AABB" class="form-control" /> 
                <span class="input-group-addon"><i></i></span>
                @if($errors->has('color'))
                    <p class="help-block">
                        {{ $errors->first('color') }}
                    </p>
                @endif
            </div>
            <div class="form-group">
                <label>Product Status </label>
                <select name="status"  id="type" class="form-control">
                    <option  disabled selected>Select</option>
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
            </div>
            <div class="form-group">
                <label>Product Type</label>
                <select name="type"  id="type" class="form-control">
                    <option  disabled selected>Select</option>
                    <option value="New">New</option>
                    <option value="Featured">Featured</option>
                </select>
            </div>
            <input class="btn btn-primary" type="submit" value="Submit">
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection