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
<label for="">List Admin</label>
<table class="table table-hover">
    <thead>
        <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Created At</th>
        <th class="text-right">Action</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($admin as $each)
        <tr>
            <td>{{$each->name}}</td>
            <td>{{$each->email}}</td>
            <td>
                @if ($each->role == 0)
                    {{ "admin" }}
                @else
                    {{ "Super Admin" }}
                @endif
        </td>
         
            <td>{{$each->created_at}}</td>
            <td class="text-right">
                <a href="{{ route('admin.edit',$each->id) }}" class="btn btn-success">
                    <i class="fa fa-edit"></i>
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
    {{ $admin->appends(request()->all())->links() }}
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