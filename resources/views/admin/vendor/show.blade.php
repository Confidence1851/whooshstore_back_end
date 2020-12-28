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
        <h4 class="card-title">Products</h4>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>Image</th>
                <th>Name</th>
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
                <td>{{ $Product->name }}</td>
                <td>{{ $Product->Category->name }}</td>
                <td>{{ $Product->slug }}</td>
                <td>{{ $Product->quantity }}</td>
                <td>{{ $Product->price }}</td>
                <td>{{ $Product->status }}</td>
                <td>
                  <a href="" class="btn btn-primary btn-sm">View</a>
                  <a href="" class="btn btn-info btn-sm ">Edit</a>
                  @if ($Product->status != "Active")
                    <form method="post" action="{{ route('approveProduct',$Product->id) }}" class="d-inline">
                      @csrf
                      <input type="hidden" name="status" value="Active">
                      <button type="submit" class="btn btn-success btn-sm">Approve</button>
                    </form> 
                  @else
                    <form method="post" action="{{ route('approveProduct',$Product->id) }}" class="d-inline">
                      @csrf
                      <input type="hidden" name="status" value="Inactive">
                      <button type="submit" class="btn btn-warning btn-sm">Disapprove</button>
                    </form> 
                  @endif
                  <form action="" method="post" class="d-inline">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger btn-sm">Delete</button>
                  </form> 
                  {{-- <a href="" class="btn btn-danger btn-sm">Delete</a> --}}
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