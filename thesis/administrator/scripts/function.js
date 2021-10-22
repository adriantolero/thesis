$(document).ready(function(){

	/***********************	
			Date time picker
	************************/

	/*$("#searchFirstFloor-date,#searchSecondFloor-date").datetimepicker({
		timepicker: false,
		format: "Y-m-d"
	});*/

	$("#addDatestart").datetimepicker({
		//datepicker: false,
		timepicker: false,
		format: "Y-m-d",
		onShow: function(ct){
			this.setOptions({
				maxDate:jQuery("#addDateend").val()?jQuery("#addDateend").val():false
			})
		}
	});

	$("#vwDatestart").datetimepicker({
		//datepicker: false,
		timepicker: false,
		format: "Y-m-d",
		onShow: function(ct){
			this.setOptions({
				maxDate:jQuery("#vwDateend").val()?jQuery("#vwDateend").val():false
			})
		}
	});

	$("#addTimestart,#vwTimestart").datetimepicker({
		format: "H:i",
		formatTime: "h:ia",
		defaultTime: "08:00",
		datepicker: false
	});

	$("#addDateend").datetimepicker({
		timepicker: false,
		format: "Y-m-d",
		onShow: function(ct){
			this.setOptions({
				minDate:jQuery("#addDatestart").val()?jQuery("#addDatestart").val():false
			})
		}
	});

	$("#vwDateend").datetimepicker({
		timepicker: false,
		format: "Y-m-d",
		onShow: function(ct){
			this.setOptions({
				minDate:jQuery("#vwDatestart").val()?jQuery("#vwDatestart").val():false
			})
		}
	});

	$("#addTimeend,#vwTimeend").datetimepicker({
		format: "H:i",
		formatTime: "h:ia",
		defaultTime: "08:00",
		datepicker: false	
	});

	/******************************
				Get Schedule
	*******************************/

	function getSched(){
		$.ajax({
			type: "POST",
			url: "../../controller/functionSchedule.php",
			data:{
				function: "getSched",
				search: $("#searchFirstFloor-desc").val(),
				category: $("#firstSearch-category").data("id")
			},
			success: function(data){
				$("#tbodySched").html(data);
			},
		});
	}

	getSched();

	$("#searchFirstFloor-btn").click(function(event){
		event.preventDefault();	
		getSched();
		//alert($("#firstSearch-category").data("id"));
	});

	$("#searchBy-desc").click(function(){
		$("#searchFirstFloor-desc").attr("placeholder","Description");
		$("#searchFirstFloor-desc").val("");
		$("#firstSearch-category").data("id","1");
		$("#searchFirstFloor-desc").datetimepicker("destroy");
	});

	$("#searchBy-name").click(function(){
		$("#searchFirstFloor-desc").attr("placeholder","Organizer");
		$("#searchFirstFloor-desc").val("");
		$("#firstSearch-category").data("id","2");
		$("#searchFirstFloor-desc").datetimepicker("destroy");
	});

	$("#searchBy-date").click(function(){
		$("#searchFirstFloor-desc").attr("placeholder","Date");
		$("#searchFirstFloor-desc").val("");
		$("#firstSearch-category").data("id","3");
		$("#searchFirstFloor-desc").datetimepicker({
			timepicker: false,
			format: "Y-m-d"
		});
	});

	/*
	$("#addFunctionSched-first-flr-modal").on("change","#first-addActivityType",function(){
		if($(this).val()==4){
			$("#socialGathering-collapse").collapse("show");
		}
		else{
			$("#socialGathering-collapse").collapse("hide");
			$("#socialGatheringOthers-collapse").collapse("hide");
			$("#first-addSocialGather").val("1");
		}
	});
	
	$("#addFunctionSched-first-flr-modal").on("change","#first-addSocialGather",function(){
		if($(this).val()==3){
			$("#socialGatheringOthers-collapse").collapse("show");
		}
		else{
			$("#socialGatheringOthers-collapse").collapse("hide");
		}
	});
	*/
	$("#toggle-add-modal").click(function(){
		$.ajax({
			type: "POST",
			url: "../../controller/functionSchedule.php",
			data:{
				function: "getRoom"
			},
			success: function(data){
				$("#addRoom").html(data);
			}
		});
	});


	/*******************************************************************
							Create Schedule
	********************************************************************/

	/********************
		
		Regular Expression
	
	********************/

	/*
	$("#addFunctionSched-modal").on("keypress","#addAgency",function(e){
		var regex = new RegExp("^[a-zA-Z ]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#addFunctionSched-modal").on("keypress","#addAddress",function(e){
		var regex = new RegExp("^[a-zA-Z ]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});
	*/

	$("#addFunctionSched-modal").on("keypress","#addParticipants",function(e){
		var regex = new RegExp("^[0-9]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#addFunctionSched-modal").on("keypress","#addDatestart",function(e){
		if(e.keyCode !== 8) {
	        e.preventDefault();
	    }
	});

	$("#addFunctionSched-modal").on("keypress","#addTimestart",function(e){
		if(e.keyCode !== 8) {
	        e.preventDefault();
	    }
	});

	$("#addFunctionSched-modal").on("keypress","#addDateend",function(e){
		if(e.keyCode !== 8) {
	        e.preventDefault();
	    }
	});

	$("#addFunctionSched-modal").on("keypress","#addTimeend",function(e){
		if(e.keyCode !== 8) {
	        e.preventDefault();
	    }
	});

	$("#addFunctionSched-modal").on("keypress","#addReservedBy",function(e){
		var regex = new RegExp("^[a-zA-Z,. ]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#addFunctionSched-modal").on("keypress","#addReservedByMobile",function(e){
		var regex = new RegExp("^[0-9]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});
	



	/********************
	
		Create Schedule

	*********************/

	$("#addFunctionSched-modal").on("click","#addFunctionSched",function(e){
		e.preventDefault();
		//Checker if field is empty
		if($("#addTitle").val() == "" || $("#addParticipants").val() == "" || $("#addDatestart").val() == "" || $("#addTimestart").val() == "" || $("#addDateend").val() == "" || $("#addTimeend").val() == "" || $("#addNature").val() == "" || $("#addReservedBy").val() == "" || $("#addReservedByMobile").val() == ""){
			if($("#addTitle").val() == ""){
				$("#addTitle-msg").css("display","block");
			}
			else{
				$("#addTitle-msg").css("display","none");
			}

			if($("#addParticipants").val() == ""){
				$("#addParticipants-msg").css("display","block");
			}
			else{
				$("#addParticipants-msg").css("display","none");
			}

			if($("#addDatestart").val() == ""){
				$("#addDatestart-msg").css("display","block");
			}
			else{
				$("#addDatestart-msg").css("display","none");
			}

			if($("#addTimestart").val() == ""){
				$("#addTimestart-msg").css("display","block");
			}
			else{
				$("#addTimestart-msg").css("display","none");
			}

			if($("#addDateend").val() == ""){
				$("#addDateend-msg").css("display","block");
			}
			else{
				$("#addDateend-msg").css("display","none");
			}

			if($("#addTimeend").val() == ""){
				$("#addTimeend-msg").css("display","block");
			}
			else{
				$("#addTimeend-msg").css("display","none");
			}

			if($("#addNature").val() == ""){
				$("#addNature-msg").css("display","block");
			}
			else{
				$("#addNature-msg").css("display","none");
			}
			
			if($("#addReservedBy").val() == ""){
				$("#addReservedBy-msg").css("display","block");
			}
			else{
				$("#addReservedBy-msg").css("display","none");
			}
			
			if($("#addReservedByMobile").val() == ""){
				$("#addReservedByMobile-msg").css("display","block");
			}
			else{
				$("#addReservedByMobile-msg").css("display","none");
			}

		}
		else{
			$("#addTitle-msg,#addParticipants-msg,#addDatestart-msg,#addTimestart-msg,#addDateend-msg,#addTimeend-msg,#addNature-msg,#addReservedBy-msg,#addReservedByMobile-msg").css("display","none");
			$.ajax({
				type: "POST",
				url: "../../controller/functionSchedule.php",
				data:{
					agency: $("#addAgency").val(),
					agency_add: $("#addAddress").val(),
					room: $("#addRoom").val(),
					title: $("#addTitle").val(),
					participants: $("#addParticipants").val(),
					date_start: $("#addDatestart").val(),
					time_start: $("#addTimestart").val(),
					date_end: $("#addDateend").val(),
					time_end: $("#addTimeend").val(),
					nature: $("#addNature").val(),
					reservedBy: $("#addReservedBy").val(),
					reserved_add: $("#addReservedByAddress").val(),
					contact: $("#addReservedByMobile").val(),
					email: $("#addReservedByEmail").val(),
					function: "addSchedule"
				},
				success: function(data){
					alert(data);
					getSched();
					if(data == "There is someone already reserved in this schedule."){

					}
					else if(data == "There is someone already reserved in this schedule."){

					}
					else if(data == "Please input a valid date & time."){

					}
					else{
						$("#addFunctionSched-modal").modal("hide");
					}
					
				}
			});
		}
		
		
	});

	$('#addFunctionSched-modal').on('hidden.bs.modal', function () {
	    $(this).find('form').trigger('reset');
	    $("#addTitle-msg").css("display","none");
	    $("#addParticipants-msg").css("display","none");
	    $("#addDatestart-msg").css("display","none");
	    $("#addTimestart-msg").css("display","none");
	    $("#addDateend-msg").css("display","none");
	    $("#addTimeend-msg").css("display","none");
	    $("#addNature-msg").css("display","none");
	    $("#addReservedBy-msg").css("display","none");
	    $("#addReservedByMobile-msg").css("display","none");
	});







	/**************************************************************
						View & Edit Schedule
	***************************************************************/

	function getRoom(id){
		$.ajax({
			type: "POST",
			url: "../../controller/functionSchedule.php",
			data:{
				function: "getRoom"
			},
			success: function(data){
				$("#vwRoom").html(data);
				//$("#vwRoom").val(id);
			}
		});
	}


	$("#tableSched").on("click","#vw-info",function(){
		$("#vwFunctionSched-modal").data("id",$(this).data("id"));
		
		getRoom();
		$.ajax({
			type: "POST",
			url: "../../controller/functionSchedule.php",
			data: {
				i_fr_id: $(this).data("id"),
				function: "viewReserved"
			},
			success: function(data){
				data = jQuery.parseJSON(data);
				console.log(data);
				$("#vwAgency").val(data.agency);
				$("#vwAddress").val(data.agency_add);
				$("#vwTitle").val(data.title);
				$("#vwParticipants").val(data.participants);
				$("#vwRoom").val(data.rm_id);
				$("#vwDatestart").val(data.d_arrival);
				$("#vwTimestart").val(data.t_arrival);
				$("#vwDateend").val(data.d_departure);
				$("#vwTimeend").val(data.t_departure);
				$("#vwNature").val(data.nature);
				$("#vwReservedBy").val(data.requisitioner);
				$("#vwReservedByAddress").val(data.address);
				$("#vwReservedByMobile").val(data.mobile);
				$("#vwReservedByEmail").val(data.email);
			}
		});
	});	

	$("#vwFunctionSched-modal").on("click",".edit",function(){
		$("#vwAgency,#vwAddress,#vwTitle,#vwParticipants,#vwRoom,#vwDatestart,#vwTimestart,#vwDateend,#vwTimeend,#vwNature,#vwReservedBy,#vwReservedByAddress,#vwReservedByMobile,#vwReservedByEmail").prop("disabled",false);
		$("#editFunctionSched").removeClass("edit").addClass("submit");
		$("#editFunctionSched").html("<i class='fa fa-save'></i> Update");
	});

	$('#vwFunctionSched-modal').on('hidden.bs.modal', function () {
	    $(this).find('form').trigger('reset');
	    $("#vwTitle-msg,#vwParticipants-msg,#vwDatestart-msg,#vwTimestart-msg,#vwDateend-msg,#vwTimeend-msg,#vwNature-msg,#vwReservedBy-msg,#vwReservedByMobile-msg").css("display","none");
	    $("#vwAgency,#vwAddress,#vwTitle,#vwParticipants,#vwRoom,#vwDatestart,#vwTimestart,#vwDateend,#vwTimeend,#vwNature,#vwReservedBy,#vwReservedByAddress,#vwReservedByMobile,#vwReservedByEmail").prop("disabled",true);
	    $("#editFunctionSched").removeClass("submit").addClass("edit");
		$("#editFunctionSched").html("<i class='fa fa-edit'></i> Edit");
	    /*$("#create-request-name-msg").html("");
	    $("#create-request-bdate-msg").html("");
	    $("#create-request-address-msg").html("");
	    $("#create-request-contact-msg").html("");
	    $("#create-request-email-msg").html("");
	    $("#create-request-school-msg").html("");
	    $("#create-request-course-msg").html("");
	    $("#create-request-major-msg").html("");
	    $("#create-request-yrGrad-msg").html("");*/
	});

	/********************
		
		Regular Expression
	
	********************/

	/*
	$("#addFunctionSched-modal").on("keypress","#addAgency",function(e){
		var regex = new RegExp("^[a-zA-Z ]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#addFunctionSched-modal").on("keypress","#addAddress",function(e){
		var regex = new RegExp("^[a-zA-Z ]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});
	*/

	$("#vwFunctionSched-modal").on("keypress","#vwParticipants",function(e){
		var regex = new RegExp("^[0-9]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#vwFunctionSched-modal").on("keypress","#vwDatestart",function(e){
		if(e.keyCode !== 8) {
	        e.preventDefault();
	    }
	});

	$("#vwFunctionSched-modal").on("keypress","#vwTimestart",function(e){
		if(e.keyCode !== 8) {
	        e.preventDefault();
	    }
	});

	$("#vwFunctionSched-modal").on("keypress","#vwDateend",function(e){
		if(e.keyCode !== 8) {
	        e.preventDefault();
	    }
	});

	$("#vwFunctionSched-modal").on("keypress","#vwTimeend",function(e){
		if(e.keyCode !== 8) {
	        e.preventDefault();
	    }
	});

	$("#vwFunctionSched-modal").on("keypress","#vwReservedBy",function(e){
		var regex = new RegExp("^[a-zA-Z,. ]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#vwFunctionSched-modal").on("keypress","#vwReservedByMobile",function(e){
		var regex = new RegExp("^[0-9]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#vwFunctionSched-modal").on("click",".submit",function(){
		//alert($("#vwFunctionSched-modal").data("id"));
		if($("#vwTitle").val() == "" || $("#vwParticipants").val() == "" || $("#vwDatestart").val() == "" || $("#vwTimestart").val() == "" || $("#vwDateend").val() == "" || $("#vwTimeend").val() == "" || $("#vwNature").val() == "" || $("#vwReservedBy").val() == "" || $("#vwReservedByMobile").val() == ""){
			if($("#vwTitle").val() == ""){
				$("#vwTitle-msg").css("display","block");
			}
			else{
				$("#vwTitle-msg").css("display","none");
			}

			if($("#vwParticipants").val() == ""){
				$("#vwParticipants-msg").css("display","block");
			}
			else{
				$("#vwParticipants-msg").css("display","none");
			}

			if($("#vwDatestart").val() == ""){
				$("#vwDatestart-msg").css("display","block");
			}
			else{
				$("#vwDatestart-msg").css("display","none");
			}

			if($("#vwTimestart").val() == ""){
				$("#vwTimestart-msg").css("display","block");
			}
			else{
				$("#vwTimestart-msg").css("display","none");
			}

			if($("#vwDateend").val() == ""){
				$("#vwDateend-msg").css("display","block");
			}
			else{
				$("#vwDateend-msg").css("display","none");
			}

			if($("#vwTimeend").val() == ""){
				$("#vwTimeend-msg").css("display","block");
			}
			else{
				$("#vwTimeend-msg").css("display","none");
			}

			if($("#vwNature").val() == ""){
				$("#vwNature-msg").css("display","block");
			}
			else{
				$("#vwNature-msg").css("display","none");
			}
			
			if($("#vwReservedBy").val() == ""){
				$("#vwReservedBy-msg").css("display","block");
			}
			else{
				$("#vwReservedBy-msg").css("display","none");
			}
			
			if($("#vwReservedByMobile").val() == ""){
				$("#vwReservedByMobile-msg").css("display","block");
			}
			else{
				$("#vwReservedByMobile-msg").css("display","none");
			}

		}
		else{
			$("#vwTitle-msg,#vwParticipants-msg,#vwDatestart-msg,#vwTimestart-msg,#vwDateend-msg,#vwTimeend-msg,#vwNature-msg,#vwReservedBy-msg,#vwReservedByMobile-msg").css("display","none");

			$.ajax({
				type: "POST",
				url: "../../controller/functionSchedule.php",
				data:{
					i_fr_id: $("#vwFunctionSched-modal").data("id"),
					agency: $("#vwAgency").val(),
					agency_add: $("#vwAddress").val(),
					title: $("#vwTitle").val(),
					participants: $("#vwParticipants").val(),
					room: $("#vwRoom").val(),
					date_start: $("#vwDatestart").val(),
					time_start: $("#vwTimestart").val(),
					date_end: $("#vwDateend").val(),
					time_end: $("#vwTimeend").val(),
					nature: $("#vwNature").val(),
					reservedBy: $("#vwReservedBy").val(),
					reserved_add: $("#vwReservedByAddress").val(),
					contact: $("#vwReservedByMobile").val(),
					email: $("#vwReservedByEmail").val(),
					function: "updateInfo"
				},
				success: function(data){
					alert(data);
					$("#vwAgency,#vwAddress,#vwTitle,#vwParticipants,#vwRoom,#vwDatestart,#vwTimestart,#vwDateend,#vwTimeend,#vwNature,#vwReservedBy,#vwReservedByAddress,#vwReservedByMobile,#vwReservedByEmail").prop("disabled",true);
	   				$("#editFunctionSched").removeClass("submit").addClass("edit");
					$("#editFunctionSched").html("<i class='fa fa-edit'></i> Edit");
					getSched();
				}
			});
			
		}
		
	});


















	/**********************************

				Check-in
	
	************************************/


	/*$("#tbodySched").on("click","#checkin-sched",function(){
		$("#createBill-checkin-modal").data("id",$(this).data("id"));
		$.ajax({
			type: "POST",
			url: "../../controller/functionSchedule.php",
			data: {
				i_fr_id: $(this).data("id"),
				function: "settleCheckin"
			},
			success: function(data){
				data = jQuery.parseJSON(data);
				console.log(data);
				$("#checkIn-title").val(data.title);
				$("#checkIn-nature").val(data.nature);
				$("#checkIn-requisitioner").val(data.requisitioner);
				$("#checkIn-room").val(data.room);
				$("#checkIn-dateCheckin").val(data.checkin);
				$("#createBill-checkin-modal").modal("show");
				//getSched();
			}
		});
		/*$.ajax({
			type: "POST",
			url: "../../controller/functionSchedule.php",
			data: {
				i_fr_id: $(this).data("id"),
				function: "checkIn"
			},
			success: function(data){
				alert(data);
				getSched();
			}
		});
		
		//alert("Check-in clicked! Id: " + $(this).data("id"));
	});*/

	function getCheckin_ParticularDescription(){
		$.ajax({
			type: "POST",
			url: "../../controller/functionSchedule.php",
			data: {
				category: $("#checkIn-particulars-category").val(),
				aircon: $("#checkIn-particulars-aircon").val(),
				function: "getParticularDescription"
			},
			success: function(data){
				console.log(data);
				$("#checkIn-particulars-description").html(data);
				getCheckin_Rate();
			}
		});
	}

	function getCheckin_Rate(){
		$.ajax({
			type: "POST",
			url: "../../controller/functionSchedule.php",
			data:{
				i_pid: $("#checkIn-particulars-description").val(),
				function: "getRate"
			},
			success: function(data){
				data = jQuery.parseJSON(data);
				console.log(data);
				$("#checkIn-firstHour").val(data.first_hour);
				$("#checkIn-succeedingHour").val(data.succeeding_hour);
				//getCheckin_Bill();
			}
		});
	}

	/*function getCheckin_Bill(){
		$.ajax({
			type: "POST",
			url: "../../controller/functionSchedule.php",
			data:{
				total_hours: $("#createBill-totalHours").val(),
				first_hour: $("#createBill-particulars-first-hour").val(),
				succeeding_hour: $("#createBill-particulars-succeeding-hour").val(),
				function: "getBill"
			},
			success: function(data){
				data = jQuery.parseJSON(data);
				console.log(data);
				$("#createBill-particulars-total-amount").val(data.total_amount);
			}
		});
	}*/

	$("#tbodySched").on("click","#checkin-sched",function(){
		$("#createBill-checkin-modal").data("id",$(this).data("id"));
		$("#createBill-checkin-modal").modal("show");
		getCheckin_ParticularDescription();
		//getBill();
	});
	
	$("#createBill-checkin-modal").on("change","#checkIn-particulars-category",function(){
		getCheckin_ParticularDescription();
	});

	$("#createBill-checkin-modal").on("change","#checkIn-particulars-aircon",function(){
		getCheckin_ParticularDescription();
	});

	$("#createBill-checkin-modal").on("change","#checkIn-particulars-description",function(){
		getCheckin_Rate();
	});

	$("#createBill-checkin-modal").on("click","#checkIn-Submit",function(e){

		e.preventDefault();
		var x = confirm("Are you sure you want to submit this form?");
		if(x==true){
			$.ajax({
				type: "POST",
				url: "../../controller/functionSchedule.php",
				data: {
					i_fr_id: $("#createBill-checkin-modal").data("id"),
					i_pid: $("#checkIn-particulars-description").val(),
					function: "checkIn"
				},
				success: function(data){
					alert(data);
					getSched();
					$("#createBill-checkin-modal").modal("hide");
				}
			});
		}

	});

	$('#createBill-checkin-modal').on('hidden.bs.modal', function () {
	    $(this).find('form').trigger('reset');
	});



















	/****************************************************
						Delete Schedule
	*****************************************************/

	$("#tableSched").on("click","#delete-sched",function(){
		var x = confirm("Are you sure you want to delete this schedule?");
		if(x==true){
			$.ajax({
				type: "POST",
				url: "../../controller/functionSchedule.php",
				data:{
					i_fr_id: $(this).data("id"),
					function: "deleteSched"
				},
				success: function(data){
					alert(data);
					getSched();
				}
			});
		}
	});






	/********************************************************
							View Request
	*********************************************************/

	/*************
		
		Date & Time picker
	
	*************/

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

	function getRequests(){
		$.ajax({
			type: "POST",
			url: "../../controller/functionSchedule.php",
			data:{
				function: "getRequest",
				search: $("#searchRequest").val(),
				category: $("#searchRequest-category").data("id")
			},
			success: function(data){
				$("#tbodySched-request").html(data);
			},
		});
	}

	getRequests();

	$("#toggle-requests-modal").click(function(){
		getRequests();
		setInterval(function(){
			getRequests();
		},60000);
	});

	$("#searchRequest-btn").click(function(event){
		event.preventDefault();	
		getRequests();
	});

	$("#searchBy-desc-request").click(function(){
		$("#searchRequest").attr("placeholder","Description");
		$("#searchRequest").val("");
		$("#searchRequest-category").data("id","1");
		$("#searchRequest").datetimepicker("destroy");
	});

	$("#searchBy-name-request").click(function(){
		$("#searchRequest").attr("placeholder","Organizer");
		$("#searchRequest").val("");
		$("#searchRequest-category").data("id","2");
		$("#searchRequest").datetimepicker("destroy");
	});

	$("#searchBy-date-request").click(function(){
		$("#searchRequest").attr("placeholder","Date");
		$("#searchRequest").val("");
		$("#searchRequest-category").data("id","3");
		$("#searchRequest").datetimepicker({
			timepicker: false,
			format: "Y-m-d"
		});
	});

	$("#viewRequests-modal").on("click","#view-request",function(){
		$("#vwRequest-detail-modal").data("id",$(this).data("id"));
		$("#vwRequest-detail-modal").modal("show");


		//Get rooms
		$.ajax({
			type: "POST",
			url: "../../controller/functionSchedule.php",
			data:{
				function: "getRoom"
			},
			success: function(data){
				$("#vwRoom-request").html(data);
				//$("#vwRoom").val(id);
			}
		});
		
		//Get all data in this reservation schedule
		$.ajax({
			type: "POST",
			url: "../../controller/functionSchedule.php",
			data: {
				i_fr_id: $(this).data("id"),
				function: "viewReserved"
			},
			success: function(data){
				data = jQuery.parseJSON(data);
				console.log(data);
				$("#vwAgency-request").val(data.agency);
				$("#vwAddress-request").val(data.agency_add);
				$("#vwTitle-request").val(data.title);
				$("#vwParticipants-request").val(data.participants);
				$("#vwRoom-request").val(data.rm_id);
				$("#vwDatestart-request").val(data.d_arrival);
				$("#vwTimestart-request").val(data.t_arrival);
				$("#vwDateend-request").val(data.d_departure);
				$("#vwTimeend-request").val(data.t_departure);
				$("#vwNature-request").val(data.nature);
				$("#vwReservedBy-request").val(data.requisitioner);
				$("#vwReservedByAddress-request").val(data.address);
				$("#vwReservedByMobile-request").val(data.mobile);
				$("#vwReservedByEmail-request").val(data.email);
			}
		});
	});	

	$("#vwRequest-detail-modal").on("click","#editFunctionSched-request",function(){
		alert($("#vwRequest-detail-modal").data("id"));
	});

	$("#vwRequest-detail-modal").on('hidden.bs.modal', function () {
	    $(this).find('form').trigger('reset');
	});

	$("#viewRequests-modal").on("click","#accept-request",function(){
		var x = confirm("Are you sure you want to accept this request?");
		if(x==true){
			$.ajax({
				type: "POST",
				url: "../../controller/functionSchedule.php",
				data:{
					i_fr_id: $(this).data("id"),
					function: "acceptRequest"
				},
				success: function(data){
					alert(data);
					getRequests();
					getSched();
				}
			});
		}
		
	});







	/************************************************************************

								Add Request

	*************************************************************************/

	/********************
		
		Regular Expression
	
	********************/

	/*
	$("#addFunctionSched-modal").on("keypress","#addAgency",function(e){
		var regex = new RegExp("^[a-zA-Z ]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#addFunctionSched-modal").on("keypress","#addAddress",function(e){
		var regex = new RegExp("^[a-zA-Z ]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});
	*/

	$("#addRequest-modal").on("keypress","#addParticipants-request",function(e){
		var regex = new RegExp("^[0-9]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#addRequest-modal").on("keypress","#addDatestart-request",function(e){
		if(e.keyCode !== 8) {
	        e.preventDefault();
	    }
	});

	$("#addRequest-modal").on("keypress","#addTimestart-request",function(e){
		if(e.keyCode !== 8) {
	        e.preventDefault();
	    }
	});

	$("#addRequest-modal").on("keypress","#addDateend-request",function(e){
		if(e.keyCode !== 8) {
	        e.preventDefault();
	    }
	});

	$("#addRequest-modal").on("keypress","#addTimeend-request",function(e){
		if(e.keyCode !== 8) {
	        e.preventDefault();
	    }
	});

	$("#addRequest-modal").on("keypress","#addReservedBy-request",function(e){
		var regex = new RegExp("^[a-zA-Z,. ]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#addRequest-modal").on("keypress","#addReservedByMobile-request",function(e){
		var regex = new RegExp("^[0-9]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});
	

	/*************
		Generate Room
	************/

	$("#viewRequests-modal").on("click","#addRequest-toggle-modal",function(){
		$.ajax({
			type: "POST",
			url: "../../controller/functionSchedule.php",
			data:{
				function: "getRoom"
			},
			success: function(data){
				$("#addRoom-request").html(data);
			}
		});
	});

	$("#addRequest-modal").on("click","#addRequest",function(e){
		e.preventDefault();
		if($("#addTitle-request").val() == "" || $("#addParticipants-request").val() == "" || $("#addDatestart-request").val() == "" || $("#addTimestart-request").val() == "" || $("#addDateend-request").val() == "" || $("#addTimeend-request").val() == "" || $("#addNature-request").val() == "" || $("#addReservedBy-request").val() == "" || $("#addReservedByMobile-request").val() == ""){
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

			$.ajax({
				type: "POST",
				url: "../../controller/functionSchedule.php",
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
					getRequests();
					$("#addRequest-modal").modal("hide");
				}
			});

		}
	});

	$('#addRequest-modal').on('hidden.bs.modal', function () {
	    $(this).find('form').trigger('reset');
	    $("#addTitle-request-msg").css("display","none");
	    $("#addParticipants-request-msg").css("display","none");
	    $("#addDatestart-request-msg").css("display","none");
	    $("#addTimestart-request-msg").css("display","none");
	    $("#addDateend-request-msg").css("display","none");
	    $("#addTimeend-request-msg").css("display","none");
	    $("#addNature-request-msg").css("display","none");
	    $("#addReservedBy-request-msg").css("display","none");
	    $("#addReservedByMobile-request-msg").css("display","none");
	});

	$("#viewRequests-modal").on("click","#delete-request",function(){
		var x = confirm("Are you sure you want to delete this request?");
		if (x==true){
			$.ajax({
				type: "POST",
				url: "../../controller/functionSchedule.php",
				data: {
					i_fr_id: $(this).data("id"),
					function: "deleteRequest"
				},
				success: function(data){
					alert(data);
					getRequests();
				}
			});
		}
	});

	$("#viewRequests-modal").on("click","#reject-request",function(){
		var x = confirm("Are you sure you want to reject this request?");
		if(x==true){
			$.ajax({
				type: "POST",
				url: "../../controller/functionSchedule.php",
				data: {
					i_fr_id: $(this).data("id"),
					function: "rejectRequest"
				},
				success: function(data){
					alert(data);
					getRequests();
					getReject();
				}
			});
		}
	});








	/*****************************************************
						View Rejected Requests
	*****************************************************/

	$("#viewReject-toggle-modal").click(function(){
		getReject();
	});

	$("#viewReject-modal").on("click","#searchReject-btn",function(e){
		e.preventDefault();
		getReject();
	});

	$("#searchBy-desc-reject").click(function(){
		$("#searchReject").attr("placeholder","Description");
		$("#searchReject").val("");
		$("#searchReject-category").data("id","1");
		$("#searchReject").datetimepicker("destroy");
	});

	$("#searchBy-name-reject").click(function(){
		$("#searchReject").attr("placeholder","Organizer");
		$("#searchReject").val("");
		$("#searchReject-category").data("id","2");
		$("#searchReject").datetimepicker("destroy");
	});

	$("#searchBy-date-reject").click(function(){
		$("#searchReject").attr("placeholder","Date");
		$("#searchReject").val("");
		$("#searchReject-category").data("id","3");
		$("#searchReject").datetimepicker({
			timepicker: false,
			format: "Y-m-d"
		});
	});

	function getReject(){
		$.ajax({
			type: "POST",
			url: "../../controller/functionSchedule.php",
			data:{
				function: "getReject",
				search: $("#searchReject").val(),
				category: $("#searchReject-category").data("id")
			},
			success: function(data){
				$("#tbodySched-reject").html(data);
			},
		});
	}

	$("#viewReject-modal").on("click","#recover-reject",function(){
		var x = confirm("Are you sure you want to recover this request?");
		if(x==true){
			$.ajax({
				type: "POST",
				url: "../../controller/functionSchedule.php",
				data: {
					i_fr_id: $(this).data("id"),
					function: "recoverReject"
				},
				success: function(data){
					alert(data);
					getReject();
					getRequests();
				}
			});
		}
	});

	$("#viewReject-modal").on("click","#delete-reject",function(){
		var x = confirm("Are you sure you want to delete this request?");
		if(x==true){
			$.ajax({
				type: "POST",
				url: "../../controller/functionSchedule.php",
				data: {
					i_fr_id: $(this).data("id"),
					function: "deleteReject"
				},
				success: function(data){
					alert(data);
					getReject();
					getRequests();
				}
			});
		}
		
	});

	/*$("#v-pills-second-floor-tab").click(function(){
		getSecondFloorSched();
	});
	*/














	/****************************************************************

							Checked In

	*****************************************************************/

	function getCheckin(){
		$.ajax({
			type: "POST",
			url: "../../controller/functionSchedule.php",
			data: {
				function: "getCheckin"
			},
			success: function(data){
				$("#tbodyCheckin").html(data);
				console.log(data);
			}
		})
	}

	$("#v-pills-checkin-tab").click(function(){
		//alert("Tab changed");
		getCheckin();
	});

	$("#searchBy-lname-checkin").click(function(e){
		e.preventDefault();
		$("#search-checked-in").attr("placeholder","Last name");
		$("#search-category-checkin").data("id","1");
	});

	$("#searchBy-fname-checkin").click(function(e){
		e.preventDefault();
		$("#search-checked-in").attr("placeholder","First name");
		$("#search-category-checkin").data("id","2");
	});

	$("#search-checked-in-btn").click(function(e){
		e.preventDefault();
		alert($("#search-category-checkin").data("id"));
	});

	function checkin_getRoom(id){
		$.ajax({
			type: "POST",
			url: "../../controller/functionSchedule.php",
			data:{
				function: "getRoom"
			},
			success: function(data){
				$("#vw-checkin-Room").html(data);
				//$("#vwRoom").val(id);
			}
		});
	}

	//View info in checkin
	$("#tbodyCheckin").on("click","#view-checkin",function(e){
		e.preventDefault();
		$("#vwCheckin-info-modal").data("id",$(this).data("id"));
		checkin_getRoom();
		$.ajax({
			type: "POST",
			url: "../../controller/functionSchedule.php",
			data:{
				i_fr_id: $(this).data("id"),
				function: "viewCheckinInfo"
			},
			success: function(data){
				data = jQuery.parseJSON(data);
				console.log(data);
				$("#vw-checkin-Agency").val(data.agency);
				$("#vw-checkin-Address").val(data.agencyAdd);
				$("#vw-checkin-Title").val(data.title);
				$("#vw-checkin-Participants").val(data.participants);
				$("#vw-checkin-Room").val(data.room);
				/*$("#vw-checkin-Datestart").val("");
				$("#vw-checkin-Timestart").val("");
				$("#vw-checkin-Dateend").val("");
				$("#vw-checkin-Timeend").val("");*/
				$("#vw-checkin-Nature").val(data.nature);
				$("#vw-checkin-ReservedBy").val(data.requisitioner);
				$("#vw-checkin-ReservedByAddress").val(data.address);
				$("#vw-checkin-ReservedByMobile").val(data.contact);
				$("#vw-checkin-ReservedByEmail").val(data.email);
				$("#vwCheckin-info-modal").modal("show");
			}
		});
	});


	$("#vwCheckin-info-modal").on("click",".edit",function(e){
		e.preventDefault();
		//alert($("#vwCheckin-info-modal").data("id"));
		$("#vw-checkin-Agency,#vw-checkin-Address,#vw-checkin-Title,#vw-checkin-Participants,#vw-checkin-Room,#vw-checkin-Nature,#vw-checkin-ReservedBy,#vw-checkin-ReservedByAddress,#vw-checkin-ReservedByMobile,#vw-checkin-ReservedByEmail").attr("disabled",false);
		$("#vw-checkin-edit-btn").removeClass("edit").addClass("submit");
		$("#vw-checkin-edit-btn").html("<i class='fa fa-save'></i> Submit");
	});

	/*******************************************************************
							Create Schedule
	********************************************************************/

	/********************
		
		Regular Expression
	
	********************/

	/*
	$("#addFunctionSched-modal").on("keypress","#addAgency",function(e){
		var regex = new RegExp("^[a-zA-Z ]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#addFunctionSched-modal").on("keypress","#addAddress",function(e){
		var regex = new RegExp("^[a-zA-Z ]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});
	*/

	$("#vwCheckin-info-modal").on("keypress","#vw-checkin-Participants",function(e){
		var regex = new RegExp("^[0-9]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	/*

	$("#vwCheckin-info-modal").on("keypress","#addDatestart",function(e){
		if(e.keyCode !== 8) {
	        e.preventDefault();
	    }
	});

	$("#vwCheckin-info-modal").on("keypress","#addTimestart",function(e){
		if(e.keyCode !== 8) {
	        e.preventDefault();
	    }
	});

	$("#vwCheckin-info-modal").on("keypress","#addDateend",function(e){
		if(e.keyCode !== 8) {
	        e.preventDefault();
	    }
	});

	$("#vwCheckin-info-modal").on("keypress","#addTimeend",function(e){
		if(e.keyCode !== 8) {
	        e.preventDefault();
	    }
	});
	*/

	$("#vwCheckin-info-modal").on("keypress","#vw-checkin-ReservedBy",function(e){
		var regex = new RegExp("^[a-zA-Z,. ]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#vwCheckin-info-modal").on("keypress","#vw-checkin-ReservedByMobile",function(e){
		var regex = new RegExp("^[0-9]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#vwCheckin-info-modal").on("click",".submit",function(e){
		e.preventDefault();
		if($("#vw-checkin-Title").val() == "" || $("#vw-checkin-Participants").val() == "" || $("#vw-checkin-Nature").val() == "" || $("#vw-checkin-ReservedBy").val() == "" || $("#vw-checkin-ReservedByMobile").val() == ""){
			if($("#vw-checkin-Title").val() == ""){
				$("#vw-checkin-Title-msg").css("display","block");
			}
			else{
				$("#vw-checkin-Title-msg").css("display","none");
			}

			if($("#vw-checkin-Participants").val() == ""){
				$("#vw-checkin-Participants-msg").css("display","block");
			}
			else{
				$("#vw-checkin-Participants-msg").css("display","none");
			}

			/*
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
			*/

			if($("#vw-checkin-Nature").val() == ""){
				$("#vw-checkin-Nature-msg").css("display","block");
			}
			else{
				$("#vw-checkin-Nature-msg").css("display","none");
			}
			
			if($("#vw-checkin-ReservedBy").val() == ""){
				$("#vw-checkin-ReservedBy-msg").css("display","block");
			}
			else{
				$("#vw-checkin-ReservedBy-msg").css("display","none");
			}
			
			if($("#vw-checkin-ReservedByMobile").val() == ""){
				$("#vw-checkin-ReservedByMobile-msg").css("display","block");
			}
			else{
				$("#vw-checkin-ReservedByMobile-msg").css("display","none");
			}

		}
		else{
			$("#vw-checkin-Title-msg,#vw-checkin-Participants-msg,#vw-checkin-Nature-msg,#vw-checkin-ReservedBy-msg,#vw-checkin-ReservedByMobile-msg").css("display","none");
			$.ajax({
				type: "POST",
				url: "../../controller/functionSchedule.php",
				data:{
					i_fr_id: $("#vwCheckin-info-modal").data("id"),
					agency: $("#vw-checkin-Agency").val(),
					agencyAdd: $("#vw-checkin-Address").val(),
					title: $("#vw-checkin-Title").val(),
					participants: $("#vw-checkin-Participants").val(),
					room: $("#vw-checkin-Room").val(),
					nature: $("#vw-checkin-Nature").val(),
					requisitioner: $("#vw-checkin-ReservedBy").val(),
					address: $("#vw-checkin-ReservedByAddress").val(),
					contact: $("#vw-checkin-ReservedByMobile").val(),
					email: $("#vw-checkin-ReservedByEmail").val(),
					function: "updateCheckinInfo"
				},
				success: function(data){
					alert(data);
					if(data=="Room is in use."){

					}
					else{
						$("#vw-checkin-Agency,#vw-checkin-Address,#vw-checkin-Title,#vw-checkin-Participants,#vw-checkin-Room,#vw-checkin-Nature,#vw-checkin-ReservedBy,#vw-checkin-ReservedByAddress,#vw-checkin-ReservedByMobile,#vw-checkin-ReservedByEmail").attr("disabled",true);
						$("#vw-checkin-edit-btn").removeClass("submit").addClass("edit");
						$("#vw-checkin-edit-btn").html("<i class='fa fa-edit'></i> Edit");
						getCheckin();
					}
				}
			});
		}
		//alert($("#vwCheckin-info-modal").data("id"));
		
	});

	$('#vwCheckin-info-modal').on('hidden.bs.modal', function () {
	    $(this).find('form').trigger('reset');
	    $("#vw-checkin-Agency,#vw-checkin-Address,#vw-checkin-Title,#vw-checkin-Participants,#vw-checkin-Room,#vw-checkin-Nature,#vw-checkin-ReservedBy,#vw-checkin-ReservedByAddress,#vw-checkin-ReservedByMobile,#vw-checkin-ReservedByEmail").attr("disabled",true);
	    $("#vw-checkin-edit-btn").removeClass("submit").addClass("edit");
		$("#vw-checkin-edit-btn").html("<i class='fa fa-edit'></i> Edit");
	    $("#vw-checkin-Title-msg").css("display","none");
	    $("#vw-checkin-Participants-msg").css("display","none");
	    /*$("#addDatestart-request-msg").css("display","none");
	    $("#addTimestart-request-msg").css("display","none");
	    $("#addDateend-request-msg").css("display","none");
	    $("#addTimeend-request-msg").css("display","none");
	    */
	    $("#vw-checkin-Nature-msg").css("display","none");
	    $("#vw-checkin-ReservedBy-msg").css("display","none");
	    $("#vw-checkin-ReservedByMobile-msg").css("display","none");
	});













	/***********************************************************************************************

									Check-in Tab
		

	************************************************************************************************/

	function getRegisteredParticular(){
		$.ajax({
			type: "POST",
			url: "../../controller/functionSchedule.php",
			data: {
				i_fr_id: $("#createBill-checkout-modal").data("id"),
				function: "getRegisteredParticular"
			},
			success: function(data){
				$("#tbodyRegisteredParticular").html(data);
			}
		});
	}

	function getRegisteredAmenity(){
		$.ajax({
			type: "POST",
			url: "../../controller/functionSchedule.php",
			data: {
				i_fr_id: $("#createBill-checkout-modal").data("id"),
				function: "getRegisteredAmenity"
			},
			success: function(data){
				$("#tbodyRegisteredAmenity").html(data);
				//$("#createBill-checkout-modal").modal("show");
			}
		});
	}

	$("#tbodyCheckin").on("click","#viewRate-checkin",function(){

		$("#createBill-checkout-modal").data("id",$(this).data("id"));
		getRegisteredParticular();
		getRegisteredAmenity();
		$("#createBill-checkout-modal").modal("show");

	});

	/*
	function getCheckoutBill(){
		$.ajax({
			type: "POST",
			url: "../../controller/functionSchedule.php",
			data:{
				i_fr_id: $("#createBill-checkout-modal").data("id"),
				hours: $("#createBill-totalHours").val(),
				function: "getCheckoutBill",
			},
			success: function(data){
				data = jQuery.parseJSON(data);
				console.log(data);
				$("#tbodyPaymentList").html(data.data);
				$("#createBill-particulars-total-amount").val(data.totalAmount);
			}
		});
	}*/

	/*

	function getParticularDescription(){
		$.ajax({
			type: "POST",
			url: "../../controller/functionSchedule.php",
			data: {
				category: $("#createBill-particulars-category").val(),
				aircon: $("#createBill-particulars-aircon").val(),
				function: "getParticularDescription"
			},
			success: function(data){
				console.log(data);
				$("#createBill-particulars-description").html(data);
				getRate();
			}
		});
	}

	function getRate(){
		$.ajax({
			type: "POST",
			url: "../../controller/functionSchedule.php",
			data:{
				i_pid: $("#createBill-particulars-description").val(),
				function: "getRate"
			},
			success: function(data){
				data = jQuery.parseJSON(data);
				console.log(data);
				$("#createBill-particulars-first-hour").val(data.first_hour);
				$("#createBill-particulars-succeeding-hour").val(data.succeeding_hour);
				getBill();
			}
		});
	}

	function getBill(){
		$.ajax({
			type: "POST",
			url: "../../controller/functionSchedule.php",
			data:{
				total_hours: $("#createBill-totalHours").val(),
				first_hour: $("#createBill-particulars-first-hour").val(),
				succeeding_hour: $("#createBill-particulars-succeeding-hour").val(),
				function: "getBill"
			},
			success: function(data){
				data = jQuery.parseJSON(data);
				console.log(data);
				$("#createBill-particulars-total-amount").val(data.total_amount);
			}
		});
	}

	$("#tbodyCheckin").on("click","#checkout-checkin",function(){
		getParticularDescription();
		//getBill();
	});
	
	$("#createBill-checkout-modal").on("change","#createBill-particulars-category",function(){
		getParticularDescription();
	});

	$("#createBill-checkout-modal").on("change","#createBill-particulars-aircon",function(){
		getParticularDescription();
	});

	$("#createBill-checkout-modal").on("change","#createBill-particulars-description",function(){
		getRate();
	});
	*/

	function viewParticularDescription($i_pid=0){
		$.ajax({
			type: "POST",
			url: "../../controller/functionSchedule.php",
			data: {
				category: $("#view-particulars-category").val(),
				aircon: $("#view-particulars-aircon").val(),
				function: "viewParticularDescription"
			},
			success: function(data){
				console.log(data);
				$("#view-particulars-description").html(data);
				if($i_pid!=0){
					$("#view-particulars-description").val($i_pid);
				}
				
				getRate();
			}
		});
	}

	function getRate(){
		$.ajax({
			type: "POST",
			url: "../../controller/functionSchedule.php",
			data:{
				i_pid: $("#view-particulars-description").val(),
				function: "getRate"
			},
			success: function(data){
				data = jQuery.parseJSON(data);
				console.log(data);
				$("#view-particulars-firstHour").val(data.first_hour);
				$("#view-particulars-succeedingHour").val(data.succeeding_hour);
				//getBill();
			}
		});
	}

	// View selected Particular
	$("#createBill-checkout-modal").on("click","#createBill-viewParticular",function(e){
		e.preventDefault();
		$("#viewParticular-checkout-modal").data("id",$(this).data("id")); // Bill id
		
		$.ajax({
			type: "POST",
			url: "../../controller/functionSchedule.php",
			data:{
				i_bid: $(this).data("id"),
				function: "viewParticular"
			},
			success: function(data){
				data = jQuery.parseJSON(data);
				console.log(data);
				if(data.category=="VSU Personnel(First Floor)"){
					$("#view-particulars-category").val("1");
					if(data.aircon=="Without Aircon"){
						$("#view-particulars-aircon").val("0");
					}
					else{
						$("#view-particulars-aircon").val("1");
					}
				}
				else if(data.category=="VSU Students(First Floor)"){
					$("#view-particulars-category").val("2");
					if(data.aircon=="Without Aircon"){
						$("#view-particulars-aircon").val("0");
					}
					else{
						$("#view-particulars-aircon").val("1");
					}
				}

				else if(data.category=="Non VSU Employees and Students(First Floor)"){
					$("#view-particulars-category").val("3");
					if(data.aircon=="Without Aircon"){
						$("#view-particulars-aircon").val("0");
					}
					else{
						$("#view-particulars-aircon").val("1");
					}
				}

				else if(data.category=="VSU Employees and Students(Second Floor)"){
					$("#view-particulars-category").val("4");
					if(data.aircon=="Without Aircon"){
						$("#view-particulars-aircon").val("0");
					}
					else{
						$("#view-particulars-aircon").val("1");
					}
				}

				else if(data.category=="Non-VSU Employees(Second Floor)"){
					$("#view-particulars-category").val("5");
					if(data.aircon=="Without Aircon"){
						$("#view-particulars-aircon").val("0");
					}
					else{
						$("#view-particulars-aircon").val("1");
					}
				}
				viewParticularDescription(data.i_pid);
				$("#viewParticular-checkout-modal").modal("show");
			}
		});
		//$("#viewParticular-checkout-modal").modal("show");
		//alert("This is a " + $(this).data("category") + " Having an id: " + $(this).data("id"));
	});


	/******************************************************************
							
							View Particular

	*******************************************************************/


	$("#viewParticular-checkout-modal").on("click",".edit",function(e){
		e.preventDefault();
		$("#view-particulars-submit-btn").removeClass("edit").addClass("submit");
		$("#view-particulars-submit-btn").html("<i class='fa fa-save'> Submit</i>");
		$("#view-particulars-category,#view-particulars-aircon,#view-particulars-description").attr("disabled",false);
		//alert("Edit class has been changed to submit class");
	});

	$("#viewParticular-checkout-modal").on("click",".submit",function(e){
		e.preventDefault();
		$("#view-particulars-submit-btn").removeClass("submit").addClass("edit");
		$("#view-particulars-submit-btn").html("<i class='fa fa-edit'> Edit</i>");
		$("#view-particulars-category,#view-particulars-aircon,#view-particulars-description").attr("disabled",true);
		//alert("Submit class has been changed to edit class");


		//Update Particular
		$.ajax({
			type: "POST",
			url: "../../controller/functionSchedule.php",
			data:{
				i_pid: $("#view-particulars-description").val(),
				i_bid: $("#viewParticular-checkout-modal").data("id"),
				function: "updateParticular"
			},
			success: function(data){
				console.log(data);
				alert(data);
				$("#viewParticular-checkout-modal").modal("hide");
				getRegisteredParticular();
				//getCheckoutBill(); //Refresh table content
			}
		});
	});

	$("#viewParticular-checkout-modal").on("change","#view-particulars-category",function(){
		viewParticularDescription();
	});

	$("#viewParticular-checkout-modal").on("change","#view-particulars-aircon",function(){
		viewParticularDescription();
	});

	$("#viewParticular-checkout-modal").on("change","#view-particulars-description",function(){
		getRate();
	});

	$("#viewParticular-checkout-modal").on('hidden.bs.modal', function () {
	    $(this).find('form').trigger('reset');
	    $("#view-particulars-category,#view-particulars-aircon,#view-particulars-description").attr("disabled",true);
	    $("#view-particulars-submit-btn").removeClass("submit").addClass("edit");
		$("#view-particulars-submit-btn").html("<i class='fa fa-edit'> Edit</i>");
	});

	/*************************************************************
	
							Add Amenity

	**************************************************************/

	$("#createBill-checkout-modal").on("click","#createBill-addAmenity",function(e){
		e.preventDefault();
		$("#createAmenity-checkout-modal").data("id",$("#createBill-checkout-modal").data("id"));
		$("#createAmenity-checkout-modal").modal("show");
	});

	$("#createAmenity-checkout-modal").on("keypress","#create-amenityPayment",function(e){
		if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
			event.preventDefault();
		}

		/*var regex = new RegExp("^[0-9]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}*/
	});

	$("#createAmenity-checkout-modal").on("click","#create-amenity-submit-btn",function(e){
		e.preventDefault();
		if($("#create-amenityDescription").val() == "" || $("#create-amenityPayment").val() == ""){
			//alert("Both are required");
			if($("#create-amenityDescription").val() == ""){
				$("#create-amenityDescription-msg").css("display","block");
			}
			else{
				$("#create-amenityDescription-msg").css("display","none");
			}
			if($("#create-amenityPayment").val() == ""){
				$("#create-amenityPayment-msg").css("display","block");
			}
			else{
				$("#create-amenityPayment-msg").css("display","none");
			}
		}
		else{
			$("#create-amenityDescription-msg,#create-amenityPayment-msg").css("display","none");
			$.ajax({
				type: "POST",
				url: "../../controller/functionSchedule.php",
				data:{
					i_fr_id: $("#createAmenity-checkout-modal").data("id"),
					description: $("#create-amenityDescription").val(),
					payment: $("#create-amenityPayment").val(),
					function: "createAmenity"
				},
				success: function(data){
					alert(data);
					$("#createAmenity-checkout-modal").modal("hide");
					getRegisteredAmenity();
					//getCheckoutBill();
				}
			});
		}
		//alert($("#createAmenity-checkout-modal").data("id"));
	});

	
	$("#createAmenity-checkout-modal").on('hidden.bs.modal', function () {
	    $(this).find('form').trigger('reset');
	    $("#create-amenityDescription-msg,#create-amenityPayment-msg").css("display","none");
	});
















	/***********************************************
						
						View & Edit Amenity
	
	************************************************/
	
	$("#createBill-checkout-modal").on("click","#createBill-viewAmenity",function(e){
		e.preventDefault();
		$("#viewAmenity-checkout-modal").data("id",$(this).data("id"));

		$.ajax({
			type: "POST",
			url: "../../controller/functionSchedule.php",
			data:{
				i_baid: $(this).data("id"),
				function: "viewAmenity"
			},
			success: function(data){
				data = jQuery.parseJSON(data);
				console.log(data);
				$("#view-amenityDescription").val(data.description);
				$("#view-amenityPayment").val(data.rate);
			}
		});
		$("#viewAmenity-checkout-modal").modal("show");
	});

	$("#viewAmenity-checkout-modal").on("click",".edit",function(e){
		e.preventDefault();
		$("#view-amenity-submit-btn").removeClass("edit").addClass("submit");
		$("#view-amenity-submit-btn").html("<i class='fa fa-save'> Submit</i>");
		$("#view-amenityDescription,#view-amenityPayment").attr("disabled",false);
		//alert($("#viewAmenity-checkout-modal").data("id"));
	});

	$("#viewAmenity-checkout-modal").on("keypress","#view-amenityPayment",function(e){
		if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
			event.preventDefault();
		}

		/*var regex = new RegExp("^[0-9]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}*/
	});

	// Update amenity
	$("#viewAmenity-checkout-modal").on("click",".submit",function(e){
		e.preventDefault();
		if($("#view-amenityDescription").val() == "" || $("#view-amenityPayment").val() == ""){
			//alert("Both are required");
			if($("#view-amenityDescription").val() == ""){
				$("#view-amenityDescription-msg").css("display","block");
			}
			else{
				$("#view-amenityDescription-msg").css("display","none");
			}
			if($("#view-amenityPayment").val() == ""){
				$("#view-amenityPayment-msg").css("display","block");
			}
			else{
				$("#view-amenityPayment-msg").css("display","none");
			}
		}
		else{
			$("#view-amenityDescription-msg,#view-amenityPayment-msg").css("display","none");
			$.ajax({
				type: "POST",
				url: "../../controller/functionSchedule.php",
				data: {
					i_baid: $("#viewAmenity-checkout-modal").data("id"),
					description: $("#view-amenityDescription").val(),
					payment: $("#view-amenityPayment").val(),
					function: "editAmenity"
				},
				success: function(data){
					alert(data);
					$("#viewAmenity-checkout-modal").modal("hide");
					$("#view-amenity-submit-btn").removeClass("submit").addClass("edit");
					$("#view-amenity-submit-btn").html("<i class='fa fa-edit'> Edit</i>");
					$("#view-amenityDescription,#view-amenityPayment").attr("disabled",true);
					getRegisteredAmenity();
					//getCheckoutBill();
				}
			});
		}
		
		
		//alert($("#viewAmenity-checkout-modal").data("id"));
	});

	$("#viewAmenity-checkout-modal").on('hidden.bs.modal', function () {
	    $(this).find('form').trigger('reset');
	    $("#view-amenity-submit-btn").removeClass("submit").addClass("edit");
		$("#view-amenity-submit-btn").html("<i class='fa fa-edit'> Edit</i>");
	    $("#view-amenityDescription,#view-amenityPayment").attr("disabled",true);
	    $("#view-amenityDescription-msg,#view-amenityPayment-msg").css("display","none");
	});








	/***************************************************************

							Delete Amenity

	****************************************************************/

	$("#createBill-checkout-modal").on("click","#createBill-deleteAmenity",function(e){
		e.preventDefault();
		var x = confirm("Are you sure you want to delete this?");
		if(x==true){
			$.ajax({
				type: "POST",
				url: "../../controller/functionSchedule.php",
				data:{
					i_baid: $(this).data("id"),
					function: "deleteAmenity"
				},
				success: function(data){
					alert(data);
					getRegisteredAmenity();
				}
			});
		}
		
	});


	/***************************************************************


							Print Bill

	****************************************************************/

	$("#createBill-checkout-modal").on("click","#createBill-print",function(e){
		e.preventDefault();
		//alert($("#createBill-checkout-modal").data("id"));
		window.open("print/printBill.php?i_fr_id=" + $("#createBill-checkout-modal").data("id") + "&hours=" + $("#createBill-totalHours").val(), "_blank"/*, "width=700,height=600"*/);
		//window.location.href = "print/printBill.php?i_fr_id=" + $("#createBill-checkout-modal").data("id");
	});




	/*****************************************************************


							Save Bill
		
	******************************************************************/

	$("#createBill-checkout-modal").on("click","#createBill-submit",function(e){
		e.preventDefault();
		alert("Successfully saved");
		$("#createBill-checkout-modal").modal("hide");
		/*var x = confirm("Are you sure you want to submit this form?");
		if(x==true){
			$.ajax({
				type: "POST",
				url: "../../controller/functionSchedule.php",
				data: {
					i_fr_id: $("#createBill-checkout-modal").data("id"),
					checkout_time: $("#createBill-checkout").data("time"),
					bill_status: $("#createBill-billingStatus").val(),
					ORNum: $("#createBill-ORNum").val(),
					hours: $("#createBill-totalHours").val(),
					function: "checkOut"
				},
				success: function(data){
					alert(data);
					//$("#createBill-checkout-modal").modal("hide");
					getCheckin(); //Update check-in table
				}
			});
		}*/
		
	});

	$('#createBill-checkout-modal').on('hidden.bs.modal', function () {
	    $(this).find('form').trigger('reset');
	    $("#collapse-OR").collapse("hide");
	});


	/********************
		
		Generate Bill

	********************/

	$("#tbodyCheckin").on("click","#checkout-checkin",function(e){
		e.preventDefault();
		//alert($(this).data("id"));
		$("#generateBill-checkout-modal").data("id",$(this).data("id"));
		$.ajax({
			type: "POST",
			url: "../../controller/functionSchedule.php",
			data:{
				i_fr_id: $(this).data("id"),
				function: "generateCheckoutBill"
			},
			success: function(data){
				data = jQuery.parseJSON(data);
				console.log(data);
				$("#generateBill-name").val(data.name);
				$("#generateBill-room").val(data.room);
				$("#generateBill-checkin").val(data.checkin);
				$("#generateBill-checkin").data("checkin",data.checkinData);
				$("#generateBill-checkout").val(data.checkout);
				$("#generateBill-checkout").data("checkout",data.checkoutData);
				$("#generateBill-totalHours").val(data.hours);
				$("#generateBill-particular").val(data.particularFee);
				$("#generateBill-amenity").val(data.amenityFee);
				$("#generateBill-total").val(data.totalFee);
				$("#generateBill-checkout-modal").modal("show");
			}
		});
		
	});

	$("#generateBill-checkout-modal").on("change","#generateBill-billStatus",function(e){
		if($(this).val()==0){
			$("#generateBill-ORNum").attr("disabled",true);
			//$("#collapse-generateBill-ORNum").collapse("hide");
		}
		else{
			$("#generateBill-ORNum").attr("disabled",false);
			//$("#collapse-generateBill-ORNum").collapse("show");
		}
	});

	$("#generateBill-checkout-modal").on("keypress","#generateBill-ORNum",function(e){
		//e.preventDefault();
		var regex = new RegExp("^[0-9]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#generateBill-checkout-modal").on("click","#generateBill-print",function(e){
		e.preventDefault();
		window.open("print/printBill.php?i_fr_id" + $("#generateBill-checkout-modal").data("id") + "&name=" + $("#generateBill-name").val() + "&room=" + $("#generateBill-room").val() + "&checkin=" + $("#generateBill-checkin").val() + "&checkout=" + $("#generateBill-checkout").val() + "&hours=" + $("#generateBill-totalHours").val() + "&particularFee=" + $("#generateBill-particular").val() + "&amenityFee=" + $("#generateBill-amenity").val() + "&totalFee=" + $("#generateBill-total").val(),"_blank","width=1200,height=500,location=no,left=80px");
	});

	$("#generateBill-checkout-modal").on("click","#generateBill-submit",function(e){
		e.preventDefault();
		//alert($("#generateBill-checkout").data("checkout"));
		if($("#generateBill-billStatus").val()==1 && $("#generateBill-ORNum").val() == ""){
			alert("Please fill the Official Receipt");
		}
		
		else{
			$.ajax({
				type: "POST",
				url: "../../controller/functionSchedule.php",
				data: {
					i_fr_id: $("#generateBill-checkout-modal").data("id"),
					checkout: $("#generateBill-checkout").data("checkout"),
					particularFee: $("#generateBill-particular").val(),
					/*billStatus: $("#generateBill-billStatus").val(),
					ORNum: $("#generateBill-ORNum").val(),*/
					function: "checkOut",
				},
				success: function(data){
					alert(data);
					getCheckin();
					$("#generateBill-checkout-modal").modal("hide");
				}
			});
		}
		
	});

	$("#generateBill-checkout-modal").on('hidden.bs.modal', function () {
	    $(this).find('form').trigger('reset');
	    $("#generateBill-ORNum").attr("disabled",true);
	});

	$("#tbodyCheckin").on("click","#delete-checkin",function(e){
		e.preventDefault();
		var x = confirm("Are you sure you want to delete this?");
		if(x == true){
			$.ajax({
				type: "POST",
				url: "../../controller/functionSchedule.php",
				data:{
					i_fr_id: $(this).data("id"),
					function: "deleteCheckin"
				},
				success: function(data){
					alert(data);
					console.log(data);
					getCheckin();
				}
			});
		}
		
	});



































	/*******************************************************************************

										Checkout tab

	*******************************************************************************/

	function getCheckedout(){
		$.ajax({
			type: "POST",
			url: "../../controller/functionSchedule.php",
			data:{
				category: $("#checkout-search-category").data("id"),
				search: $("#checkout-search-desc").val(),
				function: "getCheckedout"
			},
			success: function(data){
				$("#tbodyCheckout").html(data);
			}
		});
	}

	$("#v-pills-checkout-tab").click(function(){
		getCheckedout();
	});

	$("#checkout-searchBy-desc").click(function(){
		$("#checkout-search-category").data("id",1);
		$("#checkout-search-desc").attr("placeholder","Description");
	});

	$("#checkout-searchBy-name").click(function(){
		$("#checkout-search-category").data("id",2);
		$("#checkout-search-desc").attr("placeholder","Organizer");
	});

	$("#checkout-search-btn").click(function(e){
		e.preventDefault();
		getCheckedout();
		//alert($("#checkout-search-category").data("id"));
	});





	//View check-out info
	$("#tbodyCheckout").on("click","#viewCheckoutInfo",function(e){
		$("#vwCheckout-info-modal").data("id",$(this).data("id"));

		//Get rooms
		/*
		$.ajax({
			type: "POST",
			url: "../../controller/functionSchedule.php",
			data:{
				function: "getRoom"
			},
			success: function(data){
				$("#vw-checkout-Room").html(data);
			}
		});*/

		$.ajax({
			type: "POST",
			url: "../../controller/functionSchedule.php",
			data:{
				i_fr_id: $(this).data("id"),
				function: "viewCheckoutInfo"
			},
			success: function(data){
				data = jQuery.parseJSON(data);
				console.log(data);
				$("#vw-checkout-Agency").val(data.agency);
				$("#vw-checkout-Address").val(data.agencyAdd);
				$("#vw-checkout-Title").val(data.title);
				$("#vw-checkout-Participants").val(data.participants);
				//$("#vw-checkout-Room").val(data.room);
				/*$("#vw-checkin-Datestart").val("");
				$("#vw-checkin-Timestart").val("");
				$("#vw-checkin-Dateend").val("");
				$("#vw-checkin-Timeend").val("");*/
				$("#vw-checkout-Nature").val(data.nature);
				$("#vw-checkout-ReservedBy").val(data.requisitioner);
				$("#vw-checkout-ReservedByAddress").val(data.address);
				$("#vw-checkout-ReservedByMobile").val(data.contact);
				$("#vw-checkout-ReservedByEmail").val(data.email);
				$("#vwCheckout-info-modal").modal("show");
			}
		});
	});






	/************************

			Regular Expression

	*************************/
	
	$("#vwCheckout-info-modal").on("keypress","#vw-checkout-ReservedBy",function(e){
		var regex = new RegExp("^[a-zA-Z,. ]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#vwCheckout-info-modal").on("keypress","#vw-checkout-Participants",function(e){
		var regex = new RegExp("^[0-9]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#vwCheckout-info-modal").on("keypress","#vw-checkout-ReservedByMobile",function(e){
		/*var reg = /^[0-9]+$/;
		if(!reg.test($(this).val())){
			return false;
		}*/
		var regex = new RegExp("^[0-9]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#vwCheckout-info-modal").on("click",".edit",function(e){
		e.preventDefault();
		$("#vw-checkout-Agency,#vw-checkout-Address,#vw-checkout-Title,#vw-checkout-Participants,#vw-checkout-Nature,#vw-checkout-ReservedBy,#vw-checkout-ReservedByAddress,#vw-checkout-ReservedByMobile,#vw-checkout-ReservedByEmail").attr("disabled",false);
		$("#vw-checkout-edit-btn").removeClass("edit").addClass("submit");
		$("#vw-checkout-edit-btn").html("<i class='fa fa-save'></i> Submit")
	});

	$("#vwCheckout-info-modal").on("click",".submit",function(e){
		e.preventDefault();

		if($("#vw-checkout-Title").val() == "" || $("#vw-checkout-Participants").val() == "" || $("#vw-checkout-Nature").val() == "" || $("#vw-checkout-ReservedBy").val() == "" || $("#vw-checkout-ReservedByMobile").val() == ""){
			if($("#vw-checkout-Title").val() == ""){
				$("#vw-checkout-Title-msg").css("display","block");
			}
			else{
				$("#vw-checkout-Title-msg").css("display","none");
			}

			if($("#vw-checkout-Participants").val() == ""){
				$("#vw-checkout-Participants-msg").css("display","block");
			}
			else{
				$("#vw-checkout-Participants-msg").css("display","none");
			}

			/*
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
			*/

			if($("#vw-checkout-Nature").val() == ""){
				$("#vw-checkout-Nature-msg").css("display","block");
			}
			else{
				$("#vw-checkout-Nature-msg").css("display","none");
			}
			
			if($("#vw-checkout-ReservedBy").val() == ""){
				$("#vw-checkout-ReservedBy-msg").css("display","block");
			}
			else{
				$("#vw-checkout-ReservedBy-msg").css("display","none");
			}
			
			if($("#vw-checkout-ReservedByMobile").val() == ""){
				$("#vw-checkout-ReservedByMobile-msg").css("display","block");
			}
			else{
				$("#vw-checkout-ReservedByMobile-msg").css("display","none");
			}

		}
		else{
			//alert($("#vwCheckout-info-modal").data("id"));
			$("#vw-checkout-Title-msg,#vw-checkout-Participants-msg,#vw-checkout-Nature-msg,#vw-checkout-ReservedBy-msg,#vw-checkout-ReservedByMobile-msg").css("display","none");
			$.ajax({
				type: "POST",
				url: "../../controller/functionSchedule.php",
				data:{
					i_fr_id: $("#vwCheckout-info-modal").data("id"),
					agency: $("#vw-checkout-Agency").val(),
					agencyAdd: $("#vw-checkout-Address").val(),
					title: $("#vw-checkout-Title").val(),
					participants: $("#vw-checkout-Participants").val(),
					//room: $("#vw-checkout-Room").val(),
					nature: $("#vw-checkout-Nature").val(),
					requisitioner: $("#vw-checkout-ReservedBy").val(),
					address: $("#vw-checkout-ReservedByAddress").val(),
					contact: $("#vw-checkout-ReservedByMobile").val(),
					email: $("#vw-checkout-ReservedByEmail").val(),
					function: "updateCheckoutInfo"
				},
				success: function(data){
					alert(data);
					getCheckedout();
					$("#vw-checkout-Agency,#vw-checkout-Address,#vw-checkout-Title,#vw-checkout-Participants,#vw-checkout-Nature,#vw-checkout-ReservedBy,#vw-checkout-ReservedByAddress,#vw-checkout-ReservedByMobile,#vw-checkout-ReservedByEmail").attr("disabled",true);
					$("#vw-checkout-edit-btn").removeClass("submit").addClass("edit");
					$("#vw-checkout-edit-btn").html("<i class='fa fa-edit'></i> Edit");
				}
			});
			
		}
	});

	$('#vwCheckout-info-modal').on('hidden.bs.modal', function () {
	    $(this).find('form').trigger('reset');
	    $("#vw-checkout-Title-msg,#vw-checkout-Participants-msg,#vw-checkout-Nature-msg,#vw-checkout-ReservedBy-msg,#vw-checkout-ReservedByMobile-msg").css("display","none");
	    $("#vw-checkout-Agency,#vw-checkout-Address,#vw-checkout-Title,#vw-checkout-Participants,#vw-checkout-Nature,#vw-checkout-ReservedBy,#vw-checkout-ReservedByAddress,#vw-checkout-ReservedByMobile,#vw-checkout-ReservedByEmail").attr("disabled",true);
		$("#vw-checkout-edit-btn").removeClass("submit").addClass("edit");
		$("#vw-checkout-edit-btn").html("<i class='fa fa-edit'></i> Edit");
	});







	/*******************************

			View Checkout Bill

	********************************/

	/*
	function getCheckoutBill_view(){
		$.ajax({
			type: "POST",
			url: "../../controller/functionSchedule.php",
			data:{
				i_fr_id: $("#viewBill-checkout-modal").data("id"),
				hours: $("#viewBill-totalHours").val(),
				function: "getCheckoutBill_view",
			},
			success: function(data){
				data = jQuery.parseJSON(data);
				console.log(data);
				$("#viewBill-tbodyPaymentList").html(data.data);
				$("#viewBill-particulars-total-amount").val(data.totalAmount);
			}
		});
	}*/

	$("#tbodyCheckout").on("click","#viewCheckoutBill",function(e){
		//alert($(this).data("id"));
		$("#viewGenerateBill-checkout-modal").data("id",$(this).data("id"));
		$.ajax({
			type: "POST",
			url: "../../controller/functionSchedule.php",
			data:{
				i_fr_id: $(this).data("id"),
				function: "viewGenerateCheckoutBill"
			},
			success: function(data){
				data = jQuery.parseJSON(data);
				console.log(data);
				$("#viewBill-generateBill-name").val(data.name);
				$("#viewBill-generateBill-room").val(data.room);
				$("#viewBill-generateBill-checkin").val(data.checkin);
				$("#viewBill-generateBill-checkout").val(data.checkout);
				$("#viewBill-generateBill-totalHours").val(data.hours);
				$("#viewBill-generateBill-particular").val(data.particularFee);
				$("#viewBill-generateBill-amenity").val(data.amenityFee);
				$("#viewBill-generateBill-total").val(data.totalFee);
				$("#viewBill-generateBill-billStatus").val(data.billing_status);
				$("#viewBill-generateBill-ORNum").val(data.ORNum);
				$("#viewBill-generateBill-billStatus").val(data.billStatus);
				if(data.billStatus==1){
					$("#viewBill-generateBill-ORNum").val(data.ORNum);
					//$("#collapse-viewBill-generateBill-ORNum").collapse("show");
					//$("#viewBill-generateBill-ORNum").attr("disabled",false);
				}
				else{
					$("#viewBill-generateBill-ORNum").val("");
					//$("#viewBill-generateBill-ORNum").attr("disabled",true);
					//$("#collapse-viewBill-generateBill-ORNum").collapse("hide");
				}
				
				//getCheckoutBill_view();
				$("#viewGenerateBill-checkout-modal").modal("show");
				//$("#viewBill-checkout-modal").modal("show");
			}
		});
		
	});

	$("#viewGenerateBill-checkout-modal").on("click",".edit",function(e){
		e.preventDefault();
		$("#viewBill-generateBill-submit").removeClass("edit").addClass("submit");
		$("#viewBill-generateBill-submit").html("<i class='fa fa-save'></i> Save");
		$("#viewBill-generateBill-billStatus").attr("disabled",false);
		if($("#viewBill-generateBill-billStatus").val()==0){
			$("#viewBill-generateBill-ORNum").attr("disabled",true);
		}
		else{
			$("#viewBill-generateBill-ORNum").attr("disabled",false);
		}
	});

	$("#viewGenerateBill-checkout-modal").on("change","#viewBill-generateBill-billStatus",function(e){
		if($(this).val()=="0"){
			$("#viewBill-generateBill-ORNum").val("");
			$("#viewBill-generateBill-ORNum").attr("disabled",true);
		}
		else{
			$("#viewBill-generateBill-ORNum").attr("disabled",false);
		}
	});

	$("#viewGenerateBill-checkout-modal").on("keypress","#viewBill-generateBill-ORNum",function(e){
		var regex = new RegExp("^[0-9]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#viewGenerateBill-checkout-modal").on("click",".submit",function(e){
		e.preventDefault();
		//alert($("#viewGenerateBill-checkout-modal").data("id"));
		if($("#viewBill-generateBill-billStatus").val()==1 && $("#viewBill-generateBill-ORNum").val() == ""){
			alert("Please fill the Official Receipt");
		}
		
		else{
			$.ajax({
				type: "POST",
				url: "../../controller/functionSchedule.php",
				data: {
					i_fr_id: $("#viewGenerateBill-checkout-modal").data("id"),
					billStatus: $("#viewBill-generateBill-billStatus").val(),
					ORNum: $("#viewBill-generateBill-ORNum").val(),
					function: "updateGenerateCheckoutBill"
				},
				success: function(data){
					alert(data);
					$("#viewBill-generateBill-submit").removeClass("submit").addClass("edit");
					$("#viewBill-generateBill-submit").html("<i class='fa fa-edit'></i> Edit");
					$("#viewBill-generateBill-billStatus,#viewBill-generateBill-ORNum").attr("disabled",true);
				}
			});
		}
	});

	$('#viewGenerateBill-checkout-modal').on('hidden.bs.modal', function () {
		$(this).find('form').trigger('reset');
		$("#viewBill-generateBill-submit").removeClass("submit").addClass("edit");
		$("#viewBill-generateBill-submit").html("<i class='fa fa-edit'></i> Edit");
		$("#viewBill-generateBill-billStatus,#viewBill-generateBill-ORNum").attr("disabled",true);
	});

	$("#tbodyCheckout").on("click","#deleteCheckoutBill",function(e){
		e.preventDefault();
		var x = confirm("Are you sure you want to delete this?");
		if(x == true){
			$.ajax({
				type: "POST",
				url: "../../controller/functionSchedule.php",
				data:{
					i_fr_id: $(this).data("id"),
					function: "deleteCheckout"
				},
				success: function(data){
					alert(data);
					console.log(data);
					getCheckedout();
				}
			});
		}
	});

	/*$("#viewBill-checkout-modal").on("click",".edit",function(e){
		e.preventDefault();
		$("#viewBill-addAmenity,#viewBill-viewAmenity,#viewBill-deleteAmenity,#viewBill-viewParticular,#viewBill-billingStatus,#viewBill-ORNum").attr("disabled",false);
		$("#viewBill-submit").removeClass("edit").addClass("submit");
		$("#viewBill-submit").html("<i class='fa fa-save'></i> Submit");
	});

	$("#viewBill-checkout-modal").on("click",".submit",function(e){
		e.preventDefault();
		$.ajax({
			type: "POST",
			url: "../../controller/functionSchedule.php",
			data: {

			},
		});
		$("#viewBill-addAmenity,#viewBill-viewAmenity,#viewBill-deleteAmenity,#viewBill-viewParticular,#viewBill-billingStatus,#viewBill-ORNum").attr("disabled",true);
		$("#viewBill-submit").removeClass("submit").addClass("edit");
		$("#viewBill-submit").html("<i class='fa fa-edit'></i> Edit");
	});*/

	/*
	function viewParticularDescription_viewBill($i_pid=0){
		$.ajax({
			type: "POST",
			url: "../../controller/functionSchedule.php",
			data: {
				category: $("#viewBill-particulars-category").val(),
				aircon: $("#viewBill-particulars-aircon").val(),
				function: "viewParticularDescription"
			},
			success: function(data){
				console.log(data);
				$("#viewBill-particulars-description").html(data);
				if($i_pid!=0){
					$("#viewBill-particulars-description").val($i_pid);
				}
				
				getRate_viewBill();
			}
		});
	}*/

	/*
	function getRate_viewBill(){
		$.ajax({
			type: "POST",
			url: "../../controller/functionSchedule.php",
			data:{
				i_pid: $("#viewBill-particulars-description").val(),
				function: "getRate"
			},
			success: function(data){
				data = jQuery.parseJSON(data);
				console.log(data);
				$("#viewBill-particulars-firstHour").val(data.first_hour);
				$("#viewBill-particulars-succeedingHour").val(data.succeeding_hour);
				//getBill();
			}
		});
	}*/

	/*
	$("#viewBill-checkout-modal").on("click","#viewBill-viewParticular",function(e){
		e.preventDefault();
		$("#viewBill-viewParticular-checkout-modal").data("id",$(this).data("id")); // Bill id
		//viewParticularDescription();
		//alert("fr_id" + $("#createBill-checkout-modal").data("id") + " pid: " + $(this).data("id"));
		
		$.ajax({
			type: "POST",
			url: "../../controller/functionSchedule.php",
			data:{
				i_bid: $(this).data("id"),
				//i_fr_id: $("#createBill-checkout-modal").data("id"),
				function: "viewParticular"
			},
			success: function(data){
				data = jQuery.parseJSON(data);
				console.log(data);
				if(data.category=="VSU Personnel(First Floor)"){
					$("#viewBill-particulars-category").val("1");
					if(data.aircon=="Without Aircon"){
						$("#viewBill-particulars-aircon").val("0");
					}
					else{
						$("#viewBill-particulars-aircon").val("1");
					}
				}
				else if(data.category=="VSU Students(First Floor)"){
					$("#viewBill-particulars-category").val("2");
					if(data.aircon=="Without Aircon"){
						$("#viewBill-particulars-aircon").val("0");
					}
					else{
						$("#viewBill-particulars-aircon").val("1");
					}
				}

				else if(data.category=="Non VSU Employees and Students(First Floor)"){
					$("#viewBill-particulars-category").val("3");
					if(data.aircon=="Without Aircon"){
						$("#viewBill-particulars-aircon").val("0");
					}
					else{
						$("#viewBill-particulars-aircon").val("1");
					}
				}

				else if(data.category=="VSU Employees and Students(Second Floor)"){
					$("#viewBill-particulars-category").val("4");
					if(data.aircon=="Without Aircon"){
						$("#viewBill-particulars-aircon").val("0");
					}
					else{
						$("#viewBill-particulars-aircon").val("1");
					}
				}

				else if(data.category=="Non-VSU Employees(Second Floor)"){
					$("#viewBill-particulars-category").val("5");
					if(data.aircon=="Without Aircon"){
						$("#viewBill-particulars-aircon").val("0");
					}
					else{
						$("#viewBill-particulars-aircon").val("1");
					}
				}
				viewParticularDescription_viewBill(data.i_pid);
				$("#viewBill-viewParticular-checkout-modal").modal("show");
			}
		});
	});*/

	/******************************************************************
							
							View Particular

	*******************************************************************/

	/*
	$("#viewBill-viewParticular-checkout-modal").on("click",".edit",function(e){
		e.preventDefault();
		$("#viewBill-particulars-submit-btn").removeClass("edit").addClass("submit");
		$("#viewBill-particulars-submit-btn").html("<i class='fa fa-save'> Submit</i>");
		$("#viewBill-particulars-category,#viewBill-particulars-aircon,#viewBill-particulars-description").attr("disabled",false);
		//alert("Edit class has been changed to submit class");
	});

	$("#viewBill-viewParticular-checkout-modal").on("click",".submit",function(e){
		e.preventDefault();
		//alert($("#viewBill-viewParticular-checkout-modal").data("id"));
		$("#viewBill-particulars-submit-btn").removeClass("submit").addClass("edit");
		$("#viewBill-particulars-submit-btn").html("<i class='fa fa-edit'> Edit</i>");
		$("#viewBill-particulars-category,#viewBill-particulars-aircon,#viewBill-particulars-description").attr("disabled",true);
		//alert("Submit class has been changed to edit class");

		
		//Update Particular
		$.ajax({
			type: "POST",
			url: "../../controller/functionSchedule.php",
			data:{
				i_pid: $("#viewBill-particulars-description").val(),
				i_bid: $("#viewBill-viewParticular-checkout-modal").data("id"),
				function: "updateParticular"
			},
			success: function(data){
				console.log(data);
				alert(data);
				$("#viewBill-viewParticular-checkout-modal").modal("hide");
				getCheckoutBill_view(); //Refresh table content
			}
		});
	});*/

	/*
	$("#viewBill-viewParticular-checkout-modal").on("change","#viewBill-particulars-category",function(){
		viewParticularDescription_viewBill();
	});

	$("#viewBill-viewParticular-checkout-modal").on("change","#viewBill-particulars-aircon",function(){
		viewParticularDescription_viewBill();
	});

	$("#viewBill-viewParticular-checkout-modal").on("change","#viewBill-particulars-description",function(){
		getRate_viewBill();
	});

	$("#viewBill-viewParticular-checkout-modal").on('hidden.bs.modal', function () {
	    $(this).find('form').trigger('reset');
	    $("#viewBill-particulars-category,#viewBill-particulars-aircon,#viewBill-particulars-description").attr("disabled",true);
	    $("#viewBill-particulars-submit-btn").removeClass("submit").addClass("edit");
		$("#viewBill-particulars-submit-btn").html("<i class='fa fa-edit'> Edit</i>");
	});*/

	/*************************************************************
	
							Add Amenity

	**************************************************************/

	/*
	$("#viewBill-checkout-modal").on("click","#viewBill-addAmenity",function(e){
		e.preventDefault();
		$("#viewBill-createAmenity-checkout-modal").data("id",$("#viewBill-checkout-modal").data("id"));
		$("#viewBill-createAmenity-checkout-modal").modal("show");
	});

	$("#viewBill-createAmenity-checkout-modal").on("keypress","#viewBill-create-amenityPayment",function(e){
		var regex = new RegExp("^[0-9]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});
	*/

	/*
	$("#viewBill-createAmenity-checkout-modal").on("click","#viewBill-create-amenity-submit-btn",function(e){
		e.preventDefault();
		if($("#viewBill-create-amenityDescription").val() == "" || $("#viewBill-create-amenityPayment").val() == ""){
			//alert("Both are required");
			if($("#viewBill-create-amenityDescription").val() == ""){
				$("#viewBill-create-amenityDescription-msg").css("display","block");
			}
			else{
				$("#viewBill-create-amenityDescription-msg").css("display","none");
			}
			if($("#viewBill-create-amenityPayment").val() == ""){
				$("#viewBill-create-amenityPayment-msg").css("display","block");
			}
			else{
				$("#viewBill-create-amenityPayment-msg").css("display","none");
			}
		}
		else{
			$("#viewBill-create-amenityDescription-msg,#viewBill-create-amenityPayment-msg").css("display","none");
			$.ajax({
				type: "POST",
				url: "../../controller/functionSchedule.php",
				data:{
					i_fr_id: $("#viewBill-createAmenity-checkout-modal").data("id"),
					description: $("#viewBill-create-amenityDescription").val(),
					payment: $("#viewBill-create-amenityPayment").val(),
					function: "createAmenity"
				},
				success: function(data){
					alert(data);
					$("#viewBill-createAmenity-checkout-modal").modal("hide");
					//getCheckoutBill();
					getCheckoutBill_view();
				}
			});
		}
		//alert($("#createAmenity-checkout-modal").data("id"));
	});
	*/

	/*
	$("#viewBill-createAmenity-checkout-modal").on('hidden.bs.modal', function () {
	    $(this).find('form').trigger('reset');
	    $("#viewBill-create-amenityDescription-msg,#viewBill-create-amenityPayment-msg").css("display","none");
	});
	*/

	/*
	$("#viewBill-checkout-modal").on("click","#viewBill-viewAmenity",function(e){
		e.preventDefault();
		//alert($(this).data("id"));
		$("#viewBill-viewAmenity-checkout-modal").data("id",$(this).data("id"));

		$.ajax({
			type: "POST",
			url: "../../controller/functionSchedule.php",
			data:{
				i_baid: $(this).data("id"),
				function: "viewAmenity"
			},
			success: function(data){
				data = jQuery.parseJSON(data);
				console.log(data);
				$("#viewBill-view-amenityDescription").val(data.description);
				$("#viewBill-view-amenityPayment").val(data.rate);
			}
		});
		$("#viewBill-viewAmenity-checkout-modal").modal("show");
	});
	*/
	/*
	$("#viewBill-viewAmenity-checkout-modal").on("click",".edit",function(e){
		e.preventDefault();
		$("#viewBill-view-amenity-submit-btn").removeClass("edit").addClass("submit");
		$("#viewBill-view-amenity-submit-btn").html("<i class='fa fa-save'> Submit</i>");
		$("#viewBill-view-amenityDescription,#viewBill-view-amenityPayment").attr("disabled",false);
		//alert($("#viewAmenity-checkout-modal").data("id"));
	});
	*/

	/*
	$("#viewBill-viewAmenity-checkout-modal").on("keypress","#viewBill-view-amenityPayment",function(e){
		var regex = new RegExp("^[0-9]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});
	*/
	
	/*
	// Update amenity
	$("#viewBill-viewAmenity-checkout-modal").on("click",".submit",function(e){
		e.preventDefault();
		if($("#viewBill-view-amenityDescription").val() == "" || $("#viewBill-view-amenityPayment").val() == ""){
			//alert("Both are required");
			if($("#viewBill-view-amenityDescription").val() == ""){
				$("#viewBill-view-amenityDescription-msg").css("display","block");
			}
			else{
				$("#viewBill-view-amenityDescription-msg").css("display","none");
			}
			if($("#viewBill-view-amenityPayment").val() == ""){
				$("#viewBill-view-amenityPayment-msg").css("display","block");
			}
			else{
				$("#viewBill-view-amenityPayment-msg").css("display","none");
			}
		}
		else{
			$("#viewBill-view-amenityDescription-msg,#viewBill-view-amenityPayment-msg").css("display","none");
			$.ajax({
				type: "POST",
				url: "../../controller/functionSchedule.php",
				data: {
					i_baid: $("#viewBill-viewAmenity-checkout-modal").data("id"),
					description: $("#viewBill-view-amenityDescription").val(),
					payment: $("#viewBill-view-amenityPayment").val(),
					function: "editAmenity"
				},
				success: function(data){
					alert(data);
					$("#viewBill-viewAmenity-checkout-modal").modal("hide");
					$("#viewBill-view-amenity-submit-btn").removeClass("submit").addClass("edit");
					$("#viewBill-view-amenity-submit-btn").html("<i class='fa fa-edit'> Edit</i>");
					$("#viewBill-view-amenityDescription,#viewBill-view-amenityPayment").attr("disabled",true);
					getCheckoutBill_view();
				}
			});
		}
		
		
		//alert($("#viewAmenity-checkout-modal").data("id"));
	});*/

	/*
	$("#viewBill-viewAmenity-checkout-modal").on('hidden.bs.modal', function () {
	    $(this).find('form').trigger('reset');
	    $("#viewBill-view-amenity-submit-btn").removeClass("submit").addClass("edit");
		$("#viewBill-view-amenity-submit-btn").html("<i class='fa fa-edit'> Edit</i>");
	    $("#viewBill-view-amenityDescription,#viewBill-view-amenityPayment").attr("disabled",true);
	    $("#viewBill-view-amenityDescription-msg,#viewBill-view-amenityPayment-msg").css("display","none");
	});
	*/

	/*
	$("#viewBill-checkout-modal").on("click","#viewBill-deleteAmenity",function(e){
		e.preventDefault();
		var x = confirm("Are you sure you want to delete this?");
		if(x==true){
			$.ajax({
				type: "POST",
				url: "../../controller/functionSchedule.php",
				data:{
					i_baid: $(this).data("id"),
					function: "deleteAmenity"
				},
				success: function(data){
					alert(data);
					getCheckoutBill_view();
				}
			});
		}
		//alert($(this).data("id"));
	});*/
	/*
	$("#viewBill-checkout-modal").on("click","#viewBill-print",function(e){
		e.preventDefault();
		window.open("print/printBill.php?i_fr_id=" + $("#viewBill-checkout-modal").data("id") + "&hours=" + $("#viewBill-totalHours").val(), "_blank"/*, "width=700,height=600");

	});
	*/


});