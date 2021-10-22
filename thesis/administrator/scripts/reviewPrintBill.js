$(document).ready(function(){

	$.urlParam = function(name){
		var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
		if(results==null){
			return null;
		}
		else{
			return decodeURI(results[1]) || 0;
		}
	}

	function getData(){
		//alert($.urlParam('i_rev_id'));
		$.ajax({
			type: "POST",
			url: "../../../controller/reviewPrintBill.php",
			data:{
				i_rev_id: $.urlParam('i_rev_id'),
				i_rid: $.urlParam("i_rid"),
				function: "getBill"
			},
			success: function(data){
				data = jQuery.parseJSON(data);
				//alert(data);
				$("#reviewTitle").html(data.reviewTitle);
				$("#name").html(data.name);
				$("#school").html(data.school);
				$("#tbodyFee").html(data.data);
				$("#amountPaid").html(data.amount_paid);
				$("#reviewFee").html(data.reviewFee);
				$("#balance").html(data.balance);
				window.print();
			}
		});
	}

	getData();
	
});