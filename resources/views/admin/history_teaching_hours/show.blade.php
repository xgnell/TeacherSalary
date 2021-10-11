@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    
@endsection


@section('main')
    <label for="">Teaching hours of current month ({{ date("m/Y") }})</label>
    <table class="table table-hover" id="example" class="display">
        <thead>
            <tr>
				<th>Teacher</th>
				<th>Total Hours</th>
				<th>Total Overtime Hours</th>
				<th>Last Update By</th>
				<th>Last Update At</th>
				<th>Status</th>
				<th class="text-right">Action</th>
            </tr>
        </thead>
        <tbody>
			<!-- Duyệt qua các giảng viên của từng tháng -->
			@foreach ($history_teaching_hours as $teaching_hours_per_teacher)
				<tr>
					@php
						// Lấy ra tên giảng viên một tháng
						$teacher_name = $teaching_hours_per_teacher->teacher->name ?? "";

						// Lấy ra admin chỉnh sửa lần cuối
						$updated_admin = $teaching_hours_per_teacher->updated_admin->name ?? "";

						// Lấy ra thời gian chỉnh sửa lần cuối
						$updated_at = $teaching_hours_per_teacher->updated_at ?? "";

						// Lấy ra trạng thái
						$status = $teaching_hours_per_teacher->status ?? "";
					@endphp

					<td>{{ $teacher_name }}</td>
					<td>{{ $teaching_hours_per_teacher->total_hours }}</td>
					<td>{{ $teaching_hours_per_teacher->total_overtime_hours }}</td>
					<td>{{ $updated_admin }}</td>
					<td>{{ $updated_at }}</td>
					<td>{{ $TeachingHourStatus::getName($status) }}</td>
						
					<!-- Chức năng tương ứng -->
					<td class="text-right">
						<a href="{{ route('history_teaching_hours.edit', $teaching_hours_per_teacher->teacher_id) }}" class="btn btn-success">
							<i class="fa fa-edit"></i>
						</a>
						{{-- <a href="{{ route('kpi.destroy',$each->id) }}" class="btn btn-danger btndelete">
							<i class="fa fa-trash"></i>
						</a> --}}
					</td>
				</tr>
			@endforeach
        </tbody>
    </table>

	@if (!$is_updated_all)
		<form action="{{ route('history_teaching_hours.create') }}" method="GET">
			@csrf
			<button class="btn btn-primary" type="submit">Update teaching hours for other teacher</button>
		</form>
	@endif

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
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <script>
		 $(document).ready(function() {
                $('#example').DataTable({
                    "pagingType": "full_numbers"
                });
            });
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