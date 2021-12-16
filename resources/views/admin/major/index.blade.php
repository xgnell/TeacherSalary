@extends('layouts.admin')
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    
@endsection
@section('main')

<hr>
<h2>All Majors</h2>

<table class="table table-hover pt-2" id="example" class="display">
    <thead>
        <tr>
        {{-- <th>ID</th> --}}
        <th>Name</th>
        <th>Created at</th>
        <th class="text-right">Action</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($major as $each)
        <tr>
            {{-- <td>{{$each->id}}</td> --}}
            <td>{{$each->name}}</td>
            <td>{{$each->created_at}}</td>
            <td class="text-right">
                <a href="{{ route('major.edit',$each->id) }}" class="btn btn-success">
                    <i class="fa fa-edit"></i>
                </a>
                <a href="{{ route('major.destroy', $each->id) }}" class="btn btn-danger btndelete">
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
    {{ $major->appends(request()->all())->links() }}
</div>

@endsection

@section('js')
{{-- <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
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
</script> --}}
@endsection

