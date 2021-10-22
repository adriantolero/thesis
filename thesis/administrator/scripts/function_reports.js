$(document).ready(function(){
	function getReports(){

		$.ajax({
			type: "POST",
			url: "../../controller/functionReports.php",
			data:{
				//displayBy: $("#displayBy").val(),
				function: "getReports"
			},
			success: function(data){
				//data = jQuery.parseJSON(data);
				console.log(data);
				$("#tbodyReports").html(data);
			}
			
		});
		//alert("BLAH");
	}

	getReports();

	$("#displayBy").change(function(e){
		e.preventDefault();
		getReports();
	});


	$("#printBtn-container").on("click","#printBtn",function(e){
		//print();
		e.preventDefault();
		var printDiv = document.getElementById("printDiv").innerHTML;
		var popupwin = window.open("","_blank","width=1000,height=600,location=no,left=150px");
		popupwin.document.open();
		popupwin.document.write("<html><head><title>Summary of CCE Utilization</title>");
		popupwin.document.write("<style>@page{size:landscape;}");
		popupwin.document.write("table th, table td {border:1px solid black;padding;0.5em;}");
		popupwin.document.write("table{border-collapse: collapse}</style>");
		popupwin.document.write("</style>");
		popupwin.document.write("</head><body onload='window.print()'></body></html>");
		popupwin.document.write(printDiv);
		popupwin.document.write("</html>");
		popupwin.document.close();
		return false;
	});

	
	function print() {

		/*var divElements = document.getElementById("printDiv").innerHTML;
		var oldPage = document.body.innerHTML;
		document.body.innerHTML = "<html><head><title>Summary</title></head><body>" + divElements + "</body></html>";
		window.print();
		document.body.innerHTML = oldPage;*/
	    /*var frame = document.getElementsByClassName('printDiv').item(0);
	    var data = frame.innerHTML;
	    var win = window.open('', '', 'height=600,width=1200');
	    win.document.write('<style>@page{size:landscape;}</style>' +
	    '<style type="text/css">' +
        'table th, table td {' +
        'border:1px solid black;' +
        'padding;0.5em;' +
        '}' +
        '</style>' +
        '<style>table{border-collapse: collapse}</style>' +
        '<html><head><title></title>');
	    win.document.write('</head><body >');
	    win.document.write(data);
	    win.document.write('</body></html>');
	    win.print();
	    win.close();
	    return true;*/
	}
	

});