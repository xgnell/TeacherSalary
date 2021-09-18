@extends('layouts.admin')

@section('main')

<form class="form-inline">
    <div class="form-group">
        <label for=""></label>
        <input type="text" name="search" value="{{ $search }}" class="form-control" placeholder="search name"
            aria-describedby="helpId">
        <button class="btn-primary"><i class="fa fa-search"></i></button>
    </div>
</form>
<hr>
<label for="">Salary Caculate</label>
<div class="alert2" role="alert2" style="text-align: center">
</div>
<table class="table table-hover" id="table_id">
    <thead>
        <tr>
            <th>Teacher Name</th>
            <th>salary basic</th>
            <th>salary per hour</th>
            <th>salary overtime hour</th>
            <th>updated by</th>
            <th class="text-right">Action</th>
        </tr>
    </thead>
   
    <tbody>
        
        @foreach ($salary as $each) 
    
            @csrf
            <tr>
                <td>{{ $each->teacher->name }}</td>
                <td>
                    {{ $each->basic_salary  }}
                </td>
                <td>
                    {{ $each->salary_per_hour }}
                </td>
                <td>
                    {{ $each->salary_overtime_per_hour }}
            </td>
            <td>
                {{ $each->admin->name }}
        </td>
                <td class="text-right">
                    {{-- data-toggle="modal" data-target="#modelId"  --}}
                    {{-- javascript:void(0) --}}
                    <button data-toggle="modal" data-id="{{ $each->teacher_id }}" id="pay" data-target="#modelId" class="btn btn-info">edit</button>
                </td>
            </tr>
    
        @endforeach

    </tbody>
   
</table>
<div class="paginate">
    {{ $salary->appends(request()->all())->links() }}
</div>

@endsection
@section('js')
<script src="{{ url('public/slug/salary.js') }}" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('body').on('click', '#pay', function(e) {
            var id = $(this).data('id');
            $.ajax({
                type: "POST",
                url: "{{route('salary.editt')}}",
                dataType: 'json',
                data: {id: id},
                success: function(response) {
                    var result = response.salary;
                    var teacher_id = parseFloat(result.id);
                    var salary_per_hour=parseFloat(result.salary_per_hour);
                    var salary_overtime_per_hour=parseFloat(result.salary_overtime_per_hour);
                    $('#teacher').html(result.name);
                    $('#teacher_id').val(teacher_id);
                    $('#salary_overtime_per_hour').val(salary_overtime_per_hour);
                    $('#salary_per_hour').val(salary_per_hour);
                }
            });

        });
        $('body').on('click', '#salary_level', function(e) {
            var level = $('#salary_level').val();
            $.ajax({
                type: "POST",
                url: "{{route('salary.editt')}}",
                dataType: 'json',
                data: {level: level},
                success: function(response) {
                    var lv = response.salary_level;
                    $('#salary_basic').html(lv.basic_salary);
                }
            });

        });
        $('body').on('click', '#update', function(e) {
            var _id = $('#teacher_id').val();
            var salary_overtime_per_hour = $('#salary_overtime_per_hour').val();
             var salary_per_hour = $('#salary_per_hour').val();
             var salary_level = $('#salary_level').val();
             var updated_by= $('#updated_by').val();
            $.ajax({
                type: "POST",
                url: "{{route('salary.updated')}}",
                dataType: 'json',
                data: {id: _id,
                    salary_overtime_per_hour:salary_overtime_per_hour,
                    salary_per_hour:salary_per_hour,
                    salary_level:salary_level,
                    updated_by:updated_by,
                },
                success: function(response) {
                    if(response.error) {
                        var err = response.error;
                       
                            $('#salary_level_e').html(err.salary_level);
                        $('#salary_overtime_per_hour_e').html(err.salary_overtime_per_hour);
                        $('#salary_per_hour_e').html(err.salary_per_hour);
                   
                       
                    }else if(response.success) {
                         $("#modelId").modal('hide');
                         $("#table_id").load(window.location + " #table_id");
                    $(".alert2").addClass("alert-success");
                    $(".alert2").html(response.success);
                     setTimeout(function(){  $(".alert-success").hide(); }, 2000);
                    }
                   
                }
            });

        });
   
    });
</script>
@endsection

<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" style="display: none" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">UPDATE SALARY</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Teacher:</label>
                                <label for="" id="teacher"></label>
                                <input type="hidden" class="form-control" name="teacher_id" id="teacher_id"
                                    aria-describedby="helpId">
                            </div>
                            </div>
                            @error('teacher_id')
                                <small class="help-block" style="color:red">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="">Salary level:</label>
                            <select name="salary_level" id="salary_level">
                                @foreach ($salaryLevel as $each)
                                    <option value="{{ $each->level }}">{{ $each->level }}</option>
                                @endforeach
                            </select>
                                <small class="help-block" id="salary_level_e" style="color:red"></small>
                            <br>
                            <label for="">Salary Basic:</label>
                            <label for="" id="salary_basic"></label>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Salary per hour:</label>
                                <input type="text" value="" class="form-control" name="salary_per_hour" id="salary_per_hour"
                                    aria-describedby="helpId" placeholder="salary per hour">
                            </div>
                                <small class="help-block" id="salary_per_hour_e" style="color:red"></small>
                
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">% salary overtime:</label>
                                <select id="value" name="value" value="tháng">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Salary overtime per hour:</label>
                                <input type="text" value="" class="form-control" name="salary_overtime_per_hour" id="salary_overtime_per_hour"
                                    aria-describedby="helpId" placeholder="salary overtime per hour">
                            </div>
                        
                                <small class="help-block" id="salary_overtime_per_hour_e" style="color:red"></small>
                          
                
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Updated by Admin:</label>
                                <label for="">{{ Auth::user()->name }}</label>
                                <input type="hidden" value="{{ Auth::user()->id }}" class="form-control" name="updated_by" id="updated_by"
                                    aria-describedby="helpId" readonly>
                            </div>
                            @error('updated_by')
                                <small class="help-block" style="color:red">{{ $message }}</small>
                            @enderror
                
                        </div>
                        
                        <button class="btn btn-primary" id="update">Submit</button>
            </div>
        </div>
    </div>
</div>