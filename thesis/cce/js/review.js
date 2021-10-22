$(document).ready(function(){

	function getReview(){
		$.ajax({
			type: "POST",
			url: "../php/controller/review.php",
			data: {
				function: "getReview"
			},
			success: function(data){
				$("#scheduleData").html(data);
			}
		});
	}

	getReview();
	setInterval(function(){
		getReview();
	},60000);	

	function getSchool(){
		$.ajax({
			type: "POST",
			url: "../php/controller/review.php",
			data:{
				function: "getSchool"
			},
			success: function(data){
				$("#school").html(data);
			}
		});
	}

	function getCourse(){
		$.ajax({
			type: "POST",
			url: "../php/controller/review.php",
			data:{
				function: "getCourse"
			},
			success: function(data){
				$("#course").html(data);
			}
		});
	}


	$("#scheduleData").on("click","#joinReview",function(){
		//alert($(this).data("id"));
		$("#joinReview-modal").data("id",$(this).data("id"));

		//Get School
		getSchool();
		//Get Course
		getCourse();
		
	});

	function getMajor(){
		$.ajax({
			type: "POST",
			url: "../php/controller/review.php",
			data:{
				course_id: $("#course").val(),
				function: "getMajor"
			},
			success: function(data){
				$("#major").html(data);
				//$("#major").prop("disabled",false);
			}
		});
	}
	//Get Major
	$("#course").change(function(){
		if($("#course").val()==""){
			$("#major").html("<option value=''></option>");
			//$("#major").prop("disabled",true);
		}
		else{
			getMajor();
		}
		
	});











	/**********************************************************************

							Add School

	**********************************************************************/

	$("#addSchool-modal").on("keypress","#addSchool",function(e){
		var regex = new RegExp("^[a-zA-Z ]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#joinReview-modal").on("click","#toggle-addSchool-modal",function(e){
		e.preventDefault();
		$("#addSchool-modal").modal("show");
	});

	/*
	$("#addSchool-modal").on("keypress","#addSchool",function(e){
		var regex = new RegExp("^[a-zA-Z ]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});*/

	
	$("#addSchool-modal").on("click","#addSchool-submit",function(e){
		e.preventDefault();
		//alert($("#addSchool").val() + $("#addSchool-address").val());
		if($("#addSchool").val() == "" || $("#addSchool-address").val() == ""){

			if($("#addSchool").val() == ""){
				$("#addSchool-msg").html(" * School is required");
				$("#addSchool-msg").css("display","block");
			}
			else{
				$("#addSchool-msg").css("display","none");
			}

			if($("#addSchool-address").val() == ""){
				$("#addSchool-address-msg").html(" * School address is required");
				$("#addSchool-msg").css("display","block");
			}
			else{
				$("#addSchool-msg").css("display","none");
			}

		}
		else{
			$("#addSchool-msg,#addSchool-address-msg").css("display","none");
			$.ajax({
				type: "POST",
				url: "../php/controller/review.php",
				data: {
					school_name: $("#addSchool").val(),
					school_address: $("#addSchool-address").val(),
					function: "createSchool"
				},
				success: function(data){
					alert(data);
					getSchool();
					$("#addSchool-modal").modal("hide");
				}
			});
		}
	});

	$('#addSchool-modal').on('hidden.bs.modal', function () {
	    $(this).find('form').trigger('reset');
	    $("#addSchool-msg,#addSchool-address-msg").css("display","none");
	});













	/********************************************************************

								Add Course

	*********************************************************************/




	$("#joinReview-modal").on("click","#toggle-addCourse-modal",function(e){
		e.preventDefault();
		$("#addCourse-modal").modal("show");
		//$("#addSchool-modal").modal("show");
	});

	$("#addCourse-modal").on("keypress","#addCourse",function(e){
		var regex = new RegExp("^[a-zA-Z ]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
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
				url: "../php/controller/review.php",
				data: {
					course: $("#addCourse").val(),
					//major: $("#addMajor1").val(),
					function: "createCourse"
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













	/**********************************************************************

								Add Major

	************************************************************************/

	$("#addMajor-modal").on("keypress","#addMajor2",function(e){
		var regex = new RegExp("^[a-zA-Z ]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#joinReview-modal").on("click","#toggle-addMajor-modal",function(e){
		e.preventDefault();

		if($("#course").val() == ""){
			alert("Please select course before you add a major.");
		}
		else{
			$("#addMajor-modal").modal("show");
		}
		//$("#addSchool-modal").modal("show");
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
				url: "../php/controller/review.php",
				data: {
					course_id: $("#course").val(),
					major: $("#addMajor2").val(),
					function: "createMajor"
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


















	/******************************************************
							
						Create Request

	********************************************************/


	$("#joinReview-modal").on("keypress","#fname",function(e){
		var regex = new RegExp("^[a-zA-Z. ]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#joinReview-modal").on("keypress","#mi",function(e){
		var regex = new RegExp("^[a-zA-Z. ]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#joinReview-modal").on("keypress","#lname",function(e){
		var regex = new RegExp("^[a-zA-Z. ]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#joinReview-modal").on("keypress","#contact",function(e){
		var regex = new RegExp("^[0-9]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#joinReview-modal").on("keypress","#yrGrad",function(e){
		var regex = new RegExp("^[0-9]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	



	$("#previewForm").click(function(e){
		e.preventDefault();
		if($("#fname").val() == "" || $("#lname").val() == "" || $("#contact").val() == "" || $("#school").val() == "" || $("#course").val() == "" || $("#major").val() == ""  || $("#yrGrad").val() == ""){
			if($("#fname").val() == "" && $("#lname").val() == ""){
				$("#create-name-msg").html("* First name and last name are required.");
				$("#create-name-msg").css("display","block");
			}
			else if($("#fname").val() != "" && $("#lname").val() == ""){
				$("#create-name-msg").html("* Last name is required.");
				$("#create-name-msg").css("display","block");	
			}
			else if($("#fname").val() == "" && $("#lname").val() != ""){
				$("#create-name-msg").html("* First name is required.");
				$("#create-name-msg").css("display","block");	
			}
			else{
				$("#create-name-msg").css("display","none");	
			}

			if($("#contact").val() == ""){
				$("#create-contact-msg").html("* Contact number is required.");
				$("#create-contact-msg").css("display","block");
			}
			else{
				$("#create-contact-msg").css("display","none");
			}

			if($("#school").val() == ""){
				$("#create-school-msg").html("* School is required");
				$("#create-school-msg").css("display","block");
			}
			else{
				$("#create-school-msg").css("display","none");
			}

			if($("#course").val() == ""){
				$("#create-course-msg").html("* Course is required");
				$("#create-course-msg").css("display","block");
			}
			else{
				$("#create-course-msg").css("display","none");
			}

			if($("#major").val() == ""){
				$("#create-major-msg").html("* Major is required");
				$("#create-major-msg").css("display","block");
			}
			else{
				$("#create-major-msg").css("display","none");
			}

			if($("#yrGrad").val() == ""){
				$("#create-yrGrad-msg").html("* Year Grad. is required");
				$("#create-yrGrad-msg").css("display","block");
			}
			else{
				$("#create-yrGrad-msg").css("display","none");
			}
		}
		else{
			$("#create-name-msg,#create-contact-msg,#create-school-msg,#create-course-msg,#create-yrGrad-msg").css("display","none");
			
			//Display Preview Form
			$.ajax({
				type: "POST",
				url: "../php/controller/review.php",
				data: {
					i_rid: $("#joinReview-modal").data("id"),
					fname: $("#fname").val(),
					mi: $("#mi").val(),
					lname: $("#lname").val(),
					bdate: $("#bdate").val(),
					address: $("#address").val(),
					contact: $("#contact").val(),
					email: $("#email").val(),
					school: $("#school").val(),
					major: $("#major").val(),
					yrGrad: $("#yrGrad").val(),
					lodge: $("#lodge").val(),
					function: "viewSubmit-form"
				},
				success: function(data){
					console.log(data);
					$("#viewSubmit-modal").modal("show");
					$("#viewForm").html(data);
					
				}
			});
			//$("#viewForm").html("");

			//Submit form
			/*$.ajax({
				type: "POST",
				url: "../php/controller/review.php",
				data: {
					i_rid: $("#joinReview-modal").data("id"),
					fname: $("#fname").val(),
					mi: $("#mi").val(),
					lname: $("#lname").val(),
					bdate: $("#bdate").val(),
					address: $("#address").val(),
					contact: $("#contact").val(),
					email: $("#email").val(),
					school: $("#school").val(),
					course: $("#course").val(),
					major: $("#major").val(),
					yrGrad: $("#yrGrad").val(),
					lodge: $("#lodge").val(),
					function: "submitForm",
				},
				success: function(data){
					alert(data);
					console.log(data);
					/*var x = confirm("Would you like to add more reservation?");
					if(x==true){
						$("#joinReview-modal").find('form').trigger('reset');
	   			 		$("#create-name-msg,#create-contact-msg").css("display","none");
					}
					else{
						$("#joinReview-modal").modal("hide");
					}//till here
				}
			});*/	
		}
		
	});

	$('#joinReview-modal').on('hidden.bs.modal', function () {
	    $(this).find('form').trigger('reset');
	    $("#create-name-msg,#create-contact-msg,#create-school-msg,#create-course-msg,#create-major-msg,#create-yrGrad-msg").css("display","none");
	});

	$("#viewSubmit-modal").on("click","#editForm",function(){
		//alert("You clicked the edit button");
		$("#viewSubmit-modal").modal("hide");
	});



	$("#viewSubmit-modal").on("click","#submitForm",function(){
		//alert("You clicked the edit button");
		var x = confirm("Are you sure you want to submit this form?");
		if(x == true){
			//alert("Form has been submitted");
			$.ajax({
				type: "POST",
				url: "../php/controller/review.php",
				data: {
					i_rid: $("#joinReview-modal").data("id"),
					fname: $("#fname").val(),
					mi: $("#mi").val(),
					lname: $("#lname").val(),
					bdate: $("#bdate").val(),
					address: $("#address").val(),
					contact: $("#contact").val(),
					email: $("#email").val(),
					school: $("#school").val(),
					course: $("#course").val(),
					major: $("#major").val(),
					yrGrad: $("#yrGrad").val(),
					lodge: $("#lodge").val(),
					function: "submitForm",
				},
				success: function(data){
					alert(data);
					console.log(data);
					var y = confirm("Do you want to add more reservation?");
					if(y == true){
						$("#viewSubmit-modal").modal("hide");
						$("#joinReview-modal").find('form').trigger('reset');
					}
					else{
						$("#viewSubmit-modal,#joinReview-modal").modal("hide");
					}
				}
			});
			/*var y = confirm("Do you want to add more reservation?");
			if(y == true){
				$("#viewSubmit-modal").modal("hide");
				$("#joinReview-modal").find('form').trigger('reset');
			}
			else{
				$("#viewSubmit-modal").modal("hide");
				$("#joinReview-modal").modal("hide");
			}*/
		}
		//$("#viewSubmit-modal").modal("hide");
	});

});
