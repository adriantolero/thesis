$(document).ready(function(){
	
	function getCourse(){
		$.ajax({
			type: "POST",
			url: "../../../controller/course.php",
			data:{
				search: $("#searchCourse").val(),
				function: "getCourse"
			},
			success:function(data){
				$("#tbodyCourseList").html(data);
			}
		});
	}

	getCourse();

	$("#searchCourse-btn").click(function(e){
		e.preventDefault();
		getCourse();
	});

	$("#addCourse-toggle").click(function(e){
		e.preventDefault();
		$("#addCourse-modal").modal("show");
	});

	$("#addCourse-modal").on("click","#addCourse-btn",function(e){
		e.preventDefault();
		if($("#addCourse").val() == ""){
			$("#addCourse-msg").html(" * Required");
			$("#addCourse-msg").css("display","block");
		}
		else{
			$("#addCourse-msg").css("display","none");
			$.ajax({
				type: "POST",
				url: "../../../controller/course.php",
				data:{
					course: $("#addCourse").val(),
					function: "createCourse"
				},
				success:function(data){
					alert(data);
					getCourse();
				}
			});
		}
		
	});

	$("#addCourse-modal").on('hidden.bs.modal', function () {
	    $(this).find('form').trigger('reset');
	    $("#addCourse-msg").css("display","none");
	});



	$("#tbodyCourseList").on("click","#viewCourseInfo-toggle",function(e){
		e.preventDefault();
		$("#viewCourse-modal").data("id",$(this).data("id"));
		$.ajax({
			type: "POST",
			url: "../../../controller/course.php",
			data:{
				i_course_id: $(this).data("id"),
				function: "getCourseInfo"
			},
			success:function(data){
				data = jQuery.parseJSON(data);
				$("#viewCourse").val(data.course);
				//$("#tbodyCourseList").html(data);
				$("#viewCourse-modal").modal("show");
			}
		});
		
	});

	$("#viewCourse-modal").on("click",".edit",function(e){
		e.preventDefault();
		$("#viewCourse").attr("disabled",false);
		$("#viewCourse-btn").removeClass("edit").addClass("submit");
		$("#viewCourse-btn").html("<i class='fa fa-save'></i> Update");
	});

	$("#viewCourse-modal").on("click",".submit",function(e){
		e.preventDefault();
		if($("#viewCourse").val() == ""){
			$("#viewCourse-msg").html(" * Required");
			$("#viewCourse-msg").css("display","block");
		}
		else{
			$("#viewCourse-msg").css("display","none");
			$.ajax({
				type: "POST",
				url: "../../../controller/course.php",
				data:{
					i_course_id: $("#viewCourse-modal").data("id"),
					course: $("#viewCourse").val(),
					function: "updateCourse"
				},
				success: function(data){
					alert(data);
					getCourse();
					$("#viewCourse").attr("disabled",true);
					$("#viewCourse-btn").removeClass("submit").addClass("edit");
					$("#viewCourse-btn").html("<i class='fa fa-edit'></i> Edit");
				}
			});
		}

	});

	$("#viewCourse-modal").on('hidden.bs.modal', function () {
	    $(this).find('form').trigger('reset');
	    $("#viewCourse-msg").css("display","none");
	});

	$("#tbodyCourseList").on("click","#deleteCourse",function(e){
		e.preventDefault();
		var x = confirm("Are you sure you want to delete this?");
		if(x==true){
			$.ajax({
				type: "POST",
				url: "../../../controller/course.php",
				data:{
					i_course_id: $(this).data("id"),
					function: "deleteCourse"
				},
				success: function(data){
					alert(data);
					getCourse();
				}
			});
		}
		
	});

	//$("#viewMajorList-modal").modal("show");
	function getMajor(){
		$.ajax({
			type: "POST",
			url: "../../../controller/course.php",
			data: {
				i_course_id: $("#viewMajorList-modal").data("id"),
				search: $("#searchMajor").val(),
				function: "getMajor"
			},
			success: function(data){
				console.log(data);
				$("#tbodyMajorList").html(data);
				$("#viewMajorList-modal").modal("show");
			}
		});
	}

	$("#tbodyCourseList").on("click","#viewMajorList-toggle",function(e){
		e.preventDefault();
		$("#viewMajorList-modal").data("id",$(this).data("id"));
		getMajor();
		
	});

	$("#viewMajorList-modal").on("click","#searchMajor-btn",function(e){
		e.preventDefault();
		getMajor();
	});

	$("#viewMajorList-modal").on("click","#addMajor-toggle",function(e){
		e.preventDefault();
		$("#addMajor-modal").data("id",$("#viewMajorList-modal").data("id"));
		$("#addMajor-modal").modal("show");
	});

	$("#viewMajorList-modal").on('hidden.bs.modal', function () {
	    $(this).find('form').trigger('reset');
	});

	$("#addMajor-modal").on("click","#addMajor-btn",function(e){
		e.preventDefault();
		if($("#addMajor").val() == ""){
			$("#addMajor-msg").html(" * Required");
			$("#addMajor-msg").css("display","block");
		}
		else{
			$("#addMajor-msg").css("display","none");
			$.ajax({
				type: "POST",
				url: "../../../controller/course.php",
				data: {
					i_course_id: $("#addMajor-modal").data("id"),
					major: $("#addMajor").val(),
					function: "createMajor"
				},
				success: function(data){
					alert(data);
					getMajor();
				}
			});
		}
		
	});

	$("#addMajor-modal").on('hidden.bs.modal', function () {
	    $(this).find('form').trigger('reset');
	    $("#addMajor-msg").css("display","none");
	});

	$("#viewMajorList-modal").on("click","#viewMajor-toggle",function(e){
		e.preventDefault();
		$("#viewMajor-modal").data("id",$(this).data("id"));
		$.ajax({
			type: "POST",
			url: "../../../controller/course.php",
			data: {
				i_mid: $(this).data("id"),
				function: "getMajorInfo"
			},
			success: function(data){
				data = jQuery.parseJSON(data);
				console.log(data);
				$("#viewMajor").val(data.major);
				$("#viewMajor-modal").modal("show");
			}
		});
	});

	$("#viewMajor-modal").on("click",".edit",function(e){
		e.preventDefault();
		$("#viewMajor").attr("disabled",false);
		$("#viewMajor-btn").removeClass("edit").addClass("submit");
		$("#viewMajor-btn").html("<i class='fa fa-save'> Update</i>");
	});

	$("#viewMajor-modal").on("click",".submit",function(e){
		e.preventDefault();
		if($("#viewMajor").val() == ""){
			$("#viewMajor-msg").html(" * Required");
			$("#viewMajor-msg").css("display","block");
		}
		else{
			$("#viewMajor-msg").css("display","none");
			$.ajax({
				type: "POST",
				url: "../../../controller/course.php",
				data:{
					i_mid: $("#viewMajor-modal").data("id"),
					major: $("#viewMajor").val(),
					function: "updateMajor"
				},
				success: function(data){
					alert(data);
					getMajor();
					$("#viewMajor").attr("disabled",true);
					$("#viewMajor-btn").removeClass("submit").addClass("edit");
					$("#viewMajor-btn").html("<i class='fa fa-edit'> Edit</i>");
				}
			});
		}
			
	});

	$("#viewMajorList-modal").on("click","#deleteMajor",function(e){
		e.preventDefault();
		var x = confirm("Are you sure you want to delete this?");
		if(x==true){
			$.ajax({
				type: "POST",
				url: "../../../controller/course.php",
				data:{
					i_mid: $(this).data("id"),
					function: "deleteMajor"
				},
				success: function(data){
					alert(data);
					getMajor();
				}
			});
		}
	});

});