@extends('layouts.admin')
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    
@endsection
@section('main')
  
    <a href="{{ route('export') }}" id="export_excel" onclick="return confirm('Are you sure you want to export')">Export
        list teacher Excel</a>
    <hr>
    <label for="">List teacher</label>
    <table class="table table-hover" id="example" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>gender</th>
                <th>status</th>
                <th>Major</th>
                <th>Image</th>
                <th>Created At</th>
                <th class="text-right">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($teacher as $each)
                <tr>
                    <td>{{ $each->id }}</td>
                    <td>{{ $each->name }}</td>
                    <td>{{ $each->GenderName }}</td>
                    <td>
                        @if ($each->status == 1)
                            <span class="badge badge-danger">lock</span>
                        @else
                            <span class="badge badge-success">unlock</span>
                        @endif
                    </td>
                    <td>{{ $each->major->name }}</td>
                    <td><img src="{{ url('public/upload') }}/{{ $each->image }}" alt="" style="height: 100px;"></td>
                    <td>{{ $each->created_at }}</td>
                    <td class="text-right">
                        <a href="{{ route('teacher.edit', $each->id) }}" class="btn btn-success">
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


@endsection

@section('js')
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).ready(function() {
                $('#example').DataTable({
                    "pagingType": "full_numbers"
                });
            });
            $('.btndelete').click(function(event) {
                event.preventDefault();
                var _href = $(this).attr('href');
                $('form#formdelete').attr('action', _href);
                if (confirm('Are you sure you want to delete')) {
                    $('form#formdelete').submit();
                }
            });


        });
    </script>



@endsection
