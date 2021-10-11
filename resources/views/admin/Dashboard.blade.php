@extends('layouts.admin')
@section('css')
    <script src="{{ asset('public/ad/chart/highcharts.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

@endsection
@section('main')
    <section>
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $tong_so_giang_vien }}</h3>

                        <p>Teacher</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{ route('teacher.index') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>53<sup style="font-size: 20px"></sup></h3>

                        <p>History Salary of month</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>2</h3>

                        <p>List Insurance</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{ route('insurance.index') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>2</h3>

                        <p>List teacher highest score KPI of month</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a id="kpi_hightest" data-toggle="modal" data-target="#modelId" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
    </section>

    <section>
        <div id="container" style="width:100%; height:400px;"></div>
    </section>
    <section>
        <div>giảng viên chưa được thanh toán</div>
        <table class="table table-hover" id="example" class="display">
            <thead>
                <tr>
                    <th>time</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($unpaymentss as $unpay)
                     <tr>
                        <td>{{$unpay->time}}</td>
                        <td>

                    <table class="table table-hover">
                        <thead>
                            <th>name</th>
                            <th>phone</th>
                            <th>email</th>
                            <th>Major</th>
                            <th>action</th>
                        </thead>
                        <tbody>
                            @foreach ($unpay as $each)
                                <tr>
                                    <td>{{ $each->name }}</td>
                                    <td>{{ $each->phone }}</td>
                                    <td>{{ $each->email }}</td>
                                    <td>{{ $each->major_id }}</td>
                                    <th>
                                        <a href="{{ route('history_teaching_hours.show_by_month') }}">Add salary</a>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    </td>
                    </tr>
                @endforeach


            </tbody>
        </table>
    </section>

@endsection
@section('js')
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    @php
    $array = json_encode($array);
    $paymented = json_encode($paymented);
    $unpayment = json_encode($unpayment);
    @endphp
    <script>
        $(document).ready(function() {
                $('#example').DataTable({
                    "pagingType": "full_numbers"
                });
            });
        var array = {!! $array !!}
        var paymented = {!! $paymented !!}
        var unpayment = {!! $unpayment !!}
        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Stacked column chart'
            },
            xAxis: {
                categories: array
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'giảng viên'
                },
                stackLabels: {
                    enabled: true,
                    style: {
                        fontWeight: 'bold',
                        color: ( // theme
                            Highcharts.defaultOptions.title.style &&
                            Highcharts.defaultOptions.title.style.color
                        ) || 'gray'
                    }
                }
            },
            legend: {
                align: 'right',
                x: -30,
                verticalAlign: 'top',
                y: 25,
                floating: true,
                backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || 'white',
                borderColor: '#CCC',
                borderWidth: 1,
                shadow: false
            },
            tooltip: {
                headerFormat: '<b>{point.x}</b><br/>',
                pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
            },
            plotOptions: {
                column: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            series: [{
                name: 'số người đã trả',
                data: paymented
            }, {
                name: 'số người chưa trả',
                data: unpayment
            }]
        });
        //kpi highest
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('body').on('click','#kpi_hightest', function(e) {
                $.ajax({
                    type: "GET",
                    url: "{{route('admin.highest')}}",
                    dataType: 'json',
                    data: {
                    },
                    success: function(response) {
                       var history = response.history_kpis;
                       
                       $.each(history, function(key, value) {
                        $('tbody#show_kpi').append('<tr>\
                           '
                        );
                    });
                    }
                });
    
            });
       
        });
    </script>
@endsection

<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" style="display: none;width: 60%;margin-left: 20%;" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Highest kpi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <table class="table table-hover">
                    <thead>
                        <th>time</th>
                        <th>total kpi</th>
                        <th>action</th>
                    </thead>
                    <tbody id="show_kpi">
                        
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
