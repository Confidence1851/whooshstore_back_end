@extends('admin.layout.master')
@section('title')
Create Product
@endsection
@push('plugin-styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/simplemde/simplemde.min.css') }}">
  {{-- {!! Html::style('/') !!} --}}
@endpush
@section('content')
<div class="row justify-content-center">
  <div class="col-lg-10 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Create Product Category</h4>
        <form class="cmxform" id="signupForm" method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
         @csrf
          <fieldset>
            <div class="form-group">
              <label for="name">Product Name</label>
              <input id="name" class="form-control @error('name') is-invalid @enderror first" name="name" autocomplete="off" placeholder="Name" value="{{ old('name') }}" type="text">
               @error('name')
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
              <label>Select Product Category </label>
              <select name="category_id"  id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                  @foreach ($categories as $category)
                  <option value="{{$category->id}}">{{$category->name}}</option>
                  @endforeach
              </select>
              @error('category_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="percent_off">Sku</label>
                  <input id="sku" class="form-control @error('sku') is-invalid @enderror first" name="sku" autocomplete="off" placeholder="sku" value="{{ old('sku') }}" type="text">
                   @error('sku')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="quantity">Product Quantity</label>
                  <input id="quantity" class="form-control @error('quantity') is-invalid @enderror first" name="quantity" autocomplete="off" placeholder="quantity" value="{{ old('quantity') }}" type="number">
                   @error('quantity')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="price">Product Price</label>
              <input id="price" class="form-control @error('price') is-invalid @enderror first" name="price" autocomplete="off" placeholder="price" value="{{ old('price') }}" type="number">
               @error('price')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="percent_off">Percent Off(optional)</label>
                  <input id="percent_off" class="form-control @error('percent_off') is-invalid @enderror first" name="percent_off" autocomplete="off" placeholder="percent_off" value="{{ old('percent_off') }}" type="number">
                   @error('percent_off')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="weight">Product Weight(optional)</label>
                  <input id="weight" class="form-control @error('weight') is-invalid @enderror first" name="weight" autocomplete="off" placeholder="weight" value="{{ old('weight') }}" type="number">
                   @error('weight')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="color">Colour(optional)</label>
              <input id="color" class="form-control @error('color') is-invalid @enderror first" name="color" autocomplete="off" placeholder="color" value="{{ old('color') }}" type="text">
               @error('color')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="tags">Tags(optional)</label>
                  <input id="tags" class="form-control @error('tags') is-invalid @enderror first" name="tags" autocomplete="off" placeholder="tags" value="{{ old('tags') }}" type="text">
                   @error('tags')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="details">DetailsProduct details(optional)</label>
                  <input id="details" class="form-control @error('details') is-invalid @enderror first" name="details" autocomplete="off" placeholder="details" value="{{ old('details') }}" type="text">
                   @error('details')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="video">Video(Optional)</label>
              <input id="video" class="form-control @error('video') is-invalid @enderror" name="video" autocomplete="off" type="file">
                @error('video')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
               <div class="form-group">
                <h4 class="card-title">Description</h4>
                <textarea class="form-control" name="description" id="tinymceExample" rows="5"></textarea>
               </div>
              </div>
            </div>
            <div class="form-group">
              <label>Select Product Size(optional)</label>
              <select name="size"  id="size" class="form-control @error('size') is-invalid @enderror">
                  @foreach ($size as $sz)
                  <option value="{{$sz}}">{{$sz}}</option>
                  @endforeach
              </select>
              @error('size')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Select Product Status(optional)</label>
                  <select name="status"  id="status" class="form-control @error('status') is-invalid @enderror">
                      @foreach ($status as $st)
                      <option value="{{$st}}">{{$st}}</option>
                      @endforeach
                  </select>
                  @error('status')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Select Product Type(optional)</label>
                  <select name="type"  id="type" class="form-control @error('type') is-invalid @enderror">
                      @foreach ($types as $ts)
                      <option value="{{$ts}}">{{$ts}}</option>
                      @endforeach
                  </select>
                  @error('type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              </div>
            </div>
            <input class="btn btn-primary" type="submit" value="Submit">
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
@push('plugin-scripts')
<script src="{{ asset('assets/plugins/tinymce/tinymce.min.js') }}"></script>
@endpush

@push('custom-scripts')
<script src="{{ asset('assets/js/tinymce.js') }}"></script>
@endpush