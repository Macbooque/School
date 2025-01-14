
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

$plumberID = $_SESSION['plumberid'];

echo "<html><head><script src='proj4customerValidation.js'></script><link rel='stylesheet' href='proj4.css'/></head><body>
    <form id = 'form' action='proj4customerchecksession.php' method='GET'>
        <h1>Perfect Plumbing Pros: Verify Customer Form</h1>
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
$firstName = isset($_GET['customerfirstname']) ? $_GET['customerfirstname'] : "";
$lastName = isset($_GET['customerlastname']) ? $_GET['customerlastname'] : "";
$query = "SELECT * FROM Customer WHERE CustomerID = $customerID AND CustomerFirstName = '$firstName' AND CustomerLastName = '$lastName'";

if ($result = mysqli_query($connect, $query))
{
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['customerid'] = $customerID;
        header("Location: proj4bookappointmentsession.php");
        exit();
    }
    else{
        if ($customerID !== -1){
            echo '<script>
                if (confirm("Customer not found. Please create a customer profile. Press Ok to redirect to customer creation.")){
                    window.location.href = "proj4createcustomersession.php";}</script>';
        }
    }
}
else {
      echo "query fail: " . mysqli_error($connect);
}




echo "<a href='proj4.html'><button id='home' type='button'>Home</button></a></body></html>";
mysqli_close($connect);
?>
