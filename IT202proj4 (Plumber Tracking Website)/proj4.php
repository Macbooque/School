<?php

session_start();

$servername = "sql1.njit.edu";
$username = "dee22";
$password = "-------";
$dbname = "dee22";
$connect = mysqli_connect($servername, $username, $password, $dbname);


if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

echo "<html><head><link rel='stylesheet' href='proj4.css'/></head><body>";


$transactionType = isset($_GET['transactiontype']) ? $_GET['transactiontype'] : '';
$plumberID = isset($_GET['plumberid']) ? $_GET['plumberid'] : '';

if ($plumberID !== ''){
    $query = "SELECT * FROM PlumberData WHERE PlumberID = $plumberID";
    $result = mysqli_query($connect, $query);

    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

     if ($row['PlumberFirstName'] === $_GET['firstname'] && $row['PlumberLastName'] === $_GET['lastname'] && $row['PlumberPassword'] === $_GET['password'] && $row['PlumberPhoneNumber'] === $_GET['phonenumber']){
        if (isset($_GET['emailconfirmation'])){
            if ($row['PlumberEmail'] !== $_GET['emailaddress']){
                echo '<script>alert("Plumber not found, please re-enter.");
                      window.location.href = "proj4.html";</script>';
                exit();
            }
        }
     }
     else{
        echo '<script>alert("Plumber not found, please re-enter.");
              window.location.href = "proj4.html";</script>';
        exit();
        }

    if ($transactionType == "plumberAccountSearch"){
        $_SESSION['plumberid'] = $plumberID;
        header("Location: proj4plumberaccountsearchsession.php");
        exit();
    }
    else if ($transactionType == "bookAppointment"){
        $_SESSION['plumberid'] = $plumberID;
        header("Location: proj4customerchecksession.php");
        exit();
    }
    else if ($transactionType == "cancelAppointment"){
        $_SESSION['plumberid'] = $plumberID;
        header("Location: proj4cancelappointmentsession.php");
        exit();
    }
    else if ($transactionType == "requestSupplies"){
        $_SESSION['plumberid'] = $plumberID;
        header("Location: proj4requestsuppliessession.php");
        exit();
    }
    else if ($transactionType == "updateRecords"){
        $_SESSION['plumberid'] = $plumberID;
        header("Location: proj4updaterecordssession.php");
        exit();
    }
    else if ($transactionType == "createCustomer"){
        $_SESSION['plumberid'] = $plumberID;
        header("Location: proj4createcustomersession.php");
        exit();
    }
    else{
        echo(mysqli_error($connect));
    }

    echo "<a href='proj4.html'><button id='home' type='button'>Home</button></a></body></html>";
}
mysqli_close($connect);
?>
