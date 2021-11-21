<?php
      // Start with PHPMailer class
      use PHPMailer\PHPMailer\PHPMailer;
      //use PHPMailer\PHPMailer\Exception;
      //require 'PHPMailer-master/src/Exception.php';
      require '../api/PHPMailer-master/src/PHPMailer.php';
      require '../api/PHPMailer-master/src/SMTP.php';
      require '../api/vendor/autoload.php';
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
      $sql = "SELECT *FROM `users` WHERE `username`='$username'";
      $result = mysqli_query($db, $sql);
      $row = mysqli_fetch_assoc($result);
      $discord_avatar = $row["discord_avatar"];
      $uuid = $row["uuid"];
      $email = $row["email"];

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
if(isset($_GET["buy_product"])){
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
function ranCode1($length)
{
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0;$i < $length;$i++)
    {
        $randomString .= $characters[rand(0, $charactersLength - 1) ];
    }
    return $randomString;
}
$gennedInvite = ranCode(8) . "-" . ranCode(8) . "-" . ranCode(8) . "-" . ranCode(8);
$gennedCode = "https://discord.gifts/" . ranCode1(16);
    $sql = "SELECT * FROM `shop` WHERE name_id='" . $_GET["buy_product"] . "'";
    $result = mysqli_query($db, $sql);
    $emailrow = mysqli_fetch_assoc($result);

  $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Mailer = "smtp";
    $mail->SMTPDebug  = 0;  
    $mail->SMTPAuth   = TRUE;
    $mail->SMTPSecure = "tls";
    $mail->Port       = 587;
    $mail->Host       = "smtp.gmail.com";
    $mail->Username   = "mhills.host@gmail.com";
    $mail->Password   = "Jan30052007";
    $mail->IsHTML(true);
    $mail->SetFrom("mhills.host@gmail.com", "mhills.de | Shop System");
    $mail->AddCC($email, $username);
    $mail->Subject = "Product bought: " . $emailrow["product_name"];
    if($_GET["buy_product"] == "invitekey"){
        $content = "<style>button a{ background-color: #131313;
            color: white;
            padding: 12px 50px;
            cursor: pointer;
            font-size: 20px;
            border-radius: 15px; }</style><img src='https://mhills.de/images/mhills.de.png' class='card-img-top'><br><hr class='rounded'><br<br><p>Hello $username.<br>Thank you for Buying: " . $emailrow["product_name"] . ".<br><br>Here is your Invite Key: $gennedInvite<br><br>Best regards, mhills.de File Hosting</p>";
    }
    else if($_GET["buy_product"] == "nitroclassic"){
        $content = "<style>button a{ background-color: #131313;
            color: white;
            padding: 12px 50px;
            cursor: pointer;
            font-size: 20px;
            border-radius: 15px; }</style><img src='https://mhills.de/images/mhills.de.png' class='card-img-top'><br><hr class='rounded'><br<br><p>Hello $username.<br>Thank you for Buying: " . $emailrow["product_name"] . ".<br><br>Here is your Code: $gennedCode<br><br>Best regards, mhills.de File Hosting</p>";
    }
    $mail->MsgHTML($content); 
    if(!$mail->send()){
        echo 'Message could not be sent.';
        //echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        $sql = "UPDATE `users` SET `social_currency` = `social_currency` - " . intval($emailrow["product_price_raw"]) . " WHERE `username`='$username'";
        $result = mysqli_query($db, $sql);
        header("location: https://mhills.de/dashboard/shop");
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

    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">

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
                        
                        <li class="sidebar-item">
                            <a href="user" class='sidebar-link'>
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

                        <li class="sidebar-item active">
                            <a href="#" class='sidebar-link'>
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
                    <div class="row">
                        <div class="col-12">
                            <div class="card-1">
                                <div class="card-header">
                                    <h4 class="card-title">Shop</h4>
                                    <div class="col-12 col-lg-3">
                        <div class="card-1">
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
                                        <h6 class="text-muted mb-0" style="text-shadow: -1px -1px 5px black, 1px -1px 5px black, -1px 1px 5px black, 1px 1px 5px black;">Balance: <a style="color: white;"><?php echo "m$" . number_format($row["social_currency"] , 0, ',', '.'); ?></a></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                                </div>
                            <div class='card-1'>
                                <div class='card-body px-3 py-4-5'>
                                    <div class='flex'>
                                        <div class='row-new'>
                                        <?php
                                    $sql = "SELECT * FROM `shop`";
                                    $result = mysqli_query($db, $sql);
                                    while($row54 = mysqli_fetch_assoc($result)){
                                        echo "                                        <div style='text-align: center;' class='card'>
                                        <img class='card-img-top' src='" . $row54["product_icon"] . "'>        <br><br>
                                        <h5 class='card-title' href='" . $row54["product_icon"] . "'>
                                        " . $row54["product_name"] . "
                                        </h5>
                                        <p style='color: grey;' class='card-text'>Price:<br><a style='color: white;'>" . $row54["product_price"] . "</a></p>
                                        <br>
                                        <a class='btn btn-lg btn-dark' href='buy-product/" . $row54["name_id"] . "' type='button'>Buy</a>
                                        </div>";
                                    }
                                ?>  
                                        </div>
                                    </div>
                                    <!--<a style="color: #ccc">To help enforce these rules, all images uploaded to mhills.de are logged.
These images can only be viewed by Admins and Developers
to ensure all uploaded images are suitable.</a>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
<br>
<br>
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
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/vendors/apexcharts/apexcharts.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>

    <script src="assets/js/main.js"></script>
</body>
<style>
.btn.btn-dark {
    color: #fff;
    margin: 5px;
    position: absolute;
    right: 0;
    bottom: 0;
    width: -webkit-fill-available;
}
    .flex {
    display: -webkit-box;
    display: -moz-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
}
    .btn.btn-dark {
    color: #fff;
    margin: 5px;
}
.col-lg-3 {
    flex: 0 0 auto;
    width: 100%;
}
.row-new {
    display: -ms-flexbox;
    display: flex;
    justify-content: center;
    flex: 1 1 auto;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    .row: :after {;
    content: "";
    clear: both;
    display: table;
    justify-content: center;
    }: ;
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
    position: relative;
    display: -ms-flexbox;
    display: block;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0px;
    width: -webkit-fill-available;
    height: auto;
    max-width: 300px;
    flex: 1 1 auto;
    word-wrap: break-word;
    background-color: #131313;
    background-clip: border-box;
    border: 1px solid rgba(0, 0, 0, .125);
    border-radius: 15px;
    padding: 15px;
    margin: 20px 20px 20px 20px;
    box-shadow: 0 1px 10px rgb(0 0 0 / 30%), 0 15px 12px rgb(0 0 0 / 22%);
}
.card-1 {
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
</html>