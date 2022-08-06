<?php
require("./../Option/GetCountry_Axaj.php");
$Country = Country($_COOKIE["Country"]);
$userID = base64_decode(urldecode($_COOKIE['userID']));
$path = './../../User/'.$userID."/";
$now_path = base64_decode(urldecode($_COOKIE['Path']));
if($now_path != "/"){
    $path = $path.$now_path."/";
}else {
    $path = $path."/";
}
$file_path = $path.$_GET['File'];
$file_paths = str_replace('./../../User/'.$userID."/","",$file_path);
if(is_dir($file_path) == true){
    $folder = "";
    if(base64_decode(urldecode($_COOKIE['Path'])) == "/" ){
        $folder = base64_decode(urldecode($_COOKIE['Path'])).$_GET['File'];
    }else {
        $folder = base64_decode(urldecode($_COOKIE['Path']))."/".$_GET['File'];
    }
    if($_GET['File'] == ".."){
        
        $folder = substr(base64_decode(urldecode($_COOKIE['Path'])),0,strrpos(base64_decode(urldecode($_COOKIE['Path'])), '/'));
    }
    setcookie('Path',urlencode(base64_encode($folder)),time() + 60*60*24*30,"/");
    echo "reflush";
    die();
}
$File_extension = pathinfo($file_path)['extension'];
$html = "";
$temp = "";
if($File_extension == "mp4" || $File_extension == "mov" || $File_extension == "MOV"){
    $html = file_get_contents("./../../Code/UserVideo/".$Country.".html");
    $temp = str_replace("+VideoNAMESHOW+",$file_paths,$html);
    $temp = str_replace("+VideoAddressSHOW+","./Core/Option/GetClickFile.php?File=".$_GET['File'],$temp);
}

if($File_extension == "jpg" || $File_extension == "jfif" || $File_extension == "jpeg" || $File_extension == "png" || $File_extension == "gif" || $File_extension == "svg" || $File_extension == "wbep"){
    $html = file_get_contents("./../../Code/UserImg/".$Country.".html");
    $temp = str_replace("SHOWPHOTOWHACT",$file_paths,$html);
    $temp = str_replace("+PHOTOAddressSHOW+","./Core/Option/GetClickFile.php?File=".$_GET['File'],$temp);
}

if($File_extension == "m4a" ||  $File_extension == "mp3" || $File_extension == "ogg"){
    $html = file_get_contents("./../../Code/UserMusic/".$Country.".html");
    $temp = str_replace("+MUSICNAMESHOW+",$file_paths,$html);
    $temp = str_replace("+MUSICAddressSHOW+","./Core/Option/GetClickFile.php?File=".$_GET['File'],$temp);
}

$result = $temp;
echo $result;
?>