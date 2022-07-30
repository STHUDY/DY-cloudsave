<?php
$userID = $_COOKIE['userID'];
$path = './../../User/'.$userID;
$now_path = base64_decode(urldecode($_COOKIE['Path']));
if($now_path != "/"){
    $path = $path.$now_path."/";
}else {
    $path = $path."/";
}
$file = $path.$_GET['file'];
$filename = $_GET['file'];
if(is_dir($file) == true){
    echo "<script type='text/javascript'>document.onload = window.close();</script>";
    die();
}
header("Content-type: application/octet-stream");

//处理中文文件名
$ua = $_SERVER["HTTP_USER_AGENT"];
$encoded_filename = rawurlencode($filename);
if (preg_match("/MSIE/", $ua)) {
header('Content-Disposition: attachment; filename="' . $encoded_filename . '"');
} else if (preg_match("/Firefox/", $ua)) {
header("Content-Disposition: attachment; filename*=\"utf8''" . $filename . '"');
} else {
header('Content-Disposition: attachment; filename="' . $filename . '"');
}

header("Content-Length: ". filesize($file));
readfile($file);

?>