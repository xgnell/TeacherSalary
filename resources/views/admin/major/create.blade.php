@extends('layouts.admin')

@section('main')
    <h2>ADD MAJOR</h2>
    <form method="POST" action="{{ route('major.store') }}">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
              <label for="">Name:</label>
              <input type="text"
                class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="Nhập Tên Ngành">
                </div>
                @error('name')
                <small class="help-block" style="color:red">{{$message}}</small>
            @enderror
                
        </div>
        <div class="col-md-12">
            <label for="">Slug: </label>
            <input type="text"
              class="form-control" name="slug" id="slug" aria-describedby="helpId" placeholder="slug">
            @error('slug')
            <small class="help-block" style="color:red">{{$message}}</small>
            @enderror
    </div>
        <button class="btn btn-primary">Submit</button>
  
    </form>

    
@endsection
@section('js')
<script src="{{ url('public/slug') }}/slug.js" type="text/javascript"></script>
@endsection