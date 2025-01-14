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


echo "<html><head><script src='proj4supplyOrderingValidation.js'></script><link rel='stylesheet' href='proj4.css'/></head><body>
    <form id = 'form' action='proj4requestsuppliessession.php' method='GET'>
        <h1>Perfect Plumbing Pros: Request Supplies Form</h1>
        <p>
          <label>Supplies Needed:
          <input type='text' id='supplies' name='supplies' placeholder='Ex: Pipe' />REQUIRED</label>
        </p>
        <p>
          <label>Supplies OnSite/Ordered:
          <input type='text' id='onsite' name='onsite' placeholder='Ex: On Site' />REQUIRED</label>
        </p>
        <p>
          <label>Date Supplies Received:
          <input type='text' id='datereceived' name='datereceived' placeholder='Ex: 11/11/2024' />REQUIRED</label>
        </p>
        <p>
          <label>Service Appointment ID:
          <input type='text' id='serviceid' name='serviceid' placeholder='Ex: 55555' />REQUIRED</label>
        </p>
        <p>
          <input type='submit' id = 'submit' value='Submit'/>
        </p>
    </form>";

$serviceID =  isset($_GET['serviceid']) ? $_GET['serviceid'] : -1;
$supplies =  isset($_GET['supplies']) ? $_GET['supplies'] : "";
$onSiteOnOrder =  isset($_GET['onsite']) ? $_GET['onsite'] : "";
$date =  isset($_GET['datereceived']) ? $_GET['datereceived'] : "";

if ($serviceID !== -1){
    $query = "SELECT ServiceAppointmentID FROM CustomerServiceRecord WHERE ServiceAppointmentID = $serviceID";
    if ($result = mysqli_query($connect, $query)){
        $queryCustomerID = "SELECT CustomerID FROM CustomerServiceRecord WHERE ServiceAppointmentID = $serviceID";
        if ($resultCustomer = mysqli_query($connect, $queryCustomerID)){
            $row = mysqli_fetch_assoc($resultCustomer);
            $customerID = $row['CustomerID'];
            if (mysqli_num_rows($result) > 0 && mysqli_num_rows($resultCustomer) > 0){
                $insertQuery = "INSERT INTO CustomerSuppliesRecord (CustomerID, SuppliesNeeded, SuppliesReceived, SuppliesOnOrderOrOnSite, ServiceAppointmentID)
                VALUES ('$customerID', '$supplies', '$date', '$onSiteOnOrder', '$serviceID') ";
                if ($insertResult = mysqli_query($connect, $insertQuery)){
                    echo "<script>alert('Supplies Added')</script>";
                }
            }
            else{
                echo "<script>alert('Service Appointment with entered service ID for this customer not found. Please re-enter a valid Service Appointment ID.')</script>";
            }
        }
    }
    else{
        echo "query fail: " . mysqli_error($connect);
    }
}


echo "<a href='proj4.html'><button id='home' type='button'>Home</button></a></body></html>";

mysqli_close($connect);
?>
