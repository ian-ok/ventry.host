<?php
session_start();
require_once "Mobile_Detect.php";
$detect = new Mobile_Detect;
if (!isset($_SESSION['username'])) {
	$_SESSION['msg'] = "You must log in first";
	header('location: https://mhills.de');
}
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['username']);
	unset($_SESSION['userid']);
	unset($_SESSION);
	header("location: https://mhills.de");
}
$db = mysqli_connect('localhost', 'root', 'Julian2016--!123', 'file-host');
if(isset($_GET["goto"])){
	$next_page_coming = $_GET["pagenumber"];
	header("location: /page/" . $next_page_coming);
}
if (isset($_GET['delete'])) {
	$delfilename = $_GET['delete'];
	if(isset($_GET['secret'])){
		$query645 = "SELECT delete_secret FROM uploads WHERE filename='$delfilename'";
		$result645 = mysqli_query($db, $query645);
		if (mysqli_num_rows($result645) > 0) {
			// output data of each row
			while ($row645 = mysqli_fetch_assoc($result645)) {
				$delete_secret = "" . $row645["delete_secret"] . "";
			}
		} else {
			echo "0 results";
		}
		if($delete_secret == $_GET['secret']){
			$username = $_SESSION['username'];
			$query = "DELETE FROM uploads WHERE filename='" . $_GET['delete'] . "';";
			$results = mysqli_query($db, $query);
			$rows = mysqli_num_rows($results);
			$query = "SELECT id, username, email, role, reg_date, secret, uploads, uuid FROM users WHERE username='$username'";
			$result = mysqli_query($db, $query);
			if (mysqli_num_rows($result) > 0) {
				// output data of each row
				while ($row = mysqli_fetch_assoc($result)) {
					$email = "" . $row["email"] . "";
					$role = "" . $row["role"] . "";
					$uid = "" . $row["id"] . "";
					$_SESSION['userid'] = $row["id"];
					$secret = "" . $row["secret"] . "";
					$reg_date = "" . $row["reg_date"] . "";
					$uploads = "" . $row["uploads"] . "" - 1;
					$uuid = "" . $row["uuid"] . "";
				}
			} else {
				echo "0 results";
			}
			unlink("/var/www/html/uploads/$uuid/$username/" . $_GET['delete']);
			$query2 = "UPDATE users SET uploads=$uploads WHERE username='" . $username . "';";
			$results2 = mysqli_query($db, $query2);
			$rows2 = mysqli_num_rows($results2);
			if(isset($_GET["page"])){
				header("location: https://mhills.de/dashboard/gallery/page/" . $_GET["page"]);
			}
			else{
				header("location: https://mhills.de/dashboard/gallery");
			}
		}
		else{
			die("Wrong Secret!");
		}
	}
}
$username = $_SESSION['username'];
$query645 = "SELECT * FROM users WHERE username='$username'";
$result645 = mysqli_query($db, $query645);
if (mysqli_num_rows($result645) > 0) {
	// output data of each row
	while ($row645 = mysqli_fetch_assoc($result645)) {
		$email = "" . $row645["email"] . "";
		$role = "" . $row645["role"] . "";
		$uid = "" . $row645["id"] . "";
		$_SESSION['userid'] = $row645["id"];
		$secret = "" . $row645["secret"] . "";
		$reg_date = "" . $row645["reg_date"] . "";
		$uploads = "" . $row645["uploads"] . "";
		$uuid = "" . $row645["uuid"] . "";
		$banned = "" . $row645["banned"] . "";
	}
} else {
	echo "0 results";
}
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
if($banned == "false"){
    $totalfillessize = human_filesize(GetDirectorySize("../uploads/$uuid/$username"), 2);
  }
  else{
    $totalfillessize = "Files locked";
    header("location: ../");
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
                            <a href="https://mhills.de/dashboard/user" class='sidebar-link'>
                            <svg class="bi" width="1em" height="1em" fill="currentColor">
                                                <use xlink:href="https://mhills.de/dashboard/assets/vendors/bootstrap-icons/bootstrap-icons.svg#person-fill"></use>
                                            </svg>
                                <span>User</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="https://mhills.de/dashboard/invites" class='sidebar-link'>
                            <svg class="bi" width="1em" height="1em" fill="currentColor">
                                                <use xlink:href="https://mhills.de/dashboard/assets/vendors/bootstrap-icons/bootstrap-icons.svg#person-plus-fill"></use>
                                            </svg>
                                <span>Invites</span>
                            </a>
                        </li>


                        <li class="sidebar-item">
                            <a href="https://mhills.de/dashboard/search" class='sidebar-link'>
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
                                <li class="submenu-item ">
                                    <a href="https://mhills.de/dashboard/embed-settings">Embed Settings</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="https://mhills.de/dashboard/domain-settings">Domain Settings</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="https://mhills.de/dashboard/upload-preferences">Upload Preferences</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item">
                            <a href="https://mhills.de/dashboard/rules" class='sidebar-link'>
                            <svg class="bi" width="1em" height="1em" fill="currentColor">
                                                <use xlink:href="https://mhills.de/dashboard/assets/vendors/bootstrap-icons/bootstrap-icons.svg#file-earmark-ruled-fill"></use>
                                            </svg>
                                <span>Rules</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="https://mhills.de/dashboard/scoreboard" class='sidebar-link'>
                            <svg class="bi" width="1em" height="1em" fill="currentColor">
                                                <use xlink:href="https://mhills.de/dashboard/assets/vendors/bootstrap-icons/bootstrap-icons.svg#clipboard"></use>
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
                        <li class="sidebar-item active">
                            <a href="#" class='sidebar-link'>
                            <svg class="bi" width="1em" height="1em" fill="currentColor">
                                                <use xlink:href="https://mhills.de/dashboard/assets/vendors/bootstrap-icons/bootstrap-icons.svg#image-fill"></use>
                                            </svg>
                                <span>Gallery</span>
                            </a>
                        </li>


                        <li class="sidebar-item  ">
                            <a href="https://mhills.de/dashboard/upload-file" class='sidebar-link'>
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
            <style>
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
.special-card {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0px;
    width: 300px;
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
.card-normal {
    position: relative;
    display: -ms-flexbox;
    display: block;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0px;
    width: auto;
    height: auto;
    flex: 1 1 auto;
    word-wrap: break-word;
    background-color: #1b1b1b;
    background-clip: border-box;
    border: 1px solid rgba(0, 0, 0, .125);
    border-radius: 15px;
    padding: 15px;
    margin: 10px 10px 10px 10px;
    box-shadow: 0 1px 10px rgb(0 0 0 / 30%), 0 15px 12px rgb(0 0 0 / 22%);
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
  width: -webkit-fill-available;
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
.flex {
    display: -webkit-box;
    display: -moz-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
}
img.card-image-top-top{
	border-radius: 25%;
    width: 40%;
    height: auto;
    display: block;
    margin-left: auto;
    margin-right: auto;
    margin-top: 10%;
    transition: 0.3s;
}
.grid__brick mt-3 col-6 col-md-4 col-xl-3 img {
			padding: 50%;
			float: left;
			width: auto;
			max-width: 100%;
			height: auto;
			object-fit: cover;
		}
        .page-link:before {
    position: relative;
    display: block;
    padding: .5rem .75rem;
    margin-left: -1px;
    line-height: 1.25;
    color: white;
    background-color: #131313;
    border: 1px solid #1b1b1b;
    transition: 0.3;
}
img {
    max-width: 100%;
    max-height: 100%;
    border-radius: 10px;
}
.page-link:after {
    position: relative;
    display: block;
    padding: .5rem .75rem;
    margin-left: -1px;
    line-height: 1.25;
    color: #131313;
    background-color: white;
    border: 1px solid #1b1b1b;
    transition: 0.3;
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
    text-align: center;
    max-width: 300px;
    flex: 1 1 auto;
    word-wrap: break-word;
    color: white;
    background-color: #131313;
    background-clip: border-box;
    border: 1px solid rgba(0, 0, 0, .125);
    border-radius: 15px;
    padding: 15px;
    margin: 20px 20px 20px 20px;
    box-shadow: 0 1px 10px rgb(0 0 0 / 30%), 0 15px 12px rgb(0 0 0 / 22%);
}
.page-item{
    margin-left: 4px;
    margin-right: 4px;
}
.card-pagination {
    position: relative;
    display: -ms-flexbox;
    display: block;
    -ms-flex-direction: column;
    flex-direction: column;
    word-wrap: break-word;
    background-color: #131313;
    justify-content: center;
    background-clip: border-box;
    border: 1px solid rgba(0, 0, 0, .125);
    border-radius: 15px;
    width: auto;
    padding: 15px;
    align-items: center;
    margin: 10px 10px 10px 10px;
    box-shadow: 0 1px 10px rgb(0 0 0 / 30%), 0 15px 12px rgb(0 0 0 / 22%);
}
.page-link {
    position: relative;
    display: block;
    padding: .5rem .75rem;
    margin-left: -1px;
    line-height: 1.25;
    color: white;
    justify-content: center;
    margin: 0 auto;
    border-radius: 10px;
    background-color: #131313;
    border-radius: 7px;
    border-color: #272727;
}
.page-item:last-child .page-link {
    border-top-right-radius: .25rem;
    border-bottom-right-radius: .25rem;
	border-radius: 10px;
}
.page-item:first-child .page-link {
    border-top-right-radius: .25rem;
    border-bottom-right-radius: .25rem;
	border-radius: 10px;
}
		.container {
			max-width: 100%;
			width: 100%;
      margin:  10px 10px 10px 10px;
	  justify-content: center;
		}
        .pagination {
    padding-left: 0;
    list-style: none;
    justify-content: center;
    border-radius: .25rem;
}
		.col-md-3 {
			width: 100%;
			float: left;
			margin: 0;
		}

		.card-img-top {
    width: 100%;
    border: 1px solid grey;
    height: 20vh;
    object-fit: cover;
    border-radius: 15px 15px 15px 15px;
}

		/* Small devices (landscape phones, 576px and up) */
		@media (min-width: 576px) {
			.card-img-top {
				height: 19vw;
			}
		}

		/* Medium devices (tablets, 768px and up) */
		@media (min-width: 768px) {
			.card-img-top {
				height: 16vw;
			}
		}

		/* Large devices (desktops, 992px and up) */
		@media (min-width: 992px) {
			.card-img-top {
				height: 11vw;
			}
		}

		/* Extra large devices (large desktops, 1200px and up) */
		@media (min-width: 992px) {
			.card-img-top {
				height: 11vw;
			}
		}

		.h5,
		h5 {
			font-size: 1.15rem;
		}
    .btn.btn-dark {
    color: #fff;
    margin: 5px;
    display: block;
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
            <div class="page-content">
                <section class="row">
                    <div class="row">
                        <div class="col-12">
                            <div class="card-1">
                                <div class="card-header">
                                    <h4 class="card-title">Gallery</h4>
                                </div>
                                <div class="card-body px-3 py-4-5">
                                <div class="flex">
                                <?php
include('db.php');

if (isset($_GET['page']) && $_GET['page']!="") {
	$page = $_GET['page'];
	} else {
		$page = 1;
        }

	$total_records_per_page = 20;
    $offset = ($page-1) * $total_records_per_page;
	$previous_page = $page - 1;
	$next_page = $page + 1;
	$adjacents = "2"; 

	$result_count = mysqli_query($con,"SELECT COUNT(*) As total_records FROM `uploads` WHERE `username`='$username'");
	$total_records = mysqli_fetch_array($result_count);
	$total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
	$second_last = $total_no_of_pages - 1; // total page minus 1

    $result = mysqli_query($con,"SELECT * FROM `uploads` WHERE `username`='$username' ORDER BY `id` DESC LIMIT $offset, $total_records_per_page");
    ?>
		<div class="row-new">
		<?php
					if($uploads == "0"){
						echo "<div class='card' <div class='card-body'> <br> <p class='card-text'>This is looking pretty empty...</a></p> <br> </div>";
						die();
					}
					
					?>
<?php 
	while($row = mysqli_fetch_array($result)){
		?>
	<div style="text-align: center;" class='card' <div class='card-body'>
		<?php  
        if($banned == "false"){
            $totalfillessize = human_filesize(GetDirectorySize("../uploads/$uuid/$username"), 2);
          }
          else{
            $totalfillessize = "Files locked";
          }
				$filename = $row["filename"];
					if(strpos($filename, ".exe")){
						echo "<img class='card-img-top' src='https://mhills.de/uploads/exe.png'>";
					}
                    else if(strpos($filename, ".msi")){
						echo "<img class='card-img-top' src='https://mhills.de/uploads/exe.png'>";
					}
					else if(strpos($filename, ".zip")){
						echo "<img class='card-img-top' src='https://mhills.de/uploads/rar-zip.png'>";
					}
					else if(strpos($filename, ".rar")){
						echo "<img class='card-img-top' src='https://mhills.de/uploads/rar-zip.png'>";
					}					
					else if(strpos($filename, ".mp4")){
						echo "<video class='card-img-top' width='640' height='480' controls='' > <source src='https://mhills.de/uploads/" .  $uuid . "/" . $username . "/" . $row["filename"] . "' type='video/mp4'> </video>";
					}					
					else if(strpos($filename, ".mov")){
						echo "<img class='card-img-top' src='https://mhills.de/uploads/video.png'>";
					}					
					else if(strpos($filename, ".avi")){
						echo "<img class='card-img-top' src='https://mhills.de/uploads/video.png'>";
					}					
					else if(strpos($filename, ".flv")){
						echo "<img class='card-img-top' src='https://mhills.de/uploads/video.png'>";
					}		
					else if(strpos($filename, ".dll")){
						echo "<img class='card-img-top' src='https://mhills.de/uploads/dll.png'>";
					}		
					else if(strpos($filename, ".sql")){
						echo "<img class='card-img-top' src='https://mhills.de/uploads/sql.png'>";
					}		
					else if(strpos($filename, ".torrent")){
						echo "<img class='card-img-top' src='https://mhills.de/uploads/torrent.png'>";
					}					
					else {
						echo "<img class='card-img-top' src='https://mhills.de/uploads/" .  $uuid . "/" . $username . "/" . $row["filename"] . "'>";
					}
				?>
        <br><br>
        <h5 class='card-title' href='<?php echo "https://mhills.de/" . $row['filename'] . "'>" . $row['filename'] . " (<a href='?delete=" . $row['filename'] . "&secret=" . $row['delete_secret']?>'><svg class="bi" width="1em" height="1em" fill="currentColor">
                                                <use xlink:href="https://mhills.de/dashboard/assets/vendors/bootstrap-icons/bootstrap-icons.svg#trash-fill"></use>
                                            </svg></a>)</h5>
<p style="color: grey;"class='card-text'>Original Filename:<br><a style='color: white;'><?php echo $row['original_filename'] ?></a></p>
<p style="color: grey;"class='card-text'>Size: <a style='color: white;'><?php echo $row['filesize'] ?></a></p>
<p style="color: grey;"class='card-text'>Uploaded at:<br><a style='color: white;'><?php echo $row['uploaded_at']; ?></a></p>
<p style="color: grey;"class='card-text'>Url:<br><a href="<?php echo 'https://mhills.de/' . $row['filename'] ?>" style="color: white;"><?php echo 'https://mhills.de/<br>' . $row['filename'] ?></a></p>
<br>
<a class="btn btn-lg btn-dark" href='<?php echo "https://mhills.de/uploads/$uuid/$username/" . $row['filename'] ?>' download type='button'>Download</a>
<a class="btn btn-lg btn-dark" href='<?php echo "?delete=" . $row['filename'] . "&secret=" . $row['delete_secret']?>' type='button'>Delete</a>
</div>
</p>
<?php
	}
	?>
                                </div>
                                </div><br>
			<hr class="rounded"><br>
            <div class="flex" style="justify-content: center;">
			<div class="card-pagination" <div class="card-body-pagination">
			<strong style="color: white;">Page <?php echo $page." of ".$total_no_of_pages; ?></strong>
<ul class="pagination">
	<?php 
		$str_output = "";
		if($detect->isMobile()){
			//Handy
			/*
			<select name="cars" id="cars">
				<option value="volvo">Volvo</option>
				<option value="saab">Saab</option>
				<option value="mercedes">Mercedes</option>
				<option value="audi">Audi</option>
			</select>
			*/
			$str_output .= "<select name='page-select' onchange='gotoPage(this.value)'>";
			for ($i = 1; $i <= $total_no_of_pages; ++$i){
				if ($i == $page){
					$str_output .= "<option selected='selected' value='".$i."'>Page ".$i."</option>";
				}else{
					$str_output .= "<option value='".$i."'>Page ".$i."</option>";
				}
			}
			$str_output .= "</select>";
		}
		else{
			//Desktop
			if($page > 1){
				$str_output .= "<li class='page-item'><a class='page-link' href='https://mhills.de/dashboard/gallery/page/1'>&lsaquo;&lsaquo; First</a></li>";
				$str_output .= "<li class='page-item'><a class='page-link' href='https://mhills.de/dashboard/gallery/page/".$previous_page."'>Previous </a></li>";
			}





			
	
			if ($total_no_of_pages <= 10){  	 
				for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
					if ($counter == $page) {	
						$str_output .= "<li class='page-item'><a class='page-link' href='https://mhills.de/dashboard/gallery/page/".$counter."'>".$counter."</a></li>";
					}else{
						$str_output .= "<li class='page-item'><a class='page-link' href='https://mhills.de/dashboard/gallery/page/".$counter."'>".$counter."</a></li>";
					}
				}
			}
			elseif ($total_no_of_pages > 10){
				if($page <= 4) {			
			 		for ($counter = 1; $counter < 8; $counter++){		 
						if ($counter == $page) {
							$str_output .= "<li class='page-item'><a class='page-link' href='https://mhills.de/dashboard/gallery/page/".$counter."'>".$counter."</a></li>";	
						}else{
							$str_output .= "<li class='page-item'><a class='page-link' href='https://mhills.de/dashboard/gallery/page/".$counter."'>".$counter."</a></li>";
						}
					}
					$str_output .= "<li class='page-item'><a class='page-link'>...</a></li>";
					$str_output .= "<li class='page-item'><a class='page-link' href='https://mhills.de/dashboard/gallery/page/".$second_last."'>".$second_last."</a></li>";
					$str_output .= "<li class='page-item'><a class='page-link' href='https://mhills.de/dashboard/gallery/page/".$total_no_of_pages."'>".$total_no_of_pages."</a></li>";
				}
				elseif ($page > 4 && $page < $total_no_of_pages - 4) {	
					$str_output .= "<li class='page-item'><a class='page-link' href='https://mhills.de/dashboard/gallery/page/1'>1</a></li>";		 
					$str_output .= "<li class='page-item'><a class='page-link' href='https://mhills.de/dashboard/gallery/page/2'>2</a></li>";		 
					$str_output .= "<li class='page-item'><a class='page-link'>...</a></li>";
					for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {			
						if ($counter == $page) {
							$str_output .= "<li class='page-item'><a class='page-link' href='https://mhills.de/dashboard/gallery/page/".$counter."'>".$counter."</a></li>";		
						}else{
							$str_output .= "<li class='page-item'><a class='page-link' href='https://mhills.de/dashboard/gallery/page/".$counter."'>".$counter."</a></li>";	
						}                  
					}
					$str_output .= "<li class='page-item'><a class='page-link'>...</a></li>";
					$str_output .= "<li class='page-item'><a class='page-link' href='https://mhills.de/dashboard/gallery/page/".$second_last."'>".$second_last."</a></li>";
					$str_output .= "<li class='page-item'><a class='page-link' href='https://mhills.de/dashboard/gallery/page/".$total_no_of_pages."'>".$total_no_of_pages."</a></li>";    
				} 
				else {
					$str_output .= "<li class='page-item'><a class='page-link' href='https://mhills.de/dashboard/gallery/page/1'>1</a></li>";		 
					$str_output .= "<li class='page-item'><a class='page-link' href='https://mhills.de/dashboard/gallery/page/2'>2</a></li>";
					$str_output .= "<li class='page-item'><a class='page-link'>...</a></li>";
		
					for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
						if ($counter == $page) {
							$str_output .= "<li class='page-item'><a class='page-link' href='https://mhills.de/dashboard/gallery/page/".$counter."'>".$counter."</a></li>";		
						}else{
							$str_output .= "<li class='page-item'><a class='page-link' href='https://mhills.de/dashboard/gallery/page/".$counter."'>".$counter."</a></li>";	
						}                
					}
				}
			}
			


			if($page < $total_no_of_pages){
				$str_output .= "<li class='page-item'><a class='page-link' href='https://mhills.de/dashboard/gallery/page/".$next_page."'>Next</a></li>";
				$str_output .= "<li class='page-item'><a class='page-link' href='https://mhills.de/dashboard/gallery/page/".$total_no_of_pages."'>Last &rsaquo;&rsaquo;</a></li>";
			}

			$str_output .= "</ul><br><form action='?goto' method='get' name='form' enctype='multipart/form-data'>
		  <input type='text' name='page' placeholder='Enter Page'>
	  </form>";

		}
		



		echo $str_output;
	?> 
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
    <script>
function gotoPage(val) {
	window.location.replace("https://mhills.de/dashboard/gallery/page/" + val);
}
</script>
    <script src="https://mhills.de/dashboard/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="https://mhills.de/dashboard/assets/js/bootstrap.bundle.min.js"></script>

    <script src="https://mhills.de/dashboard/assets/vendors/apexcharts/apexcharts.js"></script>
    <script src="https://mhills.de/dashboard/assets/js/pages/dashboard.js"></script>

    <script src="https://mhills.de/dashboard/assets/js/main.js"></script>
</body>
<style>
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
.special-card {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0px;
    width: 300px;
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
.card-normal {
    position: relative;
    display: -ms-flexbox;
    display: block;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0px;
    width: auto;
    height: auto;
    flex: 1 1 auto;
    word-wrap: break-word;
    background-color: #1b1b1b;
    background-clip: border-box;
    border: 1px solid rgba(0, 0, 0, .125);
    border-radius: 15px;
    padding: 15px;
    margin: 10px 10px 10px 10px;
    box-shadow: 0 1px 10px rgb(0 0 0 / 30%), 0 15px 12px rgb(0 0 0 / 22%);
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
  width: -webkit-fill-available;
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
.flex {
    display: -webkit-box;
    display: -moz-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
}
img.card-image-top-top{
	border-radius: 25%;
    width: 40%;
    height: auto;
    display: block;
    margin-left: auto;
    margin-right: auto;
    margin-top: 10%;
    transition: 0.3s;
}
.grid__brick mt-3 col-6 col-md-4 col-xl-3 img {
			padding: 50%;
			float: left;
			width: auto;
			max-width: 100%;
			height: auto;
			object-fit: cover;
		}
        .page-link:before {
    position: relative;
    display: block;
    padding: .5rem .75rem;
    margin-left: -1px;
    line-height: 1.25;
    color: white;
    background-color: #131313;
    border: 1px solid #1b1b1b;
    transition: 0.3;
}
img {
    max-width: 100%;
    max-height: 100%;
    border-radius: 10px;
}
.page-link:after {
    position: relative;
    display: block;
    padding: .5rem .75rem;
    margin-left: -1px;
    line-height: 1.25;
    color: #131313;
    background-color: white;
    border: 1px solid #1b1b1b;
    transition: 0.3;
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
.page-item{
    margin-left: 4px;
    margin-right: 4px;
}
.card-pagination {
    position: relative;
    display: -ms-flexbox;
    display: block;
    -ms-flex-direction: column;
    flex-direction: column;
    word-wrap: break-word;
    background-color: #131313;
    justify-content: center;
    background-clip: border-box;
    border: 1px solid rgba(0, 0, 0, .125);
    border-radius: 15px;
    width: auto;
    padding: 15px;
    align-items: center;
    margin: 10px 10px 10px 10px;
    box-shadow: 0 1px 10px rgb(0 0 0 / 30%), 0 15px 12px rgb(0 0 0 / 22%);
}
.page-link {
    position: relative;
    display: block;
    padding: .5rem .75rem;
    margin-left: -1px;
    line-height: 1.25;
    color: white;
    justify-content: center;
    margin: 0 auto;
    border-radius: 10px;
    background-color: #131313;
    border-radius: 7px;
    border-color: #272727;
}
.page-item:last-child .page-link {
    border-top-right-radius: .25rem;
    border-bottom-right-radius: .25rem;
	border-radius: 10px;
}
.page-item:first-child .page-link {
    border-top-right-radius: .25rem;
    border-bottom-right-radius: .25rem;
	border-radius: 10px;
}
		.container {
			max-width: 100%;
			width: 100%;
      margin:  10px 10px 10px 10px;
	  justify-content: center;
		}
        .pagination {
    padding-left: 0;
    list-style: none;
    justify-content: center;
    border-radius: .25rem;
}
		.col-md-3 {
			width: 100%;
			float: left;
			margin: 0;
		}

		.card-img-top {
    width: 100%;
    border: 1px solid grey;
    height: 20vh;
    object-fit: cover;
    border-radius: 15px 15px 15px 15px;
}

		/* Small devices (landscape phones, 576px and up) */
		@media (min-width: 576px) {
			.card-img-top {
				height: 19vw;
			}
		}

		/* Medium devices (tablets, 768px and up) */
		@media (min-width: 768px) {
			.card-img-top {
				height: 16vw;
			}
		}

		/* Large devices (desktops, 992px and up) */
		@media (min-width: 992px) {
			.card-img-top {
				height: 11vw;
			}
		}

		/* Extra large devices (large desktops, 1200px and up) */
		@media (min-width: 992px) {
			.card-img-top {
				height: 11vw;
			}
		}

		.h5,
		h5 {
			font-size: 1.15rem;
		}
    .btn.btn-dark {
    color: #fff;
    margin: 5px;
    display: block;
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