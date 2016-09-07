$(document).ready(function() {
	$("input[type=checkbox]").each(function() {
		if($(this).data("current-state")){
			$(this).prop("checked",true);
		}
	});
	$("input[type=checkbox]").change(function() {
		$(".save").show();
	});

	$(".create-user").change(function() {
		$(".create-user").not($(this)).prop("checked",false);
	});
	$(".edit-user").change(function() {
		$(".edit-user").not($(this)).prop("checked",false);
	});
	$(".view-tasks").change(function() {
		$(".view-tasks").not($(this)).prop("checked",false);
	});


})