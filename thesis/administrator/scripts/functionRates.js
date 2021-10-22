$(document).ready(function(){
	
	function getRates(){

		$.ajax({
			type: "POST",
			url: "../../../controller/functionRates.php",
			data:{
				function: "getRates"
			},
			success: function(data){
				$("#tbodyRates").html(data);
			}
		});

	}

	getRates();

	$("#tbodyRates").on("click","#editRate",function(e){
		e.preventDefault();
		$("#viewRate-modal").data("id",$(this).data("id"));
		$.ajax({
			type: "POST",
			url: "../../../controller/functionRates.php",
			data:{
				i_pid: $(this).data("id"),
				function: "getRateInfo"
			},
			success: function(data){
				data = jQuery.parseJSON(data);
				$("#firstHour").val(data.firstHour);
				$("#succeedingHour").val(data.succeedingHour);
				$("#viewRate-modal").modal("show");

			}
		});
		
	});

	$("#viewRate-modal").on("click",".edit",function(e){
		e.preventDefault();
		$("#firstHour,#succeedingHour").attr("disabled",false);
		$("#editRate-btn").removeClass("edit").addClass("submit");
		$("#editRate-btn").html("<i class='fa fa-save'></i> Update");
		//alert($("#viewRate-modal").data("id"));
	});

















	/******************************************************************

								Regular Expression
	
	*******************************************************************/

	$("#viewRate-modal").on("keypress","#firstHour",function(e){
		
		if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
			event.preventDefault();
		}
		/*
		var regex = new RegExp("^[0-9]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}*/
	});
	$("#viewRate-modal").on("keypress","#succeedingHour",function(e){
		if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
			event.preventDefault();
		}
		/*	
		var regex = new RegExp("^[0-9]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}*/
	});








	/*********************************************************************

								Update Rate

	*********************************************************************/

	$("#viewRate-modal").on("click",".submit",function(e){
		e.preventDefault();
		if($("#firstHour").val() == "" || $("#succeedingHour").val() == ""){
			if($("#firstHour").val() == ""){
				$("#firstHour-msg").html("* Required.");
				$("#firstHour-msg").css("display","block");
			}
			else{
				$("#firstHour-msg").css("display","none");
			}

			if($("#succeedingHour").val() == ""){
				$("#succeedingHour-msg").html("* Required.");
				$("#succeedingHour-msg").css("display","block");
			}
			else{
				$("#succeedingHour-msg").css("display","none");
			}
		}
		else{
			$("#firstHour-msg,#succeedingHour-msg").css("display","none");

			$.ajax({
				type: "POST",
				url: "../../../controller/functionRates.php",
				data:{
					i_pid: $("#viewRate-modal").data("id"),
					firstHour: $("#firstHour").val(),
					succeedingHour: $("#succeedingHour").val(),
					function: "updateRate"
				},
				success: function(data){
					alert(data);	
					getRates();
					$("#firstHour,#succeedingHour").attr("disabled",true);
					$("#editRate-btn").removeClass("submit").addClass("edit");
					$("#editRate-btn").html("<i class='fa fa-edit'></i> Edit");
				}
			});
			
		}
		
		//alert($("#viewRate-modal").data("id"));
	});

	$("#viewRate-modal").on('hidden.bs.modal', function () {
	    $(this).find('form').trigger('reset');
	    $("#firstHour,#succeedingHour").attr("disabled",true);
	    $("#firstHour-msg,#succeedingHour-msg").css("display","none");
		$("#editRate-btn").removeClass("submit").addClass("edit");
		$("#editRate-btn").html("<i class='fa fa-edit'></i> Edit");
	});

});