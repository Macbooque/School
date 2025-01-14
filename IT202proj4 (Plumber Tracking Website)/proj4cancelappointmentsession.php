<?php

session_start();
$servername = "sql1.njit.edu";
$username = "dee22";
$password = "-------";
$dbname = "dee22";

$connect = mysqli_connect($servername,$username,$password,$dbname);

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


echo "<html><head><script src='proj4appointmentCancellingValidation.js'></script><link rel='stylesheet' href='proj4.css'/></head><body>
    <form id = 'form' action='proj4cancelappointmentsession.php' method='GET'>
        <h1>Perfect Plumbing Pros: Cancel Appointment Form</h1>
        <p>
          <label>Service Appointment ID:
          <input type='text' id='serviceid' name='serviceid' placeholder='Ex: 12345' />REQUIRED</label>
        </p>

        <p>
          <input type='submit' id = 'submit' value='Submit'/>
        </p>
    </form>";
$serviceID =  isset($_GET['serviceid']) ? $_GET['serviceid'] : -1;

if ($serviceID !== -1){
    $query = "SELECT ServiceAppointmentID FROM CustomerServiceRecord WHERE ServiceAppointmentID = $serviceID";
    if ($result = mysqli_query($connect, $query)){

        if (mysqli_num_rows($result) > 0){

             $removeQuery = "DELETE FROM CustomerServiceRecord WHERE ServiceAppointmentID = $serviceID";
             $supplyCheckQuery = "SELECT ServiceAppointmentID FROM CustomerSuppliesRecord WHERE ServiceAppointmentID = $serviceID";
             $result2 = mysqli_query($connect, $supplyCheckQuery);
             $supplyRemoveQuery = "DELETE FROM CustomerSuppliesRecord WHERE ServiceAppointmentID = $serviceID";

             if (mysqli_num_rows($result2) > 0){
                 if (mysqli_query($connect, $removeQuery) && mysqli_query($connect, $supplyRemoveQuery)){
                     echo "<script>alert('Service appointment and corresponding supplies cancelled successfully')</script>";
                 }
             }
             else{
                 if (mysqli_query($connect, $removeQuery)){
                     echo "<script>alert('Service appointment cancelled successfully')</script>";
                 }
             }
        }
        else{
            echo "<script>alert('Service Appointment with entered service ID: " . $serviceID . " not found.')</script>";
        }
    }
    else{
        echo "query fail: " . mysqli_error($connect);
    }
}

echo "<a href='proj4.html'><button id='home' type='button'>Home</button></a></body></html>";

mysqli_close($connect);
?>
