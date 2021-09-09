@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{ url('public/css/history.css') }}">
@endsection
@section('main')
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Chọn Ngành
        </button>
        <div class="dropdown-menu" aria-labelledby="triggerId">
            @foreach ($major as $item)
                <a class="dropdown-item"
                    href="{{ route('history_salary.filter', ['slug' => $item->slug]) }}">{{ $item->name }}</a>
                <div class="dropdown-divider"></div>
            @endforeach
        </div>
    </div>
    {{-- //form --}}
    <form class="form-inline">
        <div class="form-group">
            <label for=""></label>
            <input type="text" name="search" value="{{ $search }}" class="form-control" placeholder="search name"
                aria-describedby="helpId">
            <button class="btn-primary"><i class="fa fa-search"></i></button>
        </div>
    </form>
    <hr>
    <label for="">PayRoll</label>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Teacher Name</th>
                <th>Đánh giá KPI</th>
                <th>BHXH</th>

                <th class="text-right">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($teacher as $each)
                @csrf
                <input type="hidden" id="teacher_id" value="{{ $each->id }}" name="teacher_id" >
                <tr>
                    <td>{{ $each->first_name }} {{ $each->last_name }}</td>
                    <td>
                        @if (isset($each->kpi->total_value))
                            Mark:{{ $each->kpi->total_value }}
                            <br>
                            <a href="{{ route('kpi.edit', $each->id) }}">Đánh Gía lại</a>
                        @else
                            <a href="{{ route('kpi', $each->id) }}">đánh giá KPI</a>
                        @endif

                    </td>
                    <td>
                        @if (isset($each->bhxh->total_value))
                            {{ $each->bhxh->total_value }}
                        @endif
                    </td>
                    <td class="text-right">
                        {{-- data-toggle="modal" data-target="#modelId"  --}}
                        {{-- javascript:void(0) --}}
                        {{-- {{ route('history_salary.add',$each->id) }} --}}
                        <button data-toggle="modal" data-id="{{ $each->id }}" id="add_payroll" data-target="#modelId" class="btn btn-info">Pay</button>
                        {{-- <a href="javascript:void(0)"    >Pay</a> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
    <div class="paginate">
        {{ $teacher->appends(request()->all())->links() }}
    </div>


@endsection
<!-- Button trigger modal -->
@section('js')
    <script src="{{ url('public/js/history.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('body').on('click', '#add_payroll', function(e) {
                var id = $(this).data('id');
                $.ajax({
                    type: "POST",
                    url: "{{route('history_salary.add')}}",
                    dataType: 'json',
                    data: {id: id},
                    success: function(response) {
                        var teacher = response.teacher;
                        
                        var teacher_id = teacher.id;
                        var result = response.salary;
                        var salary_basic = result.salary_basic;
                        var salary_per_hour = result.salary_per_hour;
                        var salary_ot_per_hour = result.salary_ot_per_hour;
                        var first_name = result.first_name;
                        var last_name = result.last_name;
                        var teaching_formality = result.teaching_formality;
                        if (teaching_formality == 0) {
                            $('#teaching_formality').html("Part Time");
                        } else {
                            $('#teaching_formality').html("Fulltime");
                        }
                        $('#salary_basic').html(salary_basic);
                        $('#salary_basic_1').val(salary_basic);
                        $('#salary_per_hour').html(salary_per_hour);
                        $('#salary_per_hour_1').val(salary_per_hour);
                        $('#salary_ot_per_hour').html(salary_ot_per_hour);
                        $('#salary_ot_per_hour_1').val(salary_ot_per_hour);
                        $('#teacher_id').val(teacher_id);
                        $('#teacher_name').html(first_name + ' ' + last_name);
                        //    kpi
                        // var kpi = response.kpi;

                        if(response.kpi==null){
                            $('#total_kpi').val(0);
                        }else{
                            var kpi = response.kpi;
                            var total_kpi = kpi.total_value;
                            $('#total_kpi').val(total_kpi);
                            
                        }
                            
                        // bhxh
                        
                        if(response.bhxh==null)
                        {
                            $('#total_bhxh').val(0);
                        }else{
                            var bhxh = response.bhxh;
                            var total_bhxh = bhxh.total_value;
                            $('#total_bhxh').val(total_bhxh);
                        }
                            
                    }
                });

            });
            //tinh tong luong
            $('body').on('click','#calculate',function(event) {
                // khai bao cac gia tri
                var salary_basic = parseFloat($('#salary_basic_1').val());
                var salary_per_hour = parseFloat($('#salary_per_hour_1').val());
                var salary_ot_per_hour = parseFloat($('#salary_ot_per_hour_1').val());
                var total_kpi = parseFloat($('#total_kpi').val());
                var total_bhxh = parseFloat($('#total_bhxh').val());
                var total_teaching_hours = parseFloat($('#total_teaching_hours').val());
                var total_ot_hours = parseFloat($('#total_ot_hours').val());
                // tong luong
                if(total_kpi > 0 && total_teaching_hours > 0 ){
                    var total_salary = (salary_basic*(total_kpi/100))+(total_teaching_hours*salary_per_hour)+(total_ot_hours*salary_ot_per_hour)-total_bhxh;
                    $('input#total_salary').val(Math.round(total_salary));
                }else{
                    alert('Bạn chưa kpi hoặc tổng giờ dạy đang trống!');
                }
                return total_salary;
            });
        });
    </script>
@endsection
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pay Roll</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('history_salary.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Teacher: </label>
                                    <label for="" id="teacher_name"></label>
                                    <input type="hidden" class="form-control" name="teacher_id" id="teacher_id"
                                        aria-describedby="helpId">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="">teaching formality: </label>
                                <label for="" id="teaching_formality"></label>

                            </div>
                            <div class="col-md-12">
                                <label for="">salary Basic: </label>
                                <label for="" id="salary_basic"></label>
                                <input type="hidden" class="form-control" name="salary_basic_1" id="salary_basic_1"
                                    aria-describedby="helpId">
                            </div>
                            <div class="col-md-12">
                                <label for="">salary per hour: </label>
                                <label for="" id="salary_per_hour"></label>
                                <input type="hidden" class="form-control" name="salary_per_hour_1"
                                    id="salary_per_hour_1" aria-describedby="helpId">
                            </div>
                            <div class="col-md-12">
                                <label for="">salary overtime per hour: </label>
                                <label for="" id="salary_ot_per_hour"></label>
                                <input type="hidden" class="form-control" name="salary_ot_per_hour_1"
                                    id="salary_ot_per_hour_1" aria-describedby="helpId">
                            </div>
                            <div class="col-md-12">
                                <label for=""> Time: </label>
                                <input type="date" class="form-control" name="time"
                                    id="time" aria-describedby="helpId">  
                        </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <label for="">Total kpi: </label>
                                <input type="text" class="form-control" name="total_kpi" id="total_kpi"
                                    aria-describedby="helpId" readonly>
                            </div>
                            <div class="col-md-12">
                                <label for="">BHXH: </label>
                                <input type="text" class="form-control" value="0" name="total_bhxh" id="total_bhxh"
                                    aria-describedby="helpId" readonly>
                            </div>
                            <div class="col-md-12">
                                <label for="">Total teaching hours: </label>
                                <input type="text" class="form-control" value="0" name="total_teaching_hours"
                                    id="total_teaching_hours" aria-describedby="helpId">
                            </div>
                            @error('total_teaching_hours')
                         <small class="help-block" style="color:red">{{$message}}</small>
                             @enderror
                            <div class="col-md-12">
                                <label for="">Total overtime hours: </label>
                                <input type="text" class="form-control" value="0" name="total_ot_hours"
                                    id="total_ot_hours" aria-describedby="helpId">
                            </div>
                            @error('total_ot_hours')
                         <small class="help-block" style="color:red">{{$message}}</small>
                             @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Total salary: </label>
                            <input type="text" value="0" class="form-control" name="total_salary" id="total_salary"
                                aria-describedby="helpId">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button>payment</button>
                    </div>
                </form>
                <button id="calculate">calculate total value</button>
            </div>
        </div>
    </div>
</div>
