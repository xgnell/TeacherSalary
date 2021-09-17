@extends('layouts.admin')

@section('main')
    <h2>ADD ACCOUNT ADMIN</h2>
    <form method="POST" action="{{ route('admin.store') }}">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
              <label for="">Name:</label>
              <input type="text"
              class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="name ">
                </div>
                @error('name')
                <small class="help-block" style="color:red">{{$message}}</small>
            @enderror
                
        </div>
        <div class="col-md-12">
            <label for=""> email: </label>
            <input type="text"
              class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="email ">
            @error('email')
            <small class="help-block" style="color:red">{{$message}}</small>
            @enderror
    </div>
    <div class="col-md-12">
        <label for=""> password: </label>
        <input type="text"
              class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="password ">
        @error('password')
        <small class="help-block" style="color:red">{{$message}}</small>
        @enderror
</div>
<div class="col-md-12">
    <label for=""> confirm password: </label>
    <input type="text"
          class="form-control" name="confirm_password" id="confirm_password" aria-describedby="helpId" placeholder="confirm_password ">
    @error('confirm_password')
    <small class="help-block" style="color:red">{{$message}}</small>
    @enderror
</div>

<div class="col-md-12">
    <label for=""> phone: </label>
    <input type="number"
      class="form-control" name="phone" id="phone" aria-describedby="helpId" placeholder="phone ">
    @error('phone')
    <small class="help-block" style="color:red">{{$message}}</small>
    @enderror
</div>
<div class="col-md-12">
    <label for=""> status: </label>
    <select name="status" id="status">
        <option value="0">unlock</option>
        <option value="1">lock</option>
    </select>
    @error('status')
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
<div class="col-md-12">
    <label for=""> Role: </label>
    <select name="role" id="role">
        <option value="0">admin</option>
        <option value="1">super Admin</option>
    </select>
    @error('role')
    <small class="help-block" style="color:red">{{$message}}</small>
    @enderror
</div>

        <button class="btn btn-primary">Submit</button>
  
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
@section('js')
    <script>
  
  $('#modelId').on('hide.bs.modal',event =>{
      var _link = $('input#image').val();
      var _img = "{{ url('public/upload') }}" + "/" + _link;
      $('img#showImg').attr('src',_img);
  });

</script>
@endsection