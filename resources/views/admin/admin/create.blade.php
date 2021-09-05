@extends('layouts.admin')

@section('main')
    <h2>ADD ACCOUNT ADMIN</h2>
    <form method="POST" action="{{ route('user.store') }}">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
              <label for="">Name:</label>
              <input type="text"
              class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="name ">
                </div>
                @error('name')
                <small class="help-block" style="color:red">{{$message}}</small>
            @enderror
                
        </div>
        <div class="col-md-12">
            <label for=""> email: </label>
            <input type="text"
              class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="email ">
            @error('email')
            <small class="help-block" style="color:red">{{$message}}</small>
            @enderror
    </div>
    <div class="col-md-12">
        <label for=""> password: </label>
        <input type="text"
              class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="password ">
        @error('password')
        <small class="help-block" style="color:red">{{$message}}</small>
        @enderror
</div>
<div class="col-md-12">
    <label for=""> confirm password: </label>
    <input type="text"
          class="form-control" name="confirm_password" id="confirm_password" aria-describedby="helpId" placeholder="confirm_password ">
    @error('confirm_password')
    <small class="help-block" style="color:red">{{$message}}</small>
    @enderror
</div>
<div class="col-md-12">
    <label for=""> Role: </label>
    <select name="role" id="role">
        <option value="0">admin</option>
        <option value="1">super Admin</option>
    </select>
    @error('role')
    <small class="help-block" style="color:red">{{$message}}</small>
    @enderror
</div>

        <button class="btn btn-primary">Submit</button>
  
    </form>

    
@endsection
