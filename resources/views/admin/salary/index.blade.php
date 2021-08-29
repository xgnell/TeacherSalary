@extends('layouts.admin')

@section('main')
<label for="">List salary</label>
<table class="table table-hover">
    <thead>
        <tr>
        <th>ID</th>
        <th>Salary level</th>
        <th>Salary Basic</th>
        <th>Salary Per Hour</th>
        <th>Salary Overtime per hour</th>
        <th>Created At</th>
        <th class="text-right">Action</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($salary as $each)
        <tr>
            <td>{{$each->id}}</td>
            <td>{{$each->salary_level->name}}</td>
            <td>{{number_format($each->salary_basic)}}</td>
            <td>{{ number_format($each->salary_per_hour) }}</td>
            <td>{{number_format($each->salary_ot_per_hour)}}</td>
            <td>{{$each->created_at}}</td>
            <td class="text-right">
                <a href="{{ route('salary.edit',$each->id) }}" class="btn btn-success">
                    <i class="fa fa-edit"></i>
                </a>
                <a href="{{ route('salary.destroy', $each->id) }}" class="btn btn-danger btndelete">
                    <i class="fa fa-trash"></i>
                </a>
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
<div class="paginate">
    {{ $salary->appends(request()->all())->links() }}
</div>

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

