$(document).ready(function(){
	//alert($("#schedule-card").data("id"));

	/*****************
			DATETIME PICKER
	*******************/

	$("#searchInput").datetimepicker({
		timepicker: false
	});


	$("#searchDate").click(function(e){
		e.preventDefault();
		$.ajax({
			type: "POST",
			url: "../php/controller/roomSchedule.php",
			data:{
				room: $("#schedule-card").data("id"),
				search: $("#searchInput").val(),
				function: "getVaccant"
			},
			success: function(data){
				$("#scheduleTable").html(data);
			}
		});
	})
});