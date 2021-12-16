@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

@endsection

@section('main')
    <div class="alert2" role="alert2" style="text-align: center">
    </div>
    <label for="">Payment salary of current month ({{ date('m/Y') }})</label>
    <div id="loaddata">
        <table class="table table-hover" id="example" class="display">
            <thead>
                <tr>
                    <th>Teacher</th>
                    <th>Image</th>
                    <th>Major code</th>
                    <th class="text-right">Action</th>

                </tr>
            </thead>
            <tbody>
                <!-- Duyệt qua các giảng viên của từng tháng -->
                @foreach ($teachers as $teacher)
                    @foreach ($teacher as $item)
                        <tr>

                            @php
                                // Lấy ra tên giảng viên một tháng
                                $teacher_name = $item->name ?? '';
                                
                                // Lấy ra admin chỉnh sửa lần cuối
                                
                            @endphp
                            <td>{{ $item->id }}</td>
                            <td>{{ $teacher_name }}</td>
                            <td><img src="{{ url('public/upload') }}/{{ $item->image }}" alt="" style="height:100px">
                            </td>
                            <td>{{ $item->major->name }}</td>

                            <td><button id="pay" data-id="{{ $item->id }}" class="btn btn-success" data-toggle="modal"
                                    data-target="#modelId">Confirm</button></td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>


    <form action="" method="POST" id="formdelete">
        @csrf
        @method('DELETE')
    </form>

    <hr>
    @php
    $HistorySalaryStatus = HistorySalaryStatus::class;
    @endphp
@endsection



@section('js')
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
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
            $('body').on('click', '#pay', function(e) {
                var id = $(this).data('id');
                $.ajax({
                    type: "POST",
                    url: "{{ route('history_salary.add') }}",
                    dataType: 'json',
                    data: {
                        teacher_id: id,
                    },
                    success: function(response) {
                        var result = response.teacher

                        $.each(result, function(key, value) {
                            //khai báo biến
                            const salary_basic = Number(value.salary_basic)
                            const salary_per_hour = Number(value.salary_per_hour)
                            const total_hours = Number(value.total_hours)
                            const kpi = Number(value.total_kpi)
                            const total_point = Number(value.total_point)
                            const salary_overtime_per_hour = Number(value.salary_overtime_per_hour)
                            const total_overtime_hours = Number(value.total_overtime_hours)
                            const insurance = Number(value.total_insurance)
                            const salary = salary_basic + salary_per_hour *
                                total_hours+salary_overtime_per_hour * total_overtime_hours;
                            const total_insurance = salary * insurance / 100;
                            const btn = document.querySelector('#send');
                            //tính kpi và tổng lương
                            const inputTime = document.querySelector('input#time');
                            //gọi hàm
                            
                                $('#teacher_id').val(value.id)
                                $('#time').val(value.time)
                                $('#name').html(value.name)
                                $('#basic_salary').val(value.salary_basic)
                                $('#salary_per_hour ').val(value.salary_per_hour)
                                $('#salary_overtime_per_hour ').val(value.salary_overtime_per_hour)
                                $('#total_hours').val(value.total_hours)
                                $('#total_overtime_hours').val(value.total_overtime_hours)
                                $('#total_insurance ').val(new Intl.NumberFormat().format(total_insurance))

                          

                         
                                if (kpi > 0) {
                                    var total_kpi = value.total_kpi / total_point
                                    $('#total_kpi').val(total_kpi)
                                    var total_salary = salary * total_kpi - total_insurance
                                    $('#total_salary').val(new Intl.NumberFormat().format(total_salary))
                                    inputTime.oninput = function() {
                                    var historyKpi = response.historyKpi;
                                    var timeSalary = response.timePaySalary;
                                    //check time kpi
                                    var arrkpi = [];
                                    historyKpi.forEach(function(item, key) {
                                        arrkpi.push(item.time)
                                    })
                                    //check history salary
                                    var arr = []
                                    timeSalary.forEach(function(item, key) {
                                        arr.push(item.time)
                                    })
                                    var check = arr.includes(inputTime.value);
                                    var checkKpi = arrkpi.includes(inputTime.value);
                                    if (check === true && checkKpi === true) {
                                        var total_kpi = value.total_kpi /
                                            total_point
                                        $('#total_kpi').val(total_kpi)
                                        var total_salary = salary * total_kpi -
                                            total_insurance
                                        $('#total_salary').val(new Intl
                                            .NumberFormat().format(
                                                total_salary))
                                    } else {
                                        $('#total_kpi').val(
                                            "người này chưa được đánh giá KPI")
                                        $('#total_salary').val(
                                            "Cần đánh giá kpi trước")
                                        btn.onclick = function(e) {
                                            $(".alert").addClass(
                                                "alert-danger");
                                            $(".alert").html(
                                                "Người này chưa được đánh giá kpi"
                                            );
                                            setTimeout(function() {
                                                $(".alert").removeClass(
                                                    "alert-danger");
                                                $(".alert").html('');
                                            }, 2000)
                                            e.preventDefault();
                                        }
                                    }
                                }
                                         $('body').on('click', '#send', function(e) {
                                            var time = $('#time').val();
                                            var total_kpis = $('#total_kpi').val()
                                            var time = $('#time').val()
                                            var teacher_id = $('#teacher_id').val()
                                            $.ajax({
                                                type: "POST",
                                                url: "{{ route('history_salary.store') }}",
                                                dataType: 'json',
                                                data: {
                                                    name: value.name,
                                                    time: time,
                                                    teacher_id: teacher_id,
                                                    basic_salary: $('#basic_salary').val(),
                                                    salary_per_hour: $('#salary_per_hour').val(),
                                                    salary_overtime_per_hour: $('#salary_overtime_per_hour').val(),
                                                    total_insurance: total_insurance,
                                                    total_kpi: $('#total_kpi').val(),
                                                    total_salary: total_salary,
                                                },
                                                success: function(response) {
                                                    if (response.error) {
                                                        var error = response.error

                                                        $(".alert").addClass("alert-danger");
                                                        $(".alert").html(response.error);
                                                        setTimeout(
                                                            function() {
                                                                $(".alert").removeClass("alert-danger");
                                                                $(".alert").html('');
                                                            }, 2000)
                                                    } else if (response.success) {
                                                        $('#loaddata').load(document.URL +  ' #loaddata');

                                                        var success =response.success
                                                        $("#modelId").modal('hide');
                                                        $(".alert2").addClass("alert-success");
                                                        $(".alert2").html(response.success);
                                                        setTimeout(
                                                            function() {
                                                                $(".alert2").removeClass("alert-success");
                                                                $(".alert2").html('');
                                                            }, 2000)

                                                    }
                                                }
                                            })
                                        })
      
                                }else{
                                    $('#total_kpi').val("người này chưa được đánh giá KPI")
                                        $('#total_salary').val("Cần đánh giá kpi trước")
                                        btn.onclick = function(e) {
                                            $(".alert").addClass("alert-danger");
                                            $(".alert").html("Người này chưa được đánh giá kpi");
                                            setTimeout(function() {
                                                $(".alert").removeClass("alert-danger");
                                                $(".alert").html('');
                                            }, 2000)
                                            e.preventDefault();
                                        }
                                }

                                const Unprocess = 0;
                                const Pending = 1;
                                const Issue = 2;
                                const Confirmed = 3;
                                const Paid = 4;

                                function getName() {
                                    switch (value.status) {
                                        case Unprocess:
                                            return "Unprocess";
                                            break;
                                        case Pending:
                                            return "Pending";
                                            break;
                                        case Issue:
                                            return "Issue";
                                            break;
                                        case Confirmed:
                                            return "Confirmed";
                                            break;
                                        case Paid:
                                            return "Paid";
                                            break;
                                    }

                                   
                                    return "";
                                }
                                $('#status_text').html(getName())
                        
                            })

                    }
                });

            });
            
            
      
    
           

        });
    </script>
@endsection


<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" style="display: none;width: 60%;margin-left: 20%;"
    aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">PayRoll</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert" role="alert" style="text-align: center">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <input type="hidden" name="teacher_id" id="teacher_id" class="form-control">
                        <div class="form-group">
                            <label for="">Name: </label>
                            <label for="" id="name"></label>
                        </div>
                        <div class="form-group">
                            <label for="">Time:</label>
                            <input disabled type="date" id="time" name="time">
                        </div>
                        <div class="form-group">
                            <label for="">Salary basic:</label>
                            <input type="text" disabled name="basic_salary" id="basic_salary" class="form-control"
                                placeholder="" aria-describedby="helpId">
                        </div>
                        <div class="form-group">
                            <label for="">Salary per hour:</label>
                            <input type="text" disabled name="salary_per_hour" id="salary_per_hour"
                                class="form-control" placeholder="" aria-describedby="helpId">
                        </div>
                        <div class="form-group">
                            <label for="">Salary overtime per hour:</label>
                            <input type="text" disabled name="salary_overtime_per_hour " id="salary_overtime_per_hour"
                                class="form-control" placeholder="" aria-describedby="helpId">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">total hours:</label>
                            <input disabled type="text" name="total_hours" id="total_hours" class="form-control"
                                placeholder="" aria-describedby="helpId">
                        </div>
                        @error('total_hours')
                            <small class="help-block" style="color:red">{{ $message }}</small>
                        @enderror
                        <div class="form-group">
                            <label for="">total overtime hours:</label>
                            <input disabled type="text" name="total_overtime_hours" id="total_overtime_hours"
                                class="form-control" placeholder="" aria-describedby="helpId">
                        </div>
                        @error('total_overtime_hours')
                            <small class="help-block" style="color:red">{{ $message }}</small>
                        @enderror
                        <div class="form-group">
                            <label for="">Mark KPI:</label>
                            <input type="text" disabled name="total_kpi" id="total_kpi" class="form-control"
                                placeholder="" aria-describedby="helpId">
                        </div>
                        <div class="form-group">
                            <label for="">total money insurance:</label>
                            <input type="text" disabled name="total_insurance" id="total_insurance"
                                class="form-control" placeholder="" aria-describedby="helpId">
                        </div>
                        <div class="form-group">
                            <label for="">Status:</label>
                            <label for="" id="status_text"></label>
                        </div>
                    </div>

                </div>
                <div class="form-group">
                    <label for="">Total Salary:</label>
                    <input type="text" disabled name="total_salary" id="total_salary" class="form-control"
                        placeholder="" aria-describedby="helpId">
                </div>

                <button id="send" class="btn btn-success">Confirm</button>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
