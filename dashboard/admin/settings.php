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
  $username = $_SESSION['username'];
  $db = mysqli_connect('localhost', 'root', 'Julian2016--!123', 'file-host');
  $sql = "SELECT * FROM `users` WHERE `username`='$username'";
  $result = mysqli_query($db, $sql);
  $row = mysqli_fetch_assoc($result);
  $discord_avatar = $row["discord_avatar"];
  $uuid = $row["uuid"];
  if($row["role"] == "Owner"){
    
  }
  else if($row["role"] == "Admin"){
      
}
else if($row["role"] == "Manager"){

}
  else{
      die("you cannot do this!");
  }

  //Invite Count
  $query251 = "SELECT * FROM `invites`";
  $results251 = mysqli_query($db, $query251);
  $invitecount = mysqli_num_rows($results251);

    //Invite Count
    $query21 = "SELECT * FROM `users`";
    $results21 = mysqli_query($db, $query21);

  //User Count
  $query22 = "SELECT * FROM `users`";
  $results22 = mysqli_query($db, $query22);
  $usercount = mysqli_num_rows($results22);

  //Upload Count
  $query25 = "SELECT * FROM `uploads`";
  $results25 = mysqli_query($db, $query25);
  $uploadcount = mysqli_num_rows($results25);

  $query26 = "SELECT * FROM `users` WHERE `banned`='true'";
  $results26 = mysqli_query($db, $query26);
  $banneduserscount = mysqli_num_rows($results26);

$sql1 = "SELECT * FROM toggles;";
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
          if(strlen($_POST['announcement_text'])>1){
            $sql2 = "UPDATE toggles SET `announcement`='" . $_POST['announcement_text'] . "';";
            $result2 = mysqli_query($db, $sql2);
          }
    }
    else if(!isset($_POST['announcement_text'])){

    }
  
    header("location: https://mhills.de/dashboard/admin/settings");
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name='theme-color' content='ffa550' />
  <meta name='og:site_name' content='https://mhills.de/'>
  <meta property="og:title" content="M. Hills File Uploader" />
  <meta property="og:url" content="https://mhills.de/" />
  <meta property="og:type" content="website" />
  <meta property="og:description" content="A Free File Uploader for all of your Files." />
  <meta property="og:locale" content="en_GB" />
  <link rel="icon" type="image/png" href="https://mhills.de/images/icons/favicon.ico" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://mhills.de/dashboard/assets/css/bootstrap.css">
    <!-- Optional: include a polyfill for ES6 Promises for IE11 -->
    <script src="//cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>
    <script src="https://mhills.de/js/toastr.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://mhills.de/css/toastr.css">
    <link rel="stylesheet" type="text/css" href="https://mhills.de/css/toastr.min.css">
    <!-- Include the Dark theme -->
    <link rel="stylesheet" href="https://mhills.de/node_modules/@sweetalert2/theme-dark/dark.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.16.2/build/styles/default.min.css">
    <script src="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.16.2/build/highlight.min.js"></script>
    <script src="https://mhills.de/node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://mhills.de/dashboard/assets/vendors/iconly/bold.css">
    <script src="https://mhills.de/js/main.js"></script>
    <link rel="stylesheet" href="https://mhills.de/dashboard/assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="https://mhills.de/dashboard/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="https://mhills.de/dashboard/assets/css/app.css">
    <link rel="shortcut icon" href="https://mhills.de/dashboard/assets/images/favicon.svg" type="image/x-icon">
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a style="color: #ffffff;"><img style="height: 75px;" src="https://mhills.de/images/mhills.de.png" alt="Logo" srcset=""> mhills.de</a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item ">
                            <a href="https://mhills.de/dashboard/" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../admin" class='sidebar-link'>
                            <svg class="bi" width="1em" height="1em" fill="currentColor">
                                                <use xlink:href="https://mhills.de/dashboard/assets/vendors/bootstrap-icons/bootstrap-icons.svg#person-fill"></use>
                                            </svg>
                                <span>Manage Users</span>
                            </a>
                        </li>
                        <li class="sidebar-item ">
                            <a href="invites" class='sidebar-link'>
                            <svg class="bi" width="1em" height="1em" fill="currentColor">
                                                <use xlink:href="https://mhills.de/dashboard/assets/vendors/bootstrap-icons/bootstrap-icons.svg#person-plus-fill"></use>
                                            </svg>
                                <span>Manage Invites</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="add-invites" class='sidebar-link'>
                            <svg class="bi" width="1em" height="1em" fill="currentColor">
                                                <use xlink:href="https://mhills.de/dashboard/assets/vendors/bootstrap-icons/bootstrap-icons.svg#person-plus-fill"></use>
                                            </svg>
                                <span>Add Invites</span>
                            </a>
                        </li>
                        <li class="sidebar-item active">
                            <a href="#" class='sidebar-link'>
                            <svg class="bi" width="1em" height="1em" fill="currentColor">
                                                <use xlink:href="https://mhills.de/dashboard/assets/vendors/bootstrap-icons/bootstrap-icons.svg#gear-wide-connected"></use>
                                            </svg>
                                <span>Settings</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="https://mhills.de/phpmyadmin" class='sidebar-link'>
                            <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                                <span>phpMyAdmin</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="https://mhills.de/dashboard/index.php?logout=%271%27" class='sidebar-link'>
                            <svg class="bi" width="1em" height="1em" fill="currentColor">
                                                <use xlink:href="https://mhills.de/dashboard/assets/vendors/bootstrap-icons/bootstrap-icons.svg#x-circle-fill"></use>
                                            </svg>
                                <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3 style="text-align: center;">Welcome, <?php echo $username ?></h3>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">MOTD</h4>
                                </div>
                                <div class="card-body px-3 py-4-5">
                                    <a style="color: #ccc">Todays MOTD is: Welcome to mhills.de! Stay safe.</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-9">        
                        <div class="row">
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon purple">
                                                <img style="width: 30px;" src="https://pmls-print.de/wp-content/uploads/2020/06/PMLS_Nav_Icon_Upload.png">
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Total Uploads</h6>
                                                <h6 class="font-extrabold mb-0"><?php echo $uploadcount ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon blue">
                                                <img style="width: 30px;" src="https://mhills.de/images/invite-icon1.png">
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Total Invites</h6>
                                                <h6 class="font-extrabold mb-0"><?php echo $invitecount ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon green">
                                                <img style="width: 30px;" src="https://mhills.de/images/invite-icon1.png">
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Total Users</h6>
                                                <h6 class="font-extrabold mb-0"><?php echo $usercount ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon red">
                                                <img style="width: 30px;" src="https://mhills.de/uploads/ban-icon.png">
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Banned Users</h6>
                                                <h6 class="font-extrabold mb-0"><?php echo $banneduserscount?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3">
                        <div class="card">
                            <div class="card-body py-4 px-5" style="
    background-image: url(<?php echo $row["social_banner"] ?>);
    background-size: cover;
    background-repeat: no-repeat;
    background-position-x: center;
    background-position-y: center;
    border-radius: .7rem;
">
                                <div class="d-flex align-items-center" style="position: relative;align-items: normal;">
                                    <div class="avatar avatar-xl">
                                        <img style="    box-shadow: 0 5px 10px 0px rgb(0 0 0 / 10%);
    -moz-box-shadow: 0 5px 10px 0px rgba(0, 0, 0, 0.1);
    -webkit-box-shadow: 0 5px 10px 0px rgb(0 0 0 / 10%);
    -o-box-shadow: 0 5px 10px 0px rgba(0, 0, 0, 0.1);
    -ms-box-shadow: 0 5px 10px 0px rgba(0, 0, 0, 0.1);" src="<?php echo $row["discord_avatar"] ?>" alt="Face 1">
                                    </div>
                                    <div class="ms-3 name">
                                        <h5 class="font-bold" style="text-shadow: -1px -1px 5px black, 1px -1px 5px black, -1px 1px 5px black, 1px 1px 5px black;"><?php echo $username ?> <span class="badge bg-primary"><?php echo $row["role"] ?></span></h5>
                                        <h6 class="text-muted mb-0" style="text-shadow: -1px -1px 5px black, 1px -1px 5px black, -1px 1px 5px black, 1px 1px 5px black;">@<?php echo $row["discord_username"] ?></h6>
                                        <h6 class="text-muted mb-0" style="text-shadow: -1px -1px 5px black, 1px -1px 5px black, -1px 1px 5px black, 1px 1px 5px black;">Followers: <a style="color: white;"><?php echo $row["social_follower"] ?></a></h6>
                                            <h6 class="text-muted mb-0" style="text-shadow: -1px -1px 5px black, 1px -1px 5px black, -1px 1px 5px black, 1px 1px 5px black;">Secret: <a id="blurtext" style="color: white;"><?php echo $row["secret"] ?></a></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="row">
   <div class="col-6 col-lg-3 col-md-6" style="width: auto">
       <form action="?update" method="post" name="form" enctype="multipart/form-data">
         <div class="card" style="    width: fit-content;">
            <div class="card-header">
               <h4 class="card-title">Host Settings</h4>
            </div>
            <div class="card-body px-3 py-4-5">
            <div class="form-group">
               <div class="flex" style="max-width: 250px">
                  <p class="flex-child-small"><strong style="color: white;">Enable Maintenance:</strong><br><br>
                     <label class="switch">
                     <input name="maintenance" type="checkbox" <?php echo $maintenance ?>>
                     <span class="slider round"></span>
                     </label>
                  </p>
                  <p class="flex-child-small"><strong style="color: white;">Allow Uploads:</strong><br><br>
                     <label class="switch">
                     <input name="allow_uploads" type="checkbox" <?php echo $allow_uploads ?>>
                     <span class="slider round"></span>
                     </label>
                  </p>
               </div>
            </div>
            <div class="form-group">
                                                <label style="color: #ccc" for="basicInput">Announcement</label>
                                                <input type="text" class="form-control" name="announcement_text" id="announcement_text" placeholder="<?php echo $announcement ?>"> </div>
            <div class="input-group">
               <input type="submit" class="btn btn-lg btn-dark" name="button1" onclick="abfrage(this.form)" value="Save" />
            </div>
      </form>
      </div>
      </div>
      </div>

                </section>
            </div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2021 &copy; mhills.de</p>
                    </div>
                    <div class="float-end">
                        <p>Created with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                                href="https://github.com/AtomicHXH">AtomicHXH</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://mhills.de/dashboard/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="https://mhills.de/dashboard/assets/js/bootstrap.bundle.min.js"></script>

    <script src="https://mhills.de/dashboard/assets/vendors/apexcharts/apexcharts.js"></script>
    <script src="https://mhills.de/dashboard/assets/js/pages/dashboard.js"></script>

    <script src="https://mhills.de/dashboard/assets/js/main.js"></script>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
.flex {
    display: -webkit-box;
    display: -moz-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    align-content: center;
    flex-wrap: wrap;
}
#drop_file_zone {
    background-color: #1b1b1b;
    border: #292929 5px dashed;
    width: auto;
    height: 200px;
    padding: 8px;
    font-size: 18px;
    text-align: center;
}
#drag_upload_file {
    margin: 0 auto;
    display: grid;
    place-items: center;
}
#drag_upload_file p {
  text-align: center;
}
#drag_upload_file #selectfile {
  display: none;
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
    font-size: 14px;
    line-height: 1.7;
    color: #666666;
    text-align: center;
}

    .switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
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
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #333333;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
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
    .btn.btn-dark {
    color: #fff;
    margin: 5px;
    background-color: #131313;
    border-radius: 7px;
    border-color: #272727;
    color: #fff;
    width: -webkit-fill-available;
}
.form-control {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background-clip: padding-box;
    background-color: #131313;
    border: 1px solid #000;
    border-radius: 7px;
    color: white;
    display: block;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    padding: .375rem .75rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    width: 100%;
    max-width: 500px;
}
    .btn.btn-dark {
    color: #fff;
    margin: 5px;
}
.table-dark {
    --bs-table-bg: #1b1b1b;
    --bs-table-striped-bg: #131313;
    --bs-table-striped-color: #fff;
    --bs-table-active-bg: #373b3e;
    --bs-table-active-color: #fff;
    --bs-table-hover-bg: #323539;
    --bs-table-hover-color: #fff;
    border-color: #373b3e;
    color: #fff;
}
        .sidebar-wrapper {
    background-color: #1b1b1b;
    bottom: 0;
    height: 100vh;
    overflow-y: auto;
    position: fixed;
    top: 0;
    transition: left .5s ease-out;
    width: 300px;
    z-index: 10;
}
.text-muted {
    color: #ccc;
}
body {
    -webkit-text-size-adjust: 100%;
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    background-color: #131313;
    color: #607080;
    font-family: Nunito;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    margin: 0;
}
.sidebar-wrapper .menu .sidebar-link {
    align-items: center;
    border-radius: .5rem;
    color: #ccc;
    display: block;
    display: flex;
    font-size: 1rem;
    background: #1b1b1b;
    padding: .7rem 1rem;
    text-decoration: none;
    transition: all .5s;
}
.sidebar-wrapper::after .menu::after .sidebar-link::after {
    align-items: center;
    border-radius: .5rem;
    color: #ccc;
    display: block;
    display: flex;
    font-size: 1rem;
    background: #1b1b1b;
    padding: .7rem 1rem;
    text-decoration: none;
    transition: all .5s;
}
.sidebar-wrapper .menu .sidebar-link:hover{background-color:#151515}
.sidebar-wrapper .menu .submenu .submenu-item a {
    color: #ccc;
    background: #171717;
    display: block;
    font-size: .85rem;
    border-radius: 10px;
    margin: 4px;
    font-weight: 600;
    letter-spacing: .5px;
    padding: .7rem 2rem;
    text-decoration: none;
    transition: all .3s;
}
.card {
    word-wrap: break-word;
    background-clip: border-box;
    background-color: #1b1b1b;
    border: 1px solid rgba(0,0,0,.125);
    border-radius: .7rem;
    display: flex;
    flex-direction: column;
    min-width: 0;
    position: relative;
}
.sidebar-wrapper .menu .sidebar-title {
    color: #ffffff;
    font-size: 1rem;
    font-weight: 600;
    list-style: none;
    margin: 1.5rem 0 1rem;
    padding: 0 1rem;
}
.card-header {
    background-color: #101010;
    border-bottom: 1px solid rgba(0,0,0,.125);
    margin-bottom: 0;
    padding: 1.5rem;
}
.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
    color: #ffffff;
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: .5rem;
    margin-top: 0;
}
.text-muted {
    color: #ccc;
}
.sidebar-wrapper .menu .sidebar-link i, .sidebar-wrapper .menu .sidebar-link svg {
    color: #5a5a5a;
}
.sidebar-wrapper .menu .sidebar-item.active .sidebar-link {
    background-color: #131313;
}
a {
    color: #ffffff;
    text-decoration: underline;
}
</style>
<script>
              function download(filename, text) {
            var element = document.createElement('a');
            element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
            element.setAttribute('download', filename);

            element.style.display = 'none';
            document.body.appendChild(element);

            element.click();

            document.body.removeChild(element);
          }

          // Start file download.
          function generateConfig(){
            var text = `{
  "Version": "13.2.1",
  "Name": "Marc Hills Host - <?php echo $_SESSION['username']; ?>",
  "DestinationType": "ImageUploader, FileUploader",
  "RequestMethod": "POST",
  "RequestURL": "https://mhills.de/upload",
  "Parameters": {
    "secret": "<?php echo $row["secret"] ?>",
    "use_sharex": "true"
  },
  "Body": "MultipartFormData",
  "FileFormName": "file"
}`;

            var filename = "mhills.de.sxcu";
            setTimeout(() => {
              download(filename, text);
            }, 1000)
          }
          </script>
          <script>
          function setTitleEmbed() {
            var embedtitle = document.getElementById("embedtitle").value;
            document.getElementById("titleembed").innerHTML = `<a data-v-408d6252="" href="https://mhills.de" target="_blank" class="title-content">${embedtitle.toString()}</a>`;
          }

          function setDescriptionEmbed() {
            var embeddescription = document.getElementById("embeddescription").value;
            document.getElementById("descriptionembed").innerHTML = `${embeddescription}`;
          }

          function setAuthorEmbed() {
            var embeddescription = document.getElementById("embedauthor").value;
            document.getElementById("authorembed").innerHTML = `${embeddescription.toString()}`;
          }

          $('.colorpicker').on('change', function() {
            newbgcolor = this.value;
            //document.getElementById("hexcode").innerHTML = newbgcolor;
            //document.getElementById("hexcode").style.display = "none";
            //var var_js1 = ``;
            //var var_js = "0";
            console.log(newbgcolor);
            $('.embed[data-v-408d6252]').css('border-left', '4px solid ' + newbgcolor);
          });
        </script>
        <style>
            .embed[data-v-408d6252] {
              place-self: start;
              text-align: left;
              max-width: 520px;
              display: grid;
              background: #19191C none repeat scroll 0 0;
              border-radius: 4px;
              border-left: 4px solid <?php echo $embed['embedcolor']; ?>;
              line-height: 1;
              color: #dcddde;
              font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
              font-size: 13px;
              text-rendering: optimizelegibility;
              min-height: 2.75rem;
            }

            .embed-body[data-v-408d6252] {
              padding: .5rem 1rem 1rem .75rem;
              display: inline-grid;
              grid-template-columns: auto;
              grid-template-rows: auto;
            }

            .embed .embed-body .author[data-v-408d6252] {
              min-width: 0;
              display: flex;
              align-items: center;
              grid-column: 1/2;
              margin: 8px 0 0;
            }

            .embed .embed-body .title[data-v-408d6252] {
              min-width: 0;
              display: inline-block;
              margin: 8px 0 0;
              grid-column: 1/2;
            }

            .embed .embed-body .description[data-v-408d6252] {
              min-width: 0;
              margin: 8px 0 0;
              grid-column: 1/2;
            }

            .embed .embed-body .fields[data-v-408d6252] {
              min-width: 0;
              margin: 8px 0 0;
              display: grid;
              grid-column: 1/2;
              gap: 8px;
            }

            .embed .embed-body .title .title-content[data-v-408d6252] {
              font-size: 1rem;
              font-weight: 600;
              white-space: pre-wrap;
              overflow-wrap: break-word;
              line-height: 1.375;
            }

            .embed .embed-body .title a[data-v-408d6252] {
              color: #00b0f4;
            }

            .embed .embed-body .image[data-v-408d6252] {
    min-width: 0;
    margin: 16px 0 0;
    border-radius: 4px;
    cursor: pointer;
    grid-column: 1/3;
    width: 15vw;
    height: auto;
}

            input[type="checkbox"] {
              position: absolute;
              left: -15px;
            }

            input[type="checkbox"]+label {
              position: relative;
              display: inline-flex;
              cursor: pointer;
              font-family: sans-serif;
              font-size: 24px;
              line-height: 1.3;
            }

            input[type="checkbox"]+label:before {
              width: 60px;
              height: 30px;
              border-radius: 30px;
              background-color: #1b1b1b;
              content: "";
              margin-right: 15px;
              transition: background-color 0.5s linear;
            }

            input[type="checkbox"]+label:after {
              width: 30px;
              height: 30px;
              border-radius: 30px;
              background-color: #fff;
              content: "";
              transition: margin 0.1s linear;
              position: absolute;
              left: 2px;
              top: 2px;
            }

            input[type="checkbox"]:checked+label:before {
              background-color: #2b8718;
            }

            input[type="checkbox"]:checked+label:after {
              margin: 0 0 0 30px;
            }

          </style>

          <script>
            function abfrage(form) {
              if (form.confirm.checked) {

              } else {

              }
            }
          </script>
</html>