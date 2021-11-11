<?php
function makeConnection()
{
    $host="localhost";
    $username="root";
    $password="";
    $database="bank";
    $conn=mysqli_connect($host,$username,$password,$database);
    if(!$conn)
        die("Database not connected ".mysqli_connect_error());
    return $conn;
}
?>