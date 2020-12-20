@extends('admin.layout.master')
@section('title')
Product Categories
@endsection
@section('content')
{{--  css  --}}
 @push('plugin-styles')
<link rel="stylesheet" href="{{ asset('/assets/plugins/datatables-net/dataTables.bootstrap4.css') }}">
@endpush

<nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Admin Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Product Category</li>
    </ol>
  </nav>
  
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h6 class="card-title">Product Category</h6>
          <div class="table-responsive">
            <table id="dataTableExample" class="table">
              <thead>
                <tr>
                  <th>Image</th>
                  <th>Name</th>
                  <th>Slug</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($ProductCategories as $ProductCategory)
                <tr>
                  <td><img src="{{ asset($ProductCategory->image) }}" alt=""></td>
                  <td>{{ $ProductCategory->name }}</td>
                  <td>{{ $ProductCategory->slug }}</td>
                  <td>
                    <a href="{{ route('productcategories.edit',$ProductCategory->id) }}" class="btn btn-info btn-sm ">Edit</a>
                    <form action="{{ route('productcategories.destroy',$ProductCategory->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">delete</button>
                    </form> 
                    {{-- <a href="" class="btn btn-danger btn-sm">Delete</a> --}}
                    <a href="" class="btn btn-primary btn-sm">View</a>
                 </td>
                </tr>
                  @endforeach
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('custom-scripts')
<script src="{{ asset('/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('/assets/js/data-table.js') }}"></script>
@endpush

@push('plugin-scripts')

<script src="{{ asset('/assets/plugins/datatables-net/jquery.dataTables.js') }}" defer></script>
<script src="{{ asset('/assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}" defer></script>

@endpush

