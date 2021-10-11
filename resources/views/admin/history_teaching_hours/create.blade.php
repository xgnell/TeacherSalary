@extends('layouts.admin')



@section('main')
    <h2>Update Teching Hours</h2>

    <form action="{{ route('history_teaching_hours.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="teacher_id">Teacher</label>
            <select class="form-control" name="teacher_id" id="teacher_id">
                @foreach ($unupdated_teachers as $teacher)
                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                @endforeach
            </select>
        </div>
        
        <br>
        <div class="form-group">
			<label for="total_hours">Total hours</label>
			<input class="form-control" type="text"
				name="total_hours"
				id="total_hours"
				placeholder="Total teaching hours"
			>
        </div>
        @error('total_hours')
        <small class="help-block" style="color:red">{{$message}}</small>
    @enderror
		<div class="form-group">
			<label for="total_overtime_hours">Total overtime hours</label>
			<input class="form-control" type="text"
				name="total_overtime_hours"
				id="total_overtime_hours"
				placeholder="Total overtime teaching hours"
			>
        </div>
        @error('total_overtime_hours')
                <small class="help-block" style="color:red">{{$message}}</small>
            @enderror

        <button type="submit" class="btn btn-primary">Update</button>
    
    </form>

@endsection