$(document).ready(function(){

	/*********************************
				LOGOUT
    **********************************/
	$("#logout-btn").click(function(){
        $.ajax({
            type: "POST",
            url: "../../controller/subQueries.php",
            data: {function: "logout"},
            success: function(data){
                if(data==1){
                    window.location.href = "../../index.php";
                }
                else{
                	console.log(data);
                }
            },
            error: function(data){
                alert(data);
            }
        });
    });

    function getReview(){
    	$.ajax({
            type: "POST",
            url: "../../controller/reviewReports.php",
            data: {
            	search: $("#searchReview").val(),
            	function: "getReview"
            },
            success: function(data){
               $("#reviewList").html(data);
            },
            error: function(data){
                alert(data);
            }
        });
    }

    getReview();

    $("#searchReview-btn").click(function(e){
    	e.preventDefault();
    	getReview();
    });

    function getReviewReport(){
    	$.ajax({
            type: "POST",
            url: "../../controller/reviewReports.php",
            data: {
            	i_rid: $("#reviewList").val(),
            	/*displayBy: $("#displayBy").val(),
            	displayMonth: $("#displayByMonth").val(),*/
            	function: "getReports"
            },
            success: function(data){
                //console.log(data);
            	data = jQuery.parseJSON(data);
            	$("#printDiv").data("title",data.review_title);
            	$("#printDiv").data("year",data.year);
            	$("#reviewTitle").html(data.review_title + " " + data.year);
               	$("#monthlyReport").html(data.data);
            },
            error: function(data){
                alert(data);
            }
        });
    }

    $("#reviewList").change(function(){
    	if($(this).val() != ""){
    		$("#printDiv").data("id",$(this).val());
	    	$("#reportColumn").css("display","block");
	    	getReviewReport();
    	}
    	else{
    		$("#reportColumn").css("display","none");
    	}
    	
    });

    $("#displayBy").change(function(e){
    	getReviewReport();
    	//e.preventDefault();
    });

    $("#displayByMonth").change(function(e){
    	getReviewReport();
    });

    $("#printBtn-container").on("click","#printBtn",function(e){
		//print();
		e.preventDefault();
		var printDiv = document.getElementById("printDiv").innerHTML;
		var review_title = $("#printDiv").data("title");
		var year = $("#printDiv").data("year");
		var popupwin = window.open("","_blank","width=1000,height=600,location=no,left=150px");
		popupwin.document.open();
		popupwin.document.write("<html><head><title>Summary for " + review_title + " " + year + "" +"</title>");
		popupwin.document.write("<style>@page{size:landscape;}");
		popupwin.document.write("table th, table td {border:1px solid black;padding;0.5em;}");
		popupwin.document.write("table{border-collapse: collapse}</style>");
        popupwin.document.write("<style>");
        popupwin.document.write("img{margin-top:100px;}");
		popupwin.document.write("</style>");
		popupwin.document.write("</head><body onload='window.print()'></body></html>");
		popupwin.document.write(printDiv);
		popupwin.document.write("</html>");
		popupwin.document.close();
		return false;
	});

    /*

    $("#reviewSchedules-open-mdl").click(function(){
    	searchYear();
    });

	function searchYear(){
		$.ajax({
			type: "POST",
			url: "../../controller/reviewReports.php",
			data: {
				search: $("#searchReview").val(),
				function: "getReview"
			},
			success: function(data){
				$("#reviewList-tbl").html(data);
			},
			error: function(data){
				alert(data);
				console.log(data);
			}
		});
	}*/

	/*

	$("#reviewSchedules-modal").on("click","#searchReview-btn",function(){
		searchYear();
	});

	
	$("#reviewSchedules-modal").on("click","#review-btn",function(){
		$("#monthlyReport-card").data("id",$(this).data("id"));
		$.ajax({
			type: "POST",
			url: "../../controller/reviewReports.php",
			data: {
				function: "getMonthlyReports",
				i_rid: $(this).data("id")
			},
			success: function(data){
				data = jQuery.parseJSON(data);
				console.log(data);
				$("#review-desc").html(data.review_desc);
				$("#review-fee-vsu").html(data.review_fee_vsu);
				$("#review-fee-non-vsu").html(data.review_fee_non_vsu);
				$("#monthlyReport").html(data.data);
			}
		});	
	});

	$("#print").click(function(){
		alert($("#monthlyReport-card").data("id"));
		$.ajax({
			type: "POST",
			url: "../../lib/fpdf/"
		});
	});
	*/
	
});
