<?php
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
$db = mysqli_connect('localhost', 'root', 'atomicasb123', 'file-host');
$query21 = "SELECT * FROM `invites` WHERE `inviteAuthor`=" . '"' . $_SESSION["username"] . '";';
$results21 = mysqli_query($db, $query21);
$rows21 = mysqli_num_rows($results21);
?>

<html>

<head>
    <meta name='theme-color' content='ffa550' . <meta name='og:site_name' content='https://www.mhills.de/'>
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
    <div class="loader-wrapper">
        <span class="loader"><span class="loader-inner"></span></span>
    </div>

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
                <li class="nav-item active">
                    <a class="nav-link" target="_self" href="#">Invites <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="../search" target="_self">User Search</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" target="_self" href="../settings">Settings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" target="_self" href="../rules">Rules</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" target="_self" href="../host">Host</a>
                </li>

                <li class="nav-item">
                <a class="nav-link" target="_self" href="../scoreboard">Scoreboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" target="_self" href="https://mhills.de/gallery">Gallery</a>
                </li>

                <li class="nav-item">
          <a class="nav-link" target="_self" href="https://mhills.de/file-upload">Upload</a>
        </li>

            </ul>
            <form class="form-inline mt-2 mt-md-0">
                <button class="btn btn-outline my-2 my-sm-0"><a href="index.php?logout='1'" style="color: red;">Logout</a></button>
            </form>
        </div>
    </div>

    <div class="container-login100">
        <style>
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
        <br><br><br>
        <div class="container-login100">
            <div class="wrap-login100">
                <!-- notification message -->
                <span class="login100-form-title p-b-26">
                    <div class='card' <div class='card-body'>
                    <div class="flex">
        <img src="https://mhills.de/images/mhills.de.png" class="card-img-top">
          </div>
          <br>
        <hr class="rounded">
        <br>
                        <?php 
                            for ($i = 0; $i < $rows21; ++$i) { 
                                $row21 = mysqli_fetch_assoc($results21);
                                echo "<p class='card-text'><a  style='color: white;' href='https://mhills.de/invite/" . $row21['inviteCode'] . "'>" . $row21['inviteCode'] . "</a></p>";
                            }
                        ?>
                </span>
            </div>
        </div>
</body>

</html>