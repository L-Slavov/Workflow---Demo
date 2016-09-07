$(document).ready(function() {
	// Запазва отключените полета и техните стойности за да ги запише при cancel.
	var inputValue = [];
	// Пази индекса на реда, за да не се променят няколко реда едновременно.
	var rowIndex = "";


	$(".input-target").dblclick(function() {
		// Ако има вече избран ред не позволява да се селектира друг
		if ($(this).closest("td").index() != rowIndex && rowIndex != "") {
			return 0;
		}
		rowIndex = $(this).closest("td").index();

		var target = $(this).find(".form-control");
		
		target.removeAttr("disabled").removeAttr("readonly");
		var currentValue = target.val();
		var selection = target.prop("name");
		inputValue.push({target:selection,value:currentValue});

		$(this).find(".input-shield").hide().addClass("hidden-shield");
		$(this).closest("tr").find(".save,.cancel").show();
	});

	$(".cancel").click(function(еvent){
		//event.preventDefault();
		var row = $(this).closest(".row");
		for(item in inputValue){
			
			row.find(".form-control[name = '"+inputValue[item]["target"]+"']").val(inputValue[item]["value"]);
			row.find(".form-control[name = '"+inputValue[item]["target"]+"']").prop("readonly","true");
			row.find(".form-control[name = '"+inputValue[item]["target"]+"']").prop("disabled","disabled");

		}
		
		$(this).hide();
		row.find(".save").hide();
		inputValue = [];
		rowIndex = "";
		$(".hidden-shield").show().removeClass("hidden-shield");
		return false;
	});

	

});