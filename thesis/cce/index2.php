<html>

	<head>
		<script type="text/javascript" src="bootstrap/js/jquery-3.1.1.min.js"></script>
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <script  type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <link href="css/home.css" rel="stylesheet">

        <title>Center for Continuing Education</title>

        <style>
        	.caption{
        		height: 5em;
        	}
        </style>
	</head>



	<body>

		<div class="container" id="main">
			<!-- navbar here -->
			<div class="navabar navbar-fixed-top"><!--  style="background-color: #337ab7;" -->
				<div class="container">
					<div class="navbar-header">
						<button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#nav-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>

						<!--<a class="navbar-brand" href="#"  style="color: white;"><b>CCE</b></a>-->
					</div>
					<div class="collapse navbar-collapse" id="nav-collapse"> 
						<ul class="nav navbar-nav">
							<li class="active">
								<a href="#" style="color: white;"><span class="glyphicon glyphicon-home"></span> Home</a>
							</li>
							<li>
								<a href="#offers"  style="color: white;">Offers</a>
							</li>
							<li>
								<a href="#rooms"  style="color: white;">Rooms</a>
							</li>
							<li>
								<a href="#about" style="color: white;">About</a>
							</li>
						</ul>
						<!--
						<ul class="nav navbar-nav pull-right">
							<li>
								<a href="#" data-toggle="modal" data-target="#admin-modal"><span class="glyphicon glyphicon-log-in"></span> Login</a>
							</li>
						</ul>
						-->
					</div>


				</div><!-- end container -->
			</div><!-- end navbar -->			

			<div class="panel panel-default row" id="carousel-container" style="margin-top:4em;padding-top: 5px;padding-bottom: 5px;background-color: #e3d5d5;"><!-- Carousel Container -->
				<div class="col-md-8 col-sm-8">
					<div class="carousel slide" id="myCarousel" data-ride="carousel" data-interval="3000"><!-- carousel -->

	                    <!-- Indicators -->
	                    <ol class="carousel-indicators">
	                        <li class="active" data-slide-to="0" data-target="myCarousel"></li>
	                        <li data-slide-to="1" data-target="myCarousel"></li>
	                        <li data-slide-to="2" data-target="myCarousel"></li>
	                    </ol>

	                    <!-- Wrapper for slides --> 
	                    <div class="carousel-inner">

	                        <div class="item active img-responsive" id="slide1">
	                        	<img src="img/CCE.jpg">
	                        <!--
	                            <div class="carousel-caption">
	                                <h2><b>WELCOME TO CENTER FOR CONTINUING EDUCATION!</b></h2>
	                            </div><!-- carousel-caption --> 
	                        </div><!-- item --> 

	                        <div class="item  img-responsive" id="slide2">
	                        	<img src="img/first.jpg">
	                        <!--
	                            <div class="carousel-caption">
	                                <h4>Training Hall(First Floor)</h4>
	                            </div><!-- carousel-caption -->
	                        </div><!-- item -->

	                        <div class="item  img-responsive" id="slide3">
	                        	<img src="img/second.jpg">
	                        <!--
	                            <div class="carousel-caption">
	                                <h4>Function Room(Second Floor)</h4>
	                            </div><!-- carousel-caption -->
	                        </div><!-- item --> 
	                    </div><!-- Carousel-inner -->

	                    <a class="carousel-control left" data-slide="prev" href="#myCarousel"><span class="icon-prev"></span></a>
	                    <a class="carousel-control right" data-slide="next" href="#myCarousel"><span class="icon-next"></span></a>
	                </div><!-- end of carousel -->
                </div><!-- end col-md-8 -->
                <div class="col-md-4 col-sm-4 col-xs-12">
                	<div class="panel panel-default"  style="border-radius: 20px;background-color: #79989d;">
                		<div class="panel-heading" style="background-color: #ab98c0;">
                			<div class="row" id="login_pic" style="text-align: center">
                				<img src="img/admin.png"/>
                			</div>
                			<div class="row">
                			<h3 class="text-center"><b>Login</b></h3>
                			</div>
                		</div>

                		<div id="login-form-container">

	            			<form class="form-horizontal row" style="margin-top: 2em;">
	            				<div class="col-md-2 col-sm-2 col-xs-2"></div>
	            				<div class="col-md-8 col-sm-8 col-xs-8"><!-- input containers -->
		            				<div class="input-group">
		            					<span class="input-group-addon">
		            						<i class="glyphicon glyphicon-user"></i>
		            					</span>
		            					<input id="username" type="text" class="form-control" placeholder="username">
		            				</div>
		            				<div class="input-group" style="margin-top:1em;">
		            					<span class="input-group-addon">
		            						<i class="glyphicon glyphicon-lock"></i>
		            					</span>
		            					<input id="password" type="password" class="form-control" placeholder="password">
		            				</div>
	            				</div><!-- end input containers -->
	            				<!--
	            				<div class="form-group">
	            					<div class="col-md-1 col-sm-1"></div>
	            					
			                		<label class="control-label col-md-4 col-sm-4" for="username"><span class="glyphicon glyphicon-user"></span> username</label>
			                		
	                				<div class="col-md-5 col-sm-5">
	                					<input type="text" id="username" class="form-control">
	                				</div>
	            				</div><!-- end form-group 

	            				<div class="form-group">
	            					<div class="col-md-1 col-sm-1"></div>
	            					
			                		<label class="control-label col-md-4 col-sm-4" for="password"><span class="glyphicon glyphicon-lock"></span> password</label>
			                		
	                				<div class="col-md-5 col-sm-5">
	                					<input type="password" id="password" class="form-control">
	                				</div>
	            				</div><!-- end form-group 
	            				-->
	            			</form>

	            			<p id="message" style="padding-bottom: 0.5em;"></p>
            				<button class="btn btn-primary" id="login-btn"><span class="glyphicon glyphicon-log-in"></span> Login</button>

                		</div><!-- end login-form-container -->
                	</div><!-- end panel -->
                </div><!-- end col-md-4 -->
			</div><!-- end of carousel row -->

			<!-- LOGIN ADMIN MODAL -->
			<!--
            <div id="admin-modal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    
                    <!-- CONTENT 
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #33b79f">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <div class="row">
                                <div class="col-sm-4"></div>
                                <div class="col-sm-4">
                                    <div align="center">
                                        <img src="img/admin.png" style="width:150px;height: 150px;" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body" style="background-color: #286a90;">
                            <div class="container-fluid">
                            	<div class="row">
	                                <div class="col-sm-12">
	                                    <form class="form-horizontal">
	                                        <!--username
	                                        <div class="form-group">
	                                            <div class="col-sm-2"></div>
	                                            <label class="control-label col-sm-2" for="username">username:</label>
	                                            <div class="col-sm-5">
	                                                <input type="text" class="form-control" id="username" placeholder="username" />
	                                            </div>
	                                            <div class="col-sm-1" id="admin-username-message"></div>
	                                        </div><!--form
	                                       
	                                        <!-- password   
	                                        <div class="form-group">
	                                            <div class="col-sm-2"></div>                         
	                                            <label class="col-sm-2 control-label" for="password">password:</label>
	                                            <div class="col-sm-5">
	                                              <input type="password" class="form-control" id="password" placeholder="password" />
	                                            </div>
	                                            <div class="col-sm-1" id="admin-password-message"></div>
	                                        </div><!--form

	                                    </form>
	                                </div>
                                </div>
                                <div class="row">
                                	<div class="col-sm-12" style="text-align: center;">
                                		<p id="message"></p>
                                	</div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer" style="background-color: #33b79f">
                            <div align="center">
                                <button class="btn btn-primary" id="btn-login-admin"><span class="glyphicon glyphicon-log-in"></span> Login</button>
                                <button class="btn btn-primary" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div> <!-- modal content

                </div> <!-- modal dialog
            </div> <!-- end of modal 
            -->

            <!-- Offers -->
            <div class="row" id="offers" style="margin-top: 2em;">    	

            	<div class="col-md-12">	

            		<div class="panel panel-default" style="background-color: #e3d5d5;">
            			<div class="panel-heading" style="background-color: grey;">
            				<h3 align="" style="color:white;"><b>Offers</b></></h3>
            			</div>
            			<div class="row">
	            			<div class="col-md-6 col-sm-6">
	            				<div class="thumbnail">
	            					<img src="img/Review.jpg" class="img-responsive"  />

	            					<div class="caption">
	            						<p>We offer Licensure Examination for Teachers(LET) Review and Agriculturist Board Review(ABR).         							
	            						</p>
	            					</div>
	            				</div>
	            			</div><!-- end col-6 -->

	            			<div class="col-md-6 col-sm-6">
	            				<div class="thumbnail">
	            					<img src="img/Birthday.jpg" class="img-responsive" />

	            					<div class="caption">
	            						<h4>We also offer Birthday Party!</h4>
	            					</div>
	            				</div>
	            			</div><!-- end col-6 -->
            			</div>

            			<div class="row">
            				<div class="col-md-3 col-sm-3"></div>
	            			<div class="col-md-6 col-sm-6">
	            				<div class="thumbnail wedding">
	            					<img id="wedding" src="img/Wedding_Party.jpg" class="img-responsive" />

	            					<div class="caption">
	            						<h4>We also offer wedding reception</h4>
	            					</div>
	            				</div>
	            			</div><!-- end col-6 -->
	            			<!--
	            			<div class="col-md-6 col-sm-6">
	            				<div class="thumbnail">
	            					<img src="img/sample/4.jpg" />

	            					<div class="caption">
	            						<h4>Place taken at Samar, Leyte</h4>
	            					</div>
	            				</div>
	            			</div><!-- end col-6
	            			-->
            			</div>
            		</div><!-- end thumbnail row -->

            	</div><!-- end col-md-12 -->
            </div><!-- end row(Offers) -->

            <!-- Rooms -->
            <div class="row" id="rooms" style="margin-top: 2em;">
            	
            	<div class="col-md-12">	

            		<div class="panel panel-default"  style="background-color: #e3d5d5;">
            			<div class="panel-heading" style="background-color: grey;">
            			<h3 align="" style="color:white;"><b>Rooms</b></></h3>
            			</div>
            			
            			<div class="row" style="margin-top: 1em;">
            				<!--<div class="col-md-1 col-sm-1"></div>-->
            				<div class="col-md-6 col-sm-6 col-xs-7">
            					<img src="img/first.jpg" class="img-responsive" style="width:90%;margin-left: 2em;">
            				</div>

            				<div class="col-md-5 col-sm-5 col-xs-4" style="background-color: white;border-radius: 1em;box-shadow: 10px 10px 5px grey">
            					<h3><b>First floor (Training Hall)</b></h3>
            					<p>It is used for wedding celebration, birthday party and Licensure Examination for Teachers Review</p>
            				</div>

            			</div>

            			<div class="row">
            				<div class="col-md-12 col-sm-12">
            					<div style="background-color: grey;height: 1em;width: 95%;margin: auto;margin-top: 1em;border-radius: 2em;"></div>
            				</div>
            			</div>

            			<div class="row" style="margin-top: 1em;padding-bottom: 3em;">
            				<div class="col-md-6 col-sm-6 col-xs-7">
            					<img src="img/second.jpg" class="img-responsive" style="width:90%;margin-left: 2em;">
            				</div>

            				<div class="col-md-5 col-sm-5 col-xs-4" style="background-color: white;border-radius: 1em;box-shadow: 10px 10px 5px grey">
            					<h3><b>Second floor (Function Room)</b></h3>
            					<p>It is used for meetings and Agricultural Review. </p>
            				</div>

            			</div>

            		</div><!-- end panel-->

            	</div><!-- end col-md-12 -->
            </div><!-- end row -->

            <!-- About -->
            <div class="row" id="about">
            	<div class="col-md-1 col-sm-1">
            		
            	</div>
            	<div class="col-md-12 col-sm-12">
            		<div class="panel panel-default"  style="background-color: #e3d5d5;">
            		 	<div class="panel-heading" style="background-color: grey;">
            		 		<h3 style="color:white;"><b>About</b></></h3>
            		 	</div>
            		 	<h3>Visayas State Univesity</h3>
            		</div>
            	</div>
            </div>

			<div class="row" style="margin-top:1em;">
				<hr>
				<div class="col-md-2 col-sm-2">
					<p><a href="#">Contact us</a></p>
					<p><a href="#">About us</a></p>
				</div>	
				<!--
				<div class="col-md-3"></div>
				<div class="col-md-6" style="text-align: center;">
					<h4>Webmaster: Adrian Cabrera Tolero</h4>
					<h4>@Visayas State University<small> Visca, Baybay City, Leyte</small></h4>
				</div>
				-->
			</div>
			
		</div><!-- end of outer container -->

	</body>

</html>

<script>
    $(document).ready(function(){
    	/*
        $("#btn-login-admin").click(function(){
            var user= $("#username").val();
            var pass= $("#password").val();

           if($("#username").val()=="" && $("#password").val()!=""){
				$("#message").text("Username must not be empty.");
			}
			else if($("#username").val()=="" && $("#password").val()==""){
				$("#message").text("Please fill both username and password.");
			}
			else if($("#username").val()!="" && $("#password").val()==""){
				$("#message").text("Password must not be empty.");
			}
			else{
				$.ajax({
					type: "POST",
					url: "php/login.php",
					data:{
						username: $("#username").val(),
						password: $("#password").val()
					},
					success: function(data){
						console.log(data);
						var result = jQuery.parseJSON(data);
						if(result.message=="Login success!"){
							window.location.href = "administrator/index.php?id=" + result.user_id;
						}

						else{
							
							$("#message").text(result.message);
						}
						

					},
					error: function(data){

					}
				});
			}	
        });*/

        $("#login-btn").click(function(){
            var user= $("#username").val();
            var pass= $("#password").val();

           if($("#username").val()=="" && $("#password").val()!=""){
				$("#message").text("Username must not be empty.");
			}
			else if($("#username").val()=="" && $("#password").val()==""){
				$("#message").text("Please fill both username and password.");
			}
			else if($("#username").val()!="" && $("#password").val()==""){
				$("#message").text("Password must not be empty.");
			}
			else{
				$.ajax({
					type: "POST",
					url: "php/login.php",
					data:{
						username: $("#username").val(),
						password: $("#password").val()
					},
					success: function(data){
						console.log(data);
						var result = jQuery.parseJSON(data);
						if(result.message=="Login success!"){
							window.location.href = "administrator/index.php?id=" + result.user_id;
						}

						else{
							
							$("#message").text(result.message);
						}
						

					},
					error: function(data){

					}
				});
			}	
        });

    });
</script>