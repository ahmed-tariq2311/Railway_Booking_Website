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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tadashii </title>
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
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id = $_POST['id'];
        $cnic = $_POST['cnic'];
       
        // echo '<div class="alert alert-info" role="alert">
        // your name is: ' . $name . $cnic . $mobile . $date . $seatT .'</div>';
    }
    ?>

   <div class = "container">
   <body class="text-center" data-new-gr-c-s-check-loaded="14.1091.0" data-gr-ext-installed="">

<main class="form-signin w-50 m-auto">
    <form action="./cancellation.php" method = "post">
        <img class="mb-4" src="./train-front-fill.svg" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">Enter your passenger ID and CNIC #</h1>

        <div class="form-floating">
            <input type="tel" class="form-control" name = "id" id="floatingInput" placeholder="ID"
                fdprocessedid="5eusdz">
            <label for="floatingInput">Passenger ID</label>
        </div>
        <br>
        <div class="form-floating">
            <input type="tel" class="form-control" name = "cnic" id="floatingPassword" placeholder="CNIC"
                fdprocessedid="vc199u">
            <label for="floatingPassword">CNIC #</label>
        </div>

        <br>
        <button class="w-100 btn btn-lg btn-danger" type="submit" fdprocessedid="4tyd8p">SEARCH</button>
        <p class="mt-5 mb-3 text-muted">WELCOME</p>
    </form>
</main>


<?php 

$sql1 = "SELECT * FROM `passenger` WHERE `id` = '$id' ";
 $result1 = mysqli_query($conn, $sql1) or die("NO RECORD EXISTS OF THE ID");

    $row1 = mysqli_fetch_assoc($result1);
    $tdate = $row1['date'];
    $a = $row1['id'];
    $trainNum = $row1['trainNo'];
    $status = $row1['ticket_status'];

    if(is_null($a)){
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <strong> ERROR... </strong> NO TICKET EXISTS OF THIS ID.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
    }
    else{

    if($status == 'CONFIRMED'){

$sql2 = "DELETE FROM `passenger` WHERE `passenger`.`id` = $id";
$result2 = mysqli_query($conn, $sql2) or die("query failed");

  echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
 <strong>DELETED </strong> YOUR TICKET IS CANCELLED SUCCESSFULLY.
 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';



$sql3 = "SELECT * FROM `passenger` WHERE `ticket_status` LIKE 'PENDING' AND `date` = '$tdate' AND `trainNo` = $trainNum ";

    $result3 = mysqli_query($conn, $sql3) or die("query failed");

    $row3 = mysqli_fetch_assoc($result3);
    $pid = $row3['id'];
    $trainNum = $row3['trainNo'];

    $sql4 = " UPDATE `passenger` SET `ticket_status` = 'CONFIRMED' WHERE `passenger`.`id` = '$pid' AND `passenger`.`date` = '$tdate' AND `passenger`.`trainNo` = '$trainNum'";
    $result4 = mysqli_query($conn, $sql4);
    }
    elseif($status == 'PENDING'){
        $sql5 = "DELETE FROM `passenger` WHERE `passenger`.`id` = $id";
        $result5 = mysqli_query($conn, $sql5) or die("query failed");

        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
 <strong>DELETED </strong> YOUR TICKET IS CANCELLED SUCCESSFULLY.
 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }
}
?>





<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;500;600;700;800&amp;display=swap"
    rel="stylesheet">
</body>
   </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>

</html>