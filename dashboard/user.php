<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: https://mhills.de');
      }
      if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header("location: https://mhills.de");
      }
      $username = $_SESSION['username'];
      $db = mysqli_connect('localhost', 'root', 'Julian2016--!123', 'file-host');
      $sql = "SELECT * FROM `users` WHERE `username`='$username'";
      $result = mysqli_query($db, $sql);
      $row = mysqli_fetch_assoc($result);
      $discord_avatar = $row["discord_avatar"];
      $uuid = $row["uuid"];
      $secret = $row["secret"];
      $average_color = $row["social_banner_color"];

      //Invite Count
      $query21 = "SELECT * FROM `invites` WHERE `inviteAuthor`=" . '"' . $username . '";';
      $results21 = mysqli_query($db, $query21);
      $rows21 = mysqli_num_rows($results21);

      //Invite Count
      $query22 = "SELECT * FROM `users` WHERE `inviter`=" . '"' . $username . '";';
      $results22 = mysqli_query($db, $query22);
      $rows22 = mysqli_num_rows($results22);
      function GetDirectorySize($path){
        $bytestotal = 0;
        $path = realpath($path);
        if($path!==false && $path!='' && file_exists($path)){
            foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS)) as $object){
                $bytestotal += $object->getSize();
            }
        }
        return $bytestotal;
      }
      function human_filesize($bytes, $decimals)
{
    $size = array(
        'B',
        'KB',
        'MB',
        'GB',
        'TB',
        'PB',
        'EB',
        'ZB',
        'YB'
    );
    $factor = floor((strlen($bytes) - 1) / 3);
    return sprintf("%.{$decimals}f ", $bytes / pow(1024, $factor)) . @$size[$factor];
}
if($row["banned"] == "false"){
    $totalfillessize = human_filesize(GetDirectorySize("../uploads/$uuid/$username"), 2);
  }
  else{
    $totalfillessize = "Files locked";
  }

if(isset($_GET["updateDescription"])){
    $description = $_GET["description"];
    if(strlen($description) >1){
        $sql312 = "UPDATE `users` SET `profile_description`='$description' WHERE `username`='$username'";
        mysqli_query($db, $sql312);
    }
    else{
        header("location: https://mhills.de/dashboard/user");
    }
    header("location: https://mhills.de/dashboard/user");
}
if(isset($_GET["followUser"])){
    $user = $_GET["followUser"];
    if($user == $username){
        die("you cant do that!");
    }
    else{
        $sql = "UPDATE `users` SET social_follower = social_follower+1 WHERE `username`='$user'";
        $result = mysqli_query($db, $sql);
        $sql = "INSERT INTO `social`(`id`, `Channel`, `User`) VALUES (NULL, '$user', '$username')";
        $result = mysqli_query($db, $sql);
        header("location: https://mhills.de/profile/" . $user);
    }
}
if(isset($_GET["unfollowUser"])){
    $user = $_GET["unfollowUser"];
    if($user == $username){
        die("you cant do that!");
    }
    else{
        $sql = "UPDATE `users` SET social_follower = social_follower-1 WHERE `username`='$user'";
        $result = mysqli_query($db, $sql);
        $sql = "DELETE FROM `social` WHERE `Channel`='$user' AND `User`='$username'";
        $result = mysqli_query($db, $sql);
        if(mysqli_num_rows($result) > 1){
            header("location: https://mhills.de/profile/" . $user);
        }
        else{
            header("location: https://mhills.de/profile/" . $user);
        }
    }
}
if(isset($_GET["social_banner"])){
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($result);
    unlink("/var/www/html/banners/" . $row["social_banner_filename"]);
    $banner = $_GET["social_banner"];
    $sql = "UPDATE `users` SET `social_banner`='https://mhills.de/banners/" . $banner . "', `social_banner_filename`='" . $banner . "' WHERE `secret`='$secret'";
    $result = mysqli_query($db, $sql);
    header("location: https://mhills.de/dashboard/user");
}
if(isset($_GET["delete_social_banner"])){
    $username = $_SESSION['username'];
    $banner = $_GET["delete_social_banner"];
    $sql = "UPDATE `users` SET `social_banner`='https://mhills.de/uploads/882ac87d-c207-4231-b115-c8e6ffc382e4/AtomicHXH/I8Rr1pwR.png', `social_banner_filename`='U2hB6rSs.png' WHERE `secret`='$secret'";
    $result = mysqli_query($db, $sql);
    header("location: https://mhills.de/dashboard/user");
}
if(isset($_GET["profile"])){
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
         $url = "https://";   
    else  
         $url = "http://";   
    // Append the host(domain name, ip) to the URL.   
    $url.= $_SERVER['HTTP_HOST'];   
    
    // Append the requested resource location to the URL   
    $url.= $_SERVER['REQUEST_URI'];

    $username = $_SESSION['username'];
    $_SESSION["tmpUsername"] = $_GET["profile"];
    $sql = "SELECT *FROM `users` WHERE `id`='" . $_SESSION["tmpUsername"] . "'";
    $result31231 = mysqli_query($db, $sql);
    $rowUser = mysqli_fetch_assoc($result31231);
    if(strpos($url, "profile/" . $_SESSION["tmpUsername"])){
        if(mysqli_num_rows($result31231) == 1){
                //die();
                $output ="<!DOCTYPE html>
        <html lang='en'>
        
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <meta name='theme-color' content='ffa550' />
          <meta name='og:site_name' content='https://mhills.de/'>
          <meta property='og:title' content='M. Hills File Uploader' />
          <meta property='og:url' content='https://mhills.de/' />
          <meta property='og:type' content='website' />
          <meta property='og:description' content='A Free File Uploader for all of your Files.' />
          <meta property='og:locale' content='en_GB' />
          <link rel='icon' type='image/png' href='https://mhills.de/images/icons/favicon.ico' />
            <link rel='preconnect' href='https://fonts.gstatic.com'>
            <link href='https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap' rel='stylesheet'>
            <link rel='stylesheet' href='https://mhills.de/dashboard/assets/css/bootstrap.css'>
            <!-- Production -->
            <script src='https://unpkg.com/@popperjs/core@2'></script>
            <script src='https://unpkg.com/tippy.js@6'></script>
            <link rel='stylesheet' href='https://mhills.de/dashboard/assets/vendors/iconly/bold.css'>
            <script async src='https://arc.io/widget.min.js#3uop4387'></script>
            <link rel='stylesheet' href='https://mhills.de/dashboard/assets/vendors/perfect-scrollbar/perfect-scrollbar.css'>
            <link rel='stylesheet' href='https://mhills.de/dashboard/assets/vendors/bootstrap-icons/bootstrap-icons.css'>
            <link rel='stylesheet' href='https://mhills.de/dashboard/assets/css/app.css'>
            <link rel='shortcut icon' href='https://mhills.de/dashboard/assets/images/favicon.svg' type='image/x-icon'>
        </head>
        
        <body>
            <div id='app'>
                <div id='sidebar' class='active'>
                    <div class='sidebar-wrapper active'>
                        <div class='sidebar-header'>
                            <div class='d-flex justify-content-between'>
                                <div class='logo'>
                                    <a style='color: #ffffff;'><img style='height: 75px;' src='https://mhills.de/images/mhills.de.png' alt='Logo' srcset=''> mhills.de</a>
                                </div>
                                <div class='toggler'>
                                    <a href='#' class='sidebar-hide d-xl-none d-block'><i class='bi bi-x bi-middle'></i></a>
                                </div>
                            </div>
                        </div>
                        <div class='sidebar-menu'>
                            <ul class='menu'>
                                <li class='sidebar-title'>Menu</li>
        
                                <li class='sidebar-item '>
                                    <a href='https://mhills.de/dashboard/index' class='sidebar-link'>
                                        <i class='bi bi-grid-fill'></i>
                                        <span>Dashboard</span>
                                    </a>
                                </li>
                                
                                <li class='sidebar-item'>
                                    <a href='https://mhills.de/dashboard/user' class='sidebar-link'>
                                    <svg class='bi' width='1em' height='1em' fill='currentColor'>
                                                        <use xlink:href='https://mhills.de/dashboard/assets/vendors/bootstrap-icons/bootstrap-icons.svg#person-fill'></use>
                                                    </svg>
                                        <span>User</span>
                                    </a>
                                </li>
        
                                <li class='sidebar-item'>
                                    <a href='https://mhills.de/dashboard/invites' class='sidebar-link'>
                                    <svg class='bi' width='1em' height='1em' fill='currentColor'>
                                                        <use xlink:href='https://mhills.de/dashboard/assets/vendors/bootstrap-icons/bootstrap-icons.svg#person-plus-fill'></use>
                                                    </svg>
                                        <span>Invites</span>
                                    </a>
                                </li>
        
                                <li class='sidebar-item active'>
                                    <a href='https://mhills.de/dashboard/search' class='sidebar-link'>
                                    <svg class='bi' width='1em' height='1em' fill='currentColor'>
                                                        <use xlink:href='https://mhills.de/dashboard/assets/vendors/bootstrap-icons/bootstrap-icons.svg#search'></use>
                                                    </svg>
                                        <span>User Search</span>
                                    </a>
                                </li>
        
                                <li class='sidebar-item  has-sub'>
                                    <a href='#' class='sidebar-link'>
                                    <svg class='bi' width='1em' height='1em' fill='currentColor'>
                                                        <use xlink:href='https://mhills.de/dashboard/assets/vendors/bootstrap-icons/bootstrap-icons.svg#gear-wide-connected'></use>
                                                    </svg>
                                        <span>Settings</span>
                                    </a>
                                    <ul class='submenu '>
                                    <li class='submenu-item'>
                                        <a href='embed-settings'>Embed Settings</a>
                                    </li>
                                    <li class='submenu-item '>
                                        <a href='domain-settings'>Domain Settings</a>
                                    </li>
                                    <li class='submenu-item '>
                                        <a href='upload-preferences'>Upload Preferences</a>
                                    </li>
                                </ul>
                                </li>
        
                                <li class='sidebar-item'>
                                    <a href='https://mhills.de/dashboard/rules' class='sidebar-link'>
                                    <svg class='bi' width='1em' height='1em' fill='currentColor'>
                                                        <use xlink:href='https://mhills.de/dashboard/assets/vendors/bootstrap-icons/bootstrap-icons.svg#file-earmark-ruled-fill'></use>
                                                    </svg>
                                        <span>Rules</span>
                                    </a>
                                </li>
        
                                <li class='sidebar-item'>
                                    <a href='https://mhills.de/dashboard/scoreboard' class='sidebar-link'>
                                    <svg class='bi' width='1em' height='1em' fill='currentColor'>
                                                        <use xlink:href='https://mhills.de/dashboard/assets/vendors/bootstrap-icons/bootstrap-icons.svg#clipboard'></use>
                                                    </svg>
                                        <span>Scoreboard</span>
                                    </a>
                                </li>
                                <li class='sidebar-item  '>
                                <a href='https://mhills.de/dashboard/paste/' class='sidebar-link'>
                                <svg class='bi' width='1em' height='1em' fill='currentColor'>
                                        <use xlink:href='https://mhills.de/dashboard/assets/vendors/bootstrap-icons/bootstrap-icons.svg#card-text'></use>
                                    </svg>
                                    <span>Paste</span>
                                </a>
                            </li>
                                <li class='sidebar-item  '>
                                <a href='https://mhills.de/dashboard/gallery/' class='sidebar-link'>
                                <svg class='bi' width='1em' height='1em' fill='currentColor'>
                                                    <use xlink:href='https://mhills.de/dashboard/assets/vendors/bootstrap-icons/bootstrap-icons.svg#image-fill'></use>
                                                </svg>
                                    <span>Gallery</span>
                                </a>
                            </li>
        
                                <li class='sidebar-item  '>
                                    <a href='upload-file' class='sidebar-link'>
                                    <svg class='bi' width='1em' height='1em' fill='currentColor'>
                                                        <use xlink:href='https://mhills.de/dashboard/assets/vendors/bootstrap-icons/bootstrap-icons.svg#cloud-upload-fill'></use>
                                                    </svg>
                                        <span>Upload</span>
                                    </a>
                                </li>
                                <li class='sidebar-item'>
                                    <a href='https://mhills.de/dashboard/index.php?logout=%271%27' class='sidebar-link'>
                                    <svg class='bi' width='1em' height='1em' fill='currentColor'>
                                                        <use xlink:href='https://mhills.de/dashboard/assets/vendors/bootstrap-icons/bootstrap-icons.svg#x-circle-fill'></use>
                                                    </svg>
                                        <span>Logout</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <button class='sidebar-toggler btn x'><i data-feather='x'></i></button>
                    </div>
                </div>
                <div id='main'>
                    <header class='mb-3'>
                        <a href='#' class='burger-btn d-block d-xl-none'>
                            <i class='bi bi-justify fs-3'></i>
                        </a>
                    </header>
        
                    <div class='page-heading'>
                        <h3 style='text-align: center;'>Welcome, $username</h3>
                    </div>
                    <div class='page-content'>
                        <section class='row'>
                            <div class='col-12 col-lg-9' style='width: auto;'>        
                                <div class='row'>
                                <div class='col-6 col-lg-3 col-md-6' style='width: auto;'>
                                    <div class='card' style='width: auto;
                                    height: auto;
                                    max-width: 500px;'>
                                            <div class='card-header' style='height: 150px;
                                            border-radius: .7rem .7rem 0 0;
                                            ";
                                                $output .= "background-image: url(" . $rowUser['social_banner'] . ");";
                                                $output .= "background-color: " . $rowUser["social_banner_color"] . ";";
                                            $output .= "
    background-size: cover;
    background-repeat: no-repeat;
    background-position-x: center;
    background-position-y: center;'> </div>
                                            <div class='card-content pb-4'>
                                                <div class='recent-message d-flex px-4 py-3' style='margin-bottom: -13%;'>
                                                    <div class='avatar avatar-lg' style='bottom: 60px;'> <img style='background-color: #1b1b1b;height: 128px;position: relative;width: 128px;border: 8px solid #1b1b1b;' src='" . $rowUser['discord_avatar']  ."'> </div>
                                                </div>";
                                                if($rowUser["discord_nitro"] == "Nitro Subscriber"){
                                                    $output .= "<img id='nitro-badge' src='https://discordapp.com/assets/e04ce699dcd2fd50d352a384511687a9.svg' style='height: 30px;margin-left: 1%;float: right;
                                                    position: relative;
                                                    top: -80px;'>";
                                                }
                                                if($rowUser["role"] == "Server Booster"){
                                                    $output .=  "<img id='booster-badge' scale-extreme='true' src='https://raw.githubusercontent.com/Mattlau04/Discord-SVG-badges/master/SVG/boost3month.svg' style='height: 30px;float: right;
                                                    position: relative;
                                                    top: -80px;'>";
                                                }
                                                if($rowUser["role"] == "Owner"){
                                                    $output .=  "<img id='owner-badge' scale-extreme='true' src='https://raw.githubusercontent.com/Mattlau04/Discord-SVG-badges/4466e3e494c9d13cc9267728a74e0d31825ebc32/SVG/Server_owner.svg' style='height: 30px;float: right;
                                                    position: relative;
                                                    top: -80px;'>";
                                                }
                                                $output .= "
                                                <div class='name ms-4'>
                                                    <h5 class='mb-1'>" .  $rowUser['username']  ." <span class='badge bg-primary'>" . $rowUser['role']  ."</span>
                                                    <br>";
                                                    $output .= "
                                                    </h5>
                                                    <h6 class='text-muted mb-0'>" . $rowUser['profile_description']  ."</h6>
                                                    <br>
                                                    <h6 class='text-muted mb-0'>Followers: <a style='color: white;'>" . $rowUser['social_follower'] . "</a></h6>
                                                    <h6 class='text-muted mb-0'>Uploads: <a style='color: white;'>" . $rowUser['uploads']. "</a></h6>
                                                    <h6 class='text-muted mb-0'>UUID: <a style='color: white;'>" . $rowUser['uuid']. "</a></h6>
                                                    <h6 class='text-muted mb-0'>Registered: <a style='color: white;'>" . $rowUser['reg_date']. "</a></h6>
                                                    <h6 class='text-muted mb-0'>Last Upload: <a style='color: white;'>" . $rowUser['last_uploaded']. "</a></h6>
                                                    <br>
                                                    ";
                                                $sql = "SELECT * FROM `social` WHERE `Channel`='" .  $rowUser['username']  ."' AND `User`='" .  $username  ."'";
                                                $newresult = mysqli_query($db, $sql);
                                                $newrows = mysqli_num_rows($newresult);
                                                if($rowUser['username'] == $username){
                                                    if($newrows <1){
                                                        $output	.= "<a class='btn btn-lg btn-dark' style='cursor: not-allowed;opacity: 0.5;' data-toggle='tooltip' title='You cant follow yourself'>Follow</a>";
                                                    }
                                                    else {
                                                        $output	.= "<a class='btn btn-lg btn-dark' style='cursor: not-allowed;opacity: 0.5;' data-toggle='tooltip' title='You cant unfollow yourself'>Unfollow</a>";
                                                    }
                                                }
                                                else{
                                                    if($newrows <1){
                                                        $output	.= "<a class='btn btn-lg btn-dark' href='https://mhills.de/dashboard/user?followUser=" .  $rowUser['username']  ."'>Follow</a>";
                                                    }
                                                    else {
                                                        $output	.= "<a class='btn btn-lg btn-dark' href='https://mhills.de/dashboard/user?unfollowUser=" .  $rowUser['username']  ."'>Unfollow</a>";
                                                    }
                                                }
$output .= "
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </section>
                    </div>
        
                    <footer>
                        <div class='footer clearfix mb-0 text-muted'>
                            <div class='float-start'>
                                <p>2021 &copy; mhills.de</p>
                            </div>
                        </div>
                    </footer>
                </div>
            </div>
<script>
tippy('#nitro-badge', {
    content: 'Nitro Subscriber',
  });
  tippy('#booster-badge', {
    content: 'Server Booster',
  });
  tippy('#owner-badge', {
    content: 'Owner of mhills.de',
  });
</script>
            <script src='https://mhills.de/dashboard/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js'></script>
            <script src='https://mhills.de/dashboard/assets/js/bootstrap.bundle.min.js'></script>
        
            <script src='https://mhills.de/dashboard/assets/vendors/apexcharts/apexcharts.js'></script>
            <script src='https://mhills.de/dashboard/assets/js/pages/dashboard.js'></script>
        
            <script src='https://mhills.de/dashboard/assets/js/main.js'></script>
        </body>
        <style>
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
          content: '';
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
        #blurtext {
            filter: blur(3px);
          }
      
          #blurtext:hover {
            filter: blur(0px);
            transition: .5s;
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
        }
            .card .card-content {
            position: relative;
            padding-right: 20px;
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
        </html>";
        die($output);
        }
        else{
            die("User not found");
        }
    }
    else{
        header("location: https://mhills.de/profile/" . $_SESSION["tmpUsername"]);
    }
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
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
    <link rel="stylesheet" href="https://mhills.de/node_modules/@sweetalert2/theme-dark/dark.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.16.2/build/styles/default.min.css">
    <script src="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.16.2/build/highlight.min.js"></script>
    <script src="https://mhills.de/node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">
    <script async src="https://arc.io/widget.min.js#3uop4387"></script>
<!-- Production -->
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://unpkg.com/tippy.js@6"></script>
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
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
                        
                        <li class="sidebar-item active">
                            <a href="#" class='sidebar-link'>
                            <svg class="bi" width="1em" height="1em" fill="currentColor">
                                                <use xlink:href="assets/vendors/bootstrap-icons/bootstrap-icons.svg#person-fill"></use>
                                            </svg>
                                <span>User</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="invites" class='sidebar-link'>
                            <svg class="bi" width="1em" height="1em" fill="currentColor">
                                                <use xlink:href="assets/vendors/bootstrap-icons/bootstrap-icons.svg#person-plus-fill"></use>
                                            </svg>
                                <span>Invites</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="search" class='sidebar-link'>
                            <svg class="bi" width="1em" height="1em" fill="currentColor">
                                                <use xlink:href="assets/vendors/bootstrap-icons/bootstrap-icons.svg#search"></use>
                                            </svg>
                                <span>User Search</span>
                            </a>
                        </li>

                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                            <svg class="bi" width="1em" height="1em" fill="currentColor">
                                                <use xlink:href="assets/vendors/bootstrap-icons/bootstrap-icons.svg#gear-wide-connected"></use>
                                            </svg>
                                <span>Settings</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item">
                                    <a href="embed-settings">Embed Settings</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="domain-settings">Domain Settings</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="upload-preferences">Upload Preferences</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item">
                            <a href="rules" class='sidebar-link'>
                            <svg class="bi" width="1em" height="1em" fill="currentColor">
                                                <use xlink:href="assets/vendors/bootstrap-icons/bootstrap-icons.svg#file-earmark-ruled-fill"></use>
                                            </svg>
                                <span>Rules</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="scoreboard" class='sidebar-link'>
                            <svg class="bi" width="1em" height="1em" fill="currentColor">
                                                <use xlink:href="assets/vendors/bootstrap-icons/bootstrap-icons.svg#clipboard"></use>
                                            </svg>
                                <span>Scoreboard</span>
                            </a>
                        </li>
                        <li class='sidebar-item  '>
                                <a href='https://mhills.de/dashboard/paste/' class='sidebar-link'>
                                <svg class='bi' width='1em' height='1em' fill='currentColor'>
                                        <use xlink:href='https://mhills.de/dashboard/assets/vendors/bootstrap-icons/bootstrap-icons.svg#card-text'></use>
                                    </svg>
                                    <span>Paste</span>
                                </a>
                            </li>
                        <li class="sidebar-item  ">
                            <a href="https://mhills.de/dashboard/gallery/" class='sidebar-link'>
                            <svg class="bi" width="1em" height="1em" fill="currentColor">
                                                <use xlink:href="assets/vendors/bootstrap-icons/bootstrap-icons.svg#image-fill"></use>
                                            </svg>
                                <span>Gallery</span>
                            </a>
                        </li>

                        <li class="sidebar-item  ">
                            <a href="upload-file" class='sidebar-link'>
                            <svg class="bi" width="1em" height="1em" fill="currentColor">
                                                <use xlink:href="assets/vendors/bootstrap-icons/bootstrap-icons.svg#cloud-upload-fill"></use>
                                            </svg>
                                <span>Upload</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="https://mhills.de/dashboard/index.php?logout=%271%27" class='sidebar-link'>
                            <svg class="bi" width="1em" height="1em" fill="currentColor">
                                                <use xlink:href="assets/vendors/bootstrap-icons/bootstrap-icons.svg#x-circle-fill"></use>
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
                    <div class="col-12 col-lg-9" style="width: auto;">        
                        <div class="row">
                        <div class="col-6 col-lg-3 col-md-6" style="width: auto;">
                            <div class="card" style="width: auto;height: auto;max-width: 500px;">
                            <label for="image">
      <input type="file"onclick="file_explorer();" accept="image/png, image/gif, image/jpeg" name="image" id="image" style="display:none;"/>
                            <div class='card-header' style='height: 150px;
                            border-radius: .7rem .7rem 0 0;
                            <?php
                                                                            echo "background-color: #" . $average_color . ";";
                                                echo "background-image: url(" . $row['social_banner'] . ");";
                                            ?>
    background-size: cover;
    background-repeat: no-repeat;
    background-position-x: center;
    background-position-y: center;'>
        <p style="
    position: absolute;
    right:5px;
    top: 17%;
    color: grey;
    text-align: right;
    margin-right: 20ü;
    text-shadow: -1px -1px 5px black, 1px -1px 5px black, -1px 1px 5px black, 1px 1px 5px black;
    ">Banner Size: 500x150</p>
                                                <h4 style='text-shadow:
    -1px -1px 5px black,  
    1px -1px 5px black,
    -1px 1px 5px black,
    1px 1px 5px black;'>Profile</h4></div>
                                                </label>
                                    <div class="card-content pb-4">
                                        <div class='recent-message d-flex px-4 py-3' style="margin-bottom: -11%;">
                                            <div class='avatar avatar-lg' style="bottom: 60px;"> <img style="background-color: #1b1b1b;height: 128px;position: relative;width: 128px;border: 8px solid #1b1b1b;" src='<?php echo $row["discord_avatar"] ?>'> </div>
                                        </div>
                                        <?php
                                                if($row["discord_nitro"] == "Nitro Subscriber"){
                                                    echo "<img id='nitro-badge' scale-extreme='true' src='https://discordapp.com/assets/e04ce699dcd2fd50d352a384511687a9.svg' style='height: 30px;margin-left: 1%;float: right;
                                                    position: relative;
                                                    top: -80px;'>";
                                                }
                                                if($row["role"] == "Server Booster"){
                                                    echo "<img id='booster-badge' scale-extreme='true' src='https://raw.githubusercontent.com/Mattlau04/Discord-SVG-badges/master/SVG/boost3month.svg' style='height: 30px;float: right;
                                                    position: relative;
                                                    top: -80px;'>";
                                                }
                                                if($row["role"] == "Owner"){
                                                    echo "<img id='owner-badge' scale-extreme='true' src='https://raw.githubusercontent.com/Mattlau04/Discord-SVG-badges/4466e3e494c9d13cc9267728a74e0d31825ebc32/SVG/Server_owner.svg' style='height: 25px;float: right;
                                                    position: relative;
                                                    top: -80px;'>";
                                                }
                                            ?>
                                        <div class='name ms-4'>
                                            <h5 class='mb-1'><?php echo $row["username"] ?> 
                                            
                                            <span class="badge bg-primary"><?php echo $row["role"] ?></span></h5>
                                            <h6 class='text-muted mb-0'><?php echo $row["profile_description"] ?></h6>
                                            <br>
                                            <h6 class='text-muted mb-0'>Followers: <a style="color: white;"><?php echo $row["social_follower"] ?></a></h6>
                                            <h6 class='text-muted mb-0'>Uploads: <a style="color: white;"><?php echo $row["uploads"] ?></a></h6>
                                            <h6 class='text-muted mb-0'>UUID: <a style="color: white;"><?php echo $row["uuid"] ?></a></h6>
                                            <h6 class='text-muted mb-0'>Registered: <a style="color: white;"><?php echo $row["reg_date"] ?></a></h6>
                                            <h6 class='text-muted mb-0'>Last Upload: <a style="color: white;"><?php echo $row["last_uploaded"] ?></a></h6>
                                            <h6 class='text-muted mb-0'>Secret: <a id="blurtext" style="color: white;"><?php echo $row["secret"] ?></a></h6>
                                            <br>
                                                <form method="GET" action="user">
                                            <div class="form-group">
                                                <label style="color: #ccc" for="basicInput">Description</label>
                                                <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="4" placeholder="<?php echo $row["profile_description"] ?>"></textarea>
                                                <input class="btn btn-lg btn-dark" type="submit" name="updateDescription" value="Update"></a>
                                                <a href="?delete_social_banner=<?php echo $row['social_banner_filename'] ?>" class="btn btn-lg btn-dark">Reset Banner</a>
                                        </div>
                                        </form>
                                </div>
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
                </div>
            </footer>
        </div>
    </div>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/vendors/apexcharts/apexcharts.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>

    <script src="assets/js/main.js"></script>
    <script>
        tippy('#nitro-badge', {
  content: "<?php echo $row["discord_nitro"] ?>",
});
tippy('#booster-badge', {
  content: "Server Booster",
});
tippy('#owner-badge', {
  content: "Owner of mhills.de",
});
var fileobj;
function upload_file(e) {
    e.preventDefault();
    fileobj = e.dataTransfer.files[0];
    ajax_file_upload(fileobj);
}
 
function file_explorer() {
    document.getElementById('image').click();
    document.getElementById('image').onchange = function() {
        fileobj = document.getElementById('image').files[0];
        ajax_file_upload(fileobj);
    };
}
function ajax_file_upload(file_obj) {
    if(file_obj != undefined) {
        var form_data = new FormData();                  
        form_data.append('file', file_obj);
        $.ajax({
            type: 'POST',
            url: 'https://mhills.de/dashboard/upload.php',
            contentType: false,
            processData: false,
            data: form_data,
            success:function(response) {
                window.open('https://mhills.de/dashboard/user?social_banner=' + response, '_self')
            }
        });
    }
}
</script>
</body>
<style>
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
#blurtext {
      filter: blur(3px);
    }

    #blurtext:hover {
      filter: blur(0px);
      transition: .5s;
    }
/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
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
}
    .card .card-content {
    position: relative;
    padding-right: 20px;
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
.avatar.avatar-xl .avatar-content, .avatar.avatar-xl img {
    font-size: 1.4rem;
    height: 60px;
    width: 60px;
    top: 0;
    right: 0;
}
#blurtext {
      filter: blur(3px);
    }

    #blurtext:hover {
      filter: blur(0px);
      transition: .5s;
    }
</style>
</html>