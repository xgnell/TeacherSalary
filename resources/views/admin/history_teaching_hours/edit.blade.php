@extends('layouts.admin')



@section('main')
    <h2>Edit Teching Hours</h2>

    <form action="{{ route('history_teaching_hours.update', $teacher->id) }}" method="POST">
        @csrf
		@method('PUT')

        <div class="form-group">
			Teacher {{ $teacher->name }}
			<input type="text" hidden name="teacher_id" id="teacher_id" value="{{ $teacher->id }}">
		</div>
        
        <br>
        
        <div class="form-group">
			<label for="total_hours">Total hours</label>
			<input class="form-control" type="text"
				name="total_hours"
				id="total_hours"
				placeholder="Total teaching hours"
				value="{{ $teaching_hours->total_hours }}"
			>
        </div>

		<div class="form-group">
			<label for="total_overtime_hours">Total overtime hours</label>
			<input class="form-control" type="text"
				name="total_overtime_hours"
				id="total_overtime_hours"
				placeholder="Total overtime teaching hours"
				value="{{ $teaching_hours->total_overtime_hours }}"
			>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    
    </form>

@endsection