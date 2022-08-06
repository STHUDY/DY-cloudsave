<?php
require("./../Option/GetLanguage_Axaj.php");
$userID = base64_decode(urldecode($_COOKIE['userID']));
$path = './../../User/'.$userID;
$now_path = base64_decode(urldecode($_COOKIE['Path']));
if($now_path != "/"){
    $path = $path.$now_path."/";
}else {
    $path = $path."/";
}
$file_path = $path.Language("User_Main_Create_Folder");
if(is_dir($path) == false){
    mkdir($path);
}
if(is_dir($file_path) == false){
    mkdir($file_path);
}
?>