@extends('layouts.admin')

@section('main')
<h1>Update KPI</h1>
<h3>Teacher: {{ $kpi->teacher->first_name }} {{ $kpi->teacher->last_name }}</h3>
@foreach ($criteria as $item)
<div>
    <input type="checkbox" name="criteria" id="criteria" value="{{ $item->criteria_mark }}"> {{ $item->name }}
</div>
@endforeach
<button id="tinh">Tính tổng điểm</button>
<form action="{{ route('kpi.update', $kpi->teacher_id) }}" method="POST">
    @csrf
    <input type="hidden" name="teacher_id" value="{{ $kpi->teacher->id }}">
<input type="text" id="total_value" name="total_value">
<br>
<label for=""> Time: </label>
<input type="date" id="time" name="time" value={{$kpi->time}}>
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



