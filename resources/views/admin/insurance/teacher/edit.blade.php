@extends('layouts.admin')

@section('main')

    <h2>Update Insurance For Teacher</h2>

    <form method="POST" action="{{ route('teacher_insurance.update', $teacher->id) }}">
        @csrf
		@method('PUT')

        <label for="type">Teacher {{ $teacher->name }}</label>

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
                            disabled
                        @endif

						@if ($insurance->insurance_id)
							checked
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

        <button class="btn btn-primary">Update</button>

    </form>


@endsection
