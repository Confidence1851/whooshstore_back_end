@extends('admin.layout.master')
@section('title')
User
@endsection
@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('/admin/users') }}">Admin Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">User {{$user->id}}</li>
    </ol>
  </nav>
<div class="row justify-content-center">
  <div class="col-lg-10 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">User</h4>
        <p>First Name: {{$user->firstname}}</p>
        <p>Last Name: {{$user->lastname}}</p>
        <p>Email: {{$user->email}}</p>
        
        <br>
        <h5>Address Info</h5>
        <p>City: {{$user->city}}</p>
        <p>State: {{$user->state}}</p>
        <p>Country: {{$user->country}}</p>
        <p>Address: {{$user->address}}</p>
        <p>Phone: {{$user->phone}}</p>
        <p>Phone: {{$user->phone2}}</p>
    </div>            
  </div>
 </div>
</div>
<div class="row justify-content-center"s>
  <div class="col-lg-10 grid-margin stretch-card">
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
                        <th>Date Added</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($Products as $product)
                      <tr>
                          <td><img src="{{ $product->getDefaultImage() }}" alt=""></td>
                          <td>{{ $product->product_name }}</td>
                          <td>{{ $product->category->name }}</td>
                          <td>{{ $product->slug }}</td>
                          <td>{{ $product->quantity }}</td>
                          <td>{{ $product->price }}</td>
                          <td>{{ $product->status }}</td>
                          <td>{{ $product->created_at->format('d-M-Y')}}</td>
                          <td>
                            <a href="{{ route('products.edit', $product->id) }}"
                                class="btn btn-info btn-sm ">Edit</a>
                            <a href="" class="btn btn-primary btn-sm d-none">View</a>
                            <form method="post" action="{{ route('approveProduct',$product->id) }}" class="d-inline">
                              @csrf
                              <input type="hidden" name="status" value="{{ ($product->status=='Active') ? 'Inactive' : 'Active'}}">
                              <button type="submit" class="btn btn-warning btn-sm">{{ ($product->status=='Active') ? 'Deactivate' : 'Activate'}}</button>
                            </form> 
                            <a href="" class="btn btn-outline-danger btn-sm" data-toggle="modal"
                                data-target="#del-{{ $product->id }}">Delete</a>
                            <div class="modal fade bd-example-modal-md" id="del-{{ $product->id }}">
                                <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header mb-3">
                                            <h5 class="modal-title">Delete Product</h5>
                                            <button type="button" class="close"
                                                data-dismiss="modal"><span>&times;</span></button></h5>
                                        </div>
                                        <div class="modal-body">
                                            <small>
                                                Are you sure? Deleting this would Remove this product from
                                                the database
                                            </small>
                                            <form action="{{ route('products.destroy', $product->id) }}"
                                                method="post">
                                                @csrf @method('delete')
                                                <div class="modal-footer">
                                                    <button class="btn btn-outline-info btn-sm"
                                                        type="button" class="close"
                                                        data-dismiss="modal">Cancel</button>
                                                    <button type="submit"
                                                        class="btn btn-outline-danger btn-sm">Proceed</button>
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