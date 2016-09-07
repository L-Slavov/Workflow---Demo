$(document).ready(function(){

$(".datepicker").datepicker({ dateFormat: 'yy-mm-dd',minDate: 0 });
$(".datepicker").change(function(){
	$(".save").show();
});
});