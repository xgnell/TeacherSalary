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
        <th>ID</th>
        <th>Name</th>
        <th>gender</th>
        <th>status</th>
        <th>Image</th>
        <th>Created At</th>
        <th class="text-right">Action</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($teacher as $each)
        <tr>
            <td>{{$each->id}}</td>
            <td>{{$each->first_name}} {{$each->last_name}}</td>
            <td>{{$each->genderName}}</td>
            <td>
                @if ($each->status==1)
                    <span class="badge badge-danger">lock</span>
                @else
                    <span class="badge badge-success">unlock</span>
                @endif
            </td>
            <td><img src="{{ url('public/upload') }}/{{$each->image}}" alt="" style="height: 150px;"></td>
            <td>{{$each->created_at}}</td>
            <td class="text-right">
                <a href="{{ route('teacher.show',$each->id) }}" class="btn btn-primary">
                    <i class="fa fa-eye"></i>
                </a>
                <a href="{{ route('teacher.edit',$each->id) }}" class="btn btn-success">
                    <i class="fa fa-edit"></i>
                </a>
                <a href="{{ route('teacher.destroy', $each->id) }}" class="btn btn-danger btndelete">
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
    {{ $teacher->appends(request()->all())->links() }}
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

