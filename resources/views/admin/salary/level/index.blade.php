@extends('layouts.admin')

@section('main')

<a href="{{ route('salary_level.create') }}">Add salary level</a>
<hr>
<label for="">List Categories</label>
<table class="table table-hover">
    <thead>
        <tr>
        <th>Level</th>
        <th>Salary Basic</th>
        <th>Created At</th>
        <th class="text-right">Action</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($salary_lv as $each)
        <tr>
            <td>{{$each->level}}</td>
            <td>{{$each->basic_salary}}</td>
            <td>{{$each->created_at}}</td>
            <td class="text-right">
                <a href="{{ route('salary_level.edit',$each->level) }}" class="btn btn-success">
                    <i class="fa fa-edit"></i>
                </a>
                <a href="{{ route('salary_level.destroy', $each->level) }}" class="btn btn-danger btndelete">
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
    {{ $salary_lv->appends(request()->all())->links() }}
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

