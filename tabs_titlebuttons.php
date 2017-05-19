<?php
session_start();
include 'phpFunc.php';

$tabname = $_POST['title'];
echo '<div class="form-inline">';
echo '<div class="form-group">';
if($tabname == 'adopt')
{
	echo '<h3>Pets for Adoption</h3>';
}
else if($tabname == 'lost')
{
	echo '<h3>Lost Pets</h3>';
}
else 
{
	echo '<h3>Found Pets</h3>';
}
echo '<button type="button" class="btn btn-success">Add Post</button>';
echo '<button type="button" class="btn btn-danger">Remove Post</button>';
$more = 'More Options';
$less = 'Less Options';
echo '<button type="button" class="btn btn-info" data-toggle="collapse" id="more_'.$tabname.'" data-target="#moreoptions_'.$tabname.'">More Options</button>';
echo '<div id="moreoptions_'.$tabname.'" class="collapse">';
echo '<label>Show:</label>';
echo '<label class="checkbox-inline"><input type="checkbox" value="" checked>All</label>';
echo '<label class="checkbox-inline"><input type="checkbox" value="">Dog</label>';
echo '<label class="checkbox-inline"><input type="checkbox" value="">Cat</label>';
echo '<br>';
echo '<label>Age ranges:</label>';
echo '<label class="checkbox-inline"><input type="checkbox" value="">0-2 y/o</label>';
echo '<label class="checkbox-inline"><input type="checkbox" value="">3-5 y/o</label>';
echo '<label class="checkbox-inline"><input type="checkbox" value="">6-8 y/o</label>';
echo '</div>';

echo '</div>';
echo '</div>';

?>