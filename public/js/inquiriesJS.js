$(document).ready(function() {


    $(".datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
 

	var average_reaction = 0;
	var average_work_time = 0;
	$(".average-reaction").each(function() {
		average_reaction += parseInt($(this).text());
	});
	$(".average-work-time").each(function() {
		average_work_time += parseInt($(this).text());
	});
	var count = $(".average-work-time").length;
	
	
	average_reaction = Math.floor(average_reaction/count);
	average_work_time = Math.floor(average_work_time/count);
	if (!isNaN(average_work_time)) {
		$(".statistic").append("<tr style = 'background-color: darkgrey;'><td>Общо Средно</td><td>"+average_reaction+"</td><td>"+average_work_time+"</td>");
	}



	$(".request_target").click(function(){
		var target_id = $(this).data("task-id");
		window.location.href= location.protocol + '//' + location.host +"/archive/view/"+target_id;
		
	});
});