@extends('layouts.admin')

@section('main')
    <h2>EDIT SALARY LEVEL</h2>
    <form method="POST" action="{{ route('salary_level.update',$salaryLevel->level) }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
              <label for="">level:</label>
              <input type="text"
                class="form-control" value="{{ $salaryLevel->level }}" name="level" id="name" aria-describedby="helpId" placeholder="Nhập level">
                </div>
                @error('level')
                <small class="help-block" style="color:red">{{$message}}</small>
            @enderror
                
        </div>
        <div class="col-md-12">
            <label for="">basic salary: </label>
            <input type="text"
              class="form-control" value="{{ $salaryLevel->basic_salary }}" name="criteria" id="criteria" aria-describedby="helpId" placeholder="basic salary">
            @error('basic_salary')
            <small class="help-block" style="color:red">{{$message}}</small>
            @enderror
    </div>
        <button class="btn btn-primary">Submit</button>
  
    </form>

    
@endsection
