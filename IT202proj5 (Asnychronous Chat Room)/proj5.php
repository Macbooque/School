<?php

$servername = "sql1.njit.edu";
$username = "dee22";
$password = "---------";
$dbname = "dee22";

$connect = mysqli_connect($servername,$username,$password,$dbname);

if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


$name = isset($_POST['name']) ? $_POST['name'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$chat = isset($_POST['chatEntry']) ? $_POST['chatEntry'] : '';

$loginCheckQuery = "SELECT * FROM ChatRoom WHERE Name = '$name' AND Password = '$password'";
if ($result = mysqli_query($connect, $loginCheckQuery)){
    if (mysqli_num_rows($result) > 0){
        $updateQuery = "UPDATE ChatRoom SET ChatContent = '$chat' WHERE Name = '$name' AND Password = '$password'";
        if ($result2 = mysqli_query($connect, $updateQuery)){
            echo "update success";
        }
        else{
            echo "update fail";
        }
    }
    else{
        echo("loginFail");
    }
}

else{
    echo("initial query fail");
}

?>
