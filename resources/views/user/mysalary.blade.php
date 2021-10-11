@extends('layouts.user')

@section('user')
<section class="hero-wrap hero-wrap-2" style="background-image: url('{{ url('public/user') }}/images/bg_1.jpg');">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center">
        <div class="col-md-9 ftco-animate text-center">
          <h1 class="mb-2 bread">My salary</h1>
          <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home')}}">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>My salary <i class="ion-ios-arrow-forward"></i></span></p>
        </div>
      </div>
    </div>
  </section>
    <section>
        {{-- <div class="container"> --}}
            <div class="card-content">
        <h4 class="card-title"> Salary new</h4>
        <div class="table-responsive">
            <table class="table" style="border: 1px solid; text-align: center;">
                <thead>
                    <tr>
                        <th class="text-center">Time</th>
                        <th>Name</th>
                        <th>Total hours</th>
                        <th>Salary basic</th>
                        <th>Total overtime hours</th>
                        <th>Salary per hour</th>
                        <th>Salary overtime per hour</th>
                        <th>Total insurance</th>
                        <th>Total KPI</th>
                        <th >Actions</th>
                    </tr>
                </thead>
                <tbody>
                @if ($history_salary !== null)
                    <tr>
                        <td class="text-center">{{$current_time}}</td>
                        <td>{{ $history_salary->teacher->name }}</td>
                        <td>{{ $history_teaching->total_hours }}</td>
                        <td>{{ $history_salary->basic_salary }}</td>
                        <td>{{ $history_teaching->total_overtime_hours }}</td>
                        <td>{{ $history_salary->salary_per_hour }}</td>
                        <td>{{ $history_salary->salary_overtime_per_hour }}</td>
                        <td>{{ $history_salary->total_insurance }}</td>
                         @php
                         $summary_point = 0;
                        foreach ($history_kpi as $item){
                            $summary_point += $item->point;
                        }
                        
                        @endphp
                        <td>{{ $summary_point }}
                            <br>
                            <button id="detail" class="btn btn-danger" data-toggle="modal" data-target="#modelId">
                                <i class="fa fa-edit">Detail</i>
                            </button>
                        </td>
    
                        <td class="td-actions text-right">
                            {{-- <button rel="tooltip" class="btn btn-success" data-original-title="" title="">
                                <i class="material-icons">confirm</i>
                            </button> --}}
                            <a href="{{ route('contact')}}" rel="tooltip" class="btn btn-info" data-original-title="" title="">
                                <i class="material-icons">Feedback</i>
                            </a>
                            
                        </td>
                    </tr>
              
                    
                   
                </tbody>
            </table>

        </div>
        @else
            <div class="text-center">
                <p>Tháng này chưa có lương.</p>
            </div>
        @endif
        <div class="text-center">
            <a href="{{ route('home.history') }}" class="btn btn-primary">History salary</a>
        </div>
    </div>
       
      
    </section>
@endsection

<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail KPI</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <div>Time: {{$current_time}}</div>
                @foreach ($history_kpi as $item)
                <span class="input-group-addon">
                    {{$item->kpi->criteria }} :  {{$item->point}}
                </span><br>
                @endforeach
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>