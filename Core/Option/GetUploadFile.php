<?php
$userID = base64_decode(urldecode($_COOKIE['userID']));
$path = './../../User/'.$userID;
$now_path = base64_decode(urldecode($_COOKIE['Path']));
if($now_path != "/"){
    $path = $path.$now_path."/";
    if(file_exists($path) == false){
        setcookie('Path',urlencode(base64_encode("/")),time() + 60*60*24*30,"/");
        return false;
    }
}else {
    $path = $path."/";
}
if(isset($_FILES["file"]) == false){
    die();
}
if(is_dir($path) == false){
    mkdir($path);
    die();
}
if(file_exists($path.$_FILES["file"]["name"]) == true){
    die();
}
if(is_uploaded_file($_FILES["file"]["tmp_name"])){
    move_uploaded_file($_FILES["file"]["tmp_name"],$path . $_FILES["file"]["name"]);
}
?>