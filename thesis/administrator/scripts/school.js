$(document).ready(function(){

	function getSchool(){
		$.ajax({
			type: "POST",
			url: "../../../controller/school.php",
			data:{
				schoolName: $("#searchSchool").val(),
				function: "getSchool"
			},
			success: function(data){
				$("#tbodySchoolList").html(data);
				console.log(data);
			}
		});
	}

	getSchool();

	$("#searchSchool-btn").click(function(e){
		e.preventDefault();
		getSchool();
	});

	$("#addSchool-toggle").click(function(e){
		e.preventDefault();
		$("#addSchool-modal").modal("show");
	});

	$("#addSchool-modal").on("click","#addSchool-btn",function(e){
		e.preventDefault();
		if($("#addSchool").val() == "" || $("#addSchoolAddress").val() == ""){
			if($("#addSchool").val() == ""){
				$("#addSchool-msg").html("* School name is required.");
				$("#addSchool-msg").css("display","block");
			}
			else{
				$("#addSchool-msg").css("display","none");
			}

			if($("#addSchoolAddress").val() == ""){
				$("#addSchoolAddress-msg").html("* School address is required.");
				$("#addSchoolAddress-msg").css("display","block");
			}
			else{
				$("#addSchoolAddress-msg").css("display","none");
			}
		}
		else{
			$.ajax({
				type: "POST",
				url: "../../../controller/school.php",
				data:{
					schoolName: $("#addSchool").val(),
					schoolAddress: $("#addSchoolAddress").val(),
					schoolType: $("#addSchoolType").val(),
					function: "addSchool"
				},
				success: function(data){
					alert(data);
					getSchool();
				}
			});
		}
		
	});

	$("#addSchool-modal").on('hidden.bs.modal', function () {
	    $(this).find('form').trigger('reset');
	    $("#addSchool-msg,#addSchoolAddress-msg").css("display","none");
	});

	$("#tbodySchoolList").on("click","#editSchool",function(e){
		$("#viewSchool-modal").data("id",$(this).data("id"));
		$.ajax({
			type: "POST",
			url: "../../../controller/school.php",
			data:{
				i_sid: $("#viewSchool-modal").data("id"),
				function: "getSchoolInfo"
			},
			success: function(data){
				data = jQuery.parseJSON(data);
				$("#viewSchool").val(data.schoolName);
				$("#viewSchoolAddress").val(data.schoolAddress);
				$("#viewSchoolType").val(data.schoolType);
				//alert(data);
				//getSchool();
				$("#viewSchool-modal").modal("show");
			}
		});
		
	});

	$("#viewSchool-modal").on("click",".edit",function(e){
		e.preventDefault();
		$("#viewSchool,#viewSchoolAddress,#viewSchoolType").attr("disabled",false);
		$("#viewSchool-btn").removeClass("edit").addClass("submit");
		$("#viewSchool-btn").html("<i class='fa fa-save'></i> Update");
	});

	$("#viewSchool-modal").on("click",".submit",function(e){
		e.preventDefault();
		if($("#viewSchool").val() == "" || $("#viewSchoolAddress").val() == ""){
			if($("#viewSchool").val() == ""){
				$("#viewSchool-msg").html("* School name is required.");
				$("#viewSchool-msg").css("display","block");
			}
			else{
				$("#viewSchool-msg").css("display","none");
			}

			if($("#viewSchoolAddress").val() == ""){
				$("#viewSchoolAddress-msg").html("* School address is required.");
				$("#viewSchoolAddress-msg").css("display","block");
			}
			else{
				$("#viewSchoolAddress-msg").css("display","none");
			}
		}
		else{
			$.ajax({
				type: "POST",
				url: "../../../controller/school.php",
				data:{
					i_sid: $("#viewSchool-modal").data("id"),
					schoolName: $("#viewSchool").val(),
					schoolAddress: $("#viewSchoolAddress").val(),
					schoolType: $("#viewSchoolType").val(),
					function: "updateSchool"
				},
				success: function(data){
					alert(data);
					getSchool();
					$("#viewSchool,#viewSchoolAddress,#viewSchoolType").attr("disabled",true);
					$("#viewSchool-btn").removeClass("submit").addClass("edit");
					$("#viewSchool-btn").html("<i class='fa fa-edit'></i> Edit");
				}
			});
			
		}
		
	});

	$("#viewSchool-modal").on('hidden.bs.modal', function () {
	    $(this).find('form').trigger('reset');
	    $("#viewSchool-msg,#viewSchoolAddress-msg").css("display","none");
	});

	$("#tbodySchoolList").on("click","#deleteSchool",function(e){
		e.preventDefault();
		var x = confirm("Are you sure you want to delete this?");
		if(x == true){
			$.ajax({
				type: "POST",
				url: "../../../controller/school.php",
				data:{
					i_sid: $(this).data("id"),
					function: "deleteSchool"
				},
				success: function(data){
					alert(data);
					getSchool();
				}
			});
		}
	});

});