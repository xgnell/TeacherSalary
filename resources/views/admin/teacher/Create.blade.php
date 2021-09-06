@extends('layouts.admin')

@section('main')
<h2>ADD TEEACHER</h2>
<form method="POST" action="{{ route('teacher.store') }}">
    @csrf
    <div class="row">
      <div class="col-md-8">
        <div class="row">
          <div class="col-md-12">
              <div class="form-group">
            <label for="">First Name:</label>
            <input type="text"
              class="form-control" name="first_name" id="first_name" aria-describedby="helpId" placeholder="first name">
              </div>
              @error('first_name')
              <small class="help-block" style="color:red">{{$message}}</small>
          @enderror
              
      </div>
      <div class="col-md-12">
          <label for="">Last Name: </label>
          <input type="text"
            class="form-control" name="last_name" id="last_name" aria-describedby="helpId" placeholder="last name">
          @error('last_name')
          <small class="help-block" style="color:red">{{$message}}</small>
          @enderror
          </div>
          <div class="col-md-12">
            <label for="">email: </label>
            <input type="text"
              class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="email">
            @error('email')
            <small class="help-block" style="color:red">{{$message}}</small>
            @enderror
            </div>
            <div class="col-md-12">
              <label for="">password: </label>
              <input type="text"
                class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="password">
              @error('password')
              <small class="help-block" style="color:red">{{$message}}</small>
              @enderror
              </div>
          <div class="col-md-12">
            <label for="">Address: </label>
            <input type="text"
              class="form-control" name="address" id="address" aria-describedby="helpId" placeholder="address">
            @error('address')
            <small class="help-block" style="color:red">{{$message}}</small>
            @enderror
          </div>
          <div class="col-md-12">
            <label for="">Phone: </label>
            <input type="text"
              class="form-control" name="phone" id="phone" aria-describedby="helpId" placeholder="phone">
            @error('last_name')
            <small class="help-block" style="color:red">{{$message}}</small>
            @enderror
          </div>
          <div class="col-md-12">
            <label for="">Birthdate: </label>
            <input type="Date"
              class="form-control" name="birthday" id="birthday" aria-describedby="helpId" placeholder="birthday">
            @error('birthday')
            <small class="help-block" style="color:red">{{$message}}</small>
            @enderror
          </div>
          <div class="col-md-12">
            <label for="">Gender:</label>
            <div>
                <label for="">Male: </label>
                <input type="radio" name="gender" id="gender" aria-describedby="helpId" value="1" checked="checked">
                <label for="">Female: </label>
            <input type="radio" name="gender" id="gender" aria-describedby="helpId" value="0">
            </div>
            @error('gender')
            <small class="help-block" style="color:red">{{$message}}</small>
            @enderror
          </div>
      </div>
      {{-- end ben trai --}}
      
      <button class="btn btn-primary">Submit</button>
    </div>
    <div class="col-md-4">
      <div class="row">
        <div class="col-md-12">
          <label for="">Teaching Formality: </label>
          <br>
          <select name="teaching_formality" id="">
            <option value="1">Fulltime</option>
            <option value="0">PartTime</option>
          </select>
          @error('teaching_formality')
          <small class="help-block" style="color:red">{{$message}}</small>
          @enderror
        </div>
        <div class="col-md-12">
          <label for="">Major: </label>
          <br>
          <select name="major_id" id="">
            @foreach ($major as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
          </select>
          @error('major_id')
          <small class="help-block" style="color:red">{{$message}}</small>
          @enderror
        </div>
        <div class="col-md-12">
          <label for="">Salary: </label>
          <br>
          <select name="salary_id" id="">
            @foreach ($salary as $item)
                <option value="{{ $item->id }}">{{ $item->salary_level->name }} </option>
            @endforeach
          </select>
          @error('salary_id')
          <small class="help-block" style="color:red">{{$message}}</small>
          @enderror
        </div>
        <div class="col-md-12">
          <label for="">Status:</label>
          <div>
              <label for="">lock: </label>
              <input type="radio" name="status" id="status" aria-describedby="helpId" value="1" checked="checked">
              <label for="">unlock: </label>
          <input type="radio" name="status" id="status" aria-describedby="helpId" value="0">
          </div>
          @error('status')
          <small class="help-block" style="color:red">{{$message}}</small>
          @enderror
        </div>
        <div class="col-md-12">
          <label for="">image: </label>
            <input type="hidden"
              class="form-control" name="image" id="image" aria-describedby="helpId" placeholder="image ...">
              <div class="input-group-append">
                <span class="input-group-text">
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modelId">
                        <i class="fa fa-folder-open"></i>
                    </button>
                </span>
            </div>
            <div class="img1" style="padding: 10px 25px; ">
                <img src="" alt="" id="showImg" class="img-responsive" style="width:100%; margin: auto; border: 1px solid black;height : 200px">
            </div>
              @error('image')
                  <small class="help-block">{{$message}}</small>
              @enderror
        </div>
      </div>
    </div>
    </div>
    
    

</form>

<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog modal-custom" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Modal title</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
          </div>
          <div class="modal-body">
              <iframe src="{{url('public/filemanager/dialog.php?field_id=image')}}" style="width:100%; height: 500px; overflow-y:auto; border:none"></iframe>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
      </div>
  </div>
</div>
@endsection
<script>
  
    $('#modelId').on('hide.bs.modal',event =>{
        var _link = $('input#image').val();
        var _img = "{{ url('public/upload') }}" + "/" + _link;
        $('img#showImg').attr('src',_img);
    });

   

</script>