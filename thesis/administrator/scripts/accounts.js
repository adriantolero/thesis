$(document).ready(function () {

	/* Trying to update this into the github :) */

	
	function getAccounts(){
		$.ajax({
			type: "POST",
			url: "../../controller/accounts.php",
			data:{
				search: $("#searchInput").val(),
				category: $("#searchCategory").data("id"),
				function: "getAccounts"
			},
			success:function(data){
				$("#tbodyEmployee").html(data);
				console.log(data);
			}
		});
	}
	
	getAccounts();

	$("#searchBy-username").click(function(e){
		e.preventDefault();
		$("#searchCategory").data("id",1);
		$("#searchInput").attr("placeholder","username");
	});

	$("#searchBy-firstname").click(function(e){
		e.preventDefault();
		$("#searchCategory").data("id",2);
		$("#searchInput").attr("placeholder","first name");
	});

	$("#searchBy-lastname").click(function(e){
		e.preventDefault();
		$("#searchCategory").data("id",3);
		$("#searchInput").attr("placeholder","last name");
	});

	$("#searchBtn").click(function(e){
		e.preventDefault();
		getAccounts();
		/*$.ajax({
			type: "POST",
			url: "../../controller/accounts.php",
			data:{
				function: "getAccounts"
			},
			success:function(data){
				$("#tbodyEmployee").html(data);
				console.log(data);
			}
		});*/
	});

	$("#createAccount-toggle-modal").click(function(e){
		e.preventDefault();
		$("#createAccount-modal").modal("show");
	});

	$('#createAccount-modal').on("click","#create-showpassword",function(){
     	//alert($(this).is(':checked'));
        $(this).is(':checked') ? $('#create-password').attr('type', 'text') : $('#create-password').attr('type', 'password');
    });

    $("#createAccount-modal").on("keypress","#create-fname",function(e){
		var regex = new RegExp("^[A-Za-z,. ]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#createAccount-modal").on("keypress","#create-mi",function(e){
		var regex = new RegExp("^[A-Za-z. ]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#createAccount-modal").on("keypress","#create-lname",function(e){
		var regex = new RegExp("^[A-Za-z,. ]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#createAccount-modal").on("click","#create-account-submit-btn",function(e){
		e.preventDefault();

		if($("#create-username").val() == "" || $("#create-password").val() == "" || $("#create-fname").val() == "" || $("#create-lname").val() == ""){
			if($("#create-username").val() == ""){
				$("#create-username-msg").html("* Required");
				$("#create-username-msg").css("display","block");
			}
			else{
				$("#create-username-msg").css("display","none");
			}

			if($("#create-password").val() == ""){
				$("#create-password-msg").html("* Required");
				$("#create-password-msg").css("display","block");
			}
			else{
				$("#create-password-msg").css("display","none");
			}

			if($("#create-fname").val() == "" && $("#create-lname").val() == ""){
				$("#create-name-msg").html("* First name and Last name are required");
				$("#create-name-msg").css("display","block");
			}
			else if($("#create-fname").val() == "" && $("#create-lname").val() != ""){
				$("#create-name-msg").html("* First name is required");
				$("#create-name-msg").css("display","block");
			}

			else if($("#create-fname").val() != "" && $("#create-lname").val() == ""){
				$("#create-name-msg").html("* Last name is required");
				$("#create-name-msg").css("display","block");
			}
			else{
				$("#create-name-msg").css("display","none");
			}
		}
		else{
			$("#create-username-msg,#create-password-msg,#create-name-msg").css("display","none");
			$.ajax({
				type: "POST",
				url: "../../controller/accounts.php",
				data:{
					username :$("#create-username").val(),
					password: $("#create-password").val(),
					fname : $("#create-fname").val(),
					mi: $("#create-mi").val(),
					lname: $("#create-lname").val(),
					function: "createAccount"
				},
				success: function(data){
					alert(data);
					if(data == "Username is already taken."){

					}
					else{
						getAccounts();
						$("#createAccount-modal").modal("hide");
					}
					
				}
			});
		}
		
	});

	$("#createAccount-modal").on('hidden.bs.modal', function () {
	    $(this).find('form').trigger('reset');
	    $("#create-username-msg,#create-password-msg,#create-name-msg").css("display","none");
	});

	$("#tbodyEmployee").on("click","#editUser",function(e){
		e.preventDefault();
		$.ajax({
				type: "POST",
				url: "../../controller/accounts.php",
				data:{
					i_emp_id: $(this).data("id"),
					function: "getUserInfo"
				},
				success: function(data){
					data = jQuery.parseJSON(data);
					console.log(data);
					$("#editAccount-modal").data("id",data.i_emp_id);
					$("#edit-username").val(data.username);
					$("#edit-password").val(data.password);
					$("#edit-lname").val(data.lname);
					$("#edit-fname").val(data.fname);
					$("#edit-mi").val(data.mi);
					$("#editAccount-modal").modal("show");
					//getAccounts();
				}
			});
		//$("#editAccount-modal").modal("show");
	});

	$('#editAccount-modal').on("click","#edit-showpassword",function(){
     	//alert($(this).is(':checked'));
        $(this).is(':checked') ? $('#edit-password').attr('type', 'text') : $('#edit-password').attr('type', 'password');
    });

    $("#editAccount-modal").on("click",".edit",function(e){
    	e.preventDefault();
    	$("#edit-username,#edit-password,#edit-fname,#edit-lname,#edit-mi,#edit-showpassword").attr("disabled",false);
    	$("#edit-account-submit-btn").removeClass("edit").addClass("submit");
    	$("#edit-account-submit-btn").html("<i class='fa fa-save'> Submit</i>");

    });

    $("#editAccount-modal").on("keypress","#edit-fname",function(e){
		var regex = new RegExp("^[A-Za-z,. ]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#editAccount-modal").on("keypress","#edit-mi",function(e){
		var regex = new RegExp("^[A-Za-z. ]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#editAccount-modal").on("keypress","#edit-lname",function(e){
		var regex = new RegExp("^[A-Za-z,. ]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

    $("#editAccount-modal").on("click",".submit",function(e){
    	e.preventDefault();
    	if($("#edit-username").val() == "" || $("#edit-password").val() == "" || $("#edit-fname").val() == "" || $("#edit-lname").val() == ""){
			if($("#edit-username").val() == ""){
				$("#edit-username-msg").html("* Required");
				$("#edit-username-msg").css("display","block");
			}
			else{
				$("#edit-username-msg").css("display","none");
			}

			if($("#edit-password").val() == ""){
				$("#edit-password-msg").html("* Required");
				$("#edit-password-msg").css("display","block");
			}
			else{
				$("#edit-password-msg").css("display","none");
			}

			if($("#edit-fname").val() == "" && $("#edit-lname").val() == ""){
				$("#edit-name-msg").html("* First name and Last name are required");
				$("#edit-name-msg").css("display","block");
			}
			else if($("#edit-fname").val() == "" && $("#edit-lname").val() != ""){
				$("#edit-name-msg").html("* First name is required");
				$("#edit-name-msg").css("display","block");
			}

			else if($("#edit-fname").val() != "" && $("#edit-lname").val() == ""){
				$("#edit-name-msg").html("* Last name is required");
				$("#edit-name-msg").css("display","block");
			}
			else{
				$("#edit-name-msg").css("display","none");
			}
		}
		else{
			$("#edit-username-msg,#edit-password-msg,#edit-name-msg").css("display","none");
			$.ajax({
				type: "POST",
				url: "../../controller/accounts.php",
				data:{ 
					i_emp_id: $("#editAccount-modal").data("id"),
					username: $("#edit-username").val(),
					password: $("#edit-password").val(),
					fname: $("#edit-fname").val(),
					lname: $("#edit-lname").val(),
					mi: $("#edit-mi").val(),
					function: "updateUserInfo"
				},
				success: function(data){
					alert(data);
					if(data == "Username is already taken."){

					}
					else{
						$("#edit-showpassword").prop("checked",false);
						$("#edit-password").attr("type","password");
						$("#edit-username,#edit-password,#edit-fname,#edit-lname,#edit-mi,#edit-showpassword").attr("disabled",true);
				    	$("#edit-account-submit-btn").removeClass("submit").addClass("edit");
				    	$("#edit-account-submit-btn").html("<i class='fa fa-edit'> Edit</i>");
					}
					getAccounts();
					
				}
			});
			
		}
    });

    $("#editAccount-modal").on('hidden.bs.modal', function () {
	    $(this).find('form').trigger('reset');
	    $("#edit-username,#edit-password,#edit-fname,#edit-lname,#edit-mi,#edit-showpassword").attr("disabled",true);
	    $('#edit-password').attr('type', 'password');
	    $("#edit-username-msg,#edit-password-msg,#edit-name-msg").css("display","none");
	    $("#edit-account-submit-btn").removeClass("submit").addClass("edit");
		$("#edit-account-submit-btn").html("<i class='fa fa-edit'> Edit</i>");
	});

	$("#tbodyEmployee").on("click","#deleteUser",function(e){
		e.preventDefault();

		var x = confirm("Are you sure you want to delete this?");
		if(x == true){
			$.ajax({
				type: "POST",
				url: "../../controller/accounts.php",
				data:{
					i_emp_id: $(this).data("id"),
					function: "deleteUser"
				},
				success: function(data){
					alert(data);
					getAccounts();
				}
			});
		}

	});

});