@extends('layouts.admin')

@section('main')
    <h2>ADD SALARY LEVEL</h2>
    <form method="POST" action="{{ route('salary_level.store') }}">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
              <label for="">Name:</label>
              <input type="text"
                class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="name">
                </div>
                @error('name')
                <small class="help-block" style="color:red">{{$message}}</small>
            @enderror
                
        </div>
        <div class="col-md-12">
            <label for="">criteria: </label>
            <input type="text"
              class="form-control" name="criteria" id="criteria" aria-describedby="helpId" placeholder="criteria">
            @error('criteria')
            <small class="help-block" style="color:red">{{$message}}</small>
            @enderror
    </div>
        <button class="btn btn-primary">Submit</button>
  
    </form>

    
@endsection
