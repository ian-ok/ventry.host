<?php
session_start();


require "Authenticator.php";
if ($_SERVER['REQUEST_METHOD'] != "POST") {
    header("location: ../2fa");
    die();
}
$Authenticator = new Authenticator();




$checkResult = $Authenticator->verifyCode($_SESSION['auth_secret'], $_POST['code'], 2);    // 2 = 2*30sec clock tolerance
$db = mysqli_connect('localhost', 'rootuser', 'K7d^xd52', 'file-host');
if (!$checkResult) {
    $_SESSION['failed'] = true;
    header("location: ../2fa");
    die();
} 
else{
    $username = $_SESSION['username'];
    $_SESSION['2faResult'] = "true";
    $query = "UPDATE `users` SET `use_2fa`='true' WHERE `username`='$username';";
    $result = mysqli_query($db, $query);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>

</head>
<body>
<p>Success! Redirecting...</p>
<script>
setTimeout(() => {
    window.location.href = 'https://mhills.de/home';
}, 2000);
</script>
</body>
</html>