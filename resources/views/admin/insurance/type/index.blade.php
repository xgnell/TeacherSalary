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

    <label for="">List Insurance Types</label>
    <table class="table table-hover">
        <thead>
            <tr>
            <th>Type</th>
            <th>Value (%)</th>
            <th>Period Id</th>
            <th>Mandatory</th>
            <th class="text-right">Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($insurances as $each)
                <tr>
                    <td>{{$each->type}}</td>
                    <td>{{$each->value}}</td>
                    <td>{{$each->period_id}}</td>
                    <td>{{$each->NameMandatory}}</td>
                    <td class="text-right">
                        <a href="{{ route('insurance.edit',$each->id) }}" class="btn btn-success">
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

    <form action="" method="POST" id="formdelete">
        @csrf
        @method('DELETE')
    </form>

    <hr>

    <div class="paginate">
        {{ $insurances->appends(request()->all())->links() }}
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