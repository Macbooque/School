
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

echo "<html><head><script src='proj4customerValidation.js'></script><link rel='stylesheet' href='proj4.css'/></head><body>
    <form id = 'form' action='proj4createcustomersession.php' method='GET'>
        <h1>Perfect Plumbing Pros: Create a Customer Profile Form</h1>
        <p>
          <label>Customer's First Name:
          <input type='text' id='customerfirstname' name='customerfirstname' placeholder='Ex: John' />REQUIRED</label>
        </p>
        <p>
          <label>Customer's Last Name:
          <input type='text' id='customerlastname' name='customerlastname' placeholder='Ex: Smith' />REQUIRED</label>
        </p>
        <p>
          <label>Customer's ID Number:
          <input type='text' id='customerid' name='customerid' placeholder='Ex: 1234' />REQUIRED</label>
        </p>
        <p>
          <input type='submit' id = 'submit' value='Submit'/>
        </p>
    </form>";


$customerID = isset($_GET['customerid']) ? $_GET['customerid'] : -1;

if (!empty($_GET['customerid']) && !empty($_GET['customerfirstname']) && !empty($_GET['customerlastname'])){

    $firstName = $_GET['customerfirstname'];
    $lastName = $_GET['customerlastname'];
    $query = "SELECT * FROM Customer WHERE CustomerID = $customerID";
    $result = mysqli_query($connect, $query);
    if (mysqli_num_rows($result) === 0){

        $insertQuery = "INSERT INTO Customer (CustomerFirstname, CustomerLastName, CustomerID)
                        VALUES ('$firstName', '$lastName', '$customerID') ";
        if (mysqli_query($connect, $insertQuery)) {
            $insertPersonalInfo = "INSERT INTO CustomerPersonalInformation (CustomerID, CustomerAddress, CustomerState, CustomerCity, CustomerZipCode, CustomerPhoneNumber)
                                   VALUES ('$customerID', '', '', '', '', '') ";
            if (mysqli_query($connect, $insertPersonalInfo)) {
                echo "<script>alert('Customer has been created. You will now be redirected to a form to enter the personal information for the customer.');
                      window.location.href = 'proj4updaterecordssession.php';</script>";
            }
            else {
                echo "Error during insert query: " . mysqli_error($connect);
            }
        }
    }
    else{
        if ($customerID !== -1){
            echo "<script>alert('Customer already has an Account.'); </script>";
        }
    }
}


echo "<a href='proj4.html'><button id='home' type='button'>Home</button></a></body></html>";
mysqli_close($connect);
?>
