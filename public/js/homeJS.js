$(document).ready(function(){

	$(".request_target").click(function(){
		var target_id = $(this).attr('id');
		window.location.href= location.protocol + '//' + location.host + location.pathname+"/view/"+target_id;
	});



});