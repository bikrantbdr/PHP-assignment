<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "webtech";

$conn = mysqli_connect($server, $username, $password, $database);

if ($conn){
    // echo "success";
}
else{
    echo "not connected to database";
}


?>