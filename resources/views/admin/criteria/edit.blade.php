@extends('layouts.admin')

@section('main')
    <h2>EDIT MAJOR</h2>
    <form method="POST" action="{{ route('criteria.update', $criteria->id) }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
              <label for="">Name:</label>
              <input type="text"
                class="form-control" value="{{$criteria->name}}" name="name" id="name" aria-describedby="helpId" placeholder="Nhập Tên Ngành">
                </div>
                @error('name')
                <small class="help-block" style="color:red">{{$message}}</small>
            @enderror
                
        </div>
        <div class="col-md-12">
            <label for="">Criteria Mark: </label>
            <input type="text"
              class="form-control" value="{{$criteria->criteria_mark}}" name="slug" id="slug" aria-describedby="helpId" placeholder="slug">
            @error('criteria_mark')
            <small class="help-block" style="color:red">{{$message}}</small>
            @enderror
    </div>
        <button class="btn btn-primary">Submit</button>
  
    </form>

    
@endsection