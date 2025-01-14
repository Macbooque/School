
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
$query = "SELECT
              PlumberData.PlumberFirstName,
              PlumberData.PlumberLastName,
              PlumberData.PlumberID,
              PlumberData.PlumberPhoneNumber,
              PlumberData.PlumberEmail,
              Customer.CustomerFirstName,
              Customer.CustomerLastName,
              Customer.CustomerID,
              CustomerPersonalInformation.CustomerAddress,
              CustomerPersonalInformation.CustomerState,
              CustomerPersonalInformation.CustomerCity,
              CustomerPersonalInformation.CustomerZipCode,
              CustomerPersonalInformation.CustomerPhoneNumber,
              CustomerServiceRecord.DateOfService,
              CustomerServiceRecord.TypeOfService,
              CustomerServiceRecord.CostOfService,
              CustomerServiceRecord.ServiceAppointmentID,
              CustomerSuppliesRecord.SuppliesNeeded,
              CustomerSuppliesRecord.SuppliesReceived,
              CustomerSuppliesRecord.SuppliesOnOrderOrOnSite
          FROM
              PlumberData
          INNER JOIN
              CustomerServiceRecord ON PlumberData.PlumberID = CustomerServiceRecord.PlumberID
          INNER JOIN
              Customer ON CustomerServiceRecord.CustomerID = Customer.CustomerID
          INNER JOIN
              CustomerPersonalInformation ON Customer.CustomerID = CustomerPersonalInformation.CustomerID
          INNER JOIN
              CustomerSuppliesRecord ON CustomerServiceRecord.ServiceAppointmentID = CustomerSuppliesRecord.ServiceAppointmentID
          WHERE
              PlumberData.PlumberID = '$plumberID'";

if ($result = mysqli_query($connect, $query))
{
    if (mysqli_num_rows($result) > 0) {
        echo "<link href='proj4.css' rel='stylesheet'><h1>Perfect Plumbing Pros</h1>";
        echo "<table align='center' border='2px' style='width: 1500px; line-height: 40px;'>";
        echo "<tr><th>PlumberFirstName</th><th>PlumberLastName</th><th>PlumberID</th><th>PlumberPhoneNumber</th><th>PlumberEmail</th>
               <th>CustomerFirstName</th><th>CustomerLastName</th><th>CustomerID</th><th>CustomerAddress</th><th>CustomerState</th><th>CustomerZipCode</th>
               <th>CustomerPhoneNumber</th><th>DateOfService</th><th>TypeOfService</th><th>CostOfService</th><th>ServiceAppointmentID</th><th>SuppliesNeeded</th>
               <th>SuppliesReceived</th><th>SuppliesOnOrderOrOnSite</th></tr>";

        while ($row = mysqli_fetch_assoc($result))
        {
            echo "<tr>";
            echo "<td>" . ($row['PlumberFirstName']) . "</td>";
            echo "<td>" . ($row['PlumberLastName']) . "</td>";
            echo "<td>" . ($row['PlumberID']) . "</td>";
            echo "<td>" . ($row['PlumberPhoneNumber']) . "</td>";
            echo "<td>" . ($row['PlumberEmail']) . "</td>";
            echo "<td>" . ($row['CustomerFirstName']) . "</td>";
            echo "<td>" . ($row['CustomerLastName']) . "</td>";
            echo "<td>" . ($row['CustomerID']) . "</td>";
            echo "<td>" . ($row['CustomerAddress']) . "</td>";
            echo "<td>" . ($row['CustomerState']) . "</td>";
            echo "<td>" . ($row['CustomerZipCode']) . "</td>";
            echo "<td>" . ($row['CustomerPhoneNumber']) . "</td>";
            echo "<td>" . ($row['DateOfService']) . "</td>";
            echo "<td>" . ($row['TypeOfService']) . "</td>";
            echo "<td>" . ($row['CostOfService']) . "</td>";
            echo "<td>" . ($row['ServiceAppointmentID']) . "</td>";
            echo "<td>" . ($row['SuppliesNeeded']) . "</td>";
            echo "<td>" . ($row['SuppliesReceived']) . "</td>";
            echo "<td>" . ($row['SuppliesOnOrderOrOnSite']) . "</td>";
            echo "</tr>";
        }

        echo "</table>";
        echo "<a href='proj4.html'><button id='home' type='button'>Home</button></a></body></html>";
    }
    else{
        echo "No data found.";
    }
}
else {
      echo "Error retrieving table details: " . mysqli_error($connect);
}
mysqli_close($connect);
?>