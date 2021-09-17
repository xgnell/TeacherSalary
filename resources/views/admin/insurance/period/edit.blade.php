@extends('layouts.admin')

@section('main')

    <h2>Edit Insurance Period</h2>

    <form method="POST" action="{{ route('insurance_period.update', $period->id) }}">
        @csrf
		@method('PUT')
		
        <div class="form-group">
            <label for="type">Name: </label>
            <input type="text" value="{{ $period->name }}"
                class="form-control" name="name" id="name" aria-describedby="name" placeholder="Period name">
            
            @error('name')
                <small class="help-block" style="color:red">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="value">Period: </label>
            <input type="text" value="{{ $period->period }}"
                class="form-control" name="period" id="period" aria-describedby="period" placeholder="Period value (month)">
            
            @error('period')
                <small class="help-block" style="color:red">{{ $message }}</small>
            @enderror
        </div>

        <button class="btn btn-primary">Update</button>

    </form>


@endsection
