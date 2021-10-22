$(document).ready(function(){

	function getData(){
		$.ajax({
			type: "POST",
			url: "../controller/profile.php",
			data:{
				function: "getProfile"
			},
			success:function(data){
				data = jQuery.parseJSON(data);
				console.log(data);
				$("#card-profile").data("id",data.emp_id);
				$("#fname").val(data.fname);
				$("#mi").val(data.mi);
				$("#lname").val(data.lname);
				//$("#username").val(data.username);
				$("#password").val(data.password);
			}
		});
	}

	getData();

	$("#editProfile-wrapper").on("click",".edit",function(e){
		e.preventDefault();
		$("#fname,#mi,#lname,#username,#password,#showpassword").attr("disabled",false);
		$("#editProfile").removeClass("edit").addClass("submit");
		$("#editProfile").html("<i class='fa fa-save'> Update</i>");
	});

	$('.form-check').on("click","#showpassword",function(){
     	//alert($(this).is(':checked'));
        $(this).is(':checked') ? $('#password').attr('type', 'text') : $('#password').attr('type', 'password');
    });

    $("#card-profile").on("keypress","#fname",function(e){
		var regex = new RegExp("^[A-Za-z,. ]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#card-profile").on("keypress","#mi",function(e){
		var regex = new RegExp("^[A-Za-z,. ]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#card-profile").on("keypress","#lname",function(e){
		var regex = new RegExp("^[A-Za-z,. ]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#editProfile-wrapper").on("click",".submit",function(e){
		e.preventDefault();

		if($("#fname").val() == "" || $("#lname").val() == "" || $("#password").val() == ""){
			if($("#fname").val() == "" && $("#lname").val() == ""){
				$("#update-name-msg").html("* First name and Last name is required");
				$("#update-name-msg").css("display","block");
			}
			else if($("#fname").val() == ""){
				$("#update-name-msg").html("* First name is required");
				$("#update-name-msg").css("display","block");
			}
			else if($("#lname").val() == ""){
				$("#update-name-msg").html("* Last name is required");
				$("#update-name-msg").css("display","block");
			}
			else{
				$("#update-name-msg").css("display","none");
			}

			if($("#password").val()== ""){
				$("#update-password-msg").html("* Password is required.");
				$("#update-password-msg").css("display","block");
			}
			else{
				$("#update-password-msg").css("display","none");
			}
		}
		else{
			$("#update-name-msg,#update-password-msg").css("display","none");
			$.ajax({
				type: "POST",
				url: "../controller/profile.php",
				data: {
					i_emp_id: $("#card-profile").data("id"),
					fname: $("#fname").val(),
					mi: $("#mi").val(),
					lname: $("#lname").val(),
					password: $("#password").val(),
					function: "updateProfile"
				},
				success: function(data){
					alert(data);
					$("#fname,#mi,#lname,#username,#password,#showpassword").attr("disabled",true);
					$("#password").attr("type","password");
					$("#showpassword").prop("checked",false);
					$("#editProfile").removeClass("submit").addClass("edit");
					$("#editProfile").html("<i class='fa fa-edit'> Edit</i>");
				}
			});
		}
		
		
		
	});

	/*
	function readURL(input) {

	  if (input.files && input.files[0]) {
	    var reader = new FileReader();

	    reader.onload = function(e) {
	      $('#myPhoto').attr('src', e.target.result);
	    }

	    reader.readAsDataURL(input.files[0]);
	  }
	}*/

	/*
	$(".card-body").on("click",".uploadPhoto",function(e){
		e.preventDefault();
		$("#file").click();
	});

	$(".card-body").on("change","#file",function(e){
		readURL(this);
		$("#uploadPhoto").removeClass("uploadPhoto").addClass("submitPhoto");
		$("#uploadPhoto").html("<i class='fa fa-save'> Save</i>")
	});

	$(".card-body").on("click",".submitPhoto",function(e){
		$.ajax({
			type: "POST",
			url: "../controller/profile.php",
			data:{
				
			}
		});
		$("#uploadPhoto").removeClass("submitPhoto").addClass("uploadPhoto");
		$("#uploadPhoto").html("<i class='fa fa-upload'> Upload</i>")
	});*/

	$("").on("click",".editName",function(e){
		e.preventDefault();
		$("#fname,#mi,#lname").attr("disabled",false);
		$("#editName").removeClass("editName").addClass("submitName");
		$("#editName").html("<i class='fa fa-save'></i>")
	});

	$(".card-body").on("click",".submitName",function(e){
		alert("SUBMITTED");
		e.preventDefault();
		$("#fname,#mi,#lname").attr("disabled",true);
		$("#editName").removeClass("submitName").addClass("editName");
		$("#editName").html("<i class='fa fa-edit'></i>")
	});

	$(".card-body").on("click",".editPassword",function(e){
		e.preventDefault();
		$("#collapsePassword").collapse("show");
	});

});