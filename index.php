<?php
	include 'phpFunc.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>

  <title>ALF</title>

  <meta charset="utf-8">
  <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  <link rel = "stylesheet" type = "text/css" href = "myStyle.css" />
  <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script>
	$(document).ready(function(){
			$.ajax({url: "tabs_titlebuttons.php", data: {"title": "adopt"}, type:'post',
			        success: function(result){
				          $("#adoptdiv").html(result);
			}});
			$.ajax({url: "tabs_titlebuttons.php", data: {"title": "lost"}, type:'post',
			        success: function(result){
				          $("#lostdiv").html(result);
			}});
			$.ajax({url: "tabs_titlebuttons.php", data: {"title": "found"}, type:'post',
			        success: function(result){
				          $("#founddiv").html(result);
			}});
	});
	
	$(document).ready(function() {
		$('#more_lost').click(function() {
			$(this).text('Hello World');
		})
	});
  </script>
</head>
<body>

<div class="container">
  <ul class="nav nav-pills nav-justified">
    <li class="active"><a data-toggle="pill" href="#home">Home</a></li>
    <li><a data-toggle="pill" href="#aboutus">About Us</a></li>
    <li><a data-toggle="pill" href="#contactus">Contact Us</a></li>
    <li><a data-toggle="pill" href="#petcare">Pet Care</a></li>
  </ul>
</div>
  
<div class="container">

	<br>
	<div class="jumbotron">
		<a href="index.php"><img id = "logoimg" src="ALF_logo_nobg.png" class="img-responsive" alt="ALF logo"></a>
		<br>
		<h2>Adopt, Lost, Found
		<br>
		<small>Where you can post about your lost pet, a pet you've found, or pet(s) that you're putting up for adoption.</small>
		</h2>
	</div>  
	  
	<div class="tab-content">
		<div id = "home" class="tab-pane fade in active">
		  
		  <ul class="nav nav-tabs nav-justified">
			<li><a data-toggle="tab" href="#adopt">Adopt</a></li>
			<li class="active"><a data-toggle="tab" href="#lost">Lost</a></li>
			<li><a data-toggle="tab" href="#found">Found</a></li>
		  </ul>

		  <div class="tab-content">
		  
				<div id="adopt" class="tab-pane fade">
				  <div id="adoptdiv"></div>
				  <br><br>
  				    <?php
						view_posts("adopt");
					?>
				</div>
				
				<div id="lost" class="tab-pane fade in active">
				  <div id="lostdiv"></div>
				  <br><br>
					<!--<div class="embed-responsive embed-responsive-16by9">
						<iframe class="embed-responsive-item" src="post_lost.php"></iframe>
					</div>-->
					<?php
						view_posts("lost");
					?>
				</div>
				
				<div id="found" class="tab-pane fade">
				  <div id="founddiv"></div>
				  <br><br>
				    <?php
						view_posts("found");
					?>
				</div>
				
		  </div>
		</div>

		<div id = "aboutus" class="tab-pane fade">
		<h1>About Us</h1>
		</div>

		<div id = "contactus" class="tab-pane fade">
		<h1>Contact Us</h1>
		</div>

		<div id = "petcare" class="tab-pane fade">
		<h1>Pet Care</h1>
	</div>
</div> 

</div>

</body>
</html>
