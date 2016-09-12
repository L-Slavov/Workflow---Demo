$(document).ready(function() {

	// Проверка ако има текст в полето за телефон, да се грижи че е валиден.
	$("#phone").keyup(function()
               {
               	var input = $(this).val();
                 if (!input.match(/(^\+[0-9]{12,12}$)|(^[0][0-9]{9,9}$)/) && input != ""){
                 	
                 	$("#create_user").prop("disabled","true");
                 	$("#hidden").show();
                 }else{
                 	$("#create_user").removeAttr("disabled");
                 	$("#hidden").hide();
                 }

               });
	
	$('.radio input').change(function(){
		if($('input[value = "Manager"]').is(':checked')){
			$('select option[value = "LyuboINC"]').prop("selected",true);
			$('select').closest(".form-group").hide();
		}else{
			$('select').closest(".form-group").show();
		}
	});

	$("select").change(function(){
		 if($('select option[value != "LyuboINC"]').is(":checked")){
		 	$('input[value = "Manager"]').closest('.radio').hide();
		 }else{
		 	$('input[value = "Manager"]').closest('.radio').show();
		 }
	});
});