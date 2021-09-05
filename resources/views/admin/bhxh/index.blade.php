@extends('layouts.admin')

@section('main')

<form class="form-inline">
    <div class="form-group">
        <label for=""></label>
        <input type="text" name="search" value="{{$search}}" class="form-control" placeholder="search..." aria-describedby="helpId">
        <button class="btn-primary"><i class="fa fa-search"></i></button>
    </div>
</form>
<hr>
<label for="">List Categories</label>
<table class="table table-hover">
    <thead>
        <tr>
        <th>Teacher ID</th>
        <th>Teacher Name</th>
        <th>Total Value</th>
        <th>Month</th>
        <th>Year</th>
        <th>Created At</th>
        <th class="text-right">Action</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($bhxh as $each)
        <tr>
            <td>{{$each->teacher_id}}</td>
            <td>{{$each->teacher->first_name}} {{$each->teacher->last_name}}</td>
            <td>{{$each->total_value}}</td>
            <td>{{$each->month}}</td>
            <td>{{$each->year}}</td>
            <td>{{$each->created_at}}</td>
            <td class="text-right">
                <a href="{{ route('bhxh.edit',$each->teacher_id) }}" class="btn btn-success">
                    <i class="fa fa-edit"></i>
                </a>
                <a href="{{ route('bhxh.destroy', $each->teacher_id) }}" class="btn btn-danger btndelete">
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
    {{ $bhxh->appends(request()->all())->links() }}
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