@extends('layouts.admin')

@section('main')

    <h2>Add Insurance For Teacher</h2>

    <form method="POST" action="{{ route('teacher_insurance.store') }}">
        @csrf

        <div class="form-group">
            <label for="type">Teacher: </label>
            <select class="form-control" name="teacher_id" id="teacher_id">
                @foreach ($teachers as $teacher)
                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                @endforeach
            </select>
            
            @error('teacher_id')
                <small class="help-block" style="color:red">{{ $message }}</small>
            @enderror
        </div>

        <br>

        <div class="form-group">
            <label for="value">Insurance: </label>

            @foreach ($insurances as $insurance)
                <div class="form-check">
                    <input type="checkbox"
                        class="form-check-input"
                        name="insurance_{{ $insurance->id }}"
                        id="insurance_{{ $insurance->id }}"
                        aria-describedby="{{ $insurance->id }}"
                        @if ($insurance->mandatory)
                            checked
                            disabled
                        @endif
                    >
                    
                    <label for="insurance_{{ $insurance->id }}">{{ $insurance->type }} @if ($insurance->mandatory)
                        (Mandatory)
                    @endif</label>
        
                    @error('insurance_{{ $insurance->id }}')
                        <small class="help-block" style="color:red">{{ $message }}</small>
                    @enderror
                </div>
            @endforeach
        </div>

        <button class="btn btn-primary">Create</button>

    </form>


@endsection
