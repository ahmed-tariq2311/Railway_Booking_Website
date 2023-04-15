<?php
function OpenCon(){
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "123";
    $db = "railway";
    $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
    return $conn;
}
 
function CloseCon($conn){
    $conn -> close();
}

echo "success pllzzzzzzzzz"

$sql = "SELECT * FROM 'trainlist'";
$result  = mysqli_query($conn, $sql);
echo "$result"; 
?>

