@extends('layouts.admin')

@section('main')
    <h2>ADD CRITERIA</h2>
    <form method="POST" action="{{ route('bhxh.store') }}">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
              <label for="">Chose Teacher:</label>
              <select name="teacher_id" >
                  @foreach ($teacher as $each)
                      <option value="{{ $each->id }}">{{ $each->first_name }} {{ $each->last_name }}</option>
                  @endforeach
              </select>
                </div>
                @error('teacher_id')
                <small class="help-block" style="color:red">{{$message}}</small>
            @enderror
                
        </div>
        <div class="col-md-12">
            <label for=""> total value: </label>
            <input type="text"
              class="form-control" name="total_value" id="total_value" aria-describedby="helpId" placeholder="total value ">
            @error('total_value')
            <small class="help-block" style="color:red">{{$message}}</small>
            @enderror
    </div>
    <div class="col-md-12">
        <label for=""> Time: </label>
        <input type="date"
              class="form-control" name="time" id="time" aria-describedby="helpId" placeholder="time ">
        @error('time')
        <small class="help-block" style="color:red">{{$message}}</small>
        @enderror
</div>
        <button class="btn btn-primary">Submit</button>
  
    </form>

    
@endsection
