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
      date_default_timezone_set('Europe/Amsterdam');
      $username = $_SESSION['username'];
      $db = mysqli_connect('localhost', 'root', 'Julian2016--!123', 'file-host');
      $sql = "SELECT *FROM `users` WHERE `username`='$username'";
      $result = mysqli_query($db, $sql);
      $row = mysqli_fetch_assoc($result);
      $discord_avatar = $row["discord_avatar"];
      $uuid = $row["uuid"];

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
      function generateRandomString($length = 8) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
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
/**
* Class and Function List:
* Function list:
* Classes list:
*/

if (!isset($_SESSION['username']))
{
    $_SESSION['msg'] = "You must log in first";
    header('location: https://mhills.de');
}
if (isset($_GET['logout']))
{
    session_destroy();
    unset($_SESSION['username']);
    header("location: https://mhills.de");
}
$db = mysqli_connect('localhost', 'root', 'Julian2016--!123', 'file-host');
$username = $_SESSION['username'];
$query = "SELECT * FROM users WHERE username='$username'";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    $uuid = "" . $row["uuid"]. "";

  }
} else {
  echo "0 results";
}

if (isset($_GET['update']))
{
    if (isset($_POST['embedtitle']) && isset($_POST['embeddesc']) && isset($_POST['colorpicker']))
    {
        $sql2 = "UPDATE users SET upload_domain='" . $_POST['upload_domain'] . "', embedcolor='" . $_POST['colorpicker'] . "', embedauthor='" . $_POST['embedauthor'] . "', embedtitle='" . $_POST['embedtitle'] . "', embeddesc='" . $_POST['embeddesc'] . "' WHERE username='" . $username . "';";
        $result2 = mysqli_query($db, $sql2);
    }

    if (isset($_POST['use_customdomain']))
    {
        $sql3 = "UPDATE users SET use_customdomain='true' WHERE username='" . $username . "';";
        $result3 = mysqli_query($db, $sql3);
    }
    if (isset($_POST['use_embeds']))
    {
        $sql3 = "UPDATE users SET use_embed='true' WHERE username='" . $username . "';";
        $result3 = mysqli_query($db, $sql3);
    }

    if (!isset($_POST['use_customdomain']))
    {
        $sql3 = "UPDATE users SET use_customdomain='false' WHERE username='" . $username . "';";
        $result3 = mysqli_query($db, $sql3);
    }
    if (!isset($_POST['use_embeds']))
    {
        $sql3 = "UPDATE users SET use_embed='false' WHERE username='" . $username . "';";
        $result3 = mysqli_query($db, $sql3);
    }

    if (isset($_POST['filename_type']))
    {
        $sql3 = "UPDATE users SET filename_type='long' WHERE username='" . $username . "';";
        $result3 = mysqli_query($db, $sql3);
    }
    if (isset($_POST['filename_type']))
    {
        $sql3 = "UPDATE users SET filename_type='long' WHERE username='" . $username . "';";
        $result3 = mysqli_query($db, $sql3);
    }
    if (!isset($_POST['filename_type']))
    {
        $sql3 = "UPDATE users SET filename_type='short' WHERE username='" . $username . "';";
        $result3 = mysqli_query($db, $sql3);
    }
    if (!isset($_POST['filename_type']))
    {
        $sql3 = "UPDATE users SET filename_type='short' WHERE username='" . $username . "';";
        $result3 = mysqli_query($db, $sql3);
    }


    if (isset($_POST['self_destruct_upload']))
    {
        $sql3 = "UPDATE users SET self_destruct_upload='true' WHERE username='" . $username . "';";
        $result3 = mysqli_query($db, $sql3);
    }
    if (isset($_POST['self_destruct_upload']))
    {
        $sql3 = "UPDATE users SET self_destruct_upload='true' WHERE username='" . $username . "';";
        $result3 = mysqli_query($db, $sql3);
    }
    if (!isset($_POST['self_destruct_upload']))
    {
        $sql3 = "UPDATE users SET self_destruct_upload='false' WHERE username='" . $username . "';";
        $result3 = mysqli_query($db, $sql3);
    }
    if (!isset($_POST['self_destruct_upload']))
    {
        $sql3 = "UPDATE users SET self_destruct_upload='false' WHERE username='" . $username . "';";
        $result3 = mysqli_query($db, $sql3);
    }


    if (isset($_POST['url_type']))
    {
        $sql3 = "UPDATE users SET url_type='long' WHERE username='" . $username . "';";
        $result3 = mysqli_query($db, $sql3);
    }
    if (isset($_POST['url_type']))
    {
        $sql3 = "UPDATE users SET url_type='long' WHERE username='" . $username . "';";
        $result3 = mysqli_query($db, $sql3);
    }
    if (!isset($_POST['url_type']))
    {
        $sql3 = "UPDATE users SET url_type='short' WHERE username='" . $username . "';";
        $result3 = mysqli_query($db, $sql3);
    }
    if (!isset($_POST['url_type']))
    {
        $sql3 = "UPDATE users SET url_type='short' WHERE username='" . $username . "';";
        $result3 = mysqli_query($db, $sql3);
    }

    header("location: https://mhills.de/dashboard/embed-settings");
}

$sql = "SELECT * FROM users WHERE username='$username';";
$result = mysqli_query($db, $sql);
$embed = mysqli_fetch_assoc($result);
if ($embed["use_customdomain"] == "true")
{

    $usecustomdomain = "checked";
}
else
{

    $usecustomdomain = "false";
}

$sql321 = "SELECT * FROM uploads WHERE `username` = '$username' ORDER BY id DESC LIMIT 1;";
$result321 = mysqli_query($db, $sql321);
$embed321 = mysqli_fetch_assoc($result321);
$lastUploadUrl = "https://mhills.de/uploads/$uuid/$username/" . $embed321["filename"];
if ($lastUploadUrl == "https://mhills.de/uploads/")
{
    $lastUploadUrl = "https://mhills.de/images/example.png";
}

if ($embed["use_embed"] == "true")
{

    $useembed = "checked";
}
else
{

    $useembed = "false";
}

if ($embed["filename_type"] == "long")
{

    $uselongfilename = "checked";
}
else
{

    $uselongfilename = "false";
}

if ($embed["url_type"] == "long")
{

    $uselongurl = "checked";
}
else
{

    $uselongurl = "false";
}
if ($embed["self_destruct_upload"] == "true")
{

    $self_destruct_upload = "checked";
}
else
{

    $self_destruct_upload = "false";
}
if($embed["use_customdomain"] == "true"){
    $usedomain = "https://" . $embed["upload_domain"] . "/" . generateRandomString() . ".png";
}
else{
    $usedomain = "https://mhills.de/" . generateRandomString() . ".png";
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
    <script async src="https://arc.io/widget.min.js#3uop4387"></script>
    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
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

                        <li class="sidebar-item  has-sub active">
                            <a href="#" class='sidebar-link'>
                            <svg class="bi" width="1em" height="1em" fill="currentColor">
                                                <use xlink:href="assets/vendors/bootstrap-icons/bootstrap-icons.svg#gear-wide-connected"></use>
                                            </svg>
                                <span>Settings</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item active">
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
                    <div class="row">
                        <div class="col-12">
                        <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Placeholders</h4>
                                </div>
                                <div class="card-body px-3 py-4-5">
                                    <a style="color: white;">%username</a><a style="color: grey;"> - Displays your Username</a><br>
                                    <a style="color: white;">%filename</a><a style="color: grey;"> - Displays the Name of the uploaded File</a><br>
                                    <a style="color: white;">%filesize</a><a style="color: grey;"> - Displays the Size of the uploaded File<</a><br>
                                    <a style="color: white;">%id</a><a style="color: grey;"> - Displays your User ID</a><br>
                                    <a style="color: white;">%date</a><a style="color: grey;"> - Displays the time when the File was uploaded</a><br>
                                    <a style="color: white;">%uploads</a><a style="color: grey;"> - Displays the amount of uploads you have</a>
                                </div>
                            </div>
                            <form action="?update" method="post" name="form" enctype="multipart/form-data">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Embed Settings</h4>
                                </div>
                                <div class="card-body px-3 py-4-5">
                                <div class="form-group">
                                    <label style="color: #ccc" for="basicInput">Embed Author</label>
                                    <input type="text" class="form-control" name="embedauthor" id="embedauthor" data-temp-mail-org="0" placeholder="<?php echo $embed['embedauthor']; ?>" value="<?php echo $embed['embedauthor']; ?>" oninput="setAuthorEmbed()">
                                </div>
                                <div class="form-group">
                                    <label style="color: #ccc" for="basicInput">Embed Title</label>
                                    <input type="text" class="form-control" name="embedtitle" id="embedtitle" data-temp-mail-org="0" placeholder="<?php echo $embed['embedtitle']; ?>" value="<?php echo $embed['embedtitle']; ?>" oninput="setTitleEmbed()">
                                </div>
                                <div class="form-group">
                                    <label style="color: #ccc" for="basicInput">Embed Description</label>
                                    <input type="text" class="form-control" name="embeddesc" id="embeddescription" data-temp-mail-org="0" placeholder="<?php echo $embed['embeddesc']; ?>" value="<?php echo $embed['embeddesc']; ?>" oninput="setDescriptionEmbed()">
                                </div>
                                <div class="form-group">
                                    <label style="color: #ccc" for="colorpicker">Embed Color</label><br>
                                    <input type="color" class="colorpicker" id="colorpicker" name="colorpicker" value="<?php echo $embed['embedcolor']; ?>" style="background-color: #131313;border: 1px solid #000;border-radius: 7px;height: 30px;width: 100%;max-width: 500px;">
                                </div>
                                    <!-- <p><strong>Discord Embeds:</strong></p> -->
          <!-- <input id="confirm" type="checkbox" /><label for="confirm"></label> -->
          <!-- <br> -->
          <br>
          <div class="Discord_message">
   <div class="Discord_messageContents">
      <img src="<?php echo $embed["discord_avatar"]?>" class="Discord_messageAvatar" alt="Discord Profile Picture">
      <h2 class="Discord_messageHeader"><span class="Discord_messageHeaderText"><span class="Discord_messageUsername"><?php echo $embed["username"]?></span></span><span class="Discord_messageTime"><span> Today at <?php echo date("h:i A") ?></span></span></h2>
      <div class="Discord_messageContent"><span class="Discord_messageLink"><a><?php echo $usedomain ?></a></span></div>
   </div>
   <div class="Discord_embedContainer">
   <div data-v-408d6252="">
            <div data-v-408d6252="" class="embed" style="border-color: <?php echo $embed['embedcolor']; ?> ;">
              <div data-v-408d6252="" class="embed-body">
                <div data-v-408d6252="" class="author">
                  <span data-v-408d6252="" id="authorembed" class="author-name"><?php echo $embed['embedauthor']; ?></span>
                </div>


                <div data-v-408d6252="" class="title">
                  <span data-v-408d6252="" class="titleembed" id="titleembed"><a style="text-decoration: none;" data-v-408d6252="" href="https://mhills.de" target="_blank" class="title-content"><?php echo $embed['embedtitle']; ?></a></span>
                </div>


                <div data-v-408d6252="" class="description">
                  <span data-v-408d6252="" id="descriptionembed" class="author-name"><?php echo $embed['embeddesc']; ?></span>
                </div>
                <div data-v-408d6252="" class="fields"></div>
                <!---->
                <!---->
                <!---->
                <img data-v-408d6252="" src="https://mhills.de/images/example.png" alt="image" class="image">
              </div>
            </div>
          </div>
          </div>
   </div>
</div>
          <br>
          <div class="input-group">
            <input type="submit" class="btn btn-lg btn-dark" name="button1" onclick="abfrage(this.form)" value="Save" />
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
</body>
<style>
.Discord_message {
    padding-right: 48px!important;
    min-height: 2.75rem;
    position: relative;
    margin-top: 1rem;
    word-wrap: break-word;
    max-width: 500px;
    width: auto;
    background: #131313;
    -webkit-user-select: text;
    -ms-user-select: text;
    user-select: text;
    border-radius: 15px;
    flex: 0 0 auto;
    min-height: 1.375rem;
    padding: 15px 16px 15px 72px;
}
.Discord_messageUsername:hover{
    cursor: pointer;
    text-decoration: underline;
}
.Discord_messageContents {
    text-align: left;
    position: static;
    margin-left: 0;
    padding-left: 0;
    text-indent: 0;
}
    .btn.btn-dark {
    color: #fff;
    margin: 5px;
    background-color: #131313;
    border-radius: 7px;
    border-color: #272727;
    color: #fff;
    width: 200px;
}
.Discord_messageHeader {
    display: block;
    position: relative;
    margin-bottom: 0;
    line-height: 1rem;
    font-weight: 600;
    font-size: larger;
    min-height: 1.375rem;
    color: #fff;
    white-space: break-spaces;
    overflow: hidden;
}
.Discord_messageTime {
    display: inline-block;
    height: 1.25rem;
    cursor: default;
    pointer-events: none;
    font-weight: 500;
    font-size: .75rem;
    line-height: 1.375rem;
    color: #ccc;
    vertical-align: baseline;
    margin-left: .25rem;
}
.Discord_messageContent {
    font-size: 1rem;
    line-height: 1.375rem;
    white-space: break-spaces;
    word-wrap: break-word;
    color: rgb(0, 175, 244);
    font-weight: 400;
    text-indent: 0;
    position: relative;
    overflow: hidden;
    -webkit-user-select: text;
    -ms-user-select: text;
    user-select: text;
    margin-left: -72px;
    padding-left: 72px;
}
.Discord_messageAvatar {
    position: absolute;
    left: 16px;
    margin-top: calc(8px - .125rem);
    width: 40px;
    height: 40px;
    border-radius: 50%;
    overflow: hidden;
    cursor: pointer;
    -webkit-user-select: none;
    -ms-user-select: none;
    user-select: none;
    flex: 0 0 auto;
    pointer-events: none;
    z-index: 1;
}
.Discord_messageLink:hover {
    text-decoration: underline;
    cursor: pointer;
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
    border-left: 4px solid #85a1f4;
    line-height: 1;
    color: #ffffff;
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
    font-weight: 700;
    white-space: pre-wrap;
    overflow-wrap: break-word;
    line-height: 1.375;
}
a {
    color: #ffffff;
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