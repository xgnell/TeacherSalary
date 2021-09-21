@extends('layouts.admin')



@section('main')
	{{-- <form class="form-inline">
		<div class="form-group">
			<label for=""></label>
			<input type="text" name="search" value="{{ $search }}" class="form-control" placeholder="search..." aria-describedby="helpId">
			<button class="btn-primary"><i class="fa fa-search"></i></button>
		</div>
	</form>

	<hr> --}}

    <label for="">List History Teaching Hours</label>
    <table class="table table-hover">
        <thead>
            <tr>
				<th>Time</th>
                <th class="text-center">History</th>
            </tr>
        </thead>
        <tbody>
			<!-- Duyệt qua các tháng -->
            @foreach ($teaching_hours as $teaching_hour_by_month)
            <tr>
				@php
					// Lấy ra tháng
					$teaching_hour_timeline = $teaching_hour_by_month[0]->time ?? "";
				@endphp


                <td>{{ (new Datetime($teaching_hour_timeline))->format("Y/m") }}</td>

				<td>
					<table class="col-md-12">
						<tr>
							<th>Teacher</th>
							<th>Total hours</th>
							<th>Total overtime hours</th>
							<th>Last Update By</th>
							<th>Last Update At</th>
							<th>Status</th>
							{{-- <th class="text-right">Action</th> --}}
						</tr>

						<!-- Duyệt qua các giảng viên của từng tháng -->
						@foreach ($teaching_hour_by_month as $teaching_hour_per_teacher)
							<tr>
								@php
									// Lấy ra tên giảng viên một tháng
									$teacher_name = $teaching_hour_per_teacher->teacher->name ?? "";

									// Lấy ra admin chỉnh sửa lần cuối
									$updated_admin = $teaching_hour_per_teacher->updated_admin->name ?? "";

									// Lấy ra thời gian chỉnh sửa lần cuối
									$updated_at = $teaching_hour_per_teacher->updated_at ?? "";

									// Lấy ra trạng thái
									$status = $teaching_hour_per_teacher->status ?? "";
								@endphp

								<td>{{ $teacher_name }}</td>
								<td>{{ $teaching_hour_per_teacher->total_hours }}</td>
								<td>{{ $teaching_hour_per_teacher->total_overtime_hours }}</td>
								<td>{{ $updated_admin }}</td>
								<td>{{ $updated_at }}</td>
								<td>{{ $TeachingHourStatus::getName($status) }}</td>
									
								<!-- Chức năng tương ứng -->
								
								{{-- <td class="text-right">
									<a href="{{ route('history_kpi.edit', $history_kpi_per_teacher[0]->teacher_id) }}" class="btn btn-success">
										<i class="fa fa-edit"></i>
									</a>
									<a href="{{ route('kpi.destroy',$each->id) }}" class="btn btn-danger btndelete">
										<i class="fa fa-trash"></i>
									</a>
								</td> --}}
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