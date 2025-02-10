<?php
$server="localhost";
$username="root";
$password="";
$database="resturant";

$conn=mysqli_connect($server, $username, $password, $database);

if(!$conn) {
    // echo "success";
// }
// else {
    die("Error" . mysqli_connect_errno());
}
# php full form: Hypertext Preprocessor
?>