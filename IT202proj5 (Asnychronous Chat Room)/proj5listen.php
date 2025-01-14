<?php

$servername = "sql1.njit.edu";
$username = "dee22";
$password = "Dumbass1234!";
$dbname = "dee22";

$connect = mysqli_connect($servername,$username,$password,$dbname);

if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


$listenName = isset($_POST['listenName']) ? $_POST['listenName'] : '';


$loginCheckQuery = "SELECT ChatContent FROM ChatRoom WHERE Name = '$listenName'";
if ($result = mysqli_query($connect, $loginCheckQuery)){
    if (mysqli_num_rows($result) > 0){
        if ($row = mysqli_fetch_assoc($result)){
            echo $row['ChatContent'];
        }
    }
}

else{
    echo("initial query fail");
}

?>
