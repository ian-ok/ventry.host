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
}$sql1 = "SELECT * FROM toggles;";
if($result1 = mysqli_query($db, $sql1)){
    if(mysqli_num_rows($result1) > 0){
        while($row1 = mysqli_fetch_array($result1)){
            $maintenance = $row1["maintenance"];
            $allow_uploads = $row1["allow_uploads"];
            $announcement = $row1["announcement"];
        }
    }
    else{
        die("Not found!");
    }
}

if($maintenance == "true"){
    $maintenance = "checked";
}
if($allow_uploads == "true"){
    $allow_uploads = "checked";
}

if(!$role == "Owner" || !$role == "Admin"){
    die("Dont try it (:");
}
if (isset($_GET['update'])) {
    if (isset($_POST['maintenance'])) {
      $sql2 = "UPDATE toggles SET `maintenance`='true';";
      $result2 = mysqli_query($db, $sql2);
    }

    if (!isset($_POST['maintenance'])) {
        $sql2 = "UPDATE toggles SET `maintenance`='false';";
        $result2 = mysqli_query($db, $sql2);
    }

    if (isset($_POST['allow_uploads'])) {
        $sql2 = "UPDATE toggles SET `allow_uploads`='true';";
        $result2 = mysqli_query($db, $sql2);
      }
  
      if (!isset($_POST['allow_uploads'])) {
          $sql2 = "UPDATE toggles SET `allow_uploads`='false';";
          $result2 = mysqli_query($db, $sql2);
      }

      if (isset($_POST['announcement_text'])) {
        $sql2 = "UPDATE toggles SET `announcement`='" . $_POST['announcement_text'] . "';";
        $result2 = mysqli_query($db, $sql2);
    }
  
    header("location: https://mhills.de/adminpanel/settings");
  }
else{
    echo "
    <html>

<head>
  <meta name='theme-color' content='ffa550'>
  <meta name='og:site_name' content='https://www.mhills.de/'>
  <meta property='og:title' content='M. Hills File Uploader' />
  <meta property='og:url' content='https://www.mhills.de/' />
  <meta property='og:type' content='website' />
  <meta property='og:description' content='A Free File Uploader for all of your Files.' />
  <meta property='og:locale' content='en_GB' />
  <link rel='icon' type='image/png' href='https://mhills.de/images/icons/favicon.ico' />
  <link rel='stylesheet' type='text/css' href='https://mhills.de/vendor/bootstrap/css/bootstrap.min.css'>
  <link rel='stylesheet' type='text/css' href='https://mhills.de/fonts/font-awesome-4.7.0/css/font-awesome.min.css'>
  <link rel='stylesheet' type='text/css' href='https://mhills.de/fonts/iconic/css/material-design-iconic-font.min.css'>
  <link rel='stylesheet' type='text/css' href='https://mhills.de/vendor/animate/animate.css'>
  <link rel='stylesheet' type='text/css' href='https://mhills.de/vendor/css-hamburgers/hamburgers.min.css'>
  <link rel='stylesheet' type='text/css' href='https://mhills.de/vendor/animsition/css/animsition.min.css'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <meta name='apple-mobile-web-app-capable' content='yes' />

  <meta name='apple-mobile-web-app-status-bar-style' content='black' />
  <link rel='apple-touch-icon' href='https://mhills.de/images/mhills.de.png'/>
  
  <link rel='apple-touch-startup-image' href='https://mhills.de/images/mhills.de.png' />
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.16.2/build/styles/default.min.css'>
  <script src='https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.16.2/build/highlight.min.js'></script>
  <script>
    hljs.initHighlightingOnLoad();
  </script>
  <link rel='stylesheet' type='text/css' href='https://mhills.de/vendor/select2/select2.min.css'>
  <link rel='stylesheet' type='text/css' href='https://mhills.de/vendor/daterangepicker/daterangepicker.css'>
  <link rel='stylesheet' type='text/css' href='https://mhills.de/css/util.css'>
  <link rel='stylesheet' type='text/css' href='https://mhills.de/css/main.css'>
  <script src='https://mhills.de/vendor/jquery/jquery-3.2.1.min.js'></script>
  <script src='https://www.google.com/recaptcha/api.js'></script>
  <script src='https://mhills.de/vendor/animsition/js/animsition.min.js'></script>
  <script src='https://mhills.de/vendor/bootstrap/js/popper.js'></script>
  <script src='https://mhills.de/vendor/bootstrap/js/bootstrap.min.js'></script>
  <script src='https://mhills.de/vendor/select2/select2.min.js'></script>
  <!-- Optional: include a polyfill for ES6 Promises for IE11 -->
  <script src='//cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js'></script>
  <!-- Include the Dark theme -->
  <link rel='stylesheet' href='node_modules/@sweetalert2/theme-dark/dark.css'>

  <script src='node_modules/sweetalert2/dist/sweetalert2.min.js'></script>

  <script src='https://mhills.de/vendor/daterangepicker/moment.min.js'></script>
  <script src='https://mhills.de/vendor/daterangepicker/daterangepicker.js'></script>
  <script src='https://mhills.de/vendor/countdowntime/countdowntime.js'></script>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
  <script src='https://mhills.de/js/main.js'></script>
</head>

<body>
  <div class='loader-wrapper'>
    <span class='loader'><span class='loader-inner'></span></span>
  </div>

  <div class='navbar navbar-expand-md navbar-dark bg-dark mb-4' role='navigation'>
    <div class='navbarimg'>
      <img src='https://mhills.de/images/mhills.de.png' alt='' style='max-height: 30px;'>
    </div>
    <a class='navbar-brand' href='#'><strong>M. Hills File Host</strong></a>
    <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarCollapse' aria-controls='navbarCollapse' aria-expanded='false' aria-label='Toggle navigation'>
      <span class='navbar-toggler-icon'></span>
    </button>
    <div class='collapse navbar-collapse' id='navbarCollapse'>
      <ul class='navbar-nav mr-auto'>
        <li class='nav-item'>
          <a class='nav-link' target='_self' href='../home'>Home</a>
        </li>

        <li class='nav-item'>
          <a class='nav-link' target='_self' href='invite-management'>Invite Management</a>
        </li>

        <li class='nav-item'>
          <a class='nav-link' target='_self' href='addinvite'>Add Invites</a>
        </li>

        <li class='nav-item'>
          <a class='nav-link' target='_self' href='#'>Users</a>
        </li>
        <li class='nav-item active'>
          <a class='nav-link' target='_self' href='settings'>Settings <span class='sr-only'>(current)</span></a>
        </li>
        <li class='nav-item'>
          <a class='nav-link' target='_self' href='https://mhills.de/phpmyadmin'>phpMyAdmin</a>
        </li>

      </ul>
      <form class='form-inline mt-2 mt-md-0'>
        <button class='btn btn-outline my-2 my-sm-0'><a href='index.php?logout='1'' style='color: red;'>Logout</a></button>
      </form>
    </div>
  </div>
  <script>
  function abfrage(form) {
    if (form.confirm.checked) {

    } else {

    }
  }
</script>
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
.wrap-login100 {
    width: 590px;
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
  </style>
  <div class='container-login100'>
    <div class='wrap-login100'>
      <!-- notification message -->
      <span class='login100-form-title p-b-26'>
        <style>
          .colorpicker {
            height: 45px;
          }

          .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
          }

          .switch input {
            opacity: 0;
            width: 0;
            height: 0;
          }

          .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
          }

          .slider:before {
            position: absolute;
            content: '';
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
          }

          input:checked+.slider {
    background-color: #333333;
}

          input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
          }

          input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
          }

          /* Rounded sliders */
          .slider.round {
            border-radius: 34px;
          }

          .slider.round:before {
            border-radius: 50%;
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
.card img {
      border-radius: 50%;
      width: 40%;
      height: auto;
      display: block;
      margin-left: auto;
      margin-right: auto;
      margin-top: 10%;
    }

    .card img:hover {
      border-radius: 50%;
      width: 40%;
      height: auto;
      display: block;
      margin-left: auto;
      margin-right: auto;
      margin-top: 10%;
      transition: 0.3s;
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
    .card img {
      border-radius: 25%;
      width: 40%;
      height: auto;
      display: block;
      margin-left: auto;
      margin-right: auto;
      margin-top: 10%;
      transition: 0.3s;
    }
    input {
    display: block;
    margin-bottom: 10px;
    padding: 5px;
    width: 100%;
    border: 1px solid grey;
    border-radius: 10px;
    font-size: 16px;
    background-color: #1b1b1b;
    color: white;
}
        </style>
                <div class='card' <div class='card-body'>
        <div class='flex'>
        <img src='https://mhills.de/images/mhills.de.png' class='card-img-top'>
          </div>
          <br>
        <hr class='rounded'>
        <h5 class='card-title'><br>Settings</h5>
        <br>
        <form action='?update' method='post' name='form' enctype='multipart/form-data'>
        <div class='flex'>
          <p class='flex-child-small'><strong>Maintenance:</strong><br><br>
            <label class='switch'>
            <input name='maintenance' type='checkbox' $maintenance>
              <span class='slider round'></span>
            </label>
            </p>
            <p class='flex-child-small'><strong>Allow Uploads:</strong><br><br>
            <label class='switch'>
            <input name='allow_uploads' type='checkbox' $allow_uploads>
              <span class='slider round'></span>
            </label>
            </p>
          </div>
          <br>
        <hr class='rounded'>
        <br>
          <p><strong>Announcement:</strong></p>
          <div class='input-group'>
            <input type='text' name='announcement_text' id='announcement_text' value='$announcement' placeholder='$announcement'>
          </div>
          <div class='input-group'>
          <input type='submit' class='btn32143' name='button1' onclick='abfrage(this.form)' value='Save' />
        </div>

</body>

</html>
    ";
}

?>