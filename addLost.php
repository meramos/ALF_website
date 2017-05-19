<?php

session_start();

?>
<!DOCTYPE html>
<html>
<!-- test by going to http://localhost:8080/ALF/addLost.php -->
<title> Adopt, Lost Found </title>
<meta charset="UTF-8">
<head>
<title> Adopt, Lost Found </title>
<meta charset="UTF-8">
</head>
<body>

Lost post data collected:<br><br>
type of pet: <?php echo $_SESSION["animal"]?><br><br>
breed: <?php echo $_POST["breed"]?><br><br>
age range: <?php echo $_POST["age"]?><br><br>
sex: <?php echo $_POST["sex"]?><br><br>
size: <?php echo $_POST["size"]?><br><br>
description: <?php echo $_POST["description"]?><br><br>
location: <?php echo $_POST["location"]?><br><br>

<?php

	//Set the language
	$language = "english"; //default language will be english
	if(isset($_SESSION["language"]))
	{
		$language = $_SESSION["language"];
	}

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

	//organize values/variables that we want to insert to the pet table
	$species = $_SESSION["animal"];
	$breedtxt = $_POST["breed"];
	$age = $_POST["age"];
	$sextxt = $_POST["sex"];
	$size = $_POST["size"];
    $description = $_POST["description"];
	$location = $_POST["location"];
	
	//need to store sex as binary into pet table
	$sex = ($sextxt == "male" ? 0 : 1);
	
	//need to get id of breed entry in catalog to store into pet table
	$sql = "SELECT id FROM catalog WHERE ".$language."_value = '".$breedtxt."' AND table_name = '".$species."'";
	echo $sql;
	$result = $conn->query($sql); //execute the query
	
	if (! $result) {
		printf("Error message: %s\n", $conn->error);
	}
	else{
		$queryresult = $result->fetch_assoc();
		$breed = $queryresult['id'];
	}
	
	//query to insert data into pet table
	$sql = "INSERT INTO pet(user_id,species,breed,age_range,sex,size,description,location) ".
			"VALUES (0,'".$species."','".$breed."','".$age."','".$sex."','".$size."','".$description."','".$location."')";
	$result = $conn->query($sql); //execute the query
   
    echo "\nEntered data successfully.\n";
	
	$conn->close();
?>

</body>
</html> 