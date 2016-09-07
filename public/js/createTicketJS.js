$(document).ready(function(){

	$(".datepicker").datepicker({ dateFormat: 'yy-mm-dd',minDate: 0 });
	var today = new Date();
 	$("#time").text(today.getFullYear() +" - "+today.getMonth()+ " - "+today.getDate());
	$('.required').change(function(){
		$(this).closest('.row').removeClass('has-error').addClass("has-success");
		check();

	}).keyup(function(){
		if($(this).val() !=''){
			$(this).closest('.row').removeClass('has-error').addClass("has-success");
		}else{
			$(this).closest('.row').removeClass('has-success').addClass("has-error");	
		}
		check();
	});

	function check(){
		if($('.has-error').length == 0){
			$('#mainBtn').removeAttr('disabled');
			
		}else{
			$('#mainBtn').prop('disabled',"true");
		}
	}



});