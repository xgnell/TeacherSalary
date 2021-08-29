@extends('layouts.admin')

@section('main')
    <h2>ADD CRITERIA</h2>
    <form method="POST" action="{{ route('criteria.store') }}">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
              <label for="">Name:</label>
              <input type="text"
                class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="Name">
                </div>
                @error('name')
                <small class="help-block" style="color:red">{{$message}}</small>
            @enderror
                
        </div>
        <div class="col-md-12">
            <label for="">Criteria Mark: </label>
            <input type="text"
              class="form-control" name="criteria_mark" id="criteria_mark" aria-describedby="helpId" placeholder="criteria mark">
            @error('criteria_mark')
            <small class="help-block" style="color:red">{{$message}}</small>
            @enderror
    </div>
        <button class="btn btn-primary">Submit</button>
  
    </form>

    
@endsection
