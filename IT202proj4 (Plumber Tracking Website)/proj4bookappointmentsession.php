<?php

session_start();
$servername = "sql1.njit.edu";
$username = "dee22";
$password = "Dumbass1234!";
$dbname = "dee22";

$connect = mysqli_connect($servername,$username,$password,$dbname);

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


$customerID = $_SESSION['customerid'];
$plumberID = $_SESSION['plumberid'];

echo "<html><head><script src='proj4appointmentCreatingValidation.js'></script><link rel='stylesheet' href='proj4.css'/></head><body>
    <form id = 'form' action='proj4bookappointmentsession.php' method='GET'>
        <h1>Perfect Plumbing Pros: Request Service Appointment Form</h1>
        <p>
          <label>Service Appointment Date:
          <input type='text' id='serviceappointmentdate' name='serviceappointmentdate' placeholder='Ex: 11/11/2024' />REQUIRED</label>
        </p>
        <p>
          <label>Service Appointment Time:
          <input type='text' id='serviceappointmenttime' name='serviceappointmenttime' placeholder='Ex: 12PM' />REQUIRED</label>
        </p>
        <p>
          <label>Service Type:
          <input type='text' id='servicetype' name='servicetype' placeholder='Ex: Pipe Replacement' />REQUIRED</label>
        </p>
        <p>
          <label>Cost:
          <input type='text' id='cost' name='cost' placeholder='Ex: $300' />REQUIRED</label>
        </p>
        <p>
          <input type='submit' id = 'submit' value='Submit'/>
        </p>
    </form>";

$newServiceID = rand(10000, 99999);
$query = "SELECT ServiceAppointmentID FROM CustomerServiceRecord WHERE ServiceAppointmentID = $newServiceID";
$result = mysqli_query($connect, $query);
while (mysqli_num_rows($result) > 0){
    $newServiceID = rand(10000, 99999);
    $query = "SELECT ServiceAppointmentID FROM CustomerServiceRecord WHERE ServiceAppointmentID = $newServiceID";
    $result = mysqli_query($connect, $query);
}


if (isset($_GET['serviceappointmentdate'], $_GET['serviceappointmenttime'], $_GET['servicetype'], $_GET['cost'])){

    $date = $_GET['serviceappointmentdate'];
    $time = $_GET['serviceappointmenttime'];
    $serviceType = $_GET['servicetype'];
    $cost = $_GET['cost'];
    $insertQuery = "INSERT INTO CustomerServiceRecord (CustomerID, DateOfService, TypeOfService, CostOfService, ServiceAppointmentID, TimeOfService, PlumberID)
                    VALUES ('$customerID', '$date', '$serviceType', '$cost', '$newServiceID', '$time', '$plumberID') ";
    if (mysqli_query($connect, $insertQuery)) {
        echo "<script>alert('Service Appointment Made. Your Appointment ID is: " . $newServiceID . ". You will now be redirected to indicate supplies needed for the job.');
              window.location.href = 'proj4requestsuppliessession.php';</script>";
    }
    else {
        echo "Error during insert query: " . mysqli_error($connect);
    }
}

echo "<a href='proj4.html'><button id='home' type='button'>Home</button></a></body></html>";
mysqli_close($connect);
?>
