@extends('layouts.admin')

@section('main')
    <h2>ADD CRITERIA</h2>
    <form method="POST" action="{{ route('bhxh.update',$bHXH->teacher->id) }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
              <label for="">Teacher:</label> {{ $bHXH->teacher->first_name }} {{ $bHXH->teacher->last_name }}
              <input type="hidden" name="teacher_id" value="{{ $bHXH->teacher->id }}">
                </div>
                @error('teacher_id')
                <small class="help-block" style="color:red">{{$message}}</small>
            @enderror
                
        </div>
        <div class="col-md-12">
            <label for=""> total value: </label>
            <input type="text"
              class="form-control" value="{{ $bHXH->total_value }}" name="total_value" id="total_value" aria-describedby="helpId" placeholder="total value ">
            @error('total_value')
            <small class="help-block" style="color:red">{{$message}}</small>
            @enderror
    </div>
    <div class="col-md-12">
        <label for=""> Time: </label>
        <select id="select_month" name="month" value="tháng">
        </select>
        <select id="select_year" name="year" value="năm">  
        </select>
        @error('month')
        <small class="help-block" style="color:red">{{$message}}</small>
        @enderror
</div>
        <button class="btn btn-primary">Submit</button>
  
    {{-- </form> --}}
<script>
    var chuoi_thang = '';
    for(var i = 1; i <= 12;i++){
        chuoi_thang += "<option>" + i + "</option>";
    }
    document.getElementById('select_month').innerHTML = chuoi_thang;

    //chuoi nam
    var chuoi_nam = '';
    var d= new Date();
    var nam_hien_tai = d.getFullYear();
    for(var i=nam_hien_tai; i > 1900; i--){
        chuoi_nam += "<option>" + i + "</option>";
    }
    document.getElementById('select_year').innerHTML = chuoi_nam;


</script>
    
@endsection
