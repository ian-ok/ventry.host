<?php
$oldurl = $_POST['oldurl']; 
$newurl = $_POST['newurl'];
$ip = $_SERVER['REMOTE_ADDR'];
  $hookObject = json_encode([
    /*
     * The username shown in the message
     */
    "username" => "M. Hills URL Shortener",
    /*
     * The image location for the senders image
     */
    "avatar_url" => "https://www.mhills.de/images/mhills.de.png",
    /*
     * Whether or not to read the message in Text-to-speech
     */
    "tts" => false,
    /*
     * File contents to send to upload a file
     */
    // "file" => "",
    /*
     * An array of Embeds
     */
    "embeds" => [
        /*
         * Our first embed
         */
        [
            // Set the title for your embed
            "title" => "Marc URL Shortener | Logs",

            // The type of your embed, will ALWAYS be "rich"
            "type" => "rich",

            // A description for your embed
            "description" => "",

            // The URL of where your title will be a link to
            "url" => "https://www.mhills.de/",

            // The integer color to be used on the left side of the embed
            "color" => hexdec("#ffa500"),

            // Field array of objects
            "fields" => [
                [
                    "name" => "Original URL",
                    "value" => "`$oldurl`",
                    "inline" => false
                ],
                [
                    "name" => "Short URL",
                    "value" => "`$newurl`",
                    "inline" => false
                ],  

                [
                    "name" => "IP",
                    "value" => "`$ip`",
                    "inline" => false
                ],

            ]
        ]
    ]

  ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
  $url = "https://discord.com/api/webhooks/832386243353640971/EZFllveqisKD59vvGxdZ2d7t_7q2dfz341qbS9sNIhpSIegxv-PGzdabtt7b5UU1wcJf";
  
  $ch = curl_init();
  curl_setopt_array( $ch, [
      CURLOPT_URL => $url,
      CURLOPT_POST => true,
      CURLOPT_POSTFIELDS => $hookObject,
      CURLOPT_HTTPHEADER => [
          "Content-Type: application/json"
      ]
  ]);
  curl_exec($ch);
 ?>