<?php
    session_start();
    $username = $_SESSION['username'];
    $db = mysqli_connect('localhost', 'root', 'Julian2016--!123', 'file-host');
    function generateRandomString($length = 5)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0;$i < $length;$i++)
        {
            $randomString .= $characters[rand(0, $charactersLength - 1) ];
        }
        return $randomString;
    }
    function get_header($field)
    {
        $headers = headers_list();
        foreach ($headers as $header)
        {
            list($key, $value) = preg_split('/:\s*/', $header);
            if ($key == $field) return $value;
        }
    }
    function generateSecret($length)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0;$i < $length;$i++)
        {
            $randomString .= $characters[rand(0, $charactersLength - 1) ];
        }
        return $randomString;
    }
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
    function rndFileName($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0;$i < $length;$i++)
        {
            $randomString .= $characters[rand(0, $charactersLength - 1) ];
        }
        return $randomString;
    }
    $sql = "SELECT * FROM users WHERE `username`='" . $username . "'";
    $result = mysqli_query($db, $sql);
    $user = mysqli_fetch_assoc($result);
    $userid = $user['id'];
    $username = $user['username'];
    $emcolor = $user['embedcolor'];
    $emdesc = $user['embeddesc'];
    $emauthor = $user['embedauthor'];
    $emtitle = $user['embedtitle'];
    $role = $user['role'];
    $use_embed = $user['use_embed'];
    $use_customdomain = $user['use_customdomain'];
    $uuid = $user['uuid'];
    $uploadToDomain = $user['upload_domain'];
    $uploads = intval($user['uploads']) + 1;
    $filename_type = $user['filename_type'];
    $url_type = $user['url_type'];
    $last_uploaded = $user['last_uploaded'];
    $banned = $user['banned'];
    $upload_limit = $user['upload_limit'];
    $upload_size_limit = $user['upload_size_limit'];
    $self_destruct_upload = $user["self_destruct_upload"];
    $sql1121 = "SELECT * FROM toggles";
    $result1 = mysqli_query($db, $sql1121);
    $user1 = mysqli_fetch_assoc($result1);
    $maintenance = $user1['maintenance'];
    $allow_uploads = $user1['allow_uploads'];
    $announcement = $user1['announcement'];
    $path = "../banners";
    $path = $path . basename($_FILES['file']['tmp_name']);
    $type = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));

    $rnd = rndFileName(8);
    $hash = $uuid . "-" . $rnd . "." . $type;
    $smallHash = $rnd;
    if(isset($_POST["upload-background"])){
        if(move_uploaded_file($_FILES['file']['tmp_name'], '../upload-backgrounds/' . $hash)) {
          echo $hash;
        } else{
            echo "There was an error uploading the file, please try again!";
        }
    }
    else{
        if(move_uploaded_file($_FILES['file']['tmp_name'], '../banners/' . $hash)) {
            echo $hash;
          } else{
              echo "There was an error uploading the file, please try again!";
          }
    }

?>