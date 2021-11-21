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
if($row["banned"] == "false"){
    $totalfillessize = human_filesize(GetDirectorySize("../uploads/$uuid/$username"), 2);
  }
  else{
    $totalfillessize = "Files locked";
    header("location: ../dashboard");
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
  <script async src="https://arc.io/widget.min.js#3uop4387"></script>
  <meta property="og:url" content="https://mhills.de/" />
  <meta property="og:type" content="website" />
  <meta property="og:description" content="A Free File Uploader for all of your Files." />
  <meta property="og:locale" content="en_GB" />
  <link rel="icon" type="image/png" href="https://mhills.de/images/icons/favicon.ico" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
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
    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">
    <script src="https://mhills.de/js/main.js"></script>
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

                        <li class="sidebar-item active">
                            <a href="#" class='sidebar-link'>
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
                                    <h4 class="card-title">Upload a File</h4>
                                </div>
                                <div class="card-body px-3 py-4-5">
                                <div id="drop_file_zone" ondrop="upload_file(event)" ondragover="return false">
        <br>
    <div id="drag_upload_file">
    <h4 class="card-title">Drag and Drop a File Here</h4>
    <h4 class="card-title">Or</h4>
    <input type="button" class="btn btn-lg btn-dark" value="Select" onclick="file_explorer();" style="
    color: #fff;
    margin: 5px;
    background-color: #131313;
    border-radius: 7px;
    border-color: #272727;
    color: #fff;
    padding: 10px 30px 10px 30px;
">
        <input type="file" id="selectfile">
    </div>
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
  width:50%;
  margin:0 auto;
}
#drag_upload_file p {
  text-align: center;
}
#drag_upload_file #selectfile {
  display: none;
}
a {
    color: #ffffff;
    text-decoration: underline;
}
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
var fileobj;
function upload_file(e) {
    e.preventDefault();
    fileobj = e.dataTransfer.files[0];
    ajax_file_upload(fileobj);
}
 
function file_explorer() {
    document.getElementById('selectfile').click();
    document.getElementById('selectfile').onchange = function() {
        fileobj = document.getElementById('selectfile').files[0];
        ajax_file_upload(fileobj);
    };
}
function ajax_file_upload(file_obj) {
    if(file_obj != undefined) {
        var form_data = new FormData();                  
        form_data.append('file', file_obj);
        form_data.append('secret', "<?php echo $row["secret"] ?>");
        $.ajax({
            type: 'POST',
            url: 'https://mhills.de/upload.php',
            contentType: false,
            processData: false,
            data: form_data,
            success:function(response) {
                navigator.clipboard.writeText(response);
                Swal.fire({
                    title: 'Uploaded Successfully',
                    text: 'Your file has been uploaded: ' + response,
                    icon: 'success',
                    showDenyButton: true,
                    confirmButtonText: `Open`,
                    denyButtonText: `Don't open`,
                })
                .then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        window.open(response, '_blank').focus();
                    } else if (result.isDenied) {

                    }
                })
                $('#selectfile').val('');
            }
        });
    }
}
</script>
</html>