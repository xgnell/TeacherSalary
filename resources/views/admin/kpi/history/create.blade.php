@extends('layouts.admin')



@section('main')
    <h2>Update KPI Table</h2>

    <form action="{{ route('history_kpi.store') }}" method="POST">
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
            @foreach ($kpi_criterias as $criteria)
                <div>
                    <label for="criteria_{{ $criteria->id }}">Criteria {{ $criteria->criteria }}</label>
                    <input class="form-control" type="text"
                        name="criteria_{{ $criteria->id }}"
                        id="criteria_{{ $criteria->id }}"
                    >
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    
    
    </form>


@endsection