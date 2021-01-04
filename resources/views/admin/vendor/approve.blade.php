@extends('admin.layout.master')
@section('title')
Approve Products
@endsection
@section('content')
{{--  css  --}}
 @push('plugin-styles')
<link rel="stylesheet" href="{{ asset('/assets/plugins/datatables-net/dataTables.bootstrap4.css') }}">
@endpush

<nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Admin Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Approve Product</li>
    </ol>
  </nav>
  
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h6 class="card-title">Products</h6>
          <div class="table-responsive">
            <table id="dataTableExample" class="table">
              <thead>
                <tr>
                  <th>Image</th>
                  <th>Vendor</th>
                  <th>Name</th>
                  <th>Category</th>
                  <th>Slug</th>
                  <th>Quantity</th>
                  <th>Price</th>
                  <th>Status</th>
                  <th>Date Added</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($Products as $Product)
                <tr>
                  <td><img src="{{ asset($Product->image) }}" alt=""></td>
                  <td>{{ $Product->Vendor->firstname }} {{ $Product->Vendor->lastname }}</td>
                  <td>{{ $Product->name }}</td>
                  <td>{{ $Product->Category->name }}</td>
                  <td>{{ $Product->slug }}</td>
                  <td>{{ $Product->quantity }}</td>
                  <td>{{ $Product->price }}</td>
                  <td>{{ $Product->status }}</td>
                  <td>{{ $Product->created_at->format('d-M-Y')}}</td>
                  <td>
                    <form method="post" action="{{ route('approveProduct',$Product->id) }}" class="d-inline">
                        @csrf
                        <input type="hidden" name="status" value="Active">
                        <button type="submit" class="btn btn-success btn-sm">Approve</button>
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

