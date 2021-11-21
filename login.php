<?php
   session_start();
   if(isset($_SESSION["username"])){
      header("location: https://mhills.de/dashboard");
   }
?>
<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
        <link rel="icon" type="image/png" href="/images/icons/favicon.ico"/>
        <link rel="stylesheet" type="text/css" href="/vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="/fonts/iconic/css/material-design-iconic-font.min.css">
        <link rel="stylesheet" type="text/css" href="/vendor/animate/animate.css">
        <link rel="stylesheet" type="text/css" href="/vendor/css-hamburgers/hamburgers.min.css">
        <link rel="stylesheet" type="text/css" href="/vendor/animsition/css/animsition.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.16.2/build/styles/default.min.css">
        <script src="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.16.2/build/highlight.min.js"></script>
        <script>hljs.initHighlightingOnLoad();</script>
        <link rel="stylesheet" type="text/css" href="/vendor/select2/select2.min.css">
        <link rel="stylesheet" type="text/css" href="/vendor/daterangepicker/daterangepicker.css">
        <link rel="stylesheet" type="text/css" href="/css/util.css">
        <link rel="stylesheet" type="text/css" href="/css/main.css">
        <script src="/vendor/jquery/jquery-3.2.1.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <script async src="https://arc.io/widget.min.js#3uop4387"></script>
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<link rel="apple-touch-icon" href="https://mhills.de/images/mhills.de.png"/>

<link rel="apple-touch-startup-image" href="https://mhills.de/images/mhills.de.png" />
        <script src='/https://www.google.com/recaptcha/api.js'></script>
        <script src="/vendor/animsition/js/animsition.min.js"></script>
        <script src="/vendor/bootstrap/js/popper.js"></script>
        <script src="/vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="/vendor/select2/select2.min.js"></script>
        <script src="/vendor/daterangepicker/moment.min.js"></script>
        <script src="/vendor/daterangepicker/daterangepicker.js"></script>
        <script src="/vendor/countdowntime/countdowntime.js"></script>
<!-- Optional: include a polyfill for ES6 Promises for IE11 -->
<script src="//cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>
<!-- Include the Dark theme -->
<link rel="stylesheet" href="node_modules/@sweetalert2/theme-dark/dark.css">

<script src="node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="/js/main.js"></script>
</head>
<body>
<div class="loader-wrapper">
    <span class="loader"><span class="loader-inner"></span></span>
</div>

<style>
.wrap-login100 {
    width: 490px;
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
   .hljs {
   display: block;
   overflow-x: auto;
   padding: .5em;
   background: #131313;
   border-radius: 15px;
   text-align: left;
   color: #fff;
   }
   /* Style buttons */
   .btn32143 {
    background-color: #131313;
    color: white;
    padding: 12px 50px;
    cursor: pointer;
    font-size: 20px;
    border-radius: 15px;
    border: 1px solid grey;
}
   .g-recaptcha {
   padding: 12px 30%;
   }
   /* Darker background on mouse-over */
   .btn32143:hover {
   background-color: grey;
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
<!-- <div class="container-login100">
   <div class="wrap-login100">
      <span class="login100-form-title p-b-26">
      <div class="card">
         <div class="img-container-small">
            <img src="../images/mhills.de.png">
         </div>
         <br>
         <strong>Login</strong>
         <br>    
         <hr class="rounded">        
      <br>    -->     
<!-- <form method="post" action="login">
  	<?php include('errors.php'); ?>
<br>-->
     <!-- <div class="input-group">
  	  <input type="text" name="username" placeholder="Enter Username" value="">
  	</div>
  	<div class="input-group">
  	  <input type="password" placeholder="Enter Password" name="password">
  	</div>
     <p style='text-align: right;'>
  		Forgot your Password? <a href="reset" style="color: white; text-align: right;">Reset</a>
  	</p><br>
  	  <button type="submit" class="btn32143" name="login_user">Login</button>
       <p><br>
  		Not yet a member? <a href="register" style="color: white;">Sign Up</a>
  	</p>
     </div>
       </form>-->
				
      <!--</span>
   </div>
</div>	-->
</body>
</html>