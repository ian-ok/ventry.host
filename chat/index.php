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
$username = $_SESSION["username"];
$db = mysqli_connect('localhost', 'root', 'atomicasb123', 'chat');
if(isset($_POST["send"])){
    date_default_timezone_set('Europe/Amsterdam');
    $date = date("h:i A");
    $message = $_POST["send"];
    unset($_POST['send']);
    $sql = "INSERT INTO `messages` VALUES(NULL, '$username', '$message', '$date')";
    $result = mysqli_query($db, $sql);
}
unset($_POST['send']);
$sql = "SELECT * FROM `messages` ORDER BY `id` DESC";
$result = mysqli_query($db, $sql);
$message = mysqli_fetch_assoc($result);
$old_id = $message["id"];
?>
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
        <style>
    html {
  font-family: Lato, sans-serif;
  background-color: #131313;
}

.activity-stream {
  list-style-type: none;
  margin: 2em 3em;
  padding: 0;
  padding-left: 1.5em;
}
.activity-stream li {
    border: 1px solid grey;
    padding: 1em;
    display: block;
    border-radius: 15px;
    background: #1b1b1b;
    position: relative;
    width: fit-content;
    box-shadow: 0 1px 10px rgb(0 0 0 / 30%), 0 15px 12px rgb(0 0 0 / 22%);
}
.activity-stream li .icon {
  height: 30px;
  width: 30px;
  padding: 8px 11px;
  color: #fff;
  box-sizing: border-box;
  display: block;
  background: #53b2ea;
  position: absolute;
  left: -3.5em;
  top: .5em;
  -moz-border-radius: 50%;
  -webkit-border-radius: 50%;
  border-radius: 50%;
}
a{
    padding-right: 3em;
}
</style>
    <ol class="activity-stream">
        <?php
            dothis:
            $sql = "SELECT * FROM `messages` ORDER BY `id` DESC";
            $new_result = mysqli_query($db, $sql);
            $new_message = mysqli_fetch_assoc($new_result);
            $new_id = $new_message["id"];
            if(!$new_id == $old_id){
                goto dothis;
            }
            else{
                $sql = "SELECT * FROM `messages`";
                if($result = mysqli_query($db, $sql)){
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_array($result)){
                            echo "<li><i class='fa fa-bolt icon'></i><a>" . $row["author"] . " - at " . $row["date"] . "</a><br><a>" . $row["content"] . "</a></li><br>";
                        }
                    }
                }
            }
        ?>
    </ol>
    <br>
    <br>
    <form method="POST">
        <input style="margin: 0 0 0 3em;" type="text" name="send" placeholder="Enter message">
        <input type="submit" value="Send">
    </form>         
                </span>
            </div>
        </div>
</body>

</html>