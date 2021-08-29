@extends('layouts.admin')

@section('main')
{{url('public/filemanager/dialog.php')}}
    <iframe src="{{url('public/filemanager/dialog.php')}}" style="width:100%; height: 500px; overflow-y:auto; border:none"></iframe>
@endsection