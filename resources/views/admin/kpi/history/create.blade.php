@extends('layouts.admin')



@section('main')
    <h2>Update KPI Table</h2>

    <form action="{{ route('history_kpi.store') }}" method="POST" id="form-1">
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
        <small id="helpId" class="err" style="color: red; font-size:17px"></small>

        <div class="form-group">
            @foreach ($kpi_criterias as $criteria)
                <div>
                    <label for="criteria_{{ $criteria->id }}">{{ $criteria->criteria }}</label>
                    <label for="max_point">:Max point {{ $criteria->max_point }}</label>
                    <input class="form-control criteria_input" data-id="{{ $criteria->max_point }}" type="text"
                        name="criteria_{{ $criteria->id }}" id="criteria_{{ $criteria->id }}">
                </div>


            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Update</button>


    </form>
@endsection
@section('js')
    @php
    $criteria = json_encode($criteria);
    @endphp

    <script>
        var inp = document.querySelectorAll('.criteria_input')
        var err = document.querySelector('.err')
        var btn = document.querySelector('.btn-primary');
        var form = document.querySelector('#form-1');



        var isCheck = false
        var inputs = Array.prototype.slice.call(inp)
        var max_point
        inputs.forEach(function(input, index) {
            input.oninput = function() {
               
               check()  
            }
        })
        

        function check() {
            var result = inputs.every(function(input) {
                // console.log(max_point)
                max_point = input.getAttribute('data-id') 
                return Number(input.value) <= Number(max_point)
            })
            if (result) {
                btn.onclick = function(e) {
                    form.submit()
                }
                err.innerText = ""
            } else {
                err.innerText = "số bạn nhập không được vượt quá điểm tối đa"
                btn.onclick = function(e) {
                    e.preventDefault();
                }
            }
        }
    </script>
@endsection
