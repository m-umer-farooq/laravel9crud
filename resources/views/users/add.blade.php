@extends('layouts.app')
@section('content')
<div class="container">


    {{-- @if (count($errors) > 0)
        <div class="row">
            <div class="col-lg-12 mt-6">
         <div class = "alert alert-danger">
            <ul>
               @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
               @endforeach
            </ul>
         </div>
        </div>
        </div>
      @endif --}}




    <div class="row d-flex justify-content-center">
        <div class="col-md-12">

            @if (session()->has('success'))
                <div class="row mt-5">
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            <div class="row mt-5">
                <h4 class="mb-3 mt-12">Add User</h4>
            </div>
            <form action="user-add" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">First Name</label>
                    <input type="text" id="first_name" name="first_name" class="form-control" value="{{ old('first_name') }}">
                    @error('first_name')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Last Name</label>
                    <input type="text" id="last_name" name="last_name" class="form-control" value="{{ old('last_name') }}">
                    @error('last_name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Phone Number</label>
                    <input type="text" id="phone_number" name="phone_number" class="form-control" value="{{ old('phone_number') }}">
                    @error('phone_number')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="text" id="email" name="email" class="form-control" value="{{ old('email') }}">
                    @error('email')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" value="">
                    @error('password')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <input type="submit" id="btn_submit" name="btn_submit" class="btn btn-primary" value="Submit">
                    &nbsp;
                    <input type="button" id="btn_back" name="btn_back" class="btn btn-primary" value="Back" onclick="location.href='list-users'">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
