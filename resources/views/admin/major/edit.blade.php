@extends('layouts.admin')

@section('main')
    <h2>Edit Major</h2>
    <form method="POST" action="{{ route('major.update', $major->id) }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Name:</label>
                    <input type="text"
                        class="form-control" value="{{$major->name}}" name="name" id="name" aria-describedby="helpId" placeholder="Major name">
                </div>
                @error('name')
                    <small class="help-block" style="color:red">{{$message}}</small>
                @enderror
            </div>

            <div class="col-md-12">
                <label for="">Slug: </label>
                <input type="text"
                class="form-control" value="{{$major->slug}}" name="slug" id="slug" aria-describedby="helpId" placeholder="Slug">
                @error('slug')
                    <small class="help-block" style="color:red">{{$message}}</small>
                @enderror
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6">
                <button class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>

    
@endsection
@section('js')
<script src="{{ url('public/slug') }}/slug.js" type="text/javascript"></script>
@endsection