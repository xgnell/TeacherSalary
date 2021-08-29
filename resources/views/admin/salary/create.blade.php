@extends('layouts.admin')

@section('main')
    <h2>ADD Salary</h2>
    <form method="POST" action="{{ route('salary.store') }}">
        @csrf
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
          <label for="">Salary level:</label>
          <select name="salary_level_id" id="">
            @foreach ($salaryLevel as $item)
                  <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
          </select>
              
            </div>
            @error('salary_level_id')
            <small class="help-block" style="color:red">{{$message}}</small>
            @enderror
            
        </div>
            <div class="col-md-12">
                <div class="form-group">
              <label for="">Salary Basic:</label>
              <input type="text"
                class="form-control" name="salary_basic" id="salary_basic" aria-describedby="helpId" placeholder="salary basic">
                </div>
                @error('salary_basic')
                <small class="help-block" style="color:red">{{$message}}</small>
            @enderror
                
        </div>
        <div class="col-md-12">
            <label for="">Salary per hour: </label>
            <input type="text"
              class="form-control" name="salary_per_hour" id="salary_per_hour" aria-describedby="helpId" placeholder="salary per hour">
            @error('salary_per_hour')
            <small class="help-block" style="color:red">{{$message}}</small>
            @enderror
    </div>
    <div class="col-md-12">
      <div class="form-group">
    <label for="">% of salary per hour:</label>
        <select id="percent" name="percent"></select>
      </div>
    </div>
    <div class="col-md-12">
        <label for="">Salary OverTime per hour: </label>
        <input type="text"
          class="form-control" name="salary_ot_per_hour" id="salary_ot_per_hour" aria-describedby="helpId" placeholder="salary overtime per hour">
        @error('salary_ot_per_hour')
        <small class="help-block" style="color:red">{{$message}}</small>
        @enderror
</div>
        <button class="btn btn-primary">Submit</button>
  
    </form>

    <script type="text/javascript">
  var chuoi_p = '';
    for(var i = 0; i <= 100;i++){
        chuoi_p += "<option>" + i + "</option>";
    }
    document.getElementById('percent').innerHTML = chuoi_p;

    
</script>

@endsection
@section('js')
<script src="{{ url('public/slug') }}/salary.js" type="text/javascript"></script>
@endsection

