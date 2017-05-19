<?php
include 'phpFunc.php';
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("button").click(function(){
        $.ajax({url: "demo_file.php", success: function(result){
		    var myObj = JSON.parse(result);
            $("#div1").html(myObj.name);
        }});
    });
});

$(document).ready(function(){
    $("#animSelect").change(function(){
	    var animal = $(this).val();
        $.ajax({url: "changedAnimal.php", data: {"animal": animal},type: 'post', 
		        success: function(result){
					$("#breedDiv").html(result);
        }});
    });
});
</script>

<script>
var xmlhttp = new XMLHttpRequest();

xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        myObj = JSON.parse(this.responseText);
        document.getElementById("demo").innerHTML = myObj.name;
    }
};
xmlhttp.open("GET", "demo_file.php", true);
xmlhttp.send();
</script>

</head>
<body>

<h2>Get data as JSON from a PHP file on the server.</h2>

<p id="demo"></p>
<br><br>
<div id="div1"><h2>Let jQuery AJAX Change This Text</h2></div>

<button>Get External Content</button>
<br><br>
<div id="animDiv">
<select name="animSelect" id="animSelect">
<option value="dog">Dog</option>
<option value="cat">Cat</option>
</select>
</div>

<div id="breedDiv">
<?php get_breeds("dog"); ?>
</select>
</div>

</body>
</html>
