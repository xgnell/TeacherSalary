@extends('layouts.admin')



@section('main')
    <form class="form-inline">
        <div class="form-group">
            <label for=""></label>
            <input type="text" name="search" value="{{ $search }}" class="form-control" placeholder="search..." aria-describedby="search">
            <button class="btn-primary"><i class="fa fa-search"></i></button>
        </div>
    </form>

    <hr>

    <label for="">List Teacher Insurances</label>
    <table class="table table-hover">
        <thead>
            <tr>
				<th>Teacher Name</th>
				<th>Insurance Type</th>
				<th class="text-right">Action</th>
        	</tr>
        </thead>
        <tbody>
            @foreach ($insurance_by_teacher as $insurances)
                <tr>
					@php
                        // Lấy tên giảng viên
						$teacher_name = $insurances[0]->teacher->name;
					@endphp

                    <td>{{ $teacher_name }}</td>
                    <td>
						@foreach ($insurances as $each)
							<span>{{ $each->insurance->type }}</span>
							<br>
						@endforeach
					</td>

                    <td class="text-right">
                        <a href="{{ route('teacher_insurance.edit', $each->teacher_id) }}" class="btn btn-success">
                            <i class="fa fa-edit"></i>
                        </a>
                        {{-- <a href="{{ route('insurance.destroy', $each->id) }}" class="btn btn-danger btndelete">
                            <i class="fa fa-trash"></i>
                        </a> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if (!$is_used_all)
		<form action="{{ route('teacher_insurance.create') }}" method="GET">
			<button class="btn btn-primary" type="submit">Add insurance for other teacher</button>
		</form>
	@endif

    <form action="" method="POST" id="formdelete">
        @csrf
        @method('DELETE')
    </form>

    <hr>

    {{-- <div class="paginate">
        {{ $insurances->appends(request()->all())->links() }}
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