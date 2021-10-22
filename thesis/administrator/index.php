<html>

	<head>
		<title>CCE Administrator</title>
		<script type="text/javascript" src="lib/bootstrap4/js/jquery-3.2.1.min.js"></script>
		<link rel="stylesheet" type="text/css" href="lib/bootstrap4/css/bootstrap.min.css">	
	   	<link rel="stylesheet" type="text/css" href="lib/fontawesome-free-5.0.6/web-fonts-with-css/css/fontawesome-all.min.css">
	   	<script type="text/javascript" src="lib/bootstrap4/js/popper.min.js"></script>
	   	<script type="text/javascript" src="lib/bootstrap4/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/login.css">

		<?php
			session_start();
		?>
	</head>

	<body>
		<div class="container-fluid">

			<!-- Login -->
			<div class="row" style="margin-top: 7em;">
				<div class="col-md-4 offset-md-4 card" id="card-cont">
					
					<h3>Login <i class="fa fa-users"></i></h3>
					<div style="background-color: white;height: 1px;width: 100%;"></div>
					<div id="login-form">
						<form class="mt-4">
							<div class="form-group row">
								<label class="col-md-6 control-form-label" for="username"><i class="Fa fa-user"></i> username</label>
								<div class="col-md-10">
									<input type="text" class="form-control" id="username">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-6 control-form-label" for="password"><i class="fa fa-key"></i> password</label>
								<div class="col-md-10">
									<input type="password" class="form-control" id="password">
								</div>
							</div>
							<div class="col-md-10" id="message-collapse">
								<p id="message"></p>
							</div>
							<button  class="btn btn-success" id="login-btn">Login <i class="fa fa-sign-in-alt"></i></button>
						</form>
					</div>
				</div>
			</div><!-- end row -->

		</div>
	</body>

</html>

<script>
    $(document).ready(function(){

    	//$('[data-toggle="popover"]').popover();
  	
        $("#login-btn").click(function(e){
        	e.preventDefault();
            var user= $("#username").val();
            var pass= $("#password").val();
            

           if($("#username").val()=="" && $("#password").val()!=""){ 
				$("#message").text("Please fill the username.");
				$("#message-collapse").css("display","block");
				$("#login-btn").css("margin-top","8px");
			}
			else if($("#username").val()=="" && $("#password").val()==""){
				$("#message").text("Please fill both username and password.");
				$("#message-collapse").css("display","block");
				$("#login-btn").css("margin-top","8px");
			}
			else if($("#username").val()!="" && $("#password").val()==""){
				$("#message").text("Please fill the password.");
				$("#message-collapse").css("display","block");
				$("#login-btn").css("margin-top","8px");
			}
			else{
				$.ajax({
					type: "POST",
					url: "controller/subQueries.php",
					data:{
						username: $("#username").val(),
						password: $("#password").val(),
						function: "login"
					},
					success: function(data){
						console.log(data);

						if(data==1){
							window.location.href = "admin/index.php";
						}
						else if(data==2){
							$("#message").text("Incorrect Password.");
							$("#message-collapse").css("display","block");
							$("#login-btn").css("margin-top","5px");
						}
						else{
							$("#message").text("User not found");
							$("#message-collapse").css("display","block");
							$("#login-btn").css("margin-top","5px");
						}
					},
					error: function(data){

					}
				});
			}	
        });

    });
</script>	