
$('input#salary_per_hour').keyup(function(event) {
    let salary_per_hour, percent , salary_ot_per_hour; 
    percent = $('#percent').val();
    salary_per_hour = $(this).val();
    console.log(salary_per_hour);
    console.log(percent);
    salary_ot_per_hour = salary_per_hour+(percent/100*salary_per_hour);
      $('input#salary_ot_per_hour').val(Math.round(salary_ot_per_hour));
      return salary_ot_per_hour;

});