@extends('layouts.admin')



@section('main')
	<form class="form-inline">
		<div class="form-group">
			<label for=""></label>
			<input type="text" name="search" value="{{ $search }}" class="form-control" placeholder="search..." aria-describedby="helpId">
			<button class="btn-primary"><i class="fa fa-search"></i></button>
		</div>
	</form>

	<hr>

    <label for="">List History Salary</label>
    <table class="table table-hover">
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
								<td>{{ $salary->basic_salary }}</td>
								<td>{{ $salary->salary_per_hour }}</td>
								<td>{{ $salary->salary_overtime_per_hour }}</td>
								<td>{{ $salary->total_insurance }}</td>
								<td>{{ $salary->total_kpi }}</td>
								<td>{{ $salary->total_salary }}</td>
								<td>{{ $HistorySalaryStatus::getName($salary->status) }}</td>
								<td>{{ $salary->updated_at }}</td>
									
								<!-- Chức năng tương ứng -->
								
								<td class="text-right">
									<a href="">
										Detail KPI points
									</a>
									<a href="">
										Detail Teaching hours
									</a>
									<a href="">
										Detail Insurances
									</a>
									{{-- <a href="{{ route('history_kpi.edit', $history_kpi_per_teacher[0]->teacher_id) }}" class="btn btn-success">
										<i class="fa fa-edit"></i>
									</a> --}}
									{{-- <a href="{{ route('kpi.destroy',$each->id) }}" class="btn btn-danger btndelete">
										<i class="fa fa-trash"></i>
									</a> --}}
								</td>
							</tr>
						@endforeach
					</table>
				</td>
				
            </tr>
        @endforeach

        </tbody>
        
    </table>
	
    <form action="" method="POST" id="formdelete">
        @csrf
        @method('DELETE')
    </form>

    <hr>

    {{-- <div class="paginate">
        {{ $history_kpis->appends(request()->all())->links() }}
    </div> --}}

@endsection



@section('js')
    <script>
        $('.btndelete').click(function(event){
            event.preventDefault();
            var _href = $(this).attr('href');
            $('form#formdelete').attr('action',_href);
            if(confirm('Are you sure you want to delete')){
                $('form#formdelete').submit();
            }
        });
    </script>
@endsection