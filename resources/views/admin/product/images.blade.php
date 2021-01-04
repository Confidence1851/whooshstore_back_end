@extends('admin.layout.master')
@section('title')
Product Images
@endsection
@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('/admin/products/create') }}">Back</a></li>
      <li class="breadcrumb-item active" aria-current="page">Add Product Images</li>
    </ol>
</nav>
    <div class="container">
        <h2>Product Images</h2>
        <div class="row">
            @foreach ($images as $image)
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <img src="{{ $image->getImage(false)}}" class="w-100 img-fluid rounded" data-toggle="modal" data-target="#image_modal_{{ $image->id }}" alt="">
                             @include('admin.partials.update-image-modal')
                            <a href="" class="btn btn-outline-danger btn-sm mt-3" data-toggle="modal"
                            data-target="#del_image-{{ $image->id }}">Delete</a> 
                        </div>
                    </div>
                </div>
                @include('admin.partials.delete-image-modal'  , ["image" => $image])
            @endforeach
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Add Product Images</h2>
                    <form action="{{ route("products.image.save") }}" method="post" enctype="multipart/form-data">@csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}" id="" >
                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="">
                        @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input class="btn btn-primary mt-5" type="submit" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
