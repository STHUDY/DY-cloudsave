<?php
$userID = $_COOKIE['userID'];
$path = './../../User/'.$userID;
$now_path = base64_decode(urldecode($_COOKIE['Path']));
if($now_path != "/"){
    $path = $path.$now_path."/";
}else {
    $path = $path."/";
}
if(is_dir($path) == false){
    mkdir($path);
    die();
}
if(file_exists($path.$_FILES["file"]["name"]) == true){
    unlink($path.$_FILES["file"]["name"]);
}

move_uploaded_file($_FILES["file"]["tmp_name"],$path . $_FILES["file"]["name"]);
echo '<script>top.location.reload()</script>'
?>