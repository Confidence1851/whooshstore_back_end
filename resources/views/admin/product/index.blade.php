@extends('admin.layout.master')
@section('title')
Products
@endsection
@section('content')
{{--  css  --}}
 @push('plugin-styles')
<link rel="stylesheet" href="{{ asset('/assets/plugins/datatables-net/dataTables.bootstrap4.css') }}">
@endpush

<nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Admin Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Product</li>
    </ol>
  </nav>
  
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h6 class="card-title">Product</h6>
          <div class="table-responsive">
            <table id="dataTableExample" class="table">
              <thead>
                <tr>
                  <th>Image</th>
                  <th>Product Name</th>
                  <th>Category</th>
                  <th>Slug</th>
                  <th>Quantity</th>
                  <th>Price</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($Products as $Product)
                <tr>
                  <td><img src="{{ asset($Product->image) }}" alt=""></td>
                  <td>{{ $Product->product_name }}</td>
                  <td>{{ $Product->Category->name }}</td>
                  <td>{{ $Product->slug }}</td>
                  <td>{{ $Product->quantity }}</td>
                  <td>{{ $Product->price }}</td>
                  <td>{{ $Product->status }}</td>
                  <td>
                    <a href="{{ route('products.edit',$Product->id) }}" class="btn btn-info btn-sm ">Edit</a>
                    <a href="" class="btn btn-primary btn-sm">View</a>

                    <a href="" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#del-{{$Product->id}}">Delete</a>
                    <div class="modal fade bd-example-modal-md" id="del-{{$Product->id}}">
                        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-header mb-3">
                                    <h5 class="modal-title">Delete Product Category </h5>
                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button></h5>
                                </div>
                                <div class="modal-body">
                                  <small> 
                                  Are you sure? Deleting this would Remove this category from the database
                                  </small>
                                <form action="{{ route('products.destroy',$Product->id) }}" method="post">
                                  @csrf @method('delete')
                                    <div class="modal-footer">
                                        <button class="btn btn-outline-info btn-sm" type="button" class="close" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" >Proceed</button>
                                    </div>
                                </form>
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

