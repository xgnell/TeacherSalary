@extends('layouts.admin')

@section('main')
    <h2>Edit KPI Criteria</h2>
    <form method="POST" action="{{ route('kpi.update', $criteria->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="criteria">Criteria:</label>
            <input type="text" value="{{ $criteria->criteria }}"
                class="form-control" name="criteria" id="criteria" aria-describedby="criteria" placeholder="Criteria name">
            
            @error('criteria')
                <small class="help-block" style="color:red">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="max_point">Max point: </label>
            <input type="text" value="{{ $criteria->max_point }}"
                class="form-control" name="max_point" id="max_point" aria-describedby="max_point" placeholder="Max point">
            
            @error('max_point')
                <small class="help-block" style="color:red">{{ $message }}</small>
            @enderror
        </div>

        <button class="btn btn-primary">Update</button>
    </form>

@endsection