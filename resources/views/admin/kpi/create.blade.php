@extends('layouts.admin')

@section('main')
<h1>Tinh tong KPI</h1>
<h3>Teacher: {{ $teacher->first_name }} {{ $teacher->last_name }}</h3>
@foreach ($criteria as $item)
<div>
    <input type="checkbox" name="criteria" id="criteria" value="{{ $item->criteria_mark }}"> {{ $item->name }}
</div>
@endforeach
<button id="tinh">Tính tổng điểm</button>
<form action="{{ route('kpi.add') }}" method="POST">
    @csrf
    <input type="hidden" name="teacher_id" value="{{ $teacher->id }}">
<input type="text" id="total_value" name="total_value">
<br>
<label for=""> Time: </label>
<input type="date" id="time" name="time">
        
        <div>
            <button>Submit</button>
        </div>
</form>

<script>
  
    $('#tinh').click(function(e){
        let total = 0;
        let criteria = document.getElementsByName('criteria');
        for(var i= 0;i<criteria.length;i++){
            if(criteria[i].checked){
                let item = parseFloat(document.getElementById('criteria').value); 
                total = total + item;   
            }
            
        }
         $('input#total_value').val(total);
    });
</script>  
@endsection



