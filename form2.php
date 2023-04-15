<?php
$servername = "localhost";
$username = "id20086944_ahmed11";
$password = "p*SmyHd\2(M&[yM";
$db = "id20086944_railway";

$conn = mysqli_connect($servername, $username,$password, $db);

// if(!$conn){
//     die("sorry, failed" . mysqli_connect_error());
// }
// else{
//     echo "connection was successful";
// }


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Tadashii</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>
    


  <nav class="navbar navbar-expand-lg" style="background-color: #3477a7;">

<div class="container-fluid">
    <a class="navbar-brand" href="./index.php">Tadashii</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="./timing.php">Timing</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="./booking.php">Booking</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="./cancellation.php">Cancellation</a>
            </li>

        </ul>
    </div>
</div>
</nav>
    <br>
    <?php
    // to get data from user.
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $name = $_POST['name'];
        $date = $_POST['date'];
        $cnic = $_POST['cnic'];
        $mobile = $_POST['mobile'];
        $seatT = $_POST['seatT'];

        // echo '<div class="alert alert-info" role="alert">
        // your name is: ' . $name . $cnic . $mobile . $date . $seatT .'</div>';
    }
    ?>

   

    <div class="container">
    <form action="./form2.php" method = "post">
  <div class="mb-3">
    <label for="exampahmed" class="form-label">Name</label>
    <input type="text" name = "name" class="form-control" id="exampahmed" placeholder="Example: Ahmed Tariq" >
  </div>
  <div class="mb-3">
    <label for="number" class="form-label">CNIC NUMBER</label>
    <input type="text" name = "cnic" class="form-control" id="number" placeholder=" Enter your 13 digit number">
  </div>
  <div class="mb-3">
    <label for="phone" class="form-label"> MOBILE NUMBER</label>
    <input type="text" name = "mobile" class="form-control" id="phone" placeholder=" Enter your 11 digit number">
  </div>
  <div>
    <div class = "mb-3">
    <select class="form-select" name = "date" aria-label="Default select example">
  <option selected>SELECT DATE</option>
  <option value="2023-01-01">2023-01-01</option>
  <option value="2023-01-02">2023-01-02</option>
  <option value="2023-01-03">2023-01-03</option>
  <option value="2023-01-04">2023-01-04</option>
  <option value="2023-01-05">2023-01-05</option>
  <option value="2023-01-06">2023-01-06</option>
  <option value="2023-01-07">2023-01-07</option>

</select>
    </div>
  </div>
  <div>
    <div class = "mb-3">
    <select class="form-select" name = "seatT" aria-label="Default select example">
  <option selected>SEAT TYPE</option>
  <option value='LUXURY'>LUXURY</option>
  <option value='STANDARD'>STANDARD</option>

</select>
    </div>
  </div>
  
  <button type="submit" class="btn btn-danger my-auto">Submit</button>
</form>
<br>
    </div>



    <?php
   
$trainNum = 2;
$status = "aa";
$trainName = "RED LINE";
// to get data from database
    $sql = "SELECT * FROM `entry_check` WHERE `date` = '$date' AND `trainNum` = $trainNum";
    $result = mysqli_query($conn, $sql) or die("query failed");

    $row = mysqli_fetch_assoc($result);

    $luxSeat = $row['luxA'];
    $sSeat = $row['stanA'];
    $waiting = $row['Waiting'];


    // function to inset data in tables.
function insert($n,$c,$d,$sn,$ts,$m,$t){
global $conn;
global $trainName;
global $trainNum;
global $status;
global $date;

$sql = "INSERT INTO `passenger` ( `name`, `mobile`, `cnic`, `ticket_status`, `seatNo`, `date`,`trainNo`) VALUES ( '$n', '$m', '$c', '$ts', '$sn', '$d','$trainNum')"; 
$result = mysqli_query($conn, $sql);

$sql2 = "SELECT * FROM `passenger` WHERE `name` LIKE '$n' AND `mobile` = $m AND `cnic` = $c";

    $result2 = mysqli_query($conn, $sql2) or die("query failed");

    $row2 = mysqli_fetch_assoc($result2);
    $pid = $row2['id'];


if($result){
    echo '  <div class="card mx-auto" style="width: 20rem;">
    <img src="./ticket-detailed.svg" class="card-img-top" alt="...">
    <div class="card-body">
      <h5>YOUR REQUEST IS PROCESSED.</h5>
      <h6>DETAILS:</h6>
      <br>
      <p class="card-text">PASSENGER ID: ' . $pid .'   </p>
      <p class="card-text">NAME: ' . $n . '  </p>
      <p class="card-text">CNIC: '. $c .  ' </p>
      <p class="card-text">MOBLIE NUMBER: '. $m .  ' </p>
      <p class="card-text">TRAIN NAME: '. $trainName .  ' </p>
      <p class="card-text">TRAIN NUMBER: '. $t .  ' </p>
      <p class="card-text">SEAT #: '. $sn .  ' </p>
      <p class="card-text">TICKET STATUS: '. $ts .  ' </p>
  
  
    </div>
  </div>
    ';
}
else{
    echo "insertion failed";
}
// echo "kjgas";
}
// insert('ahmed', '123','2023-01-01','comfirmed','l2435', '42212','1' );


//  function to update standard seats column in check entry column
function updateS($av,$d,$t){
global $conn;

$sql = "UPDATE `entry_check` SET `stanA` = '$av' WHERE `entry_check`.`date` = '$d' AND `entry_check`.`trainNum` = $t ";
$result = mysqli_query($conn, $sql);
if($result){
    echo "the record is updated";
}
else{
    echo "update failed";
}
}
// updateS('5','2023-01-02', '1');


//  function to update luxury seats column in check entry column
function updateL($av,$d,$t){
global $conn;

$sql = "UPDATE `entry_check` SET `luxA` = '$av' WHERE `entry_check`.`date` = '$d' AND `entry_check`.`trainNum` = $t ";
$result = mysqli_query($conn, $sql);
if($result){
    echo "the record is updated";
}
else{
    echo "update failed";
}
}
// updateL('5','2023-01-02', '1');

//  function to update waiting colum in check entry column
function updateW($av,$d,$t){
global $conn;

$sql = "UPDATE `entry_check` SET `Waiting` = '$av' WHERE `entry_check`.`date` = '$d' AND `entry_check`.`trainNum` = $t ";
$result = mysqli_query($conn, $sql);
if($result){
    echo "the record is updated";
}
else{
    echo "update failed";
}
}
// updateW('1','2023-01-02', '1');
    

    if($seatT == 'LUXURY'){
        $seatNo = 'L' . rand(1,100);
    }
    elseif($seatT == 'STANDARD'){
        $seatNo = 'S' . rand(1,100);
    }

    if($seatT == 'LUXURY'){
        if($luxSeat > 0){
            $status = 'CONFIRMED';
            $luxSeat = $luxSeat - 1;
            updateL($luxSeat,$date,$trainNum);
            insert($name,$cnic,$date,$seatNo,$status,$mobile,$trainNum);

        }
        elseif($waiting > 0){

            $status = 'PENDING';
            $waiting = $waiting -1;
            updateW($waiting,$date,$trainNum);
            insert($name,$cnic,$date,$seatNo,$status,$mobile,$trainNum);

        }
        else{
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>SORRY...</strong> SEATS ARE UNAVAILABLE.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';// echo dismiss wali bar
        }
    }
        elseif($seatT == 'STANDARD'){

            if($sSeat > 0){

            $status = 'CONFIRMED';
            $sSeat = $sSeat -1;
            updateS($sSeat,$date,$trainNum);
            insert($name,$cnic,$date,$seatNo,$status,$mobile,$trainNum);


             }
            elseif($waiting > 0){

            $status = 'PENDING';
            $waiting = $waiting -1;
            updateW($waiting,$date,$trainNum);
            insert($name,$cnic,$date,$seatNo,$status,$mobile,$trainNum);


            }
            else{
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>SORRY...</strong> SEATS ARE UNAVAILABLE.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';// echo dismiss wali bar
        }
    }
    
?>



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>