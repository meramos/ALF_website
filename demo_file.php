<?php
class foo
{
    function do_foo()
    {
        echo "Doing foo."; 
    }
}

$myObj = new foo;
$myObj->name = "John";
$myObj->age = 30;
$myObj->city = "New York";

$myJSON = json_encode($myObj);

echo $myJSON;
?>