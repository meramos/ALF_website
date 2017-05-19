<?php

function connect_to_db(){
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
	
	return $conn;
}

function set_collation($conn){
	//Set collation
	$conn->query("SET character_set_results=utf8");
    mb_internal_encoding('utf8');
    $conn->query("set names 'utf8'");
}

function view_posts($alf_status){
	
	$conn = connect_to_db();
	set_collation($conn);
	
	//query to get pet ids of lost pets
	if($alf_status == "lost")
	{
		$getpids_sql = "SELECT pet_id FROM lost WHERE found=0";
	}
	else if($alf_status == "found")
	{
		$getpids_sql = "SELECT pet_id FROM found WHERE returned=0";
	}
	else //adopt
	{
		$getpids_sql = "SELECT pet_id FROM adopt WHERE adopted=0";
	}
	$conn->real_query($getpids_sql);
	
	$result = $conn->use_result();

	$petid_array = array();
	
	while($row = $result->fetch_assoc()) 
	{
		$petid_array[] = $row['pet_id'];
	}
	$result->close();
	
	//iterate through pet ids
	for($i = 0; $i < count($petid_array); $i++)
	{   
		$petid = $petid_array[$i];
		
		if(($i%4)==0)
		{
			echo "<div class='row'>\n";
		}
		
		//query to get info of pets
		$getinfo_sql = "SELECT * FROM pet WHERE pet_id = '".$petid."'";
		$result = $conn->query($getinfo_sql);
		if (($result->num_rows) > 0) //returns 1 row
		{	
			// store data of each column
			$row = $result->fetch_assoc();
			
			$species = $row['species'];
			$breed = $row['breed']; //id in catalog
			$age = $row['age_range'];
			$sex = $row['sex'];
			$size = $row['size'];
			$description = $row['description'];
			$location = $row['location'];
			
			$result->close();
		} 
		else {
			echo "0 results";
		}
		
		//query to get breed txt value, which is in catalog
		$getbreed_sql = "SELECT english_value FROM catalog WHERE id = '".$breed."'";
		$result = $conn->query($getbreed_sql);
		if (($result->num_rows) > 0) //returns 1 row
		{	
			// store data of each column
			$row = $result->fetch_assoc();
			
			$breed = $row['english_value'];
			
			$result->close();
		} 
		else {
			echo "0 results";
		}
		
		//query to get path to main photo
		$getinfo_sql = "SELECT file_path FROM photos WHERE pet_id = '".$petid."' AND main=1";
		$result = $conn->query($getinfo_sql);
		if (($result->num_rows) > 0) //returns 1 row and column
		{	
			// store data of each column
			$row = $result->fetch_assoc();
			
			$photopath = $row['file_path'];
			
			$result->close();
		} 
		else {
			echo "0 results";
		}
		
		//now to display entry using bootstrap!
		
		echo "<div class='col-md-4'>\n";
		echo "<div class='thumbnail'>\n";
		echo "<a href='view_post.php'>\n";
		echo "<img src='".$photopath."' alt='".$breed."' width='200' height='200' >\n";
		echo "<div class='caption'>\n";
		echo "<p>".$species."\n<br>Breed: ".$breed."\n<br>Age: ".$age."\n<br>Sex: ".$sex."\n<br>Last Seen: ".$location."</p>\n";
		echo "</div>\n";
		echo "</a>\n";
		echo "</div>\n";
		
		if(($i%4)==0)
		{
			echo "</div>\n"; //close row div
		}
	}
	
	//VERIFY PROBLEM WITH DIVS CLOSING
	if(($i%4)!=0)
	{
		echo "</div>\n"; //close row div
		echo "</div>\n"; //close row div
	}
	
	//close DB connection
	$conn->close();
}

function get_breeds($animal){
	
	$conn = connect_to_db();
	set_collation($conn);
	
	//Set the language
	$language = "english"; //default language will be english
	if(isset($_SESSION["language"]))
	{
		$language = $_SESSION["language"];
	}
	
	//query to get breed value based on animal
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
}

?>