$(document).ready(function(){
	$('#vw-review-sched-modal').modal('show');
	
    function removeURLParam(){
		var uri = window.location.toString();

		if (uri.indexOf("?") > 0) {

		    var clean_uri = uri.substring(0, uri.indexOf("?"));

		    window.history.replaceState({}, document.title, clean_uri);

		}
	}

	removeURLParam();

	$("#searchReview-open-mdl").click(function(){
		$("#close-createReview").css("display","block");
	})

	function getReviewSched(search){

		$.ajax({
			type: "POST",
			url: "../../controller/reviewBilling.php",
			data: {
				search: search,
				function: "searchReview"
			},
			success: function(data){
				$("#reviewList-tbl").html(data);
			},
			error: function(data){
				alert(data);
			}
		});
		//alert(search);
	}

	getReviewSched("");

	$("#vw-review-sched-modal").on("click","#searchReview-btn",function(e){
		e.preventDefault();
		getReviewSched($("#searchReview").val());
	});

	$("#searchReview-open-mdl").click(function(){
		getReviewSched($("#searchReview").val());
	});

	$("#searchReview-open-mdl").click(function(){
		$("#searchReview").val("");
		getReviewSched("");
	});


	function getReviewer(i_rid,search){
		$.ajax({
			type: "POST",
			url: "../../controller/reviewBilling.php",
			data: {
				i_rid: i_rid,
				search: search,
				function: "searchReviewer"
			},
			success: function(data){
				console.log(data);
				//alert(data);
				$("#vw-review-sched-modal").modal("hide");
				$("#reviewerList").html(data);
			},
			error: function(data){
				alert(data);
			}
		});
		
	}
 
	//getReviewer("");

	function updateURL(i_rid){
		if(history.pushState){
			var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?i_rid=' + i_rid;
			window.history.pushState({path:newurl},'',newurl);
		}
	}

	$.urlParam = function(name){
		var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
		if(results==null){
			return null;
		}
		else{
			return decodeURI(results[1]) || 0;
		}
	}

	$("#searchReviewer-btn").click(function(e){
		e.preventDefault();
		getReviewer($.urlParam('i_rid'),$("#searchReviewer").val());
	});

	$("#vw-review-sched-modal").on("click","#selectReview-btn",function(){
		updateURL($(this).data("id"));
		//alert($.urlParam('i_rid'));
		//alert($(this).data("id"));
		$("#invoice_info").css("display","none");
		$("#searchReviewer").val("");
		getReviewer($.urlParam('i_rid'),"");
	});

	/*function getSchool(){
		$.ajax({
			type: "POST",
			url: "../../controller/reviewBilling.php",
			data:{
				/*i_rev_id: $("#reviewerList").val(),
				function: "getSchool"
			},
			success: function(data){
				//console.log(data);
				$("#bill_school").html(data);
			}
		});
	}*/

	function getReviewerInfo(){
		$.ajax({
			type: "POST",
			url: "../../controller/reviewBilling.php",
			data:{
				i_rev_id: $("#invoice_info").data("id"),
				function: "getInfo"
			},
			success: function(data){
				data = jQuery.parseJSON(data);
				console.log(data);
				$("#bill_name").val(data.name);
				$("#bill_school").val(data.school_name);
				$("#bill_review_title").val(data.review_title);
				$("#bill_review_fee").val(data.review_fee);
				$("#bill_review_fee").data("fee",data.review_fee_hidden);
				
				if(data.school_name == null || data.school_name == ""){
					$("#open-bill-modal").attr("disabled",true);
				}
				else{
					$("#open-bill-modal").attr("disabled",false);
				}
				getReviewerBill();
				
			}
		});
	}

	function getReviewerBill(){
		$.ajax({
			type: "POST",
			url: "../../controller/reviewBilling.php",
			data:{
				i_rev_id: $("#invoice_info").data("id"),
				fee: $("#bill_review_fee").data("fee"),
				function: "getBills"
			},
			success: function(data){
				data = jQuery.parseJSON(data);
				console.log(data);
				$("#billLists").html(data.data);
				$("#total-amount").val(data.total);
				$("#remaining-bal").val(data.balance);
				/*data = jQuery.parseJSON(data);
				$("#invoice_info").css("display","block");
				$("#bill_name").html(data.name);
				$("#bill_school").html(data.school);
				$("#bill_review_title").html(data.review_title);
				$("#bill_review_fee").html(data.review_fee);
				$("#billLists").html(data.data);
				$("#total-amount").html(data.total);
				$("#remaining-bal").html(data.balance);
				$("#open-bill-modal").data("id",$("#reviewerList").val());
				*/
				
			},
			error: function(data){
				//console.log(data);
			}
		});
	}

	$("#reviewerList").change(function(){
		if($(this).val() != ""){
			$("#invoice_info").data("id",$(this).val());
			$("#invoice_info").css("display","block");
			getReviewerInfo();
		}	
	});
	

	

	/*************************
			DATETIME PICKER
	**************************/
	$("#add-date-paid,#edit-date-paid").datetimepicker({
    	timepicker: false,
    	format: 'Y-m-d',
    	formatDate: 'Y-m-d'
    });

	/*************************
			Add Bill
	**************************/

	$("#open-bill-modal").click(function(){	
			$("#add-bill-modal").modal("show");
			$("#add-bill-modal").data("id",$("#invoice_info").data("id"));
	});

	$("#add-bill-modal").on("keypress","#add-or-num",function(e){
		var regex = new RegExp("^[0-9]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#add-bill-modal").on("keypress","#add-amount-paid",function(e){
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

	$("#add-bill-modal").on("keypress","#add-date-paid",function(e){
		if(e.keyCode !== 8) {
	        e.preventDefault();
	    }
	});
	

	$("#add-bill-modal").on("click","#add-bill-btn",function(e){
		e.preventDefault();

		if($("#add-description").val() == "" || $("#add-or-num").val() == "" || $("#add-amount-paid").val() == "" || $("#add-date-paid").val() == ""){
			if($("#add-description").val() == ""){
				$("#add-description-msg").css("display","block");
			}
			else{
				$("#add-description-msg").css("display","none");
			}
			if($("#add-or-num").val() == ""){
				$("#add-or-num-msg").css("display","block");
			}
			else{
				$("#add-or-num-msg").css("display","none");
			}
			if($("#add-amount-paid").val() == ""){
				$("#add-amount-paid-msg").css("display","block");
			}
			else{
				$("#add-amount-paid-msg").css("display","none");
				/*if($("#add-amount-paid").val() == 0){
					$("#add-amount-paid-msg").html("* Cannot enter 0 value.");
				}
				else{
					$("#add-amount-paid-msg").html("");
				}*/
			}
			if($("#add-date-paid").val() == ""){
				$("#add-date-paid-msg").css("display","block");
			}
			else{
				$("#add-date-paid-msg").css("display","none");
			}
		}
		else{
			$("#add-description-msg,#add-or-num-msg,#add-amount-paid-msg,#add-date-paid-msg").css("display","none");
		//alert($("#add-or-num").val() + $("#add-amount-paid").val() + $("#add-date-paid").val());
			$.ajax({
				type: "POST",
				url: "../../controller/reviewBilling.php",
				data: {
					i_rid: $.urlParam('i_rid'),
					i_rev_id: $("#add-bill-modal").data("id"),
					description: $("#add-description").val(),
					or_num: $("#add-or-num").val(),
					amount_paid: $("#add-amount-paid").val(),
					date_paid: $("#add-date-paid").val(),
					function: "addBill"
				},
				success: function(data){
					console.log(data);
					
					if(data == "This reviewee has 0 balance." || data == "The payment you input exceeds the remaining balance."){
						alert(data);
					}
					else{
						alert(data);
						getReviewerBill();
						$("#add-bill-modal").modal("hide");
					}
					
					/*var x = confirm("Would you like to record another bill?");
					if(x==true){
						$("#add-bill-modal").find('form').trigger('reset');
						$("#add-description-msg,#add-or-num-msg,#add-amount-paid-msg,#add-date-paid-msg").css("display","none");
					}
					else{
						$("#add-bill-modal").modal("hide");
					}*/
				},
				error: function(data){
					console.log(data);
				}
			});
		}
	});



	$('#add-bill-modal').on('hidden.bs.modal', function () {
	    $(this).find('form').trigger('reset');
	    $("#add-description-msg,#add-or-num-msg,#add-amount-paid-msg,#add-date-paid-msg").css("display","none");
	});













	/**********************************
					Edit Bill

	************************************/



	$("#billLists").on("click","#editBill-btn",function(){
		//alert("Edit button clicked having a value of " + $(this).data("id"));
		$("#edit-bill-modal").data("id",$("#invoice_info").data("id"));
		$.ajax({
			type: "POST",
			url: "../../controller/reviewBilling.php",
			data:{
				bill_id: $(this).data("id"),
				function: "getBill"
			},
			success: function(data){
				data = jQuery.parseJSON(data);
				$("#edit-description").val(data.description);
				$("#edit-or-num").val(data.or_num);
				$("#edit-amount-paid").val(data.amount_paid);
				$("#edit-date-paid").val(data.date_paid);
				$("#edit-bill-btn").data("id",data.pay_id);
			},
			error: function(data){

			}
		});
	});

	$("#edit-bill-modal").on("keypress","#edit-or-num",function(e){
		var regex = new RegExp("^[0-9]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if(regex.test(str)){
			return true;
		}
		else{
			return false;
		}
	});

	$("#edit-bill-modal").on("keypress","#edit-amount-paid",function(e){
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

	$("#edit-bill-modal").on("keypress","#edit-date-paid",function(e){
		if(e.keyCode !== 8) {
	        e.preventDefault();
	    }
	});

	$("#edit-bill-modal").on("click","#edit-bill-btn",function(){
		//alert($(this).data("id"));
		if($("#edit-description").val() == "" || $("#edit-or-num").val() == "" || $("#edit-amount-paid").val() == "" || $("#edit-date-paid").val() == ""){
			if($("#edit-description").val() == ""){
				$("#edit-description-msg").css("display","block");
			}
			else{
				$("#edit-description-msg").css("display","none");
			}
			if($("#edit-or-num").val() == ""){
				$("#edit-or-num-msg").css("display","block");
			}
			else{
				$("#edit-or-num-msg").css("display","none");
			}
			if($("#edit-amount-paid").val() == ""){
				$("#edit-amount-paid-msg").css("display","block");
			}
			else{
				$("#edit-amount-paid-msg").css("display","none");
				/*if($("#add-amount-paid").val() == 0){
					$("#add-amount-paid-msg").html("* Cannot enter 0 value.");
				}
				else{
					$("#add-amount-paid-msg").html("");
				}*/
			}
			if($("#edit-date-paid").val() == ""){
				$("#edit-date-paid-msg").css("display","block");
			}
			else{
				$("#edit-date-paid-msg").css("display","none");
			}
		}
		else{
			$("#edit-description-msg,#edit-or-num-msg,#edit-amount-paid-msg,#edit-date-paid-msg").css("display","none");
			$.ajax({
				type: "POST",
				url: "../../controller/reviewBilling.php",
				data:{
					bill_id: $(this).data("id"),
					i_rid: $.urlParam('i_rid'),
					i_rev_id: $("#edit-bill-modal").data("id"),
					/*i_rid: $.urlParam('i_rid'),
					i_rev_id: $("#open-bill-modal").data("id"),
					*/
					description: $("#edit-description").val(),
					or_num: $("#edit-or-num").val(),
					amount_paid: $("#edit-amount-paid").val(),
					date_paid: $("#edit-date-paid").val(),
					function: "updateBill"
				},
				success: function(data){
					alert(data);
					if(data == "This reviewee has 0 balance." || data == "The payment you input exceeds the remaining balance."){

					}
					else{
						getReviewerBill();
						$("#edit-bill-modal").modal("hide");
					}
				},
				error: function(data){
					console.log(data);
				}
			});
		}
	});

	$('#edit-bill-modal').on('hidden.bs.modal', function () {
	    $(this).find('form').trigger('reset');
	    $("#edit-description-msg,#edit-or-num-msg,#edit-amount-paid-msg,#edit-date-paid-msg").css("display","none");
	});









	/**********************************
					Delete Bill

	************************************/

	$("#billLists").on("click","#deleteBill-btn",function(){
		var x = confirm("Are you sure you want to delete this?");
		if (x==true){
			$.ajax({
				type: "POST",
				url: "../../controller/reviewBilling.php",
				data:{
					bill_id: $(this).data("id"),
					function: "deleteBill"
				},
				success: function(data){
					alert(data);
					getReviewerBill();
				},
				error: function(data){
					console.log(data);
				}
			});
		}
	});

	$("#open-bill-modal-cont").on("click","#print-bill",function(e){

		window.open("print/printBill.php?i_rev_id=" + $("#invoice_info").data("id") + "&i_rid=" + $.urlParam("i_rid") ,"_blank","width=1000,height=500,location=no,left=200px");
	});

	/*
	function print(){
		//Get the print button and put it into a variable
        var printButton = document.getElementById("printBill");
        //Set the print button visibility to 'hidden' 
        printButton.style.visibility = 'hidden';
        //Print the page content
        window.print()
        printButton.style.visibility = 'visible';
	}

	$("#printBill").click(function(){
		print();
	});
	*/


	//getReviewSched($("#searchReview").val());
});