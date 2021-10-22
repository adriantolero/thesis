 $(document).ready(function () {

    var dateToday = new Date();
    
    $("#create-date-start").datetimepicker({
		//datepicker: false,
		timepicker: false,
		format: "Y-m-d",
		onShow: function(ct){
			this.setOptions({
				maxDate:jQuery("#create-date-end").val()?jQuery("#create-date-end").val():false
			})
		}
	});

	$("#view-date-start").datetimepicker({
		//datepicker: false,
		timepicker: false,
		format: "Y-m-d",
		onShow: function(ct){
			this.setOptions({
				maxDate:jQuery("#view-date-end").val()?jQuery("#view-date-end").val():false
			})
		}
	});

	$("#create-time-start,#view-time-start").datetimepicker({
		format: "H:i",
		formatTime: "h:ia",
		defaultTime: "08:00",
		datepicker: false
	});

	$("#create-date-end").datetimepicker({
		timepicker: false,
		format: "Y-m-d",
		onShow: function(ct){
			this.setOptions({
				minDate:jQuery("#create-date-start").val()?jQuery("#create-date-start").val():false
			})
		}
	});

	$("#view-date-end").datetimepicker({
		timepicker: false,
		format: "Y-m-d",
		onShow: function(ct){
			this.setOptions({
				minDate:jQuery("#view-date-start").val()?jQuery("#view-date-start").val():false
			})
		}
	});

	$("#create-time-end,#view-time-end").datetimepicker({
		format: "H:i",
		formatTime: "h:ia",
		defaultTime: "08:00",
		datepicker: false
	});
	

	/**********************************
				DISPLAY SCHEDULE
	**********************************/
	function getReviewSched(){
		$.ajax({
			type: "POST",
			url: "../../controller/schedule.php",
			data: {reviewSchedule: "display"},
			success: function(data){
				//console.log(data);
				$("#dataSchedule").html(data);
			}
		});
	}

	getReviewSched();
	/**********************************
				SEARCH SCHEDULE
	**********************************/

	$("#searchBy-description").click(function(e){
		e.preventDefault();
		$("#searchCategory").data("id","1");
		$("#searchInput").attr("placeholder","Description");
	});

	$("#searchBy-room").click(function(e){
		e.preventDefault();
		$("#searchCategory").data("id","2");
		$("#searchInput").attr("placeholder","Room");
	});

	$("#searchBy-year").click(function(e){
		e.preventDefault();
		$("#searchCategory").data("id","3");
		$("#searchInput").attr("placeholder","Year");
	});

	function searchReview(){
		$.ajax({
			type: "POST",
			url: "../../controller/schedule.php",
			data:{
				search: $("#searchInput").val(),
				/*room: $("#roomOption").val(),
				//sort: $("#sortSchedule").val(),
				date: $("#searchDate").val(),*/
				category: $("#searchCategory").data("id"),
				searchReview: "search"
			},
			success: function(data){
				//console.log(data);
				$("#dataSchedule").html(data);
			}
		});
	}

	$("#searchBtn").click(function(e){
		e.preventDefault();
		searchReview();
	});

	/*
	$("#searchInput").on("input",function(){
		searchReview();
	});

	$("#roomOption").on("change",function(){
		searchReview();
	});

	$("#searchDate").on("input",function(){
		searchReview();
	});
	$("#searchDate").on("change",function(){
		searchReview();
	});
	*/
	/**************************
			Create Review
	***************************/

	/*
	$("#create-description,#create-reviewee").keypress(function(e){
		var regex = new RegExp("^[a-zA-Z ]+$");
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);

        if (regex.test(str)) {
            return true;
        }
        else
        {
	        return false;
        }
	});

	$("#create-num-reviewers").keypress(function(e){
		var regex = new RegExp("^[0-9]+$");
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);

        if (regex.test(str)){
            return true;
        }
        else{
	        return false;
        }
	});

	$("#create-reviewFee-vsu").keypress(function(e){
		var regex = new RegExp("[1-9]+(\.[0-9][0-9]?)?");
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);

        if (regex.test(str)){
            return true;
        }
        else{
	        return false;
        }
	});
	*/

	$("#addReview-modal").on("keypress","#create-reviewee",function(e){
		var regex = new RegExp("^[A-Za-z,. ]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#addReview-modal").on("keypress","#create-num-reviewers",function(e){
		var regex = new RegExp("^[0-9]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#addReview-modal").on("keypress","#create-date-start",function(e){
		if(e.keyCode !== 8) {
	        e.preventDefault();
	    }
	});

	$("#addReview-modal").on("keypress","#create-time-start",function(e){
		if(e.keyCode !== 8) {
	        e.preventDefault();
	    }
	});

	$("#addReview-modal").on("keypress","#create-date-end",function(e){
		if(e.keyCode !== 8) {
	        e.preventDefault();
	    }
	});

	$("#addReview-modal").on("keypress","#create-time-end",function(e){
		if(e.keyCode !== 8) {
	        e.preventDefault();
	    }
	});

	$("#addReview-modal").on("keypress","#create-reviewFee-vsu",function(e){
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

	$("#addReview-modal").on("keypress","#create-reviewFee-nonVsu",function(e){
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

	$("#createReviewSched").click(function(event){
		
		event.preventDefault();
		
		if($("#create-room").val() == 0 || $("#create-description").val() == "" || $("#create-reviewee").val() == "" || $("#create-date-start").val() == "" || $("#create-time-start").val() == "" || $("#create-date-end").val() == "" || $("#create-time-end").val() == ""  || $("#create-reviewFee-vsu").val() == "" || $("#create-reviewFee-nonVsu").val() == "" || $("#create-num-reviewers").val() == ""){

			if($("#create-room").val() == 0){
				$("#create-room-msg").css("display","block");
			}
			else{
				$("#create-room-msg").css("display","none");
			}

			if($("#create-description").val()==""){
				$("#create-description-msg").css("display","block");
			}
			else{
				$("#create-description-msg").css("display","none");
			}

			if($("#create-reviewee").val() == ""){
				$("#create-reviewee-msg").css("display","block");
			}
			else{
				$("#create-reviewee-msg").css("display","none");
			}

			if($("#create-date-start").val() == ""){
				$("#create-date-start-msg").css("display","block");
			} 
			else{
				$("#create-date-start-msg").css("display","none");
			}

			if($("#create-time-start").val() == ""){
				$("#create-time-start-msg").css("display","block");
			}
			else{
				$("#create-time-start-msg").css("display","none");
			}

			if($("#create-date-end").val() == "" ){
				$("#create-date-end-msg").css("display","block");
			}
			else{
				$("#create-date-end-msg").css("display","none");
			}

			if($("#create-time-end").val() == ""){
				$("#create-time-end-msg").css("display","block");
			}
			else{
				$("#create-time-end-msg").css("display","none");
			}

			if($("#create-reviewFee-vsu").val() == ""){
				$("#create-reviewFee-vsu-msg").css("display","block");
			}
			else{
				$("#create-reviewFee-vsu-msg").css("display","none");
			}

			if($("#create-reviewFee-nonVsu").val() == ""){
				$("#create-reviewFee-nonVsu-msg").css("display","block");
			} 
			else{
				$("#create-reviewFee-nonVsu-msg").css("display","none");
			}

			if($("#create-num-reviewers").val() == ""){
				$("#create-num-reviewers-msg").css("display","block");	
			}
			else{
				$("#create-num-reviewers-msg").css("display","none");	
			}
	
		}

		else{
			$("#create-description-msg,#create-reviewee-msg,#create-num-reviewers-msg,#create-room-msg,#create-date-start-msg,#create-time-start-msg,#create-date-end-msg,#create-time-end-msg,#create-reviewFee-vsu-msg,#create-reviewFee-nonVsu-msg,#create-status-msg").css("display","none");
			$.ajax({
				type: "POST",
				url: "../../controller/schedule.php",
				data: {
					room_id: $("#create-room").val(),
					description: $("#create-description").val(),
					reviewee: $("#create-reviewee").val(),
					date_start: $("#create-date-start").val(),
					time_start: $("#create-time-start").val(),
					date_end: $("#create-date-end").val(),
					time_end: $("#create-time-end").val(),
					review_fee_vsu: $("#create-reviewFee-vsu").val(),
					review_fee_non_vsu: $("#create-reviewFee-nonVsu").val(),
					reviewers: $("#create-num-reviewers").val(),
					status: $("#create-status").val(),
					createReviewSched: "create"
				},
				success: function(data){
					alert(data);
					
					if(data == "Successfully created."){
						getReviewSched();
						$("#addReview-modal").modal("hide");
					}
					//fillreservedRevSched();
				},
				error: function(data){
					console.log(data);
				}
			});
		}
		
	});

	//Clear all forms when closing the modal
	$('#addReview-modal').on('hidden.bs.modal', function () {
	    $(this).find('form').trigger('reset');
	    $("#create-description-msg,#create-reviewee-msg,#create-num-reviewers-msg,#create-room-msg,#create-date-start-msg,#create-time-start-msg,#create-date-end-msg,#create-time-end-msg,#create-reviewFee-vsu-msg,#create-reviewFee-nonVsu-msg,#create-status-msg").css("display","none");
	});
	

	//END SEARCH SCHEDULE

	/************************
		View Review Sched
	*************************/
	// View schedule details
	$("#tableSchedule").on("click","#viewSched-btn",function(){
		//alert($(this).data("id"));
		$.ajax({
			type: "POST",
			url: "../../controller/schedule.php",
			data: {
				viewReview : "view",
				rev_id : $(this).data("id")
			},
			success: function(data){
				//console.log(data);
				var data = jQuery.parseJSON(data);
				$("#manageReviewSched-btn").data("rev_id",data.id);
				$("#view-room").val(data.room_id);
				$("#view-description").val(data.description);
				$("#view-reviewee").val(data.reviewee);
				$("#view-date-start").val(data.date_start);
				$("#view-time-start").val(data.time_start);
				$("#view-date-end").val(data.date_end);
				$("#view-time-end").val(data.time_end);
				$("#view-reviewFee-vsu").val(data.reviewFee_vsu);
				$("#view-reviewFee-nonVsu").val(data.reviewFee_non_vsu);
				$("#view-status").val(data.status);
				$("#view-num-reviewers").val(data.reviewers);
			}
			
		});
	});

	$("#open-addReview-modal").click(function(){
		//$("#searchInput").prop("disabled", false);
	});

	$("#viewReview-modal").on("click",".edit",function(){
		//alert("Edit button clicked!!");
		$("#view-room,#view-description,#view-reviewee,#view-num-reviewers,#view-date-start,#view-time-start,#view-date-end,#view-time-end,#view-reviewFee-vsu,#view-reviewFee-nonVsu,#view-status").prop("disabled", false);
		$("#manageReviewSched-btn").removeClass("edit").addClass("submit");
		$("#manageReviewSched-btn").html("<i class='fa fa-save'></i> Update");
	});

	$("#viewReview-modal").on("keypress","#view-reviewee",function(e){
		var regex = new RegExp("^[A-Za-z,. ]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#viewReview-modal").on("keypress","#view-date-start",function(e){
		if(e.keyCode !== 8) {
	        e.preventDefault();
	    }
	});

	$("#viewReview-modal").on("keypress","#view-time-start",function(e){
		if(e.keyCode !== 8) {
	        e.preventDefault();
	    }
	});

	$("#viewReview-modal").on("keypress","#view-date-end",function(e){
		if(e.keyCode !== 8) {
	        e.preventDefault();
	    }
	});

	$("#viewReview-modal").on("keypress","#view-time-end",function(e){
		if(e.keyCode !== 8) {
	        e.preventDefault();
	    }
	});

	$("#viewReview-modal").on("keypress","#view-num-reviewers",function(e){
		var regex = new RegExp("^[0-9]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#viewReview-modal").on("keypress","#view-reviewFee-vsu",function(e){
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

	$("#viewReview-modal").on("keypress","#view-reviewFee-nonVsu",function(e){
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

	$("#viewReview-modal").on("click",".submit",function(){
		event.preventDefault();
		if($("#view-room").val() == 0 || $("#view-description").val() == "" || $("#view-reviewee").val() == "" || $("#view-date-start").val() == "" || $("#view-time-start").val() == "" || $("#view-date-end").val() == "" || $("#view-time-end").val() == "" || $("#view-reviewFee-vsu").val() == "" || $("#view-reviewFee-nonVsu").val() == "" || $("#view-num-reviewers").val() == ""){

			if($("#view-room").val() == 0){
				$("#view-room-msg").css("display","block");
			}
			else{
				$("#view-room-msg").css("display","none");
			}

			if($("#view-description").val()==""){
				$("#view-description-msg").css("display","block");
			}
			else{
				$("#view-description-msg").css("display","none");
			}

			if($("#view-reviewee").val() == ""){
				$("#view-reviewee-msg").css("display","block");
			}
			else{
				$("#view-reviewee-msg").css("display","none");
			}

			if($("#view-date-start").val() == ""){
				$("#view-date-start-msg").css("display","block");
			} 
			else{
				$("#view-date-start-msg").css("display","none");
			}

			if($("#view-time-start").val() == ""){
				$("#view-time-start-msg").css("display","block");
			}
			else{
				$("#view-time-start-msg").css("display","none");
			}

			if($("#view-date-end").val() == "" ){
				$("#view-date-end-msg").css("display","block");
			}
			else{
				$("#view-date-end-msg").css("display","none");
			}

			if($("#view-time-end").val() == ""){
				$("#view-time-end-msg").css("display","block");
			}
			else{
				$("#view-time-end-msg").css("display","none");
			}

			if($("#view-reviewFee-vsu").val() == ""){
				$("#view-reviewFee-vsu-msg").css("display","block");
			}
			else{
				$("#view-reviewFee-vsu-msg").css("display","none");
			}

			if($("#view-reviewFee-nonVsu").val() == ""){
				$("#view-reviewFee-nonVsu-msg").css("display","block");
			} 
			else{
				$("#view-reviewFee-nonVsu-msg").css("display","none");
			}

			if($("#view-num-reviewers").val() == ""){
				$("#view-num-reviewers-msg").css("display","block");	
			}
			else{
				$("#view-num-reviewers-msg").css("display","none");	
			}
	
		}

		else{
			$("#view-description-msg,#view-reviewee-msg,#view-num-reviewers-msg,#view-room-msg,#view-date-start-msg,#view-time-start-msg,#view-date-end-msg,#view-time-end-msg,#view-reviewFee-vsu-msg,#view-reviewFee-nonVsu-msg,#view-status-msg").css("display","none");
			$.ajax({
				type: "POST",
				url: "../../controller/schedule.php",
				data: {
					review_id: $(this).data("rev_id"),
					room_id: $("#view-room").val(),
					description: $("#view-description").val(),
					reviewee: $("#view-reviewee").val(),
					date_start: $("#view-date-start").val(),
					time_start: $("#view-time-start").val(),
					date_end: $("#view-date-end").val(),
					time_end: $("#view-time-end").val(),
					review_fee_vsu: $("#view-reviewFee-vsu").val(),
					review_fee_non_vsu: $("#view-reviewFee-nonVsu").val(),
					reviewers: $("#view-num-reviewers").val(),
					status: $("#view-status").val(),
					manageReviewSched_btn: "update"
				},
				success: function(data){
					//console.log(data);
					alert(data);
					if(data == "Successfully updated."){
						getReviewSched();
						$("#view-room,#view-description,#view-reviewee,#view-num-reviewers,#view-date-start,#view-time-start,#view-date-end,#view-time-end,#view-reviewFee-vsu,#view-reviewFee-nonVsu,#view-status").prop("disabled", true);
						$("#manageReviewSched-btn").removeClass("submit").addClass("edit");
						$("#manageReviewSched-btn").html("<i class='fa fa-edit'></i> Edit");
					}
					
					//fillreservedRevSched();
				},
				error: function(data){
					//console.log(data);
					alert(data);
				}
			});
		}
	});

	$("#viewReview-modal").on("click",".close",function(){
		$("#view-room,#view-description,#view-reviewee,#view-num-reviewers,#view-date-start,#view-time-start,#view-date-end,#view-time-end,#view-reviewFee-vsu,#view-reviewFee-nonVsu,#view-status").prop("disabled", true);
		$("#manageReviewSched-btn").removeClass("submit").addClass("edit");
		$("#manageReviewSched-btn").html("<i class='fa fa-edit'></i> Edit");
	});


	$("#tableSchedule").on("click","#deleteSched-btn",function(){
		var x = confirm("Are you sure you want to delete this Review?");
		if(x==true){
			$.ajax({
			type: "POST",
			url: "../../controller/schedule.php",
			data:{
				sched_id: $(this).data("id"),
				deleteSched_btn: "delete"
			},
			success: function(data){
				alert(data);
				getReviewSched();
				//fillreservedRevSched();
			}
		});
		}	
	});

	$("#btn-add-reviewSched").click(function(){
		/*var c = confirm("You want to view this?");
		if(c == false) return false;*/
	});

 });