
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('body').on('click', '#add_payroll', function(e) {
        var id = $(this).data('id');
        $.ajax({
            type: "GET",
            url: "history_add/" + id,
            dataType: 'json',
            success: function(response) {
                var result = response.teacher;
                var teacher_id = result.id;
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
                var kpi = response.kpi;
                if(isset(kpi.total_value)){
                    var total_kpi = kpi.total_value;
                    $('#total_kpi').val(total_kpi);
                }else{
                    $('#total_kpi').val(0);
                }
                    
                // bhxh
                var bhxh = response.bhxh;
                if(isset(bhxh.total_value)){
                    var total_bhxh = bhxh.total_value;
                    $('#total_bhxh').val(total_bhxh);
                }else{
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
        var total_salary = (salary_basic*(total_kpi/100))+(total_teaching_hours*salary_per_hour)+(total_ot_hours*salary_ot_per_hour)-total_bhxh;
        $('input#total_salary').val(Math.round(total_salary));
        return total_salary;
    });
    // tinh thang
    var chuoi_thang = '';
for(var i = 1; i <= 12;i++){
chuoi_thang += "<option>" + i + "</option>";
}
document.getElementById('select_month').innerHTML = chuoi_thang;
});