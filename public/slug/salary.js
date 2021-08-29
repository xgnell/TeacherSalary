
$('input#salary_per_hour').keyup(function(event) {
    let salary_per_hour, percent ; 
    percent = $('#percent').val();
    salary_per_hour = $(this).val();
    
    let salary_ot_2 = parseFloat(percent);
    let salary_ot_1 = parseFloat(salary_per_hour);
    console.log(salary_per_hour);
    console.log(percent);
    let salary_ot_per_hour = (salary_ot_1+(salary_ot_2/100*salary_ot_1));
      $('input#salary_ot_per_hour').val(Math.round(salary_ot_per_hour));
      return salary_ot_per_hour;

});