@extends('layouts.admin')
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    
@endsection

@section('main')
<a href="{{ route('history_salary.index') }}" class="btn btn-danger">Back</a>

	<hr>

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
		});
		
	
	
	
    </script>
@endsection