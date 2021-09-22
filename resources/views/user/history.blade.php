@extends('layouts.user')

@section('user')
    <section class="hero-wrap hero-wrap-2" style="background-image: url('{{ url('public/user') }}/images/bg_1.jpg');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <h1 class="mb-2 bread">History Salary</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Home <i
                                    class="ion-ios-arrow-forward"></i></a></span> <span>History Salary</span> <i
                            class="ion-ios-arrow-forward"></i></span></p>
                </div>
            </div>
        </div>
    </section>
    <section>
        {{-- <div class="container"> --}}
        <div class="card-content">
            <h4 class="card-title"> Salary new</h4>
            <div class="table-responsive">
                <table class="table" id="table_id" style="border: 1px solid; text-align: center;">
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
                        </tr>
                    </thead>
                    @if ($HistorySalary !== null)
                    <tbody>
                        @foreach ($HistorySalary as $item)
                        <tr>
                            
                                <td>{{$item->time}}</td>
                                <td>{{$item->teacher->name}}</td>
                                <td>{{$item->teacher->history_teaching_hours->total_hours}}</td>
                                <td>{{$item->basic_salary}}</td>
                                <td>{{$item->teacher->history_teaching_hours->total_overtime_hours}}</td>
                                <td>{{$item->salary_per_hour}}</td>
                                <td>{{$item->salary_overtime_per_hour}}</td>
                                <td>{{$item->total_insurance }}</td>
                                {{-- <td>{{$item->history_kpi}}</td> --}}
                                @php
                                $summary_point = 0;
                               foreach ($item->teacher->history_kpi as $item){
                                   $summary_point += $item->point;
                               }
                               
                               @endphp
                                <td>{{ $summary_point }}
                                    <br>
                                    <button id="detail" data-id="{{ $item->teacher_id }}"class="btn btn-danger" data-toggle="modal" data-target="#modelId">
                                        <i class="fa fa-edit">Detail</i>
                                    </button>
                                </td>
                           

                        </tr>
                    @endforeach


                    </tbody>
                    @else   
                    <div class="text-center">
                        <p>Lịch sử nhận lương của bạn trống !</p>
                    </div>
                    @endif
                </table>

            </div>
        </div>


    </section>
@endsection
@section('js')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('body').on('click','#detail', function(e) {
           var teacher_id = $(this).data('id');
            $.ajax({
                type: "POST",
                url: "{{route('home.detail')}}",
                dataType: 'json',
                data: {
                    id: teacher_id,
                },
                success: function(response) {
                    var result = response.history_kpi;
                    $.each(result, function(key, value) {
                        $('tbody#list_criteria').append('<tr>\
                            <td>' +value.criteria + '</td>\
                            <td>' +value.point + '</td>\
                            </tr>'
                        );
                        
                    });
                    
                }
            });

        });
        $('body').on('click','#close',function(e){
            window.location.reload();
            e.preventDefault();
        })
   
    });
</script>
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
                <div id="detail_kpi">
                    <table border="1px solid black" style="text-align: center; width: 100%">
                        <thead>
                            <tr>
                                <th>criteria</th>
                                <th>point</th>
                            </tr>
                        </thead>
                        <tbody id="list_criteria">

                        </tbody>
                    </table>
                </div>
                    
            </div>
            <div class="modal-footer">
                <button id="close" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
