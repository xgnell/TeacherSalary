@extends('layouts.admin')

@section('main')
    <h2>Add KPI Criteria</h2>
    <form method="POST" action="{{ route('kpi.store') }}">
        @csrf

        <div class="form-group">
            <label for="criteria">Criteria:</label>
            <input type="text"
                class="form-control" name="criteria" id="criteria" aria-describedby="criteria" placeholder="Criteria name">
            
            @error('criteria')
                <small class="help-block" style="color:red">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="max_point">Max point: </label>
            <input type="text"
                class="form-control" name="max_point" id="max_point" aria-describedby="max_point" placeholder="Max point">
            
            @error('max_point')
                <small class="help-block" style="color:red">{{ $message }}</small>
            @enderror
        </div>

        <button class="btn btn-primary">Create</button>
    </form>

    
@endsection
