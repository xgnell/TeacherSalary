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

    <label for="">List KPI Criterias</label>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Criteria</th>
                <th>Max Point</th>
                <th class="text-right">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($criterias as $each)
            <tr>
                <td>{{$each->criteria}}</td>
                <td>{{$each->max_point}}</td>
                <td class="text-right">
                    <a href="{{ route('kpi.edit',$each->id) }}" class="btn btn-success">
                        <i class="fa fa-edit"></i>
                    </a>
                    {{-- <a href="{{ route('kpi.destroy',$each->id) }}" class="btn btn-danger btndelete">
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
        {{ $criterias->appends(request()->all())->links() }}
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

