
<?php
session_start();
require "Authenticator.php";


$Authenticator = new Authenticator();
if (!isset($_SESSION['auth_secret'])) {
    $secret = $Authenticator->generateRandomSecret();
    $_SESSION['auth_secret'] = $secret;
}

function generateRandomString($length = 5)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


if (!isset($_SESSION['failed'])) {
    $_SESSION['failed'] = false;
}


?>

<html>

<head>
    <meta name='theme-color' content='ffa550'>
    <meta name='og:site_name' content='https://www.mhills.de/'>
    <meta property="og:title" content="M. Hills File Uploader" />
    <meta property="og:url" content="https://www.mhills.de/" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="A Free File Uploader for all of your Files." />
    <meta property="og:locale" content="en_GB" />
    <link rel="icon" type="image/png" href="../images/icons/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../fonts/iconic/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" type="text/css" href="../vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="../vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="../vendor/animsition/css/animsition.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.16.2/build/styles/default.min.css">
    <script src="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.16.2/build/highlight.min.js"></script>
    <script>
        hljs.initHighlightingOnLoad();
    </script>
    <link rel="stylesheet" type="text/css" href="../vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="../vendor/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="../css/util.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="../vendor/animsition/js/animsition.min.js"></script>
    <script src="../vendor/bootstrap/js/popper.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../vendor/select2/select2.min.js"></script>
    <!-- Optional: include a polyfill for ES6 Promises for IE11 -->
    <script src="//cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>
    <!-- Include the Dark theme -->
    <link rel="stylesheet" href="node_modules/@sweetalert2/theme-dark/dark.css">

    <script src="node_modules/sweetalert2/dist/sweetalert2.min.js"></script>

    <script src="../vendor/daterangepicker/moment.min.js"></script>
    <script src="../vendor/daterangepicker/daterangepicker.js"></script>
    <script src="../vendor/countdowntime/countdowntime.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../js/main.js"></script>
</head>

<body>
    <div class="loader-wrapper">
        <span class="loader"><span class="loader-inner"></span></span>
    </div>

    <div class="navbar navbar-expand-md navbar-dark bg-dark mb-4" role="navigation">
        <div class="navbarimg">
            <img src="../images/mhills.de.png" alt="" style="max-height: 30px;">
        </div>
        <a class="navbar-brand" href="#"><strong>M. Hills File Host</strong></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" target="_self" href="/home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="url-shortener" target="_self">Url Shortener</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" target="_self" href="settings">Settings</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" target="_self" href="#">Rules <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" target="_self" href="host">Host</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" target="_self" href="../forum">Forum</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" target="_self" href="../gallery">Gallery</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link disabled" target="_self" href="#">File Preview</a>
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
                width: 500px;
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
    box-shadow: 0 1px 10px rgb(0 0 0 / 30%), 0 15px 12px rgb(0 0 0 / 22%);
}
        </style>
        <br><br><br>
        <div class="container-login100">
            <div class="wrap-login100">
                <!-- notification message -->
                <span class="login100-form-title p-b-26">
                    <div class="img-container-small">
                        <!-- Block parent element -->
                        <img src="../images/mhills.de.png">
                        <br>
         <strong>Setup 2FA</strong>
         <br>   
                    </div>
                    <br>
                    <form action="checklogin" method="post">
                    <div style="text-align: center;">
                        <?php if ($_SESSION['failed']): ?>
                            <div class='card' <div class='card-body'> <br> <h3 class='card-text' style='color: red;'>Invalid Code! <? echo $secret ?></h3> <br> </div> </div> <br>
                            <?php   
                                $_SESSION['failed'] = false;
                            ?>
                        <?php endif ?>
                        
                            <div class="input-group">
  	  <input type="text" name="code" placeholder="Enter 2FA Code"">
  	</div>
                            <button type="submit" class="btn32143">Verify</button>

                    </div>

                </form>
                </span>
        </div>
</body>

</html>