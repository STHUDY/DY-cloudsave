<?php
$change_name = $_POST['FileChangeName'];
$filename = $_GET['File'];
if($change_name == $filename){
    die();
}
if($_GET['File'] == ".."){
    echo "<script>top.location.reload();</script>";
}
$userID = base64_decode(urldecode($_COOKIE['userID']));
$path = './../../User/'.$userID;
$now_path = base64_decode(urldecode($_COOKIE['Path']));
if($now_path != "/"){
    $path = $path.$now_path."/";
}else {
    $path = $path."/";
}
$paths = $path.$filename;
$path_change = $path.$change_name;
if(file_exists($path_change) == true){
    echo "<script>top.location.reload();</script>";
    die();
}
rename($paths,$path_change);
?>
