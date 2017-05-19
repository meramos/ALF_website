<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>

  <title>ALF</title>

  <meta charset="utf-8">
  <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
  <!-- test by going to http://localhost:8080/ALF/post_lost.php -->
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
	body {
		background-color: white;
	}
  </style>
<title> ALF </title>
<meta charset="UTF-8">
<script>
function readyToSubmit() 
{
    if(confirm("Are you ready to submit your post?")) //if true, submit form. otherwise do nothing.
	{
		document.getElementById("addForm").submit();
	}
}
</script>
</head>
<body>

<form action="changeLanguage.php" method="POST">
	<select name="langSelect" id="langSelect" onchange="this.form.submit()">
	  <?php 
	    if(isset($_SESSION["language"]))
		{
			echo "<option selected disabled>".ucfirst($_SESSION["language"])."</option>"; //ucfirst() turns first char of string to uppercase
		}
		else
		{
			//default language will be english
			echo "<option selected disabled>English</option>"; 
		}
	  ?>
	  <option value="english">English</option>
	  <option value="spanish">Spanish</option>
	</select>
</form>
<br><br><br>
<!-- what follows is the code to get the data from the user and add the submission to the database-->

<form action="changeAnimal.php" method="POST">
	<label>Type of pet:</label> <select name="animalSelect" "id="animalSelect" onchange="this.form.submit()">
	  <?php 
	    if(isset($_SESSION["animal"]))
		{
			echo "<option selected disabled>".ucfirst($_SESSION["animal"])."</option>"; //ucfirst() turns first char of string to uppercase
		}
		else
		{
			//default animal will be dog
			echo "<option selected disabled>Dog</option>"; 
		}
	  ?>
	  <option value="dog">Dog</option>
	  <option value="cat">Cat</option>
	</select>
	<br><br>
</form>

<!-- form that follows will be the one that sends the info to be added to the DB-->
<form action="addLost.php" method="POST" id='addForm' enctype="multipart/form-data">
<?php

	//Connect to database.
	$servername = "localhost";
	$username = "root";
	$password = "new-password";
	$dbname = "alf_db";

	// Create connection
	
    $conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) 
	{
		die("Connection failed: " . $conn->connect_error);
	} 
	
	//Set collation
	
	$conn->query("SET character_set_results=utf8");
    mb_internal_encoding('utf8');
    $conn->query("set names 'utf8'");
	
	//Set the language
	$language = "english"; //default language will be english
	if(isset($_SESSION["language"]))
	{
		$language = $_SESSION["language"];
	}
	
	//Set animal variable to then determine what values will be shown in breed drop-down menu
	$animal = "dog"; //default animal will be dog
	if(isset($_SESSION['animal']))
	{
		$animal = $_SESSION['animal'];
	}

	//query to get breed value
	$sql = "SELECT ".$language."_value FROM catalog WHERE table_name = '".$animal."' AND type = 'breed' ORDER BY ".$language."_value";

	$result = $conn->query($sql);

	echo "<label>Breed:</label><select name='breed'>";
	if($language == "spanish")
	{	echo "<option>Raza Mixto / Sato</option>";
		echo "<option>No sé </option>";
		echo "<option>No está listado</option>";
	}
	else if($language == "english")
	{	
		echo "<option>Mixed Breed</option>";
		echo "<option>I don't know</option>";
		echo "<option>Not Listed</option>";
	}
	if (($result->num_rows) > 0) 
	{	
		// output data of each row
		while($row = $result->fetch_assoc()) 
		{
			echo "<option>".$row[$language."_value"]."</option>";
		}
		$result->close();
	} 
	else 
	{
		echo "0 results";
	}
	echo "</select>";
	
	$conn->close();
?>
<br><br>
<label>Age Range:</label>
<select name="age">
  <option value="0to2">0-2</option>
  <option value="3to5">3-5</option>
  <option value="6to8">6-8</option>
  <option value="9to12">9-12</option>
  <option value="12to15">12-15</option>
  <option value="16andUp">>15</option>
</select> y/o
<br><br>
<label>Sex:</label>            
<input type = "radio" name = "sex" id = "sex_male" value = "male" checked = "checked" /> <label for = "sex_male">Male</label> 
<input type = "radio" name = "sex" id = "sex_female" value = "female" /> <label for = "sex_female">Female</label>
<br><br>
<label>Size:</label>
<select name="size">
  <option value="xsmall">very small</option>
  <option value="small">small</option>
  <option value="medium">medium</option>
  <option value="large">large</option>
  <option value="xlarge">very large</option>
</select> 
<br><br>
<label>Description:</label> <i class="fa fa-info-circle" title="Write any particular details, like markings."></i>
<br>
<textarea rows="10" cols="50" name="description">
</textarea>
<br><br>
<label>Location:</label>
<input type="text" name="location"><i class="fa fa-info-circle" title="Last place seen."></i>
<br><br><br>
<label>Select image to upload:</label>
<input type="file" name="fileToUpload" id="fileToUpload">
<br><br><br>
<button type="button" name = "sendit" onclick="readyToSubmit()">Submit</button> 

</form>

</body>
</html>