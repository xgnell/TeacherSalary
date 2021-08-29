@extends('layouts.admin')

@section('main')
    <h2>ADD MAJOR</h2>
    <form method="POST" action="{{ route('salary_level.update',$salaryLevel->id) }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
              <label for="">Name:</label>
              <input type="text"
                class="form-control" value="{{ $salaryLevel->name }}" name="name" id="name" aria-describedby="helpId" placeholder="Nhập Tên Ngành">
                </div>
                @error('name')
                <small class="help-block" style="color:red">{{$message}}</small>
            @enderror
                
        </div>
        <div class="col-md-12">
            <label for="">criteria: </label>
            <input type="text"
              class="form-control" value="{{ $salaryLevel->criteria }}" name="criteria" id="criteria" aria-describedby="helpId" placeholder="criteria">
            @error('criteria')
            <small class="help-block" style="color:red">{{$message}}</small>
            @enderror
    </div>
        <button class="btn btn-primary">Submit</button>
  
    </form>

    
@endsection
