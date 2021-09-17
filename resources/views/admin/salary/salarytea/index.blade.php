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
<table class="table table-hover">
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
            <input type="hidden" id="teacher_id" value="{{ $each->id }}" name="teacher_id" >
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
                    $('#teacher').html(result.name);
                    $('#teacher_id').val(result.id);
                    $('#salary_overtime_per_hour').val(result.salary_overtime_per_hour);
                    $('#salary_per_hour').val(result.salary_per_hour);
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
   
    });
</script>
@endsection

<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">UPDATE SALARY</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('salary.updated')}}">
                    @csrf
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
                                    <option id="salary_option" value="{{ $each->level }}">{{ $each->level }}</option>
                                @endforeach
                            </select>
                            @error('salary_level')
                                <small class="help-block" style="color:red">{{ $message }}</small>
                            @enderror
                            <br>
                            <label for="">Salary Basic:</label>
                            <label for="" id="salary_basic"></label>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Salary per hour:</label>
                                <input type="text" class="form-control" name="salary_per_hour" id="salary_per_hour"
                                    aria-describedby="helpId" placeholder="salary per hour">
                            </div>
                            @error('salary_per_hour')
                                <small class="help-block" style="color:red">{{ $message }}</small>
                            @enderror
                
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
                                <input type="text" class="form-control" name="salary_overtime_per_hour" id="salary_overtime_per_hour"
                                    aria-describedby="helpId" placeholder="salary overtime per hour">
                            </div>
                            @error('salary_overtime_per_hour')
                                <small class="help-block" style="color:red">{{ $message }}</small>
                            @enderror
                
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Updated by Admin:</label>
                                <label for="">{{ Auth::user()->name }}</label>
                                <input type="hidden" value="{{ Auth::user()->id }}" class="form-control" name="updated_by" id="updated_by"
                                    aria-describedby="helpId" readonly>
                            </div>
                            @error('salary_overtime_per_hour')
                                <small class="help-block" style="color:red">{{ $message }}</small>
                            @enderror
                
                        </div>
                        
                        <button class="btn btn-primary">Submit</button>
                
                </form>
            </div>
        </div>
    </div>
</div>