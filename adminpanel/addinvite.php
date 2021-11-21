<?php
    require_once '../server.php';
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
    function ranCode($length)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0;$i < $length;$i++)
        {
            $randomString .= $characters[rand(0, $charactersLength - 1) ];
        }
        return $randomString;
    }
    $gennedInvite = ranCode(8) . "-" . ranCode(8) . "-" . ranCode(8) . "-" . ranCode(8);
    if($role == "Owner" || $role == "Admin"){
        if(isset($_GET["invitecode"]) || isset($_GET["inviteauthor"])){
            $invitecode = $_GET["invitecode"];
            $inviteauthor = $_GET["inviteauthor"];
            $sql = "INSERT INTO `invites`(`id`, `inviteCode`, `inviteAuthor`) VALUES (NULL, '" . $invitecode . "', '" . $inviteauthor . "');";
            $result = mysqli_query($db, $sql);
            $_SESSION["invite_author"] = $inviteauthor;
            header("location: addinvite");
        }
        else if(isset($_GET["invitewave"])){
          $sql1 = "SELECT * FROM `users`";
          $result = mysqli_query($db, $sql1);
          $rows = mysqli_num_rows($result);
          for($i = 0; $i < $rows; $i++){
            $row = mysqli_fetch_assoc($result);
            $inviteauthor = $row["username"];
            $invitecode = ranCode(8) . "-" . ranCode(8) . "-" . ranCode(8) . "-" . ranCode(8);
            $sql2 = "INSERT INTO `invites`(`id`, `inviteCode`, `inviteAuthor`) VALUES (NULL, '" . $invitecode . "', '" . $inviteauthor . "');";
            mysqli_query($db, $sql2);
          }
          header("location: addinvite");
        }
    }
?>
<html lang="en">
<head>
  <meta name='theme-color' content='ffa550' />
  <meta name='og:site_name' content='https://www.mhills.de/'>
  <meta property="og:title" content="M. Hills File Uploader" />
  <meta property="og:url" content="https://www.mhills.de/" />
  <meta property="og:type" content="website" />
  <meta property="og:description" content="A Free File Uploader for all of your Files." />
  <meta property="og:locale" content="en_GB" />
  <link rel="icon" type="image/png" href="https://mhills.de/images/icons/favicon.ico" />
  <link rel="stylesheet" type="text/css" href="https://mhills.de/vendor/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://mhills.de/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="https://mhills.de/fonts/iconic/css/material-design-iconic-font.min.css">
  <link rel="stylesheet" type="text/css" href="https://mhills.de/vendor/animate/animate.css">
  <link rel="stylesheet" type="text/css" href="https://mhills.de/vendor/css-hamburgers/hamburgers.min.css">
  <link rel="stylesheet" type="text/css" href="https://mhills.de/vendor/animsition/css/animsition.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="apple-mobile-web-app-capable" content="yes" />

<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<link rel="apple-touch-icon" href="https://mhills.de/images/mhills.de.png"/>

<link rel="apple-touch-startup-image" href="https://mhills.de/images/mhills.de.png" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.16.2/build/styles/default.min.css">
  <script src="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.16.2/build/highlight.min.js"></script>
  <script>
    hljs.initHighlightingOnLoad();
  </script>
  <link rel="stylesheet" type="text/css" href="https://mhills.de/vendor/select2/select2.min.css">
  <link rel="stylesheet" type="text/css" href="https://mhills.de/vendor/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" type="text/css" href="https://mhills.de/css/util.css">
  <link rel="stylesheet" type="text/css" href="https://mhills.de/css/main.css">
  <script src="https://mhills.de/vendor/jquery/jquery-3.2.1.min.js"></script>
  <script src='https://www.google.com/recaptcha/api.js'></script>
  <script src="https://mhills.de/vendor/animsition/js/animsition.min.js"></script>
  <script src="https://mhills.de/vendor/bootstrap/js/popper.js"></script>
  <script src="https://mhills.de/vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="https://mhills.de/vendor/select2/select2.min.js"></script>
  <!-- Optional: include a polyfill for ES6 Promises for IE11 -->
  <script src="//cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>
  <!-- Include the Dark theme -->
  <link rel="stylesheet" href="node_modules/@sweetalert2/theme-dark/dark.css">

  <script src="node_modules/sweetalert2/dist/sweetalert2.min.js"></script>

  <script src="https://mhills.de/vendor/daterangepicker/moment.min.js"></script>
  <script src="https://mhills.de/vendor/daterangepicker/daterangepicker.js"></script>
  <script src="https://mhills.de/vendor/countdowntime/countdowntime.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://mhills.de/js/main.js"></script>
</head>
<body>
  <div class="navbar navbar-expand-md navbar-dark bg-dark mb-4" role="navigation">
    <div class="navbarimg">
      <img src="https://mhills.de/images/mhills.de.png" alt="" style="max-height: 30px;">
    </div>
    <a class="navbar-brand" href="#"><strong>M. Hills File Host</strong></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" target="_self" href="../home">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" target="_self" href="invite-management">Invite Management</a>
        </li>

        <li class="nav-item active">
          <a class="nav-link" target="_self" href="#">Add Invites <span class="sr-only">(current)</span></a>
        </li>

        <li class="nav-item">
          <a class="nav-link" target="_self" href="users">Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" target="_self" href="settings">Settings</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" target="_self" href="https://mhills.de/phpmyadmin">phpMyAdmin</a>
        </li>

      </ul>
      <form class="form-inline mt-2 mt-md-0">
        <button class="btn btn-outline my-2 my-sm-0"><a href="index.php?logout='1'" style="color: red;">Logout</a></button>
      </form>
    </div>
  </div>
  <style>
    .hljs {
      display: block;
      overflow-x: auto;
      padding: .5em;
      background: #131313;
      border-radius: 15px;
      color: white;
      text-align: left;
      font-size: calc(1vw + 0.7vh);
    }

    /* Style buttons */
    .btn32143 {
      background-color: #131313;
      color: white;
      padding: 12px 50px;
      cursor: pointer;
      font-size: 20px;
      border-radius: 15px;
    }

    .g-recaptcha {
      padding: 12px 30%;
    }

    /* Darker background on mouse-over */
    .btn32143:hover {
      background-color: grey;
    }

    .card {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    word-wrap: break-word;
    background-color: #131313;
    background-clip: border-box;
    border: 1px solid rgba(0, 0, 0, .125);
    border-radius: 15px;
}


    .card img {
      border-radius: 50%;
      width: 60%;
      height: auto;
      display: block;
      margin-left: auto;
      margin-right: auto;
      margin-top: 10%;
    }
    .card {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0px;
    width: auto;
    height: auto;
    word-wrap: break-word;
    background-color: #131313;
    background-clip: border-box;
    border: 2px solid rgba(0, 0, 0, .125);
    border-radius: 15px;
    padding: 15px;
    margin: 10px 10px 10px 10px;
    box-shadow: 0 1px 10px rgb(0 0 0 / 30%), 0 15px 12px rgb(0 0 0 / 22%);
}
    .wrap-login100 {
      width: auto;
      background: #1b1b1b;
      border-radius: 20px;
      overflow: hidden;
      padding: 33px 33px 33px 33px;
      box-shadow: 0 5px 10px 0px rgb(0 0 0 / 10%);
      -moz-box-shadow: 0 5px 10px 0px rgba(0, 0, 0, 0.1);
      -webkit-box-shadow: 0 5px 10px 0px rgb(0 0 0 / 10%);
      -o-box-shadow: 0 5px 10px 0px rgba(0, 0, 0, 0.1);
      -ms-box-shadow: 0 5px 10px 0px rgba(0, 0, 0, 0.1);
    }
    .swal2-popup {
    display: none;
    position: relative;
    box-sizing: border-box;
    flex-direction: column;
    justify-content: center;
    width: 45em;
    max-width: 100%;
    padding: 1.25em;
    border: none;
    border-radius: 15px;
    background: #232323;
    font-family: inherit;
    font-size: 1rem;
    box-shadow: 0 1px 10px rgb(0 0 0 / 30%), 0 15px 12px rgb(0 0 0 / 22%);
}
.swal2-styled.swal2-confirm {
  border: 0;
  border-radius: 10px;
  background: initial;
  background-color: #191919;
  color: #fff;
  font-size: 1.0625em;
  box-shadow: 0 1px 10px rgb(0 0 0 / 30%), 0 15px 12px rgb(0 0 0 / 22%);
}
.swal2-popup.swal2-toast {
    flex-direction: row;
    align-items: center;
    width: auto;
    padding: 0.625em;
    overflow-y: hidden;
    background: #19191a;
    box-shadow: 0 0 0.625em black;
}
    .card img {
      border-radius: 50%;
      width: 40%;
      height: auto;
      display: block;
      margin-left: auto;
      margin-right: auto;
      margin-top: 10%;
    }

    .card img {
    border-radius: 25%;
    width: 25%;
    height: auto;
    display: block;
    margin-left: auto;
    margin-right: auto;
    margin-top: 10%;
    transition: 0.3s;
}
    .row-card {
      display:inline-block;
      vertical-align:middle;
    }

    .wrap-login100 {
    width: 560px;
    background: #1b1b1b;
    border-radius: 20px;
    overflow: hidden;
    padding: 5px;
    box-shadow: 0 5px 10px 0px rgb(0 0 0 / 10%);
    -moz-box-shadow: 0 5px 10px 0px rgba(0, 0, 0, 0.1);
    -webkit-box-shadow: 0 5px 10px 0px rgb(0 0 0 / 10%);
    -o-box-shadow: 0 5px 10px 0px rgba(0, 0, 0, 0.1);
    -ms-box-shadow: 0 5px 10px 0px rgba(0, 0, 0, 0.1);
}
    .p-b-26 {
    padding-bottom: 0px;
}
.flex {
    display: -webkit-box;
    display: -moz-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
}
.flex-child-small {
    -webkit-box-flex: 1 1 auto;
    -moz-box-flex: 1 1 auto;
    -webkit-flex: 1 1 auto;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    margin: 10px;
    font-size: 20px;
    border-radius: 15px;
    width: 100px;
    height: auto;
    font-family: Poppins-Regular;
    font-size: 14px;
    line-height: 1.7;
    color: #666666;
    text-align: center;
}
    hr.rounded {
  border-top: 2px solid #1b1b1b;
  border-radius: 5px;
}
select {
    background-color: #131313;
    font-size: 16px;
    color: white;
    width: -webkit-fill-available;
    padding: 12px 50px;
    margin: 5px;
    cursor: pointer;
    text-align: center;
    border-radius: 15px;
    border: 1px solid grey;
}
input {
    background-color: #131313;
    font-size: 16px;
    color: white;
    padding: 12px 50px;
    margin: 5px;
    cursor: pointer;
    text-align: center;
    border-radius: 15px;
    border: 1px solid grey;
}
.btn32143 {
    background-color: #131313;
    color: white;
    padding: 12px 50px;
    margin: 5px;
    cursor: pointer;
    text-align: center;
    border-radius: 15px;
    border: 1px solid grey;
}
  </style>
  <div class="container-login100">
    <div class="wrap-login100">
      <!-- notification message -->
      <span class="login100-form-title p-b-26">
        <div class='card' <div class='card-body'>
        <div class="flex">
        <img src="https://mhills.de/images/mhills.de.png" class="card-img-top">
          </div>
          <br>
          <hr class='rounded'><br>
          <?php
        if($role == "Owner" || $role == "Admin"){
            echo "<form method='get' action='addinvite'><select name='inviteauthor' id='user-select'><option value=''>Choose a User</option>";
            $sql = "SELECT `username` FROM `users` ORDER BY username ASC";
            if($result = mysqli_query($db, $sql)){
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_array($result)){
                      $username = $row["username"];
                      $text = "<option value='$username'><a>$username</a></option>";
                        echo $text;
                    }
                }
                else{
                    die("Not found!");
                }
            }
            echo "</select>
            <div class='input-group'>
            <input type='invitecode' placeholder='Enter Invite Code' name='invitecode' value='$gennedInvite'>
          </div><br><button type='submit' class='btn32143'>Add</button></form><br>
          <hr class='rounded'><br><form method='get' action='addinvite'><button type='submit' name='invitewave' class='btn32143'>Do Invitewave</button></form>";
        }
        else{
            die("<br><br>You are not an admin! Please leave this site immediately");
        }
  ?>

      </span>
    </div>


  </div>
</body>
</html>