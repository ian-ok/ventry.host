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
        $query21 = "SELECT * FROM `invites` ORDER BY `inviteAuthor` ASC";
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
      
if(isset($_GET["deleteInvite"])){
    $invite = $_GET["deleteInvite"];
    $sql = "DELETE FROM `invites` WHERE `inviteCode`='$invite'";
    mysqli_query($db, $sql);
    header("location: invites");
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

    <link rel="stylesheet" href="https://mhills.de/dashboard/assets/vendors/iconly/bold.css">
    <script src='https://unpkg.com/@popperjs/core@2'></script>
            <script src='https://unpkg.com/tippy.js@6'></script>
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
                        <li class="sidebar-item active">
                            <a href="#" class='sidebar-link'>
                            <svg class="bi" width="1em" height="1em" fill="currentColor">
                                                <use xlink:href="https://mhills.de/dashboard/assets/vendors/bootstrap-icons/bootstrap-icons.svg#person-plus-fill"></use>
                                            </svg>
                                <span>Manage Invites</span>
                            </a>
                        </li>
                        <li class="sidebar-item ">
                            <a href="add-invites" class='sidebar-link'>
                            <svg class="bi" width="1em" height="1em" fill="currentColor">
                                                <use xlink:href="https://mhills.de/dashboard/assets/vendors/bootstrap-icons/bootstrap-icons.svg#person-plus-fill"></use>
                                            </svg>
                                <span>Add Invites</span>
                            </a>
                        </li>
                        <li class="sidebar-item ">
                            <a href="settings" class='sidebar-link'>
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
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Invites (<?php echo $invitecount?>)</h4>
                                </div>
                                <div class="card-body px-3 py-4-5">
                                <div class="dataTable-container">
                                    <table class="table table-striped dataTable-table" id="table1">
                                        <thead>
                                            <tr>
                                                <th style="width: 5.0933%;"><a style='text-decoration: none;' class="dataTable-sorter">ID</a></th>
                                                <th style="width: 54.0933%;"><a style='text-decoration: none;' class="dataTable-sorter">Invite</a></th>
                                                <th style="width: 18.3109%;"><a style='text-decoration: none;' class="dataTable-sorter">Owner</a></th>
                                                <th style="width: 48.3109%;"><a style='text-decoration: none;' class="dataTable-sorter">Expires on</a></th>
                                                <th style="width: 18.3109%;"><a style='text-decoration: none;' class="dataTable-sorter">Delete</a></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                            for ($i = 0; $i < $invitecount; ++$i) { 
                                $row21 = mysqli_fetch_assoc($results21);
                                $inviteCode = $row21["inviteCode"];
                                echo "<tr>
                                <td>" . $row21["id"] . "</td>
                                <td><a style='text-decoration: none;' href='https://mhills.de/invite/" . $row21["inviteCode"] . "'>" . $row21["inviteCode"] . "</a>";
                                echo "
                                </td>
                                <td>" . $row21["inviteAuthor"] . "</td>
                                <td><span class='badge bg-success'>Never Expires</span></td>
                                <td><span class='badge bg-danger'><a style='text-decoration: none;' href='?deleteInvite=$inviteCode'>Delete</a></span></td></tr>";
                            }
                        ?>
                                        </tbody>
                                    </table>
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
<style>
    .btn.btn-dark {
    color: #fff;
    margin: 5px;
}
a:hover{
    color: grey;
}
.table-striped>tbody>tr:nth-of-type(odd) {
    --bs-table-accent-bg: var(--bs-table-striped-bg);
    color: #ffffff;
}
.table {
    --bs-table-bg: transparent;
    --bs-table-accent-bg: transparent;
    --bs-table-striped-color: #607080;
    --bs-table-striped-bg: rgba(0, 0, 0, 0.05);
    --bs-table-active-color: #607080;
    --bs-table-active-bg: rgba(0, 0, 0, 0.1);
    --bs-table-hover-color: #607080;
    --bs-table-hover-bg: rgba(0, 0, 0, 0.075);
    border-color: #eee;
    color: #ffffff;
    margin-bottom: 1rem;
    vertical-align: top;
    width: 100%;
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
</html>