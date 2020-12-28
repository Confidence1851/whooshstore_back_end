@extends('admin.layout.master')
@section('title')
Edit User
@endsection
@section('content')
 <div class="row justify-content-center">
  <div class="col-lg-10 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Edit User</h4>
        <form class="cmxform" id="signupForm" method="post" action="{{ route('users.update',$user->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
          <fieldset>
            <div class="row">
              <div class="col-5">
                <div class="form-group">
                  <label for="firstname">First Name</label>
                  <input id="firstname" class="form-control @error('firstname') is-invalid @enderror first" name="firstname" autocomplete="off" placeholder="FirstName" value="{{ $user->firstname }}" type="text">
                   @error('firstname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                  <label for="lastname">Last Name</label>
                  <input id="lastname" class="form-control @error('lastname') is-invalid @enderror first" name="lastname" autocomplete="off" placeholder="LastName" value="{{ $user->lastname }}" type="text">
                   @error('lastname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input id="email" class="form-control @error('email') is-invalid @enderror first" name="email" autocomplete="off" placeholder="Email" value="{{ $user->email }}" type="email">
                   @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                  <label for="role">Role</label>
                  <select class="form-control @error('role') is-invalid @enderror first" name="role" id="role">
                    <option disabled selected value="2">Select a role</option>
                    <option 
                    @if ($user->role==1)
                        selected
                    @endif
                    value="1">Admin</option>
                    <option 
                    @if ($user->role==2)
                        selected
                    @endif
                    value="2">Vendor</option>
                    <option 
                    @if ($user->role==0)
                        selected
                    @endif
                    value="0">User</option>
                  </select>
                    @error('role')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                  <label for="city">City</label>
                  <input id="city" class="form-control @error('city') is-invalid @enderror " name="city" autocomplete="off" placeholder="City" value="{{ $user->city }}" type="text">
                   @error('state')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              </div>
              <div class="col-5">
                <div class="form-group">
                  <label for="state">State</label>
                  <input id="state" class="form-control @error('state') is-invalid @enderror " name="state" autocomplete="off" placeholder="state" value="{{ $user->state }}" type="text">
                   @error('state')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                  <label for="country">Country</label>
                  <input id="country" class="form-control @error('country') is-invalid @enderror " name="country" autocomplete="off" placeholder="Country" value="{{ $user->country }}" type="text">
                   @error('country')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                  <label for="address">Address</label>
                  <textarea class="form-control @error('country') is-invalid @enderror " name="address" id="address" rows="5">{{$user->address }}</textarea>
                   @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                  <label for="mobile">Mobile</label>
                  <input id="mobile" class="form-control @error('mobile') is-invalid @enderror " name="phone" autocomplete="off" placeholder="Mobile" value="{{ $user->phone }}" type="tel">
                   @error('mobile')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input id="phone" class="form-control @error('phone') is-invalid @enderror " name="phone2" autocomplete="off" placeholder="Phone" value="{{ $user->phone2 }}" type="tel">
                   @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              </div>
            </div>
            <input class="btn btn-primary" type="submit" value="Submit">
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection