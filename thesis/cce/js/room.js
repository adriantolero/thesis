$(document).ready(function(){

	/*******************
			Date Time Picker
	********************/

	$("#addDatestart-request").datetimepicker({
		//datepicker: false,
		timepicker: false,
		format: "Y-m-d",
		onShow: function(ct){
			this.setOptions({
				maxDate:jQuery("#addDateend-request").val()?jQuery("#addDateend-request").val():false
			})
		}
	});

	$("#addTimestart-request").datetimepicker({
		format: "H:i",
		formatTime: "h:ia",
		defaultTime: "08:00",
		datepicker: false
	});

	$("#addDateend-request").datetimepicker({
		timepicker: false,
		format: "Y-m-d",
		onShow: function(ct){
			this.setOptions({
				minDate:jQuery("#addDatestart-request").val()?jQuery("#addDatestart-request").val():false
			})
		}
	});

	$("#addTimeend-request").datetimepicker({
		format: "H:i",
		formatTime: "h:ia",
		defaultTime: "08:00",
		datepicker: false	
	});



	/*******************************************
					View rates
	*******************************************/
	$("#toggle-viewRate").click(function(){
		$.ajax({
			type: "POST",
			url: "../php/controller/functionRates.php",
			data: {
				function: "getRate"
			},
			success: function(data){
				$("#tbodyRates").html(data);
			}
		});
	});










	/**********************************************
							Form
	***********************************************/

	$("#createReservation-modal").on("keypress","#addDatestart-request",function(e){
		if(e.keyCode !== 8) {
	        e.preventDefault();
	    }
	});

	$("#createReservation-modal").on("keypress","#addTimestart-request",function(e){
		if(e.keyCode !== 8) {
	        e.preventDefault();
	    }
	});

	$("#createReservation-modal").on("keypress","#addDateend-request",function(e){
		if(e.keyCode !== 8) {
	        e.preventDefault();
	    }
	});

	$("#createReservation-modal").on("keypress","#addTimeend-request",function(e){
		if(e.keyCode !== 8) {
	        e.preventDefault();
	    }
	});

	// Check room availability
	$("#createReservation-modal").on("click","#roomAvailable",function(e){
		e.preventDefault();
		if($("#addDatestart-request").val() == "" || $("#addTimestart-request").val() == "" || $("#addDateend-request").val() == "" || $("#addTimeend-request").val() == ""){
			if($("#addDatestart-request").val() == ""){
				$("#addDatestart-request-msg").css("display","block");
			}
			else{
				$("#addDatestart-request-msg").css("display","none");
			}
			if($("#addTimestart-request").val() == ""){
				$("#addTimestart-request-msg").css("display","block");
			}
			else{
				$("#addTimestart-request-msg").css("display","none");
			}
			if($("#addDateend-request").val() == ""){
				$("#addDateend-request-msg").css("display","block");
			}
			else{
				$("#addDateend-request-msg").css("display","none");
			}
			if($("#addTimeend-request").val() == ""){
				$("#addTimeend-request-msg").css("display","block");
			}
			else{
				$("#addTimeend-request-msg").css("display","none");
			}
		}

		else{
			$("#addDatestart-request-msg,#addTimestart-request-msg,#addDateend-request-msg,#addTimeend-request-msg").css("display","none");
			$.ajax({
				type: "POST",
				url: "../php/controller/room.php",
				data:{
					date_start: $("#addDatestart-request").val(),
					time_start: $("#addTimestart-request").val(),
					date_end: $("#addDateend-request").val(),
					time_end: $("#addTimeend-request").val(),
					function: "getAvailRoom"
				},
				success: function(data){
					if(data == 0){
						$("#addRoom-request-warning").html("<center>The date & time you have inputted are invalid.</center>");
						$("#addRoom-request-warning").css("display","block");
						$("#collapseRoom").collapse("hide");
						$("#addRoom-request").html("<option value='0'></option>");
					}
					else if(data!=0 && data!=1){
						$("#addRoom-request-warning").css("display","none");
						$("#addRoom-request").html(data);
						$("#collapseRoom").collapse("show");
					}
					else if(data==1){
						$("#addRoom-request-warning").html("<center>* No room available</center>");
						$("#addRoom-request-warning").css("display","block");
						$("#collapseRoom").collapse("hide");
						$("#addRoom-request").html("<option value='0'></option>");
					}
				},
				error: function(data){
					alert(data);	
				}
			});
		}
		
	});

	$("#createReservation-modal").on("keypress","#addReservedBy-request",function(e){
		var regex = new RegExp("^[a-zA-Z,. ]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#createReservation-modal").on("keypress","#addParticipants-request",function(e){
		var regex = new RegExp("^[0-9]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#createReservation-modal").on("keypress","#addReservedByMobile-request",function(e){
		var regex = new RegExp("^[0-9]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#createReservation-modal").on("click","#addRequest",function(e){
		e.preventDefault();
		//$("#roomAvailable").click();
		//alert($("#addRoom-request").val());
		if($("#addTitle-request").val() == "" || $("#addParticipants-request").val() == "" || $("#addDatestart-request").val() == "" || $("#addTimestart-request").val() == "" || $("#addDateend-request").val() == "" || $("#addTimeend-request").val() == "" || $("#addNature-request").val() == "" || $("#addReservedBy-request").val() == "" || $("#addReservedByMobile-request").val() == "" ||  $("#addRoom-request").val() == 0){
			if($("#addTitle-request").val() == ""){
				$("#addTitle-request-msg").css("display","block");
			}
			else{
				$("#addTitle-request-msg").css("display","none");
			}

			if($("#addParticipants-request").val() == ""){
				$("#addParticipants-request-msg").css("display","block");
			}
			else{
				$("#addParticipants-request-msg").css("display","none");
			}

			if($("#addDatestart-request").val() == ""){
				$("#addDatestart-request-msg").css("display","block");
			}
			else{
				$("#addDatestart-request-msg").css("display","none");
			}

			if($("#addTimestart-request").val() == ""){
				$("#addTimestart-request-msg").css("display","block");
			}
			else{
				$("#addTimestart-request-msg").css("display","none");
			}

			if($("#addDateend-request").val() == ""){
				$("#addDateend-request-msg").css("display","block");
			}
			else{
				$("#addDateend-request-msg").css("display","none");
			}

			if($("#addTimeend-request").val() == ""){
				$("#addTimeend-request-msg").css("display","block");
			}
			else{
				$("#addTimeend-request-msg").css("display","none");
			}

			if($("#addRoom-request").val() == 0){
				$("#addRoom-request-warning").html("<center>* Please select a room.</center>");
				$("#addRoom-request-warning").css("display","block");
				//$("#addRoom-request-msg").css("display","block");
			}
			else{
				$("#addRoom-request-warning").css("display","none");
				//$("#addRoom-request-msg").css("display","none");
			}

			if($("#addNature-request").val() == ""){
				$("#addNature-request-msg").css("display","block");
			}
			else{
				$("#addNature-request-msg").css("display","none");
			}
			
			if($("#addReservedBy-request").val() == ""){
				$("#addReservedBy-request-msg").css("display","block");
			}
			else{
				$("#addReservedBy-request-msg").css("display","none");
			}
			
			if($("#addReservedByMobile-request").val() == ""){
				$("#addReservedByMobile-request-msg").css("display","block");
			}
			else{
				$("#addReservedByMobile-request-msg").css("display","none");
			}

		}
		else{
			$("#addTitle-request-msg,#addParticipants-request-msg,#addDatestart-request-msg,#addTimestart-request-msg,#addDateend-request-msg,#addTimeend-request-msg,#addNature-request-msg,#addReservedBy-request-msg,#addReservedByMobile-request-msg").css("display","none");

			// DISPLAY PREVIEW FORM
			$.ajax({
				type: "POST",
				url: "../php/controller/room.php",
				data:{
					agency: $("#addAgency-request").val(),
					agency_add: $("#addAddress-request").val(),
					room: $("#addRoom-request").val(),
					title: $("#addTitle-request").val(),
					participants: $("#addParticipants-request").val(),
					date_start: $("#addDatestart-request").val(),
					time_start: $("#addTimestart-request").val(),
					date_end: $("#addDateend-request").val(),
					time_end: $("#addTimeend-request").val(),
					nature: $("#addNature-request").val(),
					reservedBy: $("#addReservedBy-request").val(),
					reserved_add: $("#addReservedByAddress-request").val(),
					contact: $("#addReservedByMobile-request").val(),
					email: $("#addReservedByEmail-request").val(),
					function: "previewForm"
				},
				success: function(data){
					console.log(data);
					if(data =="Room not available in this schedule. Please select another room or schedule."){
						alert(data);
					}
					else if(data == "The date & time you have inputted are invalid."){
						alert(data);
					}
					else if(data == "Number of participants cannot exceed max capacity."){
						alert(data);
					}
					else{
						$("#viewForm").html(data);
						$("#previewForm-modal").modal("show");
					}
					
				}
			});	
		}

	});

	$("#previewForm-modal").on("click","#editForm",function(){
		//alert("You clicked the edit button");
		$("#previewForm-modal").modal("hide");
	});

	$("#previewForm-modal").on("click","#submitForm",function(){
		var x = confirm("Are you sure you want to submit this form?");
		if(x==true){
			
			$.ajax({
				type: "POST",
				url: "../php/controller/room.php",
				data:{
					agency: $("#addAgency-request").val(),
					agency_add: $("#addAddress-request").val(),
					room: $("#addRoom-request").val(),
					title: $("#addTitle-request").val(),
					participants: $("#addParticipants-request").val(),
					date_start: $("#addDatestart-request").val(),
					time_start: $("#addTimestart-request").val(),
					date_end: $("#addDateend-request").val(),
					time_end: $("#addTimeend-request").val(),
					nature: $("#addNature-request").val(),
					reservedBy: $("#addReservedBy-request").val(),
					reserved_add: $("#addReservedByAddress-request").val(),
					contact: $("#addReservedByMobile-request").val(),
					email: $("#addReservedByEmail-request").val(),
					function: "addRequest"
				},
				success: function(data){
					alert(data);
					var x = confirm("Would you like to add more request?");
					if(x==true){
						$("#createReservation-modal").find('form').trigger('reset');
						$("#collapseRoom").collapse("hide");
						$("#addRoom-request").html("<option value='0'></option>");
						$("#previewForm-modal").modal("hide");
					}
					else{
						$("#collapseRoom").collapse("hide");
						$("#addRoom-request").html("<option value='0'></option>");
						$("#previewForm-modal,#createReservation-modal").modal("hide");						
					}
					//getRequests();
				}
			});
			
		}
	});

	$('#createReservation-modal').on('hidden.bs.modal', function () {
	    $(this).find('form').trigger('reset');
	    $("#addTitle-request-msg").css("display","none");
	    $("#addParticipants-request-msg").css("display","none");
	    $("#addDatestart-request-msg").css("display","none");
	    $("#addTimestart-request-msg").css("display","none");
	    $("#addDateend-request-msg").css("display","none");
	    $("#addTimeend-request-msg").css("display","none");
	    $("#addRoom-request-warning").css("display","none");
	    $("#addNature-request-msg").css("display","none");
	    $("#addReservedBy-request-msg").css("display","none");
	    $("#addReservedByMobile-request-msg").css("display","none");
	});
});