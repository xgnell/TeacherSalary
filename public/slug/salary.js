
$(document).ready(function() {
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });




  
$('input#salary_per_hour').keyup(function(event) {
    let salary_per_hour, percent ; 
    percent = $('#value').val();
    salary_per_hour = $(this).val();
    
    let salary_ot_2 = parseFloat(percent);
    let salary_ot_1 = parseFloat(salary_per_hour);
    console.log(salary_per_hour);
    console.log(percent);
    let salary_ot_per_hour = (salary_ot_1+(salary_ot_2/100*salary_ot_1));
      $('input#salary_overtime_per_hour').val(Math.round(salary_ot_per_hour));
      return salary_ot_per_hour;

});

var chuoi= '';
for(var i=1; i<=100;i++){
    chuoi += "<option>" + i +"</option>"
}document.getElementById('value').innerHTML=chuoi;

});