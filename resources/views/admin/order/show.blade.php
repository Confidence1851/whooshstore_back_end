@extends('admin.layout.master')
@section('title')
Order Details
@endsection
@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('/admin/order') }}">Admin Dashboard</a></li>
    </ol>
  </nav>
<div class="row justify-content-center">
  <div class="col-lg-10 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">User Info</h4>
        <p>First Name: {{$order->user->firstname}}</p>
        <p>Last Name: {{$order->user->lastname}}</p>
        <p>Email: {{$order->user->email}}</p>
        
        <br>
        <h5>Address Info</h5>
        <p>City: {{$order->user->city}}</p>
        <p>State: {{$order->user->state}}</p>
        <p>Country: {{$order->user->country}}</p>
        <p>Address: {{$order->user->address}}</p>
        <p>Phone: {{$order->user->phone}}</p>
        <p>Phone: {{$order->user->phone2}}</p>
    </div>            
  </div>
 </div>
</div>
<div class="row justify-content-center"s>
  <div class="col-lg-10 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Order Items</h6>
        <div class="table-responsive">
            <table id="dataTableExample" class="table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Discount</th>
                        <th>Price</th>
                        <th>Date Added</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot class="thead-dark">
                    <tr>
                        <th colspan="4">Total Price</th>
                        <th>{{$order->amount}}</th>
                    </tr>
                </tfoot>
                <tbody>
                @if (count($OrderItem))
                @foreach ($OrderItem as $item)
                <tr>
                    <td><img src="{{ $item->product->getDefaultImage() }}" alt=""></td>
                    <td>{{ $item->product->product_name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->discount }}</td>
                    <td>{{ $item->amount }}</td>
                    <td>{{ $item->created_at->format('d-M-Y')}}</td>
                    <td>
                      <a href="" class="btn btn-outline-danger btn-sm" data-toggle="modal"
                          data-target="#del-{{ $item->id }}">Delete</a>
                      <div class="modal fade bd-example-modal-md" id="del-{{ $item->id }}">
                          <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                              <div class="modal-content">
                                  <div class="modal-header mb-3">
                                      <h5 class="modal-title">Delete Order Item</h5>
                                      <button type="button" class="close"
                                          data-dismiss="modal"><span>&times;</span></button></h5>
                                  </div>
                                  <div class="modal-body">
                                      <small>
                                          Are you sure? Deleting this would Remove this Order Item from
                                          the database
                                      </small>
                                      <form action="#"
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
                @endif
              </tbody>
            </table>
        </div>        
      </div>
    </div>
  </div>
</div>

@endsection