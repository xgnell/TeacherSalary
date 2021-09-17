@extends('layouts.admin')

@section('main')
    <h2>ADD SALARY LEVEL</h2>
    <form method="POST" action="{{ route('salary_level.store') }}">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
              <label for="">Level:</label>
              <input type="text"
                class="form-control" name="level" id="level" aria-describedby="helpId" placeholder="level">
                </div>
                @error('level')
                <small class="help-block" style="color:red">{{$message}}</small>
            @enderror
                
        </div>
        <div class="col-md-12">
            <label for="">Salary Basic: </label>
            <input type="text"
              class="form-control" name="basic_salary" id="basic_salary" aria-describedby="helpId" placeholder="basic_salary">
            @error('basic_salary')
            <small class="help-block" style="color:red">{{$message}}</small>
            @enderror
    </div>
        <button class="btn btn-primary">Submit</button>
  
    </form>

    
@endsection
