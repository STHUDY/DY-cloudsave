<?php
$userID = base64_decode(urldecode($_COOKIE['userID']));
$path = './../../User/'.$userID;
$now_path = base64_decode(urldecode($_COOKIE['Path']));
if($now_path != "/"){
    $path = $path.$now_path."/";
    if(file_exists($path) == false){
        setcookie('Path',urlencode(base64_encode("/")),time() + 60*60*24*30,"/");
        echo '<script>top.alert("文件夹位置不存在，刷新后重试");top.location.reload()</script>';
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
if(getMatchResult($_FILES["file"]["name"]) == true){
    echo "<script>top.alert('上传失败,文件中含有特殊字符,请更改文件名后重试');top.location.reload()</script>";
    die();
}
if(file_exists($path.$_FILES["file"]["name"]) == true){
    unlink($path.$_FILES["file"]["name"]);
}

function getMatchResult($str){
	$res = preg_match(':：,，。…\/、~`＠＃￥％＆×＋｜｛｝＝－＊＾＄～｀!@#$%^&*()\+-—=（）！￥{}【】\[\]\|\"\'’‘“”；;\?\？\·]/u', $str);
	return $res ? TRUE : FALSE;
}



move_uploaded_file($_FILES["file"]["tmp_name"],$path . $_FILES["file"]["name"]);
echo '<script>top.location.reload()</script>';
?>