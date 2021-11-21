<?php
    session_start();
    if (!isset($_SESSION['username']) && !isset($_GET["paste-id"])) {
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
  if(isset($_POST["highlight"]) || isset($_POST["text"])){
      $language = $_POST["highlight"];
      if(strlen($_POST["title"]) <1){
          $title = "unnamed-" . generateRandomString();
      }
      else{
        $title = $_POST["title"];
      }
      $text = $_POST["text"];
      $text = str_replace("'", "’", $text);
      $author = $username;
      if(strlen($text) > 1 && strlen($language) > 1){
        $randomid = generateRandomString();
        $sql = "INSERT INTO `pastes`(`id`, `title`, `text`, `language`, `views`, `author`, `random_id`) VALUES (NULL,'" . $title . "','" . $text . "','" . $language . "',1,'" . $author . "', '" . $randomid . "')";
        mysqli_query($db, $sql);
        header("Location: https://mhills.de/paste/$randomid");
        exit;
      }
      else{
        header("Location: https://mhills.de/dashboard/paste");
        exit;
      }
  }
  if(isset($_GET["delete_paste"])){
      $id = $_GET["delete_paste"];
      $sql = "SELECT * FROM `pastes` WHERE random_id='$id'";
      $result = mysqli_query($db, $sql);
      $rows = mysqli_fetch_assoc($result);
      if($username == $rows["author"]){
          $deletesql = "DELETE FROM `pastes` WHERE random_id='$id'";
          mysqli_query($db, $deletesql);
          header("Location: https://mhills.de/dashboard/paste");
          exit;
      }
      else{
        header("Location: https://mhills.de/dashboard/paste");
        exit;
      }
  }
  if(isset($_GET["paste-id"])){
    $id = $_GET["paste-id"];
    $sql = "SELECT * FROM `pastes` WHERE random_id='$id'";
    $result = mysqli_query($db, $sql);

        $row = mysqli_fetch_assoc($result);
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        if(strpos($user_agent, "Discordbot")){
           echo "<head>
           <link rel='icon' type='image/png' href='images/icons/favicon.ico'/>
           <link rel='stylesheet' type='text/css' href='vendor/bootstrap/css/bootstrap.min.css'>
           <meta name='viewport' content='width=device-width, initial-scale=1.0'>
           <link rel='stylesheet' type='text/css' href='/fonts/font-awesome-4.7.0/css/font-awesome.min.css'>
           <link rel='stylesheet' type='text/css' href='/fonts/iconic/css/material-design-iconic-font.min.css'>
           <link rel='stylesheet' type='text/css' href='/vendor/animate/animate.css'>
           <link rel='stylesheet' type='text/css' href='/vendor/css-hamburgers/hamburgers.min.css'>
           <link rel='stylesheet' type='text/css' href='/vendor/animsition/css/animsition.min.css'>
           <link rel='stylesheet' type='text/css' href='/vendor/select2/select2.min.css'>
           <link rel='stylesheet' type='text/css' href='/vendor/daterangepicker/daterangepicker.css'>
           <link rel='stylesheet' type='text/css' href='/css/util.css'>
           <link rel='stylesheet' type='text/css' href='/css/main.css'>
           <script src='/vendor/jquery/jquery-3.2.1.min.js'></script>
           <script src='/vendor/animsition/js/animsition.min.js'></script>
           <script src='/vendor/bootstrap/js/popper.js'></script>
           <script src='/vendor/bootstrap/js/bootstrap.min.js'></script>
           <script src='/vendor/select2/select2.min.js'></script>
           <script src='/vendor/daterangepicker/moment.min.js'></script>
           <script src='/vendor/daterangepicker/daterangepicker.js'></script>
           <script src='/vendor/countdowntime/countdowntime.js'></script>
           <script src='/js/main.js'></script>
           <meta property='og:type' content='website'>
           <meta name='og:site_name' content='" . $row["title"] . "'>
           <meta name='og:url' content='https://mhills.de/paste/" . $row["random_id"] . "'>
           <meta name='twitter:title' content='Paste from " . $row["author"] . "'>
           <meta name='theme-color' content='ffa550;'>
    </head>
           ";
           die("fuck off discord");
        }
        else{
           $sql = "UPDATE `pastes` SET views = views+1 WHERE random_id='$id';";
        $result = mysqli_query($db, $sql);
        }
        $output = '
        <!DOCTYPE html>
    <html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="theme-color" content="ffa550" />
      <meta name="og:site_name" content="' . $row["title"] . '">
      <meta property="og:title" content="Paste from ' . $row["author"] . '" />
      <meta property="og:url" content="https://mhills.de/paste/' . $row["random_id"] . '" />
      <meta property="og:type" content="website" />
      <meta property="og:locale" content="en_GB" />
      <link rel="icon" type="image/png" href="https://mhills.de/images/icons/favicon.ico" />
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://mhills.de/dashboard/assets/css/bootstrap.css">
        <script async src="https://arc.io/widget.min.js#3uop4387"></script>
        <link rel="stylesheet" href="https://mhills.de/dashboard/assets/vendors/iconly/bold.css">
        <link rel="stylesheet"
          href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.2.0/styles/default.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.2.0/highlight.min.js"></script>
    
        <link rel="stylesheet" href="https://mhills.de/dashboard/assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
        <link rel="stylesheet" href="https://mhills.de/dashboard/assets/vendors/bootstrap-icons/bootstrap-icons.css">
        <link rel="stylesheet" href="https://mhills.de/dashboard/assets/css/app.css">
        <link rel="shortcut icon" href="https://mhills.de/dashboard/assets/images/favicon.svg" type="image/x-icon">
        
    </head>
        <body style="background: #131313;display: flex;
        justify-content: center;">
        <style>
        .hljs-subst {
            /* var(--highlight-color) */
            color: #ffffff;
          }
          
          .hljs-comment {
            /* var(--highlight-comment) */
            color: #999999;
          }
          
          .hljs-keyword,
          .hljs-selector-tag,
          .hljs-meta .hljs-keyword,
          .hljs-doctag,
          .hljs-section {
            /* var(--highlight-keyword) */
            color: #88aece;
          }
          
          .hljs-attr {
            /* var(--highlight-attribute); */
            color: #88aece;
          }
          
          .hljs-attribute {
            /* var(--highlight-symbol) */
            color: #c59bc1;
          }
          
          .hljs-name,
          .hljs-type,
          .hljs-number,
          .hljs-selector-id,
          .hljs-quote,
          .hljs-template-tag {
            /* var(--highlight-namespace) */
            color: #f08d49;
          }
          
          .hljs-selector-class {
            /* var(--highlight-keyword) */
            color: #88aece;
          }
          
          .hljs-string,
          .hljs-regexp,
          .hljs-symbol,
          .hljs-variable,
          .hljs-template-variable,
          .hljs-link,
          .hljs-selector-attr {
            /* var(--highlight-variable) */
            color: #b5bd68;
          }
          
          .hljs-meta,
          .hljs-selector-pseudo {
            /* var(--highlight-keyword) */
            color: #88aece;
          }
          
          .hljs-built_in,
          .hljs-title,
          .hljs-literal {
            /* var(--highlight-literal) */
            color: #f08d49;
          }
          
          .hljs-bullet,
          .hljs-code {
            /* var(--highlight-punctuation) */
            color: #cccccc;
          }
          
          .hljs-meta .hljs-string {
            /* var(--highlight-variable) */
            color: #b5bd68;
          }
          
          .hljs-deletion {
            /* var(--highlight-deletion) */
            color: #de7176;
          }
          
          .hljs-addition {
            /* var(--highlight-addition) */
            color: #76c490;
          }
          
          .hljs-emphasis {
            font-style: italic;
          }
          
          .hljs-strong {
            font-weight: bold;
          }
          
          .hljs-formula,
          .hljs-operator,
          .hljs-params,
          .hljs-property,
          .hljs-punctuation,
          .hljs-tag {
            /* purposely ignored */
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
        pre code.hljs , textarea, input{
            display: block;
            overflow-x: auto;
            background-color: #131313;
            padding: 1em;
            border: 0;
            white-space: break-spaces;
            padding-right: 30px;
            box-shadow: inset 0 0 18px -10px #000;
            border-radius: 10px;
            color: grey;
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
        .language-plaintext{
            color: white;
        }
        </style>
        <div class="card" style="max-width: 800px;margin-top: 100px;width: 66.6666666667%;">
            <div class="card-header">
                <h4 class="card-title" style="text-align: center;" ><a style="text-decoration: none;color:#c7c7c7" href="https://mhills.de/paste/' . $row["random_id"] . '">' . $row["title"] . '</a> by <a style="text-decoration: none;color:#c7c7c7" href="https://mhills.de/profile/' . $row["author"] . '">' . $row["author"] . '</a></h4>
                <h4 class="card-title" style="text-align: center;">' . $row["views"] . ' Views</h4>
            </div>
            <div class="card-body px-3 py-4-5" style="position: relative;    padding-bottom: 0rem!important;
            padding-top: 1rem!important;">';
            if($row["language"] == "py-highlight"){
                $output .= '        <img src="https://img.icons8.com/ios/2x/ffffff/python.png" class="hide-hover" alt="icon" style="position: absolute;
                top: 1.7rem;
                right: 1.7rem;
                width: 48px;">
                <pre><code class="language-py">';
            }
            else if($row["language"] == "js-highlight"){
                $output .= '        <img src="https://img.icons8.com/ios/2x/ffffff/javascript-logo.png" class="hide-hover" alt="icon" style="position: absolute;
                top: 1.7rem;
                right: 1.7rem;
                width: 48px;">
                <pre><code class="language-js">';
            }
            else if($row["language"] == "csharp-highlight"){
                $output .= '        <img src="https://img.icons8.com/ios/2x/ffffff/c-sharp-logo.png" class="hide-hover" alt="icon" style="position: absolute;
                top: 1.7rem;
                right: 1.7rem;
                width: 48px;">
                <pre><code class="language-cs">';
            }
            else if($row["language"] == "json-highlight"){
                $output .= '        <img src="https://img.icons8.com/material-outlined/2x/ffffff/json-download.png" class="hide-hover" alt="icon" style="position: absolute;
                top: 1.7rem;
                right: 1.7rem;
                width: 48px;">
                <pre><code class="language-json">';
            }
            else if($row["language"] == "lua-highlight"){
                $output .= '        <img src="https://img.icons8.com/material-outlined/2x/ffffff/programming.png" class="hide-hover" alt="icon" style="position: absolute;
                top: 1.7rem;
                right: 1.7rem;
                width: 48px;">
                <pre><code class="language-lua">';
            }
            else if($row["language"] == "php-highlight"){
                $output .= '        <img src="https://img.icons8.com/ios/2x/ffffff/php-logo.png" class="hide-hover" alt="icon" style="position: absolute;
                top: 1.7rem;
                right: 1.7rem;
                width: 48px;">
                <pre><code class="language-php">';
            }
            else if($row["language"] == "sql-highlight"){
                $output .= '        <img src="https://img.icons8.com/material-outlined/2x/ffffff/sql.png" class="hide-hover" alt="icon" style="position: absolute;
                top: 1.2rem;
                right: 1.7rem;
                width: 48px;">
                <pre><code class="language-sql">';
            }
            else{
                $output .= '<pre><code class="language-plaintext">';
            }
            
            $output .= str_replace("’", "'", $row["text"]) .'</code></pre></div></div><script>hljs.highlightAll();</script></body></html>
        ';
        die($output);
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
    <script async src="https://arc.io/widget.min.js#3uop4387"></script>
    <link rel="stylesheet" href="https://mhills.de/dashboard/assets/vendors/iconly/bold.css">
    <link rel="stylesheet"
      href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.2.0/styles/default.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.2.0/highlight.min.js"></script>

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
                            <a href="user" class='sidebar-link'>
                            <svg class="bi" width="1em" height="1em" fill="currentColor">
                                                <use xlink:href="https://mhills.de/dashboard/assets/vendors/bootstrap-icons/bootstrap-icons.svg#person-fill"></use>
                                            </svg>
                                <span>User</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="invites" class='sidebar-link'>
                            <svg class="bi" width="1em" height="1em" fill="currentColor">
                                                <use xlink:href="https://mhills.de/dashboard/assets/vendors/bootstrap-icons/bootstrap-icons.svg#person-plus-fill"></use>
                                            </svg>
                                <span>Invites</span>
                            </a>
                        </li>


                        <li class="sidebar-item">
                            <a href="search" class='sidebar-link'>
                            <svg class="bi" width="1em" height="1em" fill="currentColor">
                                                <use xlink:href="https://mhills.de/dashboard/assets/vendors/bootstrap-icons/bootstrap-icons.svg#search"></use>
                                            </svg>
                                <span>User Search</span>
                            </a>
                        </li>

                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                            <svg class="bi" width="1em" height="1em" fill="currentColor">
                                                <use xlink:href="https://mhills.de/dashboard/assets/vendors/bootstrap-icons/bootstrap-icons.svg#gear-wide-connected"></use>
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
                                                <use xlink:href="https://mhills.de/dashboard/assets/vendors/bootstrap-icons/bootstrap-icons.svg#file-earmark-ruled-fill"></use>
                                            </svg>
                                <span>Rules</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="scoreboard" class='sidebar-link'>
                            <svg class="bi" width="1em" height="1em" fill="currentColor">
                                                <use xlink:href="https://mhills.de/dashboard/assets/vendors/bootstrap-icons/bootstrap-icons.svg#clipboard"></use>
                                            </svg>
                                <span>Scoreboard</span>
                            </a>
                        </li>
                        
                        <li class="sidebar-item active">
                            <a href="#" class='sidebar-link'>
                            <svg class="bi" width="1em" height="1em" fill="currentColor">
                                    <use xlink:href="https://mhills.de/dashboard/assets/vendors/bootstrap-icons/bootstrap-icons.svg#card-text"></use>
                                </svg>
                                <span>Paste</span>
                            </a>
                        </li>

                        <li class="sidebar-item  ">
                            <a href="https://mhills.de/dashboard/gallery/" class='sidebar-link'>
                            <svg class="bi" width="1em" height="1em" fill="currentColor">
                                                <use xlink:href="https://mhills.de/dashboard/assets/vendors/bootstrap-icons/bootstrap-icons.svg#image-fill"></use>
                                            </svg>
                                <span>Gallery</span>
                            </a>
                        </li>


                        <li class="sidebar-item  ">
                            <a href="upload-file" class='sidebar-link'>
                            <svg class="bi" width="1em" height="1em" fill="currentColor">
                                                <use xlink:href="https://mhills.de/dashboard/assets/vendors/bootstrap-icons/bootstrap-icons.svg#cloud-upload-fill"></use>
                                            </svg>
                                <span>Upload</span>
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
                                    <h4 class="card-title">Paste</h4>
                                </div>
                                <div class="card-body px-3 py-4-5">
                                    <a style="color: #ccc"></a>
                                    <form method="POST" action="">
                                <input placeholder="Title Here" name="title" style="display: block;overflow-x: auto;background-color: #131313;padding: 1em;border: 0;box-shadow: inset 0 0 18px -10px #000;border-radius: 10px;color: white;width: -webkit-fill-available;margin-bottom: 10px;"></input>
                                    <textarea maxlength='4096' placeholder="Text Here" name="text" style="display: block;overflow-x: auto;height:150px;background-color: #131313;padding: 1em;border: 0;box-shadow: inset 0 0 18px -10px #000;border-radius: 10px;color: white;width: -webkit-fill-available;"></textarea>
                                    <p style="color: white; text-align: right;" id="count">4096 Characters left</p>
                                    <select name="highlight" id="highlighting" style="display: block;overflow-x: auto;background-color: #131313;padding: 1em;border: 0;box-shadow: inset 0 0 18px -10px #000;border-radius: 10px;color: white;margin-top: 10px;"><option value="no-highlight">No Syntax Highlighting</option>
                                    <option id="py-highlight" value="py-highlight">Python</option>
                                    <option value="js-highlight">Javascript</option>
                                    <option value="csharp-highlight">C#</option>
                                    <option value="json-highlight">JSON</option>
                                    <option value="lua-highlight">Lua</option>
                                    <option value="sql-highlight">SQL</option>
                                    <option value="php-highlight">php</option>
                                
                                </select>
                                    <input class="btn btn-lg btn-dark" type="submit" value="Publish">
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Your Pastes</h4>
                                </div>
                                <div class="card-body px-3 py-4-5">
                                <div class="table-responsive">
                                        <table class="table table-striped table-dark mb-0">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Title</th>
                                                    <th>URL</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                                                                              $query21 = "SELECT * FROM `pastes` WHERE `author`=" . '"' . $username . '";';
                                                                                              $results21 = mysqli_query($db, $query21);
                                                                                              $rows21 = mysqli_num_rows($results21);
                            for ($i = 0; $i < $rows21; ++$i) { 
                                $row21 = mysqli_fetch_assoc($results21);
                                echo "<tr>
                                <td class='text-bold-500'>". $row21["random_id"] . "</td>
                                <td class='text-bold-500'>". $row21["title"] . "</td>
                                <td class='text-bold-500'><a href='https://mhills.de/paste/". $row21["random_id"] . "'>https://mhills.de/paste/". $row21["random_id"] . "</a></td>
                                <td><span class='badge bg-danger'><a style='text-decoration: none;' href='?delete_paste=". $row21["random_id"] . "'>Delete</a></span></td>
                            </tr>";
                            }
                        ?>
                                            </tbody>
                                        </table>
                                    </div>
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
    <script src="https://mhills.de/dashboard/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="https://mhills.de/dashboard/assets/js/bootstrap.bundle.min.js"></script>

    <script src="https://mhills.de/dashboard/assets/vendors/apexcharts/apexcharts.js"></script>
    <script src="https://mhills.de/dashboard/assets/js/pages/dashboard.js"></script>
    <script>hljs.highlightAll();</script>
    <script src="https://mhills.de/dashboard/assets/js/main.js"></script>
</body>
<style>
    option#py-highlight { background-image:url(../images/mhills.de.png); padding-left:15px; }

    textarea:focus, input:focus, select:focus{
    outline: none;
}
pre code.hljs , textarea, input{
    display: block;
    overflow-x: auto;
    background-color: #131313;
    padding: 1em;
    border: 0;
    box-shadow: inset 0 0 18px -10px #000;
    border-radius: 10px;
    color: grey;
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
const textarea = document.querySelector("textarea");

textarea.addEventListener("input", event => {
    const target = event.currentTarget;
    const maxLength = target.getAttribute("maxlength");
    const currentLength = target.value.length;

    if (currentLength >= maxLength) {
        return console.log("You have reached the maximum number of characters.");
    }
    document.querySelector("#count").innerHTML = `${maxLength - currentLength} Characters left`;
});
</script>
</html>