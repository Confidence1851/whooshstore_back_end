@extends('admin.layout.master')
@section('title')
Product Category
@endsection
@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('/admin/productcategories') }}">Admin Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Product Category {{$productCategory->id}}</li>
    </ol>
  </nav>
<div class="row justify-content-center">
  <div class="col-lg-10 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Product Category</h4>
        <p>Name: {{$productCategory->name}}</p>
        <p>Icon Name: {{$productCategory->icon}}</p>
        <p>Slug: {{$productCategory->slug}}</p>
        <div>
            Image:
            <img src="{{asset($productCategory->image)}}" alt="" width="100" class="image-responsive">
        </div>
    </div>            
  </div>
 </div>
</div>

@endsection