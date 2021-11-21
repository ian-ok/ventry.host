<?php
    session_start();
    $reset_permitted = "";
    if(isset($_GET["code"])){
      if($_GET["code"] == $_SESSION["resetcode"]){
        $_SESSION["RESET_ALLOWED"] = "true";
      }
      else{
        $_SESSION["RESET_ALLOWED"] = "false";
      }
      if($_SESSION["RESET_ALLOWED"] == "true"){
        echo "<head>
        <link rel='icon' type='image/png' href='https://mhills.de/images/icons/favicon.ico'/>
        <link rel='stylesheet' type='text/css' href='https://mhills.de/vendor/bootstrap/css/bootstrap.min.css'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <meta name='apple-mobile-web-app-capable' content='yes' />

        <meta name='apple-mobile-web-app-status-bar-style' content='black' />
        <link rel='apple-touch-icon' href='https://mhills.de/images/mhills.de.png'/>
        
        <link rel='apple-touch-startup-image' href='https://mhills.de/images/mhills.de.png' />
        <link rel='stylesheet' type='text/css' href='https://mhills.de//fonts/font-awesome-4.7.0/css/font-awesome.min.css'>
        <link rel='stylesheet' type='text/css' href='https://mhills.de//fonts/iconic/css/material-design-iconic-font.min.css'>
        <link rel='stylesheet' type='text/css' href='https://mhills.de//vendor/animate/animate.css'>
        <link rel='stylesheet' type='text/css' href='https://mhills.de//vendor/css-hamburgers/hamburgers.min.css'>
        <link rel='stylesheet' type='text/css' href='https://mhills.de//vendor/animsition/css/animsition.min.css'>
        <link rel='stylesheet' type='text/css' href='https://mhills.de//vendor/select2/select2.min.css'>
        <link rel='stylesheet' type='text/css' href='https://mhills.de//vendor/daterangepicker/daterangepicker.css'>
        <link rel='stylesheet' type='text/css' href='https://mhills.de//css/util.css'>
        <link rel='stylesheet' type='text/css' href='https://mhills.de//css/main.css'>
        <script src='https://mhills.de//vendor/jquery/jquery-3.2.1.min.js'></script>
        <script src='https://mhills.de//vendor/animsition/js/animsition.min.js'></script>
        <script src='https://mhills.de//vendor/bootstrap/js/popper.js'></script>
        <script src='https://mhills.de//vendor/bootstrap/js/bootstrap.min.js'></script>
        <script src='https://mhills.de//vendor/select2/select2.min.js'></script>
        <script async src='https://arc.io/widget.min.js#3uop4387'></script>
        <script src='https://mhills.de//vendor/daterangepicker/moment.min.js'></script>
        <script src='https://mhills.de//vendor/daterangepicker/daterangepicker.js'></script>
        <script src='https://mhills.de//vendor/countdowntime/countdowntime.js'></script>
        <script src='https://mhills.de//js/main.js'></script>
        <meta property='og:type' content='website'>
     </head>
     <body>
  <div class='loader-wrapper'>
      <span class='loader'><span class='loader-inner'></span></span>
  </div>
  
  <div id='body_div'>
        <div class='container-login100'>
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
        border-radius: 25%;
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
        border-radius: 50%;
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
  .btn32143 {
    background-color: #131313;
      color: white;
      cursor: pointer;
      margin-bottom: 10px;
      font-size: 20px;
      border-radius: 15px;
      border: 1px solid grey;
      width: 100%;
      }
        </style>
           <div class='wrap-login100'>
              <!-- notification message -->
              <span class='login100-form-title p-b-26'>
                 <div class='card'>
          <img src='https://mhills.de/images/mhills.de.png' class='card-img-top'>
            <br>
            <hr class='rounded'>
                 <h5 class='card-title'><br>Password Reset</h5><br>
                 <form method='post' action='reset-password'>
                  <input type='password' name='password1' placeholder='Enter New Password'>
                  <input type='password' name='password2' placeholder='Enter New Password'>
                </div><br>
              <button type='submit' class='btn32143'>Change Password</button>
            </form>
              </div>
           </div>
           </span>
        </div>
        </div>
  
  </div>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/tilt.js/1.2.1/tilt.jquery.min.js'></script>
        <script src='https://unpkg.com/tilt.js@1.2.1/dest/tilt.jquery.min.js'></script>
  
     </body>";
      }
      else{
          echo "You cant do this.";
      }
    }
    if($_SESSION["RESET_ALLOWED"] == "true" && isset($_POST["password2"])){
        $new_password1 = md5($_POST["password1"]);
        $new_password2 = md5($_POST["password2"]);
        if($new_password1 == $new_password2){
          $id = $_SESSION["resetid"];
          $db = mysqli_connect('localhost', 'root', 'Julian2016--!123', 'file-host');
          $sql = "UPDATE `users` SET `password`='$new_password2' WHERE `id`='$id'";
          mysqli_query($db, $sql);
          header("location: login");
        }

    }
?>