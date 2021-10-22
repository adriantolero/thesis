$(document).ready(function(){

	/************************************************************
							Reserved Reviewers
	*************************************************************/

	$("#v-pills-review-sched-tab").click(function(){
		$("#approved-wrapper").css("display","none");
	});

	function getReservationScheds(){


		$.ajax({
			type: "POST",
			url: "../../controller/review_reservations.php",
			data:{
				getReservation: "fillReservationScheds"
			},
			success: function(data){
				$("#reservedRevSched").html(data);
			}
		});
	}

	getReservationScheds();

	$("#reservedRevSched").on("change",function(){
		if($("#reservedRevSched").val()==""){
			alert("Please select a review.");
			$("#approved-wrapper").css("display","none");
		}
		else{
			$.ajax({
				type: "POST",
				url: "../../controller/review_reservations.php",
				data:{
					review_id: $(this).val(),
					getApproved: "get"
				},
				success: function(data){
					//console.log(data);
					//data = jQuery.parseJSON(data);
					$("#approved-wrapper").data("id",$("#reservedRevSched").val());
					$("#searchApproved").prop("disabled", false);
					updateSlotremaining();
					/*$("#review-title").html(data.title);
					$("#slots-remaining").html(data.num_stud);
					$("#approved-data").html(data.data);*/
					$("#approved-data").html(data);
					$("#approved-wrapper").css("display","block");
				},
				error: function(data){

				}
			});
		}
		
	});

	/*$("#reserved_search_sched").keypress(function(e){
		var regex = new RegExp("^[0-9]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});*/

	function fillreservedRevSched(){
		$.ajax({
			type: "POST",
			url: "../../controller/review_reservations.php",
			data: {
				fill_reserved_search_sched: "autofill",
				value: $("#reserved_search_sched").val(),
			},
			success: function(data){
				$("#reservedRevSched").html(data);
			},
			error: function(data){

			}
		});
	}

	

	function fillApproved(){
		if($("#reservedRevSched").val()!=null){
			
		}
		$.ajax({
			type: "POST",
			url: "../../controller/review_reservations.php",
			data:{
				search: $("#searchApproved").val(),
				searchBy: $("#searchApprovedBy").val(),
				review_id: $("#approved-wrapper").data("id"),
				searchApproved: "search"
				/*searchBy: $("#searchApproved-by").val()*/
			},
			success: function(data){
				//console.log(data);
				$("#approved-data").html(data);	
			},
			error: function(data){
				console.log(data);
			}
		});
	}

	fillApproved();

	/*$("#table-approved").on("click","#rem_appr_reviewer",function(){
		alert($(this).data("id"));
	});
	*/

	$("#reserved_search_sched-btn").on("click",function(){
		$.ajax({
			type: "POST",
			url: "../../controller/review_reservations.php",
			data:{
				search: $("#reserved_search_sched").val(),
				reserved_search_sched: "search",
			},
			success: function(data){
				$("#reservedRevSched").html(data);
				console.log(data);
			},
			error: function(data){
				console.log(data);
			}
		});
	});

	$("#searchApprovedBy").on("change",function(){
		if($("#searchApprovedBy").val()==1) {
			$("#searchApproved").attr("placeholder","Last Name");
		}
		else{
			$("#searchApproved").attr("placeholder","First Name");
		}
	});

	$("#searchApproved-btn").on("click",function(e){
		//alert($("#approved-wrapper").data("id"));
		e.preventDefault();
		fillApproved();
		/*$.ajax({
			type: "POST",
			url: "../../../controller/schedule.php",
			data:{
				search: $(this).val(),
				review_id: $("#reservedRevSched").val(),
				searchApproved: "search"
			},
			success: function(data){
				console.log(data);
				$("#approved-data").html(data);	
			},
			error: function(data){
				console.log(data);
			}
		});*/
	});

	function updateSlotremaining(){
		$.ajax({
			type: "POST",
			url: "../../controller/review_reservations.php",
			data:{
				updateSlot: "update",
				i_rid: $("#approved-wrapper").data("id"),
			},
			success: function(data){
				data = jQuery.parseJSON(data);
				$("#review-title").html(data.title);
				$("#slots-remaining").html(data.slot);
				//alert("Review: " + data.title + " Slot remaining: " + data.slot);
			}
		});
	}

	//Delete Expired Request
	$("#vw-requests-modal").on("click","#del_appr_reviewer",function(){
		var x = confirm("Are you sure you want to delete this reviewer?");
		if(x==true){
			$.ajax({
				type: "POST",
				url: "../../controller/review_reservations.php",
				data:{
					i_rev_id: $(this).data("id"),
					delete_reviewer: "delete"
				},
				success: function(data){
					alert(data);
					viewRequests("");
				}
			});
		}
		
	});
	










	/*********************************************************

				Add Reviewer(Goes directly to the approved)
		
	*********************************************************/

	function getSchool(sid){
		$.ajax({
			type: "POST",
			url: "../../controller/review_reservations.php",
			data: {
				getSchool: "getSchool",
			},
			success: function(data){
				$("#school").html(data);
				//$("#school").val(sid);
			},
			error: function(data){
				console.log(data);
			}
		});
	}

	function getCourse(){
		$.ajax({
			type: "POST",
			url: "../../controller/review_reservations.php",
			data: {
				create_requests: "getCourse"
			},
			success: function(data){
				$("#course").html(data);
			},
			error: function(data){
				console.log(data);
			}
		});
	}

	function getMajor(){
		$.ajax({
			type: "POST",
			url: "../../controller/review_reservations.php",
			data: {
				create_requests: "getMajor",
				course_id: $("#course").val()
			},
			success: function(data){
				$("#major").html(data);
			},
			error: function(data){
				console.log(data);
			}
		});
	}

	//Fills School & Course
	$("#create_requests").click(function(){
		getSchool();
		getCourse();
		$("#addReviewer-modal").data("id",$("#approved-wrapper").data("id"));
	});

	$("#course").on("change",function(){
		
		if($("#course").val()==0){
			$("#major").html("<option value=''></option>");
		}
		else{
			getMajor();
			//$('#vw-collapseMajor').collapse('show');
		}
		/*if($("#course").val()==0){
			$('#collapseMajor').collapse('hide');
		}
		else{
			getMajor();
			$('#collapseMajor').collapse('show');
		}*/
	});

	$("#close-addReviewer-modal").click(function(){
		$("#collapseMajor").collapse("hide");
	});

	$("#addSchool-modal").on("click","#addSchool-btn",function(){
		if($("#addSchool").val() == "" || $("#addSchoolAddress").val() == ""){
			if($("#addSchool").val() == ""){
				$("#addSchool-msg").html(" * School is required.");
				$("#addSchool-msg").css("display","block");
			}
			else{
				$("#addSchool-msg").css("display","none");
			}

			if($("#addSchoolAddress").val() == ""){
				$("#addSchoolAddress-msg").html(" * School address is required.");
				$("#addSchoolAddress-msg").css("display","block");
			}
			else{
				$("#addSchoolAddress-msg").css("display","block");
			}
		}
		else{
			$("#addSchool-msg,#addSchoolAddress-msg").css("display","none");
			$.ajax({
				type: "POST",
				url: "../../controller/review_reservations.php",
				data: {
					school: $("#addSchool").val(),
					address: $("#addSchoolAddress").val(),
					schoolType: $("#addSchoolType").val(),
					addSchool: "create"
				},
				success: function(data){
					alert("New school created.");
					getSchool();
					$("#addSchool-modal").modal("hide");
					//$("#school").val(data);
				},
				error: function(data){
					console.log(data);
				}
			});
		}
		
	});

	$('#addSchool-modal').on('hidden.bs.modal', function () {
	    $(this).find('form').trigger('reset');
	    $("#addSchool-msg,#addSchoolAddress-msg").css("display","none");
	});

	$("#addCourse-modal").on("click","#addCourse-btn",function(e){
		e.preventDefault();
		if($("#addCourse").val() == ""){
			if($("#addCourse").val() == ""){
				$("#addCourse-msg").html(" * Course is required");
				$("#addCourse-msg").css("display","block");
			}
			else{
				$("#addCourse-msg").css("display","none");
			}
		}
		else{
			$("#addCourse-msg").css("display","none");
			$.ajax({
				type: "POST",
				url: "../../controller/review_reservations.php",
				data: {
					course: $("#addCourse").val(),
					//major: $("#addMajor1").val(),
					addCourse: "create"
				},
				success: function(data){
					getCourse();
					$("#major").html("<option value=''></option>");
					alert(data);
					$("#addCourse-modal").modal("hide");
				},
				error: function(data){
					console.log(data);
				}
			});
		}
	});

	$('#addCourse-modal').on('hidden.bs.modal', function () {
	    $(this).find('form').trigger('reset');
	    $("#addCourse-msg").css("display","none");
	});

	$("#addReviewer-modal").on("click","#addMajor-mdl",function(e){
		e.preventDefault();
		if($("#course").val() == ""){
			alert("Please select course before you add a major.");
		}
		else{
			$("#addMajor-modal").modal("show");
		}
		
	});


	$("#addMajor-modal").on("click","#addMajor-submit",function(e){
		e.preventDefault();
		if($("#addMajor2").val() == ""){
			$("#addMajor2-msg").html(" * Required");
			$("#addMajor2-msg").css("display","block");
		}
		else{
			$("#addMajor2-msg").css("display","none");
			$.ajax({
				type: "POST",
				url: "../../controller/review_reservations.php",
				data: {
					course_id: $("#course").val(),
					major: $("#addMajor2").val(),
					addMajor: "create"
				},
				success: function(data){
					alert(data);
					getMajor();
					$("#addMajor-modal").modal("hide");
				},
				error: function(data){
					alert(data);
				}
			});
		}
		
	});

	$('#addMajor-modal').on('hidden.bs.modal', function () {
	    $(this).find('form').trigger('reset');
	    $("#addMajor2-msg").css("display","none");
	});

	$("#addReviewer-modal").on("keypress","#fname",function(e){
		var regex = new RegExp("^[A-Za-z. ]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#addReviewer-modal").on("keypress","#mi",function(e){
		var regex = new RegExp("^[A-Za-z. ]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#addReviewer-modal").on("keypress","#lname",function(e){
		var regex = new RegExp("^[A-Za-z. ]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#addReviewer-modal").on("keypress","#contact",function(e){
		var regex = new RegExp("^[0-9]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#addReviewer-modal").on("keypress","#yrGrad",function(e){
		var regex = new RegExp("^[0-9]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#addReviewer-modal").on("click","#addReviewer",function(e){
		e.preventDefault();
		if($("#fname").val()=="" || $("#lname").val()==""  || $("#contact").val()=="" || $("#email").val()=="" || $("#school").val()=="" || $("#course").val()=="" || $("#major").val()=="" || $("#yrGrad").val()==""){
			if($("#fname").val()=="" && $("#lname").val()==""){
				$("#create-name-msg").html("* First name and last name are required.");
				$("#create-name-msg").css("display","block");
			}
			else if($("#fname").val()!="" && $("#lname").val() ==""){
				$("#create-name-msg").html("* Last name is required.");
				$("#create-name-msg").css("display","block");
			}
			else if($("#fname").val()=="" && $("#lname").val() !=""){
				$("#create-name-msg").html("* First name is required.");
				$("#create-name-msg").css("display","block");
			}
			else{
				$("#create-name-msg").html("");
				$("#create-name-msg").css("display","none");
			}

			if($("#contact").val()==""){
				$("#create-contact-msg").html("* Contact no. is required.");
				$("#create-contact-msg").css("display","block");
			}
			else{
				$("#create-contact-msg").html("");
				$("#create-contact-msg").css("display","none");
			}

			if($("#email").val()==""){
				$("#create-email-msg").html("* Email is required.");
				$("#create-email-msg").css("display","block");
			}
			else{
				$("#create-email-msg").html("");
				$("#create-email-msg").css("display","none");
			}

			if($("#school").val()==""){
				$("#create-school-msg").html("* School is required.");
				$("#create-school-msg").css("display","block");
			}
			else{
				$("#create-school-msg").html("");
				$("#create-school-msg").css("display","none");
			}

			if($("#course").val()==""){
				$("#create-course-msg").html("* Course is required.");
				$("#create-course-msg").css("display","block");
			}
			else{
				$("#create-course-msg").html("");
				$("#create-course-msg").css("display","none");
			}

			if($("#major").val()==""){
				$("#create-major-msg").html("* Please select major.");
				$("#create-major-msg").css("display","block");
			}
			else{
				$("#create-major-msg").html("");
				$("#create-major-msg").css("display","none");
			}

			if($("#yrGrad").val()==""){
				$("#create-yrGrad-msg").html("* Year grad. is required.");
				$("#create-yrGrad-msg").css("display","block");
			}
			else{
				$("#create-yrGrad-msg").html("");
				$("#create-yrGrad-msg").css("display","none");
			}
		}

		else{
			$("#create-name-msg,#create-contact-msg,#create-email-msg,#create-school-msg,#create-course-msg,#create-major-msg,#create-yrGrad-msg").html("");

			$.ajax({
				type: "POST",
				url: "../../controller/review_reservations.php",
				data:{
					i_rid: $("#addReviewer-modal").data("id"),
					lname: $("#lname").val(),
					fname: $("#fname").val(),
					mi: $("#mi").val(),
					bdate: $("#bdate").val(),
					address: $("#address").val(),
					contact: $("#contact").val(),
					email: $("#email").val(),
					i_sid: $("#school").val(),
					i_mid: $("#major").val(),
					yrGrad: $("#yrGrad").val(),
					lodge: $("#lodge").val(),
					addReviewer: "create"
				},
				success: function(data){
					if(data!="There's no slot left."){
						updateSlotremaining();
						fillApproved();
						alert(data);
						var x = confirm("Do you want to add another reviewee?");
						if(x==true){
							$("#addReviewer-modal").find('form').trigger('reset');
						}
						else{
							$("#addReviewer-modal").modal("hide");
						}
					}
					else{
						alert(data);
					}
				},
				error: function(data){
					alert(data);
				}
			});
		}
		
	});

	//Clear all forms when closing the modal
	$('#addReviewer-modal').on('hidden.bs.modal', function () {
	    $(this).find('form').trigger('reset');
	    $("#create-name-msg").css("display","none");
	    $("#create-bdate-msg").css("display","none");
	    $("#create-address-msg").css("display","none");
	    $("#create-contact-msg").css("display","none");
	    $("#create-email-msg").css("display","none");
	    $("#create-school-msg").css("display","none");
	    $("#create-course-msg").css("display","none");
	    $("#create-major-msg").css("display","none");
	    $("#create-yrGrad-msg").css("display","none");
	});













	/***********************************************************
	
		View reviewer info

	************************************************************/

	function vw_getSchool(sid){
		$.ajax({
			type: "POST",
			url: "../../controller/review_reservations.php",
			data: {
				getSchool: "getSchool",
			},
			success: function(data){
				$("#vw-school").html(data);
				$("#vw-school").val(sid);
			},
			error: function(data){
				console.log(data);
			}
		});
	}

	function refresh_vw_getSchool(){
		$.ajax({
			type: "POST",
			url: "../../controller/review_reservations.php",
			data: {
				getSchool: "getSchool",
			},
			success: function(data){
				$("#vw-school").html(data);
			},
			error: function(data){
				console.log(data);
			}
		});
	}

	function vw_getCourse(course_id,mid){
		$.ajax({
			type: "POST",
			url: "../../controller/review_reservations.php",
			data: {
				create_requests: "getCourse"
			},
			success: function(data){
				$("#vw-course").html(data);
				$("#vw-course").val(course_id);
				vw_getMajor(mid);
			},
			error: function(data){
				console.log(data);
			}
		});
	}

	function refresh_vw_getCourse(){
		$.ajax({
			type: "POST",
			url: "../../controller/review_reservations.php",
			data: {
				create_requests: "getCourse"
			},
			success: function(data){
				$("#vw-course").html(data);
				//$("#vw-course").val(course_id);
				//vw_getMajor(mid);
			},
			error: function(data){
				console.log(data);
			}
		});
	}

	function vw_getMajor(mid){
		$.ajax({
			type: "POST",
			url: "../../controller/review_reservations.php",
			data: {
				create_requests: "getMajor",
				course_id: $("#vw-course").val()
			},
			success: function(data){
				$("#vw-major").html(data);
				$("#vw-major").val(mid);
			},
			error: function(data){
				console.log(data);
			}
		});
	}

	function refresh_vw_getMajor(){
		$.ajax({
			type: "POST",
			url: "../../controller/review_reservations.php",
			data: {
				create_requests: "getMajor",
				course_id: $("#vw-course").val()
			},
			success: function(data){
				$("#vw-major").html(data);
				//$("#vw-major").val(mid);
			},
			error: function(data){
				console.log(data);
			}
		});
	}

	$("#table-approved").on("click","#vw_appr_reviewer",function(){
		//vw_getSchool();
		//vw_getCourse();
		$("#viewReviewer-modal").data("id",$("#approved-wrapper").data("id"));
		//alert($(this).data("id"));
		$.ajax({
			type: "POST",
			url: "../../controller/review_reservations.php",
			data:{
				i_rev_id: $(this).data("id"),
				viewReviewer: "getReviewer"
			},
			success: function(data){
				data = jQuery.parseJSON(data);
				console.log(data);
				$("#editReviewer").data("id",data.i_rev_id);
				$("#vw-fname").val(data.fname);
				$("#vw-mi").val(data.mi);
				$("#vw-lname").val(data.sname);
				$("#vw-bdate").val(data.bdate);
				$("#vw-address").val(data.address);
				$("#vw-contact").val(data.contact);
				$("#vw-email").val(data.email);
				vw_getSchool(data.sid);
				//$("#vw-school").val(data.sid);
				vw_getCourse(data.course_id,data.mid);
				//$("#vw-course").val(data.course_id);
				//vw_getMajor();
				//$("#vw-major").val(data.mid);
				//$("#vw-major").val(data.mid);
				//vw_getMajor(data.mid);
				//$("#vw-major").val(data.mid);
				//$("#vw-collapseMajor").collapse("show");
				$("#vw-yrGrad").val(data.yrGrad);
				$("#vw-lodge").val(data.lodging);
			},
			error: function(data){
				alert(data);
			}
		});
	});

	$("#vw-course").on("change",function(){
		if($("#vw-course").val()==0){
			$("#vw-major").html("<option value=''></option>");
		}
		else{
			vw_getMajor();
			//$('#vw-collapseMajor').collapse('show');
		}
	});

	$("#viewReviewer-modal").on("click",".edit",function(e){
		e.preventDefault();
		$("#vw-fname,#vw-mi,#vw-lname,#vw-bdate,#vw-address,#vw-contact,#vw-email,#vw-school,#viewSchool-mdl,#vw-course,#viewCourse-mdl,#vw-major,#viewMajor-mdl,#vw-yrGrad,#vw-lodge").attr("disabled",false);
		$("#editReviewer").removeClass("edit").addClass("submit");
		$("#editReviewer").html("<i class='fa fa-save'></i> Update");
	});

	$("#viewReviewer-modal").on("keypress","#vw-fname",function(e){
		var regex = new RegExp("^[A-Za-z.' ]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#viewReviewer-modal").on("keypress","#vw-mi",function(e){
		var regex = new RegExp("^[A-Za-z. ]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#viewReviewer-modal").on("keypress","#vw-lname",function(e){
		var regex = new RegExp("^[A-Za-z.' ]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#viewReviewer-modal").on("keypress","#vw-contact",function(e){
		var regex = new RegExp("^[0-9- ]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#viewReviewer-modal").on("keypress","#vw-yrGrad",function(e){
		var regex = new RegExp("^[0-9]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#view-addSchool-modal").on("click","#view-addSchool-btn",function(e){
		e.preventDefault();
		
		if($("#view-addSchool").val() == "" || $("#view-addSchoolAddress").val() == ""){
			if($("#view-addSchool").val() == ""){
				$("#view-addSchool-msg").html(" * School is required.");
				$("#view-addSchool-msg").css("display","block");
			}
			else{
				$("#view-addSchool-msg").css("display","none");
			}

			if($("#view-addSchoolAddress").val() == ""){
				$("#view-addSchoolAddress-msg").html(" * School address is required.");
				$("#view-addSchoolAddress-msg").css("display","block");
			}
			else{
				$("#view-addSchoolAddress-msg").css("display","block");
			}
		}
		else{
			$("#view-addSchool-msg,#view-addSchoolAddress-msg").css("display","none");
			
			$.ajax({
				type: "POST",
				url: "../../controller/review_reservations.php",
				data: {
					school: $("#view-addSchool").val(),
					address: $("#view-addSchoolAddress").val(),
					schoolType: $("#view-addSchoolType").val(),
					addSchool: "create"
				},
				success: function(data){
					alert("New school created.");
					refresh_vw_getSchool();
					$("#view-addSchool-modal").modal("hide");
					//getSchool();
					//$("#school").val(data);
				},
				error: function(data){
					console.log(data);
				}
			});
		}
	});

	$("#view-addCourse-modal").on("click","#view-addCourse-btn",function(e){
		e.preventDefault();	
		if($("#view-addCourse").val() == ""){
			if($("#view-addCourse").val() == ""){
				$("#view-addCourse-msg").html(" * Course is required");
				$("#view-addCourse-msg").css("display","block");
			}
			else{
				$("#view-addCourse-msg").css("display","none");
			}
		}
		else{
			$("#view-addCourse-msg").css("display","none");
			
			$.ajax({
				type: "POST",
				url: "../../controller/review_reservations.php",
				data: {
					course: $("#view-addCourse").val(),
					//major: $("#addMajor1").val(),
					addCourse: "create"
				},
				success: function(data){
					//getCourse();
					refresh_vw_getCourse();
					$("#vw-major").html("<option value=''></option>");
					alert(data);
					$("#view-addCourse-modal").modal("hide");
				},
				error: function(data){
					console.log(data);
				}
			});
		}
	});

	$('#view-addCourse-modal').on('hidden.bs.modal', function () {
	    $(this).find('form').trigger('reset');
	    $("#view-addCourse-msg").css("display","none");
	});

	$("#viewReviewer-modal").on("click","#viewMajor-mdl",function(e){
		e.preventDefault();
		if($("#vw-course").val() == ""){
			alert("Please select course before you add a major.");
		}
		else{
			$("#view-addMajor-modal").modal("show");
		}
	});

	$("#view-addMajor-modal").on("click","#view-addMajor-submit",function(e){
		e.preventDefault();
		if($("#view-addMajor2").val() == ""){
			$("#view-addMajor2-msg").html(" * Required");
			$("#view-addMajor2-msg").css("display","block");
		}
		else{
			$("#view-addMajor2-msg").css("display","none");
			$.ajax({
				type: "POST",
				url: "../../controller/review_reservations.php",
				data: {
					course_id: $("#vw-course").val(),
					major: $("#view-addMajor2").val(),
					addMajor: "create"
				},
				success: function(data){
					alert(data);
					//getMajor();
					refresh_vw_getMajor();
					$("#view-addMajor-modal").modal("hide");
				},
				error: function(data){
					alert(data);
				}
			});
		}
	});

	$('#view-addMajor-modal').on('hidden.bs.modal', function () {
	    $(this).find('form').trigger('reset');
	    $("#view-addMajor2-msg").css("display","none");
	});

	$("#viewReviewer-modal").on("click",".submit",function(e){
		e.preventDefault();
		//$("#viewReviewer-modal").data("id"));//id from review schedule
		//alert($(this).data("id")); //reviewer's id
		
		if($("#vw-fname").val()=="" || $("#vw-lname").val()==""  || $("#vw-contact").val()==""/* || $("#vw-email").val()==""*/ || $("#vw-school").val()=="" || $("#vw-course").val()=="" || $("#vw-major").val()=="" || $("#vw-yrGrad").val()==""){
			if($("#vw-fname").val()=="" && $("#vw-lname").val()==""){
				$("#vw-name-msg").html("* First name and last name are required.");
			}
			else if($("#vw-fname").val()!="" && $("#vw-lname").val() ==""){
				$("#vw-name-msg").html("* Last name is required.");
			}
			else if($("#vw-fname").val()=="" && $("#vw-lname").val() !=""){
				$("#vw-name-msg").html("* First name is required.");
			}
			else{
				$("#vw-name-msg").html("");
			}

			if($("#vw-contact").val()==""){
				$("#vw-contact-msg").html("* Contact no. is required.");
			}
			else{
				$("#vw-contact-msg").html("");
			}

			/*
			if($("#vw-email").val()==""){
				$("#vw-email-msg").html("* Email is required.");
			}
			else{
				$("#vw-email-msg").html("");
			}
			*/
			if($("#vw-school").val()==""){
				$("#vw-school-msg").html("* School is required.");
			}
			else{
				$("#vw-school-msg").html("");
			}

			if($("#vw-course").val()==""){
				$("#vw-course-msg").html("* Course is required.");
			}
			else{
				$("#vw-course-msg").html("");
			}

			if($("#vw-major").val()==""){
				$("#vw-major-msg").html("* Please select major.");
			}
			else{
				$("#vw-major-msg").html("");
			}

			if($("#vw-yrGrad").val()==""){
				$("#vw-yrGrad-msg").html("* Year grad. is required.");
			}
			else{
				$("#vw-yrGrad-msg").html("");
			}
		}

		else{

			$("#vw-name-msg,#vw-contact-msg,#vw-email-msg,#vw-school-msg,#vw-course-msg,#vw-major-msg,#vw-yrGrad-msg").html("");

			$.ajax({
				type: "POST",
				url: "../../controller/review_reservations.php",
				data:{
					i_rev_id: $(this).data("id"),
					fname: $("#vw-fname").val(),
					mi: $("#vw-mi").val(),
					lname: $("#vw-lname").val(),
					bdate: $("#vw-bdate").val(),
					address: $("#vw-address").val(),
					contact: $("#vw-contact").val(),
					email: $("#vw-email").val(),
					sid: $("#vw-school").val(),
					mid: $("#vw-major").val(),
					yrGrad: $("#vw-yrGrad").val(),
					lodge: $("#vw-lodge").val(),
					updateReviewer: "updateReviewer"
				},
				success: function(data){
					console.log(data);
					fillApproved();
					alert(data);
					$("#vw-fname,#vw-mi,#vw-lname,#vw-bdate,#vw-address,#vw-contact,#vw-email,#vw-school,#viewSchool-mdl,#vw-course,#viewCourse-mdl,#vw-major,#viewMajor-mdl,#vw-yrGrad,#vw-lodge").attr("disabled",true);
					$("#editReviewer").removeClass("submit").addClass("edit");
					$("#editReviewer").html("<i class='fa fa-edit'></i> Edit");
				},
				error: function(data){
					alert(data);
				}
			});
		}
	
	});

	$('#viewReviewer-modal').on('hidden.bs.modal', function () {
	    $(this).find('form').trigger('reset');
	    $("#vw-name-msg").html("");
	    $("#vw-bdate-msg").html("");
	    $("#vw-address-msg").html("");
	    $("#vw-contact-msg").html("");
	    $("#vw-email-msg").html("");
	    $("#vw-school-msg").html("");
	    $("#vw-course-msg").html("");
	    $("#vw-major-msg").html("");
	    $("#vw-yrGrad-msg").html("");
	    $("#vw-fname,#vw-mi,#vw-lname,#vw-bdate,#vw-address,#vw-contact,#vw-email,#vw-school,#viewSchool-mdl,#vw-course,#viewCourse-mdl,#vw-major,#viewMajor-mdl,#vw-yrGrad,#vw-lodge").attr("disabled",true);
		$("#editReviewer").removeClass("submit").addClass("edit");
		$("#editReviewer").html("<i class='fa fa-edit'></i> Edit");
	});
































	/**********************************************************
				

						Requests


	***********************************************************/

	function viewRequests(search){
		//alert("WOWWWW");
		/*if($("#reservedRevSched").val()==null){
			alert("Please select a review.");
		}
		else{
			
			//$("#vw-requests-modal").modal("show");
		}*/
		$.ajax({
			type: "POST",
			url: "../../controller/review_reservations.php",
			data: {
				review_id: $("#vw-requests-modal").data("id"),
				vw_requests: "get",
				search: search,
				searchBy: $("#search-reviewer-requests-by").val()
			},
			success: function(data){
				$("#reviewer_requests_data").html(data);
			},
			error: function(data){

			}
		});
	}



	$("#vw_requests").click(function(){
		$("#vw-requests-modal").data("id",$("#approved-wrapper").data("id"));
		viewRequests($("#search-reviewer-requests").val());
		setInterval(function(){
			viewRequests($("#search-reviewer-requests").val());
		},60000);
	});

	$("#search-reviewer-requests-by").change(function(){
		if($(this).val()=="1"){
			$("#search-reviewer-requests").attr("placeholder", "Last name");
			$("#search-reviewer-requests").val("");
		}
		else{
			$("#search-reviewer-requests").attr("placeholder", "First name");
			$("#search-reviewer-requests").val("");
		}
		
	});



	/**********************************************
					View Request Info
	**********************************************/
	function vw_request_getSchool(){
		$.ajax({
			type: "POST",
			url: "../../controller/review_reservations.php",
			data: {
				getSchool: "getSchool",
			},
			success: function(data){
				$("#vw-request-school").html(data);
				//$("#vw-request-school").val(sid);	
				
			},
			error: function(data){
				console.log(data);
			}
		});
	}

	function vw_request_getCourse(){
		$.ajax({
			type: "POST",
			url: "../../controller/review_reservations.php",
			data: {
				create_requests: "getCourse"
			},
			success: function(data){
				$("#vw-request-course").html(data);
			},
			error: function(data){
				console.log(data);
			}
		});
	}

	function vw_request_getMajor(){
		$.ajax({
			type: "POST",
			url: "../../controller/review_reservations.php",
			data: {
				create_requests: "getMajor",
				course_id: $("#vw-request-course").val()
			},
			success: function(data){
				$("#vw-request-major").html(data);
				//$("#vw-request-major").val(mid);
			},
			error: function(data){
				console.log(data);
			}
		});
	}






















	/*******************************************************************

							View Request Modal

	*******************************************************************/

	function vw_request_set_getSchool(sid){
		$.ajax({
			type: "POST",
			url: "../../controller/review_reservations.php",
			data: {
				getSchool: "getSchool",
			},
			success: function(data){
				console.log(data);
				$("#vw-request-school").html(data);
				$("#vw-request-school").val(sid);
			},
			error: function(data){
				console.log(data);
			}
		});
	}

	/*
	function refresh_vw_getSchool(){
		$.ajax({
			type: "POST",
			url: "../../controller/review_reservations.php",
			data: {
				getSchool: "getSchool",
			},
			success: function(data){
				$("#vw-school").html(data);
			},
			error: function(data){
				console.log(data);
			}
		});
	}*/

	function vw_request_set_getCourse(course_id,mid){
		$.ajax({
			type: "POST",
			url: "../../controller/review_reservations.php",
			data: {
				create_requests: "getCourse"
			},
			success: function(data){
				$("#vw-request-course").html(data);
				$("#vw-request-course").val(course_id);
				vw_request_set_getMajor(mid);
			},
			error: function(data){
				console.log(data);
			}
		});
	}

	/*function refresh_vw_getCourse(){
		$.ajax({
			type: "POST",
			url: "../../controller/review_reservations.php",
			data: {
				create_requests: "getCourse"
			},
			success: function(data){
				$("#vw-course").html(data);
				//$("#vw-course").val(course_id);
				//vw_getMajor(mid);
			},
			error: function(data){
				console.log(data);
			}
		});
	}*/

	function vw_request_set_getMajor(mid){
		$.ajax({
			type: "POST",
			url: "../../controller/review_reservations.php",
			data: {
				create_requests: "getMajor",
				course_id: $("#vw-request-course").val()
			},
			success: function(data){
				$("#vw-request-major").html(data);
				$("#vw-request-major").val(mid);
			},
			error: function(data){
				console.log(data);
			}
		});
	}

	/*function refresh_vw_getMajor(){
		$.ajax({
			type: "POST",
			url: "../../controller/review_reservations.php",
			data: {
				create_requests: "getMajor",
				course_id: $("#vw-course").val()
			},
			success: function(data){
				$("#vw-major").html(data);
				//$("#vw-major").val(mid);
			},
			error: function(data){
				console.log(data);
			}
		});
	}*/


	$("#vw-requests-modal").on("click","#info_appr_reviewer",function(){
		//alert($(this).data("id"));
		//vw_request_getSchool("");
		//vw_request_getCourse();
		$.ajax({
			type: "POST",
			url: "../../controller/review_reservations.php",
			data:{
				i_rev_id: $(this).data("id"),
				viewReviewer: "getReviewer"
			},
			success: function(data){
				data = jQuery.parseJSON(data);
				console.log(data);
				//console.log(data);
				//$("#editReviewer").data("id",data.i_rev_id);
				$("#vw-request-fname").val(data.fname);
				$("#vw-request-mi").val(data.mi);
				$("#vw-request-lname").val(data.sname);
				$("#vw-request-bdate").val(data.bdate);
				$("#vw-request-address").val(data.address);
				$("#vw-request-contact").val(data.contact);
				$("#vw-request-email").val(data.email);
				//$("#vw-request-school").val(data.sid);
				vw_request_set_getSchool(data.sid);
				vw_request_set_getCourse(data.course_id,data.mid)
				//vw_request_getCourse();
				//$("#vw-request-course").val(data.course_id);
				//vw_request_getMajor(data.mid);
				//$("#vw-major").val(data.mid);
				//$("#vw-collapseMajor").collapse("show");
				$("#vw-request-yrGrad").val(data.yrGrad);
				$("#vw-request-lodge").val(data.lodging);
			},
			error: function(data){
				alert(data);
			}
		});
	});
	
	$('#vw-requests-modal').on('hidden.bs.modal', function () {
	   	$("#search-reviewer-requests").val("");
	   	$("#search-reviewer-requests-by").val("1");
	   	clearInterval();
	});

	$("#viewRequestInfo-modal").on('hidden.bs.modal', function(){
		$(this).find('form').trigger('reset');
	});

	/*
	$("#approved-data").on("click","#canc_appr_reviewer",function(){
		//alert($(this).data("id"));
		var x = confirm("Are you sure you want to cancel the status?");
		if(x==true){
			$.ajax({
				type: "POST",
				url: "../../controller/review_reservations.php",
				data:{
					i_rev_id: $(this).data("id"),
					cancelReviewer: "cancel"
				},
				success: function(data){
					alert(data);
					fillApproved();
				}
			});
		}
	});*/

	/*
	$("#approved-data").on("click","#going_appr_reviewer",function(){
		var x = confirm("Are you sure you want to change to status to 'Going'?");
		if(x==true){
			$.ajax({
				type: "POST",
				url: "../../controller/review_reservations.php",
				data:{
					i_rev_id: $(this).data("id"),
					goingReviewer: "going"
				},
				success: function(data){
					alert(data);
					fillApproved();
				}
			});
		}
	});
	*/



	/************************************************************
							
							Remove from Approved

	*************************************************************/

	//Remove from Approved List
	$("#table-approved").on("click","#rem_appr_reviewer",function(){
		
		var x = confirm("Are you sure you want to remove this reviewer?");
		if(x==true){
			$.ajax({
				type: "POST",
				url: "../../controller/review_reservations.php",
				data: {
					reviewer_id: $(this).data("id"),
					review_id: $("#approved-wrapper").data("id"),
					remove_reviewer: "remove"
				},
				success: function(data){
					//data = jQuery.parseJSON(data);
					//$("#slots-remaining").html(data.num_stud);
					updateSlotremaining();
					fillApproved();
					alert("Successfully removed the reviewer from the review");
				},
				error: function(data){
					alert(data);
				}
			});	
		}
		
	});

	$('#viewReviewer-modal').on('hidden.bs.modal', function () {
	    $(this).find('form').trigger('reset');
	    $("#create-name-msg").html("");
	    $("#create-bdate-msg").html("");
	    $("#create-address-msg").html("");
	    $("#create-contact-msg").html("");
	    $("#create-email-msg").html("");
	    $("#create-school-msg").html("");
	    $("#create-course-msg").html("");
	    $("#create-major-msg").html("");
	    $("#create-yrGrad-msg").html("");
	});

	//Search Requests

	$("#vw-requests-modal").on("click","#search-reviewer-requests-btn",function(event){
		event.preventDefault();
		viewRequests($("#search-reviewer-requests").val());
	});

	// ACCEPTS Requests
	$("#vw-requests-modal").on("click","#acc_appr_reviewer",function(){
		//alert($(this).data("id"));
		var x = confirm("Are you sure you want to accept this request?");
		if(x==true){
			$.ajax({
				type: "POST",
				url: "../../controller/review_reservations.php",
				data: {
					reviewer_id: $(this).data("id"),
					review_id: $("#vw-requests-modal").data("id"),
					accept_reviewer: "accept"
				},
				success: function(data){
					//data = jQuery.parseJSON(data);
					//$("#slots-remaining").html(data.num_stud);
					alert(data);
					$("#searchApproved").val("");
					updateSlotremaining();
					viewRequests("");
					fillApproved();
					//$("#vw-requests-modal").modal("hide");
					//alert($(this).data("id") + "is accepted with review id " + $("#reservedRevSched").val());
				},
				error: function(data){
					alert(data);
				}
			});	
		}
		
	});

	//Reject Requests
	$("#vw-requests-modal").on("click","#rej_appr_reviewer",function(){
		//alert($(this).data("id"));
		var x = confirm("Are you sure you want to reject this request?");
		if(x==true){
			$.ajax({
				type: "POST",
				url: "../../controller/review_reservations.php",
				data:{
					rejectReviewer: "reject",
					i_rid: $("#vw-requests-modal").data("id"),
					i_rev_id: $(this).data("id")
				},
				success: function(data){
					viewRequests($("#search-reviewer-requests").val());
					alert(data);
				}
			});
		}
		
	});

	function create_request_getSchool(){
		$.ajax({
			type: "POST",
			url: "../../controller/review_reservations.php",
			data: {
				getSchool: "getSchool",
			},
			success: function(data){
				$("#request-school").html(data);
				//$("#request-school").val(sid);	
				
			},
			error: function(data){
				console.log(data);
			}
		});
	}

	function create_request_getCourse(){
		$.ajax({
			type: "POST",
			url: "../../controller/review_reservations.php",
			data: {
				create_requests: "getCourse"
			},
			success: function(data){
				$("#request-course").html(data);
			},
			error: function(data){
				console.log(data);
			}
		});
	}

	function create_request_getMajor(){
		$.ajax({
			type: "POST",
			url: "../../controller/review_reservations.php",
			data: {
				create_requests: "getMajor",
				course_id: $("#request-course").val()
			},
			success: function(data){
				$("#request-major").html(data);
				//$("#request-major").val(mid);
			},
			error: function(data){
				console.log(data);
			}
		});
	}

	$("#request-course").on("change",function(){
		if($("#request-course").val()==0){
			$("#request-major").html("<option value=''></option>");
		}
		else{
			create_request_getMajor();
			//$('#vw-collapseMajor').collapse('show');
		}
		/*if($("#request-course").val()==0){
			$('#request-collapseMajor').collapse('hide');
		}
		else{
			create_request_getMajor();
			$('#request-collapseMajor').collapse('show');
		}*/
	});

	$("#close-addReviewer-modal").click(function(){
		$("#collapseMajor").collapse("hide");
	});


	$("#vw-requests-modal").on("click","#addRequest",function(){
		create_request_getSchool();
		create_request_getCourse();
		$("#addRequest-modal").data("id",$("#vw-requests-modal").data("id"));
	});

	$("#addRequest-modal").on("keypress","#request-fname",function(e){
		var regex = new RegExp("^[A-Za-z'. ]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#addRequest-modal").on("keypress","#request-mi",function(e){
		var regex = new RegExp("^[A-Za-z.' ]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#addRequest-modal").on("keypress","#request-lname",function(e){
		var regex = new RegExp("^[A-Za-z.' ]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#addRequest-modal").on("keypress","#request-contact",function(e){
		var regex = new RegExp("^[0-9- ]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#addRequest-modal").on("keypress","#request-yrGrad",function(e){
		var regex = new RegExp("^[0-9]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#request-addSchool-modal").on("click","#request-addSchool-btn",function(e){
		e.preventDefault();
		if($("#request-addSchool").val() == "" || $("#request-addSchoolAddress").val() == ""){
			if($("#request-addSchool").val() == ""){
				$("#request-addSchool-msg").html(" * School is required.");
				$("#request-addSchool-msg").css("display","block");
			}
			else{
				$("#request-addSchool-msg").css("display","none");
			}

			if($("#request-addSchoolAddress").val() == ""){
				$("#request-addSchoolAddress-msg").html(" * School address is required.");
				$("#request-addSchoolAddress-msg").css("display","block");
			}
			else{
				$("#request-addSchoolAddress-msg").css("display","block");
			}
		}
		else{
			$("#request-addSchool-msg,#request-addSchoolAddress-msg").css("display","none");
			
			$.ajax({
				type: "POST",
				url: "../../controller/review_reservations.php",
				data: {
					school: $("#request-addSchool").val(),
					address: $("#request-addSchoolAddress").val(),
					schoolType: $("#request-addSchoolType").val(),
					addSchool: "create"
				},
				success: function(data){
					alert("New school created.");
					create_request_getSchool();
					$("#request-addSchool-modal").modal("hide");
					//$("#school").val(data);
				},
				error: function(data){
					console.log(data);
				}
			});
		}
	});

	$('#request-addSchool-modal').on('hidden.bs.modal', function () {
	    $(this).find('form').trigger('reset');
	    $("#request-addSchool-msg,#request-addSchoolAddress-msg").css("display","none");
	});

	$("#request-addCourse-modal").on("click","#request-addCourse-btn",function(e){
		e.preventDefault();
		if($("#request-addCourse").val() == ""){
			if($("#request-addCourse").val() == ""){
				$("#request-addCourse-msg").html(" * Course is required");
				$("#request-addCourse-msg").css("display","block");
			}
			else{
				$("#request-addCourse-msg").css("display","none");
			}
		}
		else{
			$("#request-addCourse-msg").css("display","none");
			$.ajax({
				type: "POST",
				url: "../../controller/review_reservations.php",
				data: {
					course: $("#request-addCourse").val(),
					//major: $("#addMajor1").val(),
					addCourse: "create"
				},
				success: function(data){
					alert(data);
					$("#request-addCourse-modal").modal("hide");
					create_request_getCourse();
					$("#request-major").html("<option value=''></option>");
				},
				error: function(data){
					console.log(data);
				}
			});
		}
	});

	$('#request-addCourse-modal').on('hidden.bs.modal', function () {
	    $(this).find('form').trigger('reset');
	    $("#request-addCourse-msg").css("display","none");
	});

	$("#addRequest-modal").on("click","#request-addMajor-mdl",function(e){
		e.preventDefault();
		if($("#request-course").val() == ""){
			alert("Please select course before you add a major.");
		}
		else{
			$("#request-addMajor-modal").modal("show");
		}
	});

	$("#request-addMajor-modal").on("click","#request-addMajor-submit",function(e){
		e.preventDefault();
		if($("#request-addMajor2").val() == ""){
			$("#request-addMajor2-msg").html(" * Required");
			$("#request-addMajor2-msg").css("display","block");
		}
		else{
			$("#request-addMajor2-msg").css("display","none");
			
			$.ajax({
				type: "POST",
				url: "../../controller/review_reservations.php",
				data: {
					course_id: $("#request-course").val(),
					major: $("#request-addMajor2").val(),
					addMajor: "create"
				},
				success: function(data){
					alert(data);
					//getMajor();
					create_request_getMajor();
					$("#request-addMajor-modal").modal("hide");
				},
				error: function(data){
					alert(data);
				}
			});
		}
	});

	$('#addSchool-modal').on('hidden.bs.modal', function () {
	    $(this).find('form').trigger('reset');
	    $("#request-addMajor2-msg").css("display","none");
	});
		

	$("#addRequest-modal").on("click","#addRequest",function(e){
		e.preventDefault();
		if($("#request-fname").val()=="" || $("#request-lname").val()=="" || $("#request-bdate").val()=="" || $("#request-address").val()=="" || $("#request-contact").val()=="" || $("#request-email").val()=="" || $("#request-school").val()=="" || $("#request-course").val()=="" || $("#request-major").val()=="" || $("#request-yrGrad").val()==""){
			if($("#request-fname").val()=="" && $("#request-lname").val()==""){
				$("#create-request-name-msg").html("* First name and last name are required.");
				//$("#create-request-name-msg").css("display","block");
			}
			else if($("#request-fname").val()!="" && $("#request-lname").val() ==""){
				$("#create-request-name-msg").html("* Last name is required");
				//$("#create-request-name-msg").css("display","block");
			}
			else if($("#request-fname").val()=="" && $("#request-lname").val() !=""){
				$("#create-request-name-msg").html("* First name is required");
				//$("#create-request-name-msg").css("display","block");
			}
			else{
				$("#create-request-name-msg").html("");
				//$("#create-request-name-msg").css("display","none");
			}

			if($("#request-bdate").val()==""){
				$("#create-request-bdate-msg").html("* Birthdate is required.");
				//$("#create-request-bdate-msg").css("display","block");
			}
			else{
				$("#create-request-bdate-msg").html("");
				//$("#create-request-bdate-msg").css("display","none");
			}

			if($("#request-address").val()==""){
				$("#create-request-address-msg").html("* Address is required.");
				//$("#create-request-address-msg").css("display","block");
			}
			else{
				$("#create-request-address-msg").html("");
				//$("#create-request-address-msg").css("display","none");
			}

			if($("#request-contact").val()==""){
				$("#create-request-contact-msg").html("* Contact no. is required.");
				//$("#create-request-contact-msg").css("display","block");
			}
			else{
				$("#create-request-contact-msg").html("");
				//$("#create-request-contact-msg").css("display","none");
			}

			if($("#request-email").val()==""){
				$("#create-request-email-msg").html("* Email is required.");
				//$("#create-request-email-msg").css("display","block");
			}
			else{
				$("#create-request-email-msg").html("");
				//$("#create-request-email-msg").css("display","none");
			}

			if($("#request-school").val()==""){
				$("#create-request-school-msg").html("* Please select school.");
				//$("#create-request-school-msg").css("display","block");
			}
			else{
				$("#create-request-school-msg").html("");
				//$("#create-request-school-msg").css("display","none");
			}

			if($("#request-course").val()==""){
				$("#create-request-course-msg").html("* Please select course.");
				//$("#create-request-course-msg").css("display","block");
			}
			else{
				$("#create-request-course-msg").html("");
				//$("#create-request-course-msg").css("display","none");
			}

			if($("#request-major").val()==""){
				$("#create-request-major-msg").html("* Please select major.");
				//$("#create-request-major-msg").css("display","block");
			}
			else{
				$("#create-request-major-msg").html("");
				//$("#create-request-major-msg").css("display","none");
			}

			if($("#request-yrGrad").val()==""){
				$("#create-request-yrGrad-msg").html("* Year grad. is required.");
				//$("#create-request-yrGrad-msg").css("display","block");
			}
			else{
				$("#create-request-yrGrad-msg").html("");
				//$("#create-request-yrGrad-msg").css("display","none");
			}
		}
		else{
			$("#create-request-name-msg,#create-request-contact-msg,#create-request-email-msg,#create-request-school-msg,#create-request-course-msg,#create-request-major-msg,#create-request-yrGrad-msg").html("");
			
			$.ajax({
				type: "POST",
				url: "../../controller/review_reservations.php",
				data:{
					i_rid: $("#addRequest-modal").data("id"),
					fname: $("#request-fname").val(),
					mi: $("#request-mi").val(),
					lname: $("#request-lname").val(),
					bdate: $("#request-bdate").val(),
					address: $("#request-address").val(),
					contact: $("#request-contact").val(),
					email: $("#request-email").val(),
					i_sid: $("#request-school").val(),
					//course: $("#request-course").val(),
					i_mid: $("#request-major").val(),
					yrGrad: $("#request-yrGrad").val(),
					lodge: $("#request-lodge").val(),
					addRequest: "create"
				},
				success: function(data){
					alert(data);
					viewRequests("");
					$("#addRequest-modal").modal("hide");
				},
				error: function(data){
					alert(data);
				}
			});
			
		}
		
	});

	$('#addRequest-modal').on('hidden.bs.modal', function () {
	    $(this).find('form').trigger('reset');
	    $("#create-request-name-msg").html("");
	    $("#create-request-bdate-msg").html("");
	    $("#create-request-address-msg").html("");
	    $("#create-request-contact-msg").html("");
	    $("#create-request-email-msg").html("");
	    $("#create-request-school-msg").html("");
	    $("#create-request-course-msg").html("");
	    $("#create-request-major-msg").html("");
	    $("#create-request-yrGrad-msg").html("");
	});

	//View Rejected Requests
	function vw_reject_requests(){
		$.ajax({
			type: "POST",
			url: "../../controller/review_reservations.php",
			data:{
				i_rid: $("#vw-rej-requests-modal").data("id"),
				search: $("#search-reviewer-reject-requests").val(),
				searchBy: $("#search-reviewer-reject-request-by").val(),
				vw_reject: "view"
			},
			success: function(data){
				//alert(data);
				$("#rejected-reviewer-lists").html(data);
			}
		});
	}



	/**********************************************************************

								View Reject info

	************************************************************************/

	function vw_reject_set_getSchool(sid){
		$.ajax({
			type: "POST",
			url: "../../controller/review_reservations.php",
			data: {
				getSchool: "getSchool",
			},
			success: function(data){
				console.log(data);
				$("#vw-request-school").html(data);
				$("#vw-request-school").val(sid);
			},
			error: function(data){
				console.log(data);
			}
		});
	}

	/*
	function refresh_vw_getSchool(){
		$.ajax({
			type: "POST",
			url: "../../controller/review_reservations.php",
			data: {
				getSchool: "getSchool",
			},
			success: function(data){
				$("#vw-school").html(data);
			},
			error: function(data){
				console.log(data);
			}
		});
	}*/

	function vw_reject_set_getCourse(course_id,mid){
		$.ajax({
			type: "POST",
			url: "../../controller/review_reservations.php",
			data: {
				create_requests: "getCourse"
			},
			success: function(data){
				$("#vw-request-course").html(data);
				$("#vw-request-course").val(course_id);
				vw_reject_set_getMajor(mid);
			},
			error: function(data){
				console.log(data);
			}
		});
	}

	/*function refresh_vw_getCourse(){
		$.ajax({
			type: "POST",
			url: "../../controller/review_reservations.php",
			data: {
				create_requests: "getCourse"
			},
			success: function(data){
				$("#vw-course").html(data);
				//$("#vw-course").val(course_id);
				//vw_getMajor(mid);
			},
			error: function(data){
				console.log(data);
			}
		});
	}*/

	function vw_reject_set_getMajor(mid){
		$.ajax({
			type: "POST",
			url: "../../controller/review_reservations.php",
			data: {
				create_requests: "getMajor",
				course_id: $("#vw-request-course").val()
			},
			success: function(data){
				$("#vw-request-major").html(data);
				$("#vw-request-major").val(mid);
			},
			error: function(data){
				console.log(data);
			}
		});
	}

	/*function refresh_vw_getMajor(){
		$.ajax({
			type: "POST",
			url: "../../controller/review_reservations.php",
			data: {
				create_requests: "getMajor",
				course_id: $("#vw-course").val()
			},
			success: function(data){
				$("#vw-major").html(data);
				//$("#vw-major").val(mid);
			},
			error: function(data){
				console.log(data);
			}
		});
	}*/


	$("#vw-rej-requests-modal").on("click","#info_appr_reviewer",function(){
		//alert($(this).data("id"));
		//vw_request_getSchool("");
		//vw_request_getCourse();
		$.ajax({
			type: "POST",
			url: "../../controller/review_reservations.php",
			data:{
				i_rev_id: $(this).data("id"),
				viewReviewer: "getReviewer"
			},
			success: function(data){
				data = jQuery.parseJSON(data);
				//console.log(data);
				//$("#editReviewer").data("id",data.i_rev_id);
				$("#vw-request-fname").val(data.fname);
				$("#vw-request-mi").val(data.mi);
				$("#vw-request-lname").val(data.sname);
				$("#vw-request-bdate").val(data.bdate);
				$("#vw-request-address").val(data.address);
				$("#vw-request-contact").val(data.contact);
				$("#vw-request-email").val(data.email);

				vw_reject_set_getSchool(data.sid);
				vw_reject_set_getCourse(data.course_id,data.mid);
				//$("#vw-request-school").val(data.sid);

				//$("#vw-request-course").val(data.course_id);
				//vw_request_getMajor(data.mid);
				//$("#vw-major").val(data.mid);
				//$("#vw-collapseMajor").collapse("show");
				$("#vw-request-yrGrad").val(data.yrGrad);
				$("#vw-request-lodge").val(data.lodging);
			},
			error: function(data){
				alert(data);
			}
		});
	});

	$("#vw-requests-modal").on("click","#vw-reject-request",function(){
		$("#vw-rej-requests-modal").data("id",$("#vw-requests-modal").data("id"));
		vw_reject_requests();
	});

	$("#vw-rej-requests-modal").on("change","#search-reviewer-reject-request-by",function(){
		if($("#search-reviewer-reject-request-by").val()=="1"){
			$("#search-reviewer-reject-requests").attr("placeholder","Last Name");
		}
		else{
			$("#search-reviewer-reject-requests").attr("placeholder","First Name");
		}
	});

	$("#vw-rej-requests-modal").on("click","#search-reviewer-reject-requests-btn",function(event){
		event.preventDefault();
		vw_reject_requests();
	});


	//Used to recover rejected requests
	$("#vw-rej-requests-modal").on("click","#recover-reject-req",function(){
		
		var x = confirm("Are you sure you want to recover this request?");
		if(x==true){
			$.ajax({
				type: "POST",
				url: "../../controller/review_reservations.php",
				data:{
					recoverReject: "recover",
					i_rid: $("#vw-rej-requests-modal").data("id"),
					i_rev_id: $(this).data("id")
				},
				success: function(data){
					alert(data);
					vw_reject_requests();
					viewRequests("");
				}
			});
		}
		
	});

	//Used to delete rejected requests
	$("#vw-rej-requests-modal").on("click","#delete-reject-req",function(){

		//alert($(this).data("id"));
		var x = confirm("Are you sure you want to delete this request?");
		if(x==true){
			$.ajax({
				type: "POST",
				url: "../../controller/review_reservations.php",
				data: {
					deleteReject: "delete",
					i_rev_id: $(this).data("id")
				},
				success: function(data){
					alert(data);
					vw_reject_requests();
				}
			});
		}
	});

	function searchRemoved(search,search_by){
		$.ajax({
			type: "POST",
			url: "../../controller/review_reservations.php",
			data:{
				search: search,
				search_by: search_by,
				i_rid: $("#vw-removed-modal").data("id"),
				viewRemoved: "view"
			},
			success: function(data){
				$("#removed_reviewer_data").html(data);
			}
		});
	}

	$("#approved-wrapper").on("click","#vw_removed",function(){
		$("#vw-removed-modal").data("id",$("#approved-wrapper").data("id"));
		searchRemoved($("#search-removed-reviewer").val(),$("#search-removed-reviewer-by").val());
	});

	$("#search-removed-reviewer-by").change(function(){
		if($(this).val()=="1"){
			$("#search-removed-reviewer").attr("placeholder", "Last name");
			$("#search-removed-reviewer").val("");
		}
		else{
			$("#search-removed-reviewer").attr("placeholder", "First name");
			$("#search-removed-reviewer").val("");
		}
		
	});

	$("#vw-removed-modal").on("click","#search-removed-reviewer-btn",function(event){
		event.preventDefault();
		searchRemoved($("#search-removed-reviewer").val(),$("#search-removed-reviewer-by").val());
	});

	$("#vw-removed-modal").on("click","#recover-removed-reviewer",function(){
		var x = confirm("Are you sure you want to recover this removed reviewer?");
		if(x==true){
			$.ajax({
				type: "POST",
				url: "../../controller/review_reservations.php",
				data:{
					recoverRemoved: "recover",
					i_rid: $("#vw-removed-modal").data("id"),
					i_rev_id: $(this).data("id")
				},
				success: function(data){
					alert(data);
					searchRemoved($("#search-removed-reviewer").val(),$("#search-removed-reviewer-by").val());
					updateSlotremaining();
					fillApproved();
				}
			});
		}
		//alert($(this).data("id"));
	});

	$("#vw-removed-modal").on("click","#delete-removed-reviewer",function(){
		var x = confirm("Are you sure you want to delete this removed reviewer?");
		if(x==true){
			$.ajax({
				type: "POST",
				url: "../../controller/review_reservations.php",
				data:{
					deleteRemoved: "delete",
					//i_rid: $("#vw-removed-modal").data("id"),
					i_rev_id: $(this).data("id")
				},
				success: function(data){
					alert(data);
					searchRemoved($("#search-removed-reviewer").val(),$("#search-removed-reviewer-by").val());
				}
			});
		}
	});







	/**************************************************

					View Removed Info

	**************************************************/	

	function vw_removed_set_getSchool(sid){
		$.ajax({
			type: "POST",
			url: "../../controller/review_reservations.php",
			data: {
				getSchool: "getSchool",
			},
			success: function(data){
				console.log(data);
				$("#vw-removed-school").html(data);
				$("#vw-removed-school").val(sid);
			},
			error: function(data){
				console.log(data);
			}
		});
	}

	/*
	function refresh_vw_getSchool(){
		$.ajax({
			type: "POST",
			url: "../../controller/review_reservations.php",
			data: {
				getSchool: "getSchool",
			},
			success: function(data){
				$("#vw-school").html(data);
			},
			error: function(data){
				console.log(data);
			}
		});
	}*/

	function vw_removed_set_getCourse(course_id,mid){
		$.ajax({
			type: "POST",
			url: "../../controller/review_reservations.php",
			data: {
				create_requests: "getCourse"
			},
			success: function(data){
				$("#vw-removed-course").html(data);
				$("#vw-removed-course").val(course_id);
				vw_removed_set_getMajor(mid);
			},
			error: function(data){
				console.log(data);
			}
		});
	}

	/*function refresh_vw_getCourse(){
		$.ajax({
			type: "POST",
			url: "../../controller/review_reservations.php",
			data: {
				create_requests: "getCourse"
			},
			success: function(data){
				$("#vw-course").html(data);
				//$("#vw-course").val(course_id);
				//vw_getMajor(mid);
			},
			error: function(data){
				console.log(data);
			}
		});
	}*/

	function vw_removed_set_getMajor(mid){
		$.ajax({
			type: "POST",
			url: "../../controller/review_reservations.php",
			data: {
				create_requests: "getMajor",
				course_id: $("#vw-removed-course").val()
			},
			success: function(data){
				$("#vw-removed-major").html(data);
				$("#vw-removed-major").val(mid);
			},
			error: function(data){
				console.log(data);
			}
		});
	}

	/*function refresh_vw_getMajor(){
		$.ajax({
			type: "POST",
			url: "../../controller/review_reservations.php",
			data: {
				create_requests: "getMajor",
				course_id: $("#vw-course").val()
			},
			success: function(data){
				$("#vw-major").html(data);
				//$("#vw-major").val(mid);
			},
			error: function(data){
				console.log(data);
			}
		});
	}*/

	$("#vw-removed-modal").on("click","#info_removed_reviewer",function(){
		//vw_request_getSchool("");
		//vw_request_getCourse();
		$.ajax({
			type: "POST",
			url: "../../controller/review_reservations.php",
			data:{
				i_rev_id: $(this).data("id"),
				viewReviewer: "getReviewer"
			},
			success: function(data){
				data = jQuery.parseJSON(data);
				//console.log(data);
				//$("#editReviewer").data("id",data.i_rev_id);
				$("#vw-removed-fname").val(data.fname);
				$("#vw-removed-mi").val(data.mi);
				$("#vw-removed-lname").val(data.sname);
				$("#vw-removed-bdate").val(data.bdate);
				$("#vw-removed-address").val(data.address);
				$("#vw-removed-contact").val(data.contact);
				$("#vw-removed-email").val(data.email);
				//$("#vw-removed-school").val(data.sid);
				vw_removed_set_getSchool(data.sid);
				vw_removed_set_getCourse(data.course_id,data.mid);

				$("#vw-removed-course").val(data.course_id);
				//vw_request_getMajor(data.mid);
				//$("#vw-major").val(data.mid);
				//$("#vw-collapseMajor").collapse("show");
				$("#vw-removed-yrGrad").val(data.yrGrad);
				$("#vw-removed-lodge").val(data.lodging);
			},
			error: function(data){
				alert(data);
			}
		});
	});

});