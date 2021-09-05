@extends('layouts.admin')

@section('main')
    <h2>ADD ACCOUNT ADMIN</h2>
    <form method="POST" action="{{ route('user.update',$user->id) }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
              <label for="">Name:</label>
              <input type="text"
              class="form-control" name="name" value="{{ $user->name }}" id="name" aria-describedby="helpId" placeholder="name ">
                </div>
                @error('name')
                <small class="help-block" style="color:red">{{$message}}</small>
            @enderror
                
        </div>
        <div class="col-md-12">
            <label for=""> email: </label>
            <input type="text"
              class="form-control" value="{{ $user->email }}" name="email" id="email" aria-describedby="helpId" placeholder="email ">
            @error('email')
            <small class="help-block" style="color:red">{{$message}}</small>
            @enderror
    </div>
    
<div class="col-md-12">
    <label for=""> Role: </label>
    <select name="role" id="role">
        <option value="0"
            @if ($user->role == 0)
                checked = "checked"
            @endif
        >admin</option>
        <option value="1"
        @if ($user->role == 1)
        checked = "checked"
        @endif
        >super Admin</option>
    </select>
    @error('role')
    <small class="help-block" style="color:red">{{$message}}</small>
    @enderror
</div>

        <button class="btn btn-primary">Submit</button>
  
    </form>

    
@endsection
