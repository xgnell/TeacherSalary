@extends('layouts.admin')

@section('main')

    <h2>Add Insurance Type</h2>

    <form method="POST" action="{{ route('insurance.store') }}">
        @csrf
        <div class="form-group">
            <label for="type">Type: </label>
            <input type="text"
                class="form-control" name="type" id="type" aria-describedby="type" placeholder="Insurance type">
            
            @error('type')
                <small class="help-block" style="color:red">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="value">Value: </label>
            <input type="text"
                class="form-control" name="value" id="value" aria-describedby="value" placeholder="Insurance value (% salary)">
            
            @error('value')
                <small class="help-block" style="color:red">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="period_id">Choose period:</label>
            <select class="form-control" name="period_id" id="period_id">
                @foreach ($periods as $each)
                    <option value="{{ $each->id }}">{{ $each->name }}</option>
                @endforeach
            </select>

            @error('period_id')
                <small class="help-block" style="color:red">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-check">
            <input type="checkbox"
                class="form-check-input" name="mandatory" id="mandatory" aria-describedby="mandatory">
            <label for="mandatory">Mandatory </label>

            @error('mandatory')
                <small class="help-block" style="color:red">{{ $message }}</small>
            @enderror
        </div>

        <button class="btn btn-primary">Create</button>

    </form>


@endsection
