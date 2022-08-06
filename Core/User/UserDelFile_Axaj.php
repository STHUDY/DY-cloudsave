<?php
$userID = base64_decode(urldecode($_COOKIE['userID']));
$path = './../../User/'.$userID;
$now_path = base64_decode(urldecode($_COOKIE['Path']));
if($now_path != "/"){
    $path = $path.$now_path."/".$_GET['name'];
}else {
    $path = $path."/".$_GET['name'];
}
if(is_dir($path) == true){
    rmdir($path);
    die();
}
unlink($path);
?>