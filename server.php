<?php
/**
* Class and Function List:
* Function list:
* - generateRandomInt()
* - uuid()
* - generateRandomString()
* Classes list:
*/
error_reporting(E_ERROR);

session_start();

function generateRandomInt($length)
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
$tag = generateRandomInt(4);

// initializing variables
$username = "";
$email = "";
$errors = array();
$succeded = array();
// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'file-host');
// REGISTER USER
function uuid()
{
    return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x', mt_rand(0, 0xffff) , mt_rand(0, 0xffff) , mt_rand(0, 0xffff) , mt_rand(0, 0x0fff) | 0x4000, mt_rand(0, 0x3fff) | 0x8000, mt_rand(0, 0xffff) , mt_rand(0, 0xffff) , mt_rand(0, 0xffff));
}

$uuid = uuid();
if (isset($_POST['reg_user']))
{
    // receive all input values from the form
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    define("EMAIL", mysqli_real_escape_string($db, $_POST['email']));
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
    $key = mysqli_real_escape_string($db, $_POST['key']);

    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($username))
    {
        array_push($errors, "Username is required");
    }
    if (empty($email))
    {
        array_push($errors, "Email is required");
    }
    if (empty($password_1))
    {
        array_push($errors, "Password is required");
    }
    if (empty($key))
    {
        array_push($errors, "A Key is required");
    }
    if ($password_1 != $password_2)
    {
        array_push($errors, "The two passwords do not match");
    }

    // first check the database to make sure
    // a user does not already exist with the same username and/or email
    $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user)
    { // if user exists
        if ($user['username'] == $username)
        {
            array_push($errors, "Username already exists.");
        }
        else if ($user['email'] == $email)
        {
            array_push($errors, "Email already exists.");
        }
        else
        {
            array_push($errors, "Already registered.");
        }

    }
    else
    {

    }
    $query12345 = "SELECT * FROM users WHERE invite='$key'";
    $exquery = mysqli_query($db, $query12345);

    if (mysqli_num_rows($exquery) > 0)
    {

        array_push($errors, "Invite is already assigned to another Account.");

    }
    else
    {
        $regQuery = "SELECT * FROM `invites` WHERE `inviteCode`='$key';";
        $regReq = mysqli_query($db, $regQuery);
        $regResult = mysqli_fetch_assoc($regReq);
        $inviter = $regResult['inviteAuthor'];
        if ($regResult['inviteCode'] == $key)
        {
            $delquery = "DELETE FROM `invites` WHERE `inviteCode` = '$key';";
            mysqli_query($db, $delquery);
            function generateRandomString($length = 16)
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
            $ranPass = generateRandomInt(16);
            date_default_timezone_set('Europe/Amsterdam');
            $date = date("F d, Y h:i:s A");

            // Finally, register user if there are no errors in the form
            if (count($errors) == 0)
            {
                if (!file_exists('uploads/' . $uuid))
                {
                    mkdir('uploads/' . $uuid, 0777, true);
                }
                $password = md5($password_1);
                $embed_colour = "#FFA500";
                $embed_desc = "test1";
                $embed_title = "test2";
                $query = "INSERT INTO `users`(`id`, `uuid`, `username`, `email`, `password`, `banned`, `invite`, `secret`, `embedcolor`, `embedauthor`, `embedtitle`, `embeddesc`, `role`, `reg_date`, `use_embed`, `use_customdomain`, `use_2fa`, `self_destruct_upload`, `filename_type`, `url_type`, `uploads`, `upload_domain`, `discord_username`, `discord_id`, `discord_nitro`, `discord_avatar`, `inviter`, `last_uploaded`, `upload_limit`, `upload_size_limit`, `profile_description`, `profile_privacy`, `upload_background`, `upload_background_toggle`, `social_follower`, `social_banner`, `social_banner_filename`, `social_banner_color`, `social_currency`) VALUES (NULL, '$uuid', '$username', '$email', '$password', 'false','$key', '$ranPass', '#FFA500', 'M. Hills | File Host', '%filename (%filesize)', 'Uploaded by %username at %date', 'User', '$date', 'true', 'false', 'false', 'false', 'short', 'short', 0, 'mhills.de', 'user#0000', '000000000000000000', 'No Nitro', 'https://cdn.discordapp.com/avatars/483330377214066707/2f85384205ece254104f0c6cf014bbe4.png?size=2048', '$inviter', 'Could not find Date', '500 MB', '32 MB', 'No description set.', 'true', '', 'false', 0, 'https://mhills.de/uploads/882ac87d-c207-4231-b115-c8e6ffc382e4/AtomicHXH/U2hB6rSs.png', 'U2hB6rSs.png', '#000000', 0);";
                mysqli_query($db, $query);
                $_SESSION['username'] = $username;
                $_SESSION['key'] = $key;
                $ip = $_SERVER['REMOTE_ADDR'];
                $_SESSION['success'] = "You are now logged in";
                $webhookurl = "https://discord.com/api/webhooks/838820718581252126/Rym-Gjx7u7TCfGW0l7RA6X2h6ugN8np4LD2DuOr2jtxkOyGTyxqadaB9s__KLkunUbi9";

                $json_data = json_encode([

                // Username
                "username" => "Marc Hills File Host | Logs",

                // Avatar URL.
                // Uncoment to replace image set in webhook
                //"avatar_url" => "https://ru.gravatar.com/userimage/28503754/1168e2bddca84fec2a63addb348c571d.jpg?size=512",
                // Text-to-speech
                "tts" => false,

                // File upload
                // "file" => "",
                // Embeds Array
                "embeds" => [[
                // Embed Title
                "title" => "Marc Hills File Host | Logs", "description" => "New User",

                // Embed Type
                "type" => "rich",

                // URL of title link
                "url" => "https://www.mhills.de/?f=" . $hash,

                // Embed left border color in HEX
                "color" => hexdec($embed_colour) ,

                // Footer
                "footer" => ["text" => "www.mhills.de", "icon_url" => "https://www.mhills.de/images/mhills.de.png"],

                // Author
                "author" => ["name" => $username, ],

                // Additional Fields array
                "fields" => [
                // Field 1
                ["name" => "Email", "value" => $email, "inline" => true],
                // Field 2
                ["name" => "Key", "value" => $key, "inline" => true],
                // Field 3
                ["name" => "IP", "value" => $ip, "inline" => true],
                // Etc..
                ]]]

                ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

                $ch = curl_init($webhookurl);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-type: application/json'
                ));
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                $response = curl_exec($ch);
                // If you need to debug, or find out why you can't send message uncomment line below, and execute script.
                // echo $response;
                curl_close($ch);
                header('location: oauth2/');
            }
        }
        else
        {
            array_push($errors, "Invite is not valid.");
        }

    }
}
// LOGIN USER
if (isset($_POST['login_user']))
{
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($username))
    {
        array_push($errors, "Username is required");
    }
    if (empty($password))
    {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0)
    {
        $password = md5($password);
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $results = mysqli_query($db, $query);
        $user = mysqli_fetch_assoc($results);
        $result = mysqli_num_rows($results);
        if (mysqli_num_rows($results) == 1)
        {
            if (!file_exists('uploads/' . $uuid . '/'))
            {
                mkdir('uploads/' . $uuid . '/', 0777, true);
            }
            $twofa_status = $user['use_2fa'];
            if ($twofa_status == "false")
            {
                $_SESSION['username'] = "";
                $_SESSION['uploads'] = $user['uploads'];
                $_SESSION['success'] = "<div class='card' <div class='card-body'> <br> <h3 class='card-text' style='color: green;'>You are Logged in!</h3> <br> </div> </div> <br>";
                if($user["discord_username"] == "user#0000"){
                    $_SESSION['username'] = $username;
                    header("location: /oauth2");
                }
                else{
                    $_SESSION['username'] = $username;
                    header('location: /dashboard');
                }
            }
            else if ($twofa_status == "true")
            {
                $_SESSION['usernamesecret'] = $username;
                $_SESSION['uploads'] = $user['uploads'];
                $_SESSION['success'] = "<div class='card' <div class='card-body'> <br> <h3 class='card-text' style='color: green;'>You are Logged in!</h3> <br> </div> </div> <br>";
                header('location: /2fa/login');
            }
        }
        else
        {
            array_push($errors, "Wrong username/password combination");
        }
    }
}
?>
