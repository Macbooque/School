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


echo "<html><head><script src='proj4updateRecordsValidation.js'></script><link rel='stylesheet' href='proj4.css'/></head><body>
    <form id = 'form' action='proj4updaterecordssession.php' method='GET'>
        <h1>Perfect Plumbing Pros: Update Customer Records Form</h1>
        <p>
          <label>Customer Address:
          <input type='text' id='address' name='address' placeholder='Ex: 14 White Pine Street' />REQUIRED</label>
        </p>
        <p>
          <label>Customer State:
          <input type='text' id='state' name='state' placeholder='Ex: New Jersey' />REQUIRED</label>
        </p>
        <p>
          <label>Customer City:
          <input type='text' id='city' name='city' placeholder='Ex: Newark' />REQUIRED</label>
        </p>
        <p>
          <label>Customer Zip Code:
          <input type='text' id='zip' name='zip' placeholder='Ex: 08056' />REQUIRED</label>
        </p>
        <p>
          <label>Customer Phone Number:
          <input type='text' id='phonenum' name='phonenum' placeholder='Ex: 609-444-7762' />REQUIRED</label>
        </p>
        <p>
          <label>Customer ID:
          <input type='text' id='customerid' name='customerid' placeholder='Ex: 4444' />REQUIRED</label>
        </p>
        <p>
          <input type='submit' id = 'submit' value='Submit'/>
        </p>
    </form>";

$customerID =  isset($_GET['customerid']) ? $_GET['customerid'] : -1;

if ($customerID !== -1){
    $queryCustomerID = "SELECT * FROM CustomerPersonalInformation WHERE CustomerID = $customerID";
    if ($result = mysqli_query($connect, $queryCustomerID)){

        if (mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            $customerID = $row['CustomerID'];
            $address =  !empty($_GET['address']) ? $_GET['address'] : $row['CustomerAddress'];
            $state =  !empty($_GET['state']) ? $_GET['state'] : $row['CustomerState'];
            $zip =  !empty($_GET['zip']) ? $_GET['zip'] : $row['CustomerZipCode'];
            $phoneNum =  !empty($_GET['phonenum']) ? $_GET['phonenum'] : $row['CustomerPhoneNumber'];
            $city = !empty($_GET['city']) ? $_GET['city'] : $row['CustomerCity'];

            $updateQuery = "UPDATE CustomerPersonalInformation SET CustomerAddress = '$address', CustomerState = '$state',
            CustomerCity = '$city', CustomerZipCode = '$zip', CustomerPhoneNumber = '$phoneNum' WHERE CustomerID = $customerID";

            if ($updateResult = mysqli_query($connect, $updateQuery)){
                if ($address != $row['CustomerAddress']){
                    echo "<script>alert('Customer Address has been updated.')</script>";
                }
                if ($state != $row['CustomerState']){
                    echo "<script>alert('Customer State has been updated.')</script>";
                }
                if ($zip != $row['CustomerZipCode']){
                    echo "<script>alert('Customer Zip Code has been updated.')</script>";
                }
                if ($phoneNum != $row['CustomerPhoneNumber']){
                    echo "<script>alert('Customer Phone Number has been updated.')</script>";
                }
                if ($city != $row['CustomerCity']){
                    echo "<script>alert('Customer City has been updated.')</script>";
                }

            }
        }
        else{
            echo "<script>alert('Customer does not exist. You will redirected to create a client account form.')</script>";
        }
    }
    else{
        echo "query fail: " . mysqli_error($connect);
    }
}



echo "<a href='proj4.html'><button id='home' type='button'>Home</button></a></body></html>";

mysqli_close($connect);
?>
