@extends('layouts.user')

@section('user')
<section class="hero-wrap hero-wrap-2" style="background-image: url('{{ url('public/user') }}/images/bg_1.jpg');">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center">
        <div class="col-md-9 ftco-animate text-center">
          <h1 class="mb-2 bread">Infomation Teacher</h1>
          <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('contact')}}">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Teacher <i class="ion-ios-arrow-forward"></i></span></p>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section bg-light">
          <div class="container-fluid px-4">
            <div  class="container">
              <div class="row">
                <div class="col-md-12">
                          <div class="card">
                              <div class="card-content">
                                  <h4 class="card-title">Profile -
                                      <small class="category">your profile</small>
                                  </h4>
                                      <div class="row">
                                          <div class="col-md-5">
                                              <div class="form-group label-floating is-empty">
                                                  <label class="control-label">Name</label>                                        
                                                  <input type="text" value="{{ $teacher->name }}" class="form-control" disabled="">
                                              <span class="material-input"></span></div>
                                          </div>
                                          <div class="col-md-3">
                                              <div class="form-group label-floating is-empty">
                                                  <label class="control-label">Email address</label>
                                                  <input type="email" value="{{ $teacher->email }}"  class="form-control" disabled="">
                                              <span class="material-input"></span></div>
                                          </div>
                                          <div class="col-md-4">
                                              <div class="form-group label-floating is-empty">
                                                  <label class="control-label">Phone</label>
                                                  <input type="text" value="{{ $teacher->phone }}"  class="form-control" disabled="">
                                              <span class="material-input"></span></div>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-md-6">
                                              <div class="form-group label-floating is-empty">
                                                  <label class="control-label">Major</label>
                                                  <input type="text" value="{{ $teacher->major->name }}" class="form-control" disabled="">
                                              <span class="material-input"></span></div>
                                          </div>
                                          <div class="col-md-6">
                                              <div class="form-group label-floating is-empty">
                                                  <label class="control-label">Gender</label>
                                                  <input type="text" value="{{ $teacher->name }}" class="form-control" disabled="">
                                              <span class="material-input"></span></div>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-md-12">
                                              <div class="form-group label-floating is-empty">
                                                  <label class="control-label">Address</label>
                                                  <input type="text" value="{{ $teacher->address }}" class="form-control" disabled=""> 
                                              <span class="material-input"></span></div>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-md-4">
                                              <div class="form-group label-floating is-empty">
                                                  <label class="control-label">Birthdate</label>
                                                  <input type="date" class="form-control" value="{{ $teacher->birthday }}" disabled="">
                                              <span class="material-input"></span></div>
                                          </div>
                                      </div>
                                      <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#modelId">Change password</button>
                                      <div class="clearfix"></div>
                                
                              </div>
                          </div>
                      </div>
            </div>
            </div>
              
          </div>
      </section>
      
      <!-- Modal -->
      <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title">Change Password</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                  </div>
                  <div class="modal-body">
                  
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="main-card mb-3  card">
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            <h4>Change Password</h4>
                                        </h4>
                                
                                            <div class="col-md-12">
                                                <div class="form-group mt-3">
                                                    <label for="current_password">Old password</label>
                                                    <input type="password" id="current_password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" required
                                                        placeholder="Enter current password">
                                                    @error('current_password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                   
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group mt-3">
                                                    <label for="new_password ">new password</label>
                                                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required
                                                        placeholder="Enter the new password">
                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                   
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group mt-3">
                                                    <label for="confirm_password">confirm password</label>
                                                    <input type="password" id="confirm_password" name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror"required placeholder="Enter same password">
                                                    @error('confirm_password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                   
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-first mt-4 ml-2">
                                                <button class="btn btn-success toastrDefaultSuccess"
                                                    id="change">change password</button>
                                            </div>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>        
             
                  </div>
              </div>
          </div>
      </div>
      @endsection
      @section('js')
      <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('body').on('click','#change', function(e) {
                var current_password = $('#current_password').val();
                var password = $('#password').val();
                var confirm_password = $('#confirm_password').val();
                $.ajax({
                    type: "POST",
                    url: "{{route('home.change')}}",
                    dataType: 'json',
                    data: {
                        current_password: current_password,
                        password: password,
                        confirm_password:confirm_password,
                    },
                    success: function(response) {
                        if(response.error){
                            alert(response.error);
                        }else if(response.success){
                            $("#modelId").modal('hide');
                            alert(response.success);
                        }
                    }
                });
    
            });
       
        });
    </script>
      @endsection