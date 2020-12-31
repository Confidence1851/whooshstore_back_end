@extends('admin.layout.master')
@section('title')
Product Images
@endsection
@section('content')
    <div class="container">
        <div class="row">
            @foreach ($images as $image)
                <div class="col-md-3">
                    <img src="{{ $image->getImage(false) }}" class="img-fluid" alt="">
                </div>
            @endforeach
        </div>
        <div class="">
            <form action="{{ route("products.image.save") }}" method="post" enctype="multipart/form-data">@csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}" id="" >
                <input type="file" name="image" id="">
                <button>Save</button>
              </form>
        </div>
    </div>
@endsection