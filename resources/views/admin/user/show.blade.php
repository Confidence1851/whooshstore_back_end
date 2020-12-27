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
        <p>Role: 
          @if ($user->role == 0)
            admin
          @elseif($user->role==1)
            vendor
          @else
            user
          @endif
        </p>
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

@endsection