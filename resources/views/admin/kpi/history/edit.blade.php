@extends('layouts.admin')



@section('main')
    <h2>Update KPI Table</h2>

    <form action="{{ route('history_kpi.update', $teacher->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="teacher_id">Teacher {{ $teacher->name }}</label>
            <input type="text" hidden name="teacher_id" id="teacher_id" value="{{ $teacher->id }}">
        </div>
        
        <br>
        
        <div class="form-group">
            @foreach ($kpi_criterias as $criteria)
                <div>
                    <label for="criteria_{{ $criteria->criteria_id }}">Criteria {{ $criteria->criteria }}</label>
                    <input class="form-control" type="text"
                        name="criteria_{{ $criteria->criteria_id }}"
                        id="criteria_{{ $criteria->criteria_id }}"
                        value="{{ $criteria->point }}"
                    >
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    
    
    </form>


@endsection