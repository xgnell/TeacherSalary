@extends('layouts.admin')



@section('main')
    <label for="">KPI of current month ({{ date("m/Y") }})</label>
    <table class="table table-hover">
        <thead>
            <tr>
				<th>Teacher</th>
				<th>KPI Summary Point</th>
				<th>Last Update By</th>
				<th>Last Update At</th>
				<th>Status</th>
				<th class="text-right">Action</th>
            </tr>
        </thead>
        <tbody>
			<!-- Duyệt qua các giảng viên của từng tháng -->
			@foreach ($history_kpis as $history_kpi_per_teacher)
				<tr>
					@php
						// Lấy ra tên giảng viên một tháng
						$teacher_name = $history_kpi_per_teacher[0]->teacher->name ?? "";

						// Lấy ra admin chỉnh sửa lần cuối
						$updated_admin = $history_kpi_per_teacher[0]->updated_admin->name ?? "";

						// Lấy ra thời gian chỉnh sửa lần cuối
						$updated_at = $history_kpi_per_teacher[0]->updated_at ?? "";

						// Lấy ra trạng thái
						$status = $history_kpi_per_teacher[0]->status ?? "";

						// Tính tổng điểm KPI của tháng
						$summary_point = 0;
						foreach ($history_kpi_per_teacher as $kpi) {
							$summary_point += $kpi->point;
						}
					@endphp

					<td>{{ $teacher_name }}</td>
					<td>{{ $summary_point }}</td>
					<td>{{ $updated_admin }}</td>
					<td>{{ $updated_at }}</td>
					<td>{{ $HistoryKpiStatus::getName($status) }}</td>
						
					<!-- Chức năng tương ứng -->
					<td class="text-right">
						<a href="">
							Detail KPI points
						</a>
						{{-- <a href="{{ route('history_kpi.edit',$history_kpi_by_teacher[0]->teacher_id) }}" class="btn btn-success">
							<i class="fa fa-edit"></i>
						</a>
						<a href="{{ route('kpi.destroy',$each->id) }}" class="btn btn-danger btndelete">
							<i class="fa fa-trash"></i>
						</a> --}}
					</td>
				</tr>
			@endforeach
        </tbody>
    </table>

	@if (!$is_updated_all)
		<form action="{{ route('history_kpi.create') }}" method="POST">
			@csrf
			<button class="btn btn-primary" type="submit">Update kpi for other teacher</button>
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