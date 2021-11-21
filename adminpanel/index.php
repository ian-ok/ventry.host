<?php
    require_once '../server.php';
    session_start();
    if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: https://mhills.de/login');
    }
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header("location: https://mhills.de/login");
    }

    $username = $_SESSION["username"];
    $sql = "SELECT * FROM `users` WHERE `username`='$username'";
    $db = mysqli_connect('localhost', 'root', 'atomicasb123', 'file-host');
    if($result = mysqli_query($db, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                $role = $row["role"];
            }
        }
        else{
            die("Not found!");
        }
    }

    if($role == "Owner"){
        header("location: users");
    }
    else{
        header("location: users");
    }
?>