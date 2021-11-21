<?php
function secureImage($path){
    $minetype = mime_content_type($path);
    header('Content-Type: ' . $minetype);
    readfile($path);
}
?>