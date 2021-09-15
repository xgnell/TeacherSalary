@extends('layouts.admin')

@section('main')
    <h2>Edit Insurance Type</h2>
    <form method="POST" action="{{ route('insurance.update', $insurance->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="">Type: </label>
            <input type="text" value="{{ $insurance->type }}"
                class="form-control" name="type" id="type" aria-describedby="type" placeholder="Insurance type">
            
            @error('type')
                <small class="help-block" style="color:red">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="">Value: </label>
            <input type="text" value="{{ $insurance->value }}"
                class="form-control" name="value" id="value" aria-describedby="value" placeholder="Insurance value (% salary)">
            
            @error('value')
                <small class="help-block" style="color:red">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="">Choose period:</label>
            <select class="form-control" name="period_id" >
                @foreach ($periods as $each)
                    <option
                        @if ($insurance->period_id == $each->id)
                            selected
                        @endif
                        value="{{ $each->id }}">
                        {{ $each->name }}
                    </option>
                @endforeach
            </select>

            @error('period_id')
                <small class="help-block" style="color:red">{{$message}}</small>
            @enderror
        </div>

        <div class="form-check">
            <input type="checkbox"
                @if ($insurance->mandatory == true)
                    checked
                @endif
                class="form-check-input" name="mandatory" id="mandatory" aria-describedby="mandatory">
            <label for="">Mandatory </label>

            @error('mandatory')
                <small class="help-block" style="color:red">{{ $message }}</small>
            @enderror
        </div>

        <button class="btn btn-primary">Update</button>

    </form>
    
@endsection
