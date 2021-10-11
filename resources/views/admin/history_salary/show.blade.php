@extends('layouts.admin')
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    
@endsection

@section('main')
<a href="{{ route('history_salary.index') }}" class="btn btn-danger">Back</a>
	<hr>
    <div class="alert2" role="alert2" style="text-align: center">
    </div>
    <label for="">List History Salary</label>
    <div id="loaddata">
    <table class="table table-hover" id="example" class="display">
        <thead>
            <tr>
				<th>Time</th>
                <th class="text-center">History</th>
            </tr>
        </thead>
        <tbody>
			<!-- Duyệt qua các tháng -->
            @foreach ($history_salaries as $history_salary)
            <tr>
				@php
					// Lấy ra tháng
					$timeline = $history_salary[0]->time ?? "";
				@endphp
                <td>{{ (new Datetime($timeline))->format("Y/m") }}</td>
				<td>
					<div class="infoo">
					<table class="col-md-12">
						<tr>
							<th>Teacher</th>
							<th>Basic Salary</th>
							<th>Salary/Hour</th>
							<th>Overtime Salary/Hour</th>
							<th>Total Insurance (% Salary)</th>
							<th>Total KPI Points</th>
							<th>Total Salary</th>
							<th>Status</th>
							<th>Last Updated</th>
							<th class="text-right">Action</th>
						</tr>

						<!-- Duyệt qua các giảng viên của từng tháng -->
						@foreach ($history_salary as $salary)
							<tr>
								<td>{{ $salary->teacher->name }}</td>
								<td>{{ number_format($salary->basic_salary) }}</td>
								<td>{{ number_format($salary->salary_per_hour) }}</td>
								<td>{{ number_format($salary->salary_overtime_per_hour) }}</td>
								<td>{{ number_format($salary->total_insurance) }}</td>
								<td>{{ $salary->total_kpi }}</td>
								<td>{{ number_format($salary->total_salary) }}</td>
								<td>{{ $HistorySalaryStatus::getName($salary->status) }}</td>
								<td>{{ $salary->updated_at }}</td>
									
								<!-- Chức năng tương ứng -->
								
								<td class="text-right">
									<button id="pay" data-time="{{$timeline}}" data-id="{{ $salary->teacher->id }}" class="btn btn-success" data-toggle="modal"
										data-target="#modelId" data-toggle="modal" data-target="#modelId">Update</button>
								</td>
							</tr>
						@endforeach
					</table>
					</div>
				</td>
				
            </tr>
        @endforeach

        </tbody>
        
    </table>
</div>

@endsection



@section('js')
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <script>
       

       
		 $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
                $('#example').DataTable({
                    "pagingType": "full_numbers"
                });
                $('body').on('click','#pay', function(){
                    var time = $(this).data('time');
                    var teacher_id = $(this).data('id');
                    $.ajax({
                        type: "POST",
                        url: "{{ route('history_salary.edit')}}",
                        dataType: "json",
                        data: {
                           
                            time: time,
                            teacher_id: teacher_id
                        },
                        success: function(response) {

                            var arr = response.history_salaries;
                            $.each(arr, function(key, result) {
                                $('#time').val(result.time);
                                $('#teacher_id').val(result.teacher_id);
                            $('#name').html(result.name);
                            $('#basic_salary').val(result.basic_salary);
                            $('#salary_per_hour').val(result.salary_per_hour);
                            $('#salary_overtime_per_hour').val(result.salary_overtime_per_hour);
                            $('#total_hours').val(result.total_hours);
                            $('#total_overtime_hours').val(result.total_overtime_hours);
                            $('#total_insurance').val(result.total_insurance);
                            const kpi = Number(result.total_kpi)                 
                                 $('#total_kpi').val(kpi)
                                 $('#total_salary').val(result.total_salary)
                                 //update giờ dạy
                                 var total_hour = document.querySelector('#total_hours')
                                 var total_overtime_hour = document.querySelector('#total_overtime_hours')
                                 
                              
                                    total_hour.oninput = function(e) {
                                     const salary = result.basic_salary + result.salary_per_hour *
                                     e.target.value+result.salary_overtime_per_hour * total_overtime_hour.value;
                                     const t_insurance = salary * result.insurance / 100;
                                     $('#total_insurance').val(t_insurance); 
                                     var t_salary = salary - t_insurance;
                                     $('#total_salary').val(t_salary)
                                 }   
                                 
                                 
                                 total_overtime_hour.oninput = function(e) {
                                     const salary = result.basic_salary + result.salary_per_hour *
                                     total_hour.value+result.salary_overtime_per_hour * e.target.value;
                                     const t_insurance = salary * result.insurance / 100;
                                    $('#total_insurance').val(t_insurance);
                                    var t_salary = salary - t_insurance;
                                     $('#total_salary').val(t_salary)

                                 } 
                             
                                 $('body').on('click','#send', function(){
                                     var time = $('#time').val();
                                     var total_hours = $('#total_hours').val();
                                     var total_overtime_hours = $('#total_overtime_hours').val();
                                     var total_insurance = $('#total_insurance').val();
                                     var total_salary = $('#total_salary').val();
                                    $.ajax({
                                        type: "POST",
                                        url: "{{ route('history_salary.update')}}",
                                        dataType: "json",
                                        data: {
                                            teacher_id: result.teacher_id,
                                            time : time,
                                            total_hours:total_hours,
                                            total_overtime_hours:total_overtime_hours,
                                            total_insurance:total_insurance,
                                            total_salary:total_salary
                                        },
                                        success: function(response) {
                                            if (response.error) {
                                                        var error = response.error

                                                        $(".alert").addClass("alert-danger");
                                                        $(".alert").html(response.error);
                                                        setTimeout(
                                                            function() {
                                                                $(".alert").removeClass("alert-danger");
                                                                $(".alert").html('');
                                                            }, 2000)
                                                    } else if (response.success) {
                                                        $('#loaddata').load(document.URL +  ' #loaddata');

                                                        var success =response.success
                                                        $("#modelId").modal('hide');
                                                        $(".alert2").addClass("alert-success");
                                                        $(".alert2").html(response.success);
                                                        setTimeout(
                                                            function() {
                                                                $(".alert2").removeClass("alert-success");
                                                                $(".alert2").html('');
                                                            }, 2000)

                                                    }
                                        }

                                 })
                            })
                                 
                                   
                            
                                   
                                
                        })
                    }
                })
                
            });
        })
		
	
	
	
    </script>
@endsection
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" style="display: none;width: 60%;margin-left: 20%;">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Modal title</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
			</div>
			<div class="modal-body">
				<div class="alert" role="alert" style="text-align: center">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <input type="hidden" name="teacher_id" id="teacher_id" class="form-control">
                        <div class="form-group">
                            <label for="">Name: </label>
                            <label for="" id="name"></label>
                        </div>
                        <div class="form-group">
                            <label for="">Time:</label>
                            <input disabled type="date" id="time" name="time">
                        </div>
                        <div class="form-group">
                            <label for="">Salary basic:</label>
                            <input type="text" disabled name="basic_salary" id="basic_salary" class="form-control"
                                placeholder="" aria-describedby="helpId">
                        </div>
                        <div class="form-group">
                            <label for="">Salary per hour:</label>
                            <input type="text" disabled name="salary_per_hour" id="salary_per_hour"
                                class="form-control" placeholder="" aria-describedby="helpId">
                        </div>
                        <div class="form-group">
                            <label for="">Salary overtime per hour:</label>
                            <input type="text" disabled name="salary_overtime_per_hour " id="salary_overtime_per_hour"
                                class="form-control" placeholder="" aria-describedby="helpId">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">total hours:</label>
                            <input type="text" name="total_hours" id="total_hours" class="form-control"
                                placeholder="" aria-describedby="helpId">
                        </div>
                        @error('total_hours')
                            <small class="help-block" style="color:red">{{ $message }}</small>
                        @enderror
                        <div class="form-group">
                            <label for="">total overtime hours:</label>
                            <input type="text" name="total_overtime_hours" id="total_overtime_hours"
                                class="form-control" placeholder="" aria-describedby="helpId">
                        </div>
                        @error('total_overtime_hours')
                            <small class="help-block" style="color:red">{{ $message }}</small>
                        @enderror
                        <div class="form-group">
                            <label for="">Mark KPI:</label>
                            <input type="text" disabled name="total_kpi" id="total_kpi" class="form-control"
                                placeholder="" aria-describedby="helpId">
                        </div>
                        <div class="form-group">
                            <label for="">total money insurance:</label>
                            <input type="text" disabled name="total_insurance" id="total_insurance"
                                class="form-control" placeholder="" aria-describedby="helpId">
                        </div>
                        <div class="form-group">
                            <label for="">Status:</label>
                            <label for="" id="status_text"></label>
                        </div>
                    </div>

                </div>
                <div class="form-group">
                    <label for="">Total Salary:</label>
                    <input type="text" disabled name="total_salary" id="total_salary" class="form-control"
                        placeholder="" aria-describedby="helpId">
                </div>

                <button id="send" class="btn btn-success">UPDATE</button>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>