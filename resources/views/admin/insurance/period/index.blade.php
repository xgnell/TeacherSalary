@extends('layouts.admin')



@section('main')
    <form class="form-inline">
        <div class="form-group">
            <label for=""></label>
            <input type="text" name="search" value="{{$search}}" class="form-control" placeholder="search..." aria-describedby="search">
            <button class="btn-primary"><i class="fa fa-search"></i></button>
        </div>
    </form>

    <hr>
    <a href="{{ route('insurance_period.create') }}" class="btn btn-primary">Add period</a>
    <br>
    <label for="">List Insurance Periods</label>
    <table class="table table-hover">
        <thead>
            <tr>
            <th>Name</th>
            <th>Period (months)</th>
            <th class="text-right">Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($periods as $each)
                <tr>
                    <td>{{$each->name}}</td>
                    <td>{{$each->period}}</td>
                    <td class="text-right">
                        <a href="{{ route('insurance_period.edit',$each->id) }}" class="btn btn-success">
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
        {{ $periods->appends(request()->all())->links() }}
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