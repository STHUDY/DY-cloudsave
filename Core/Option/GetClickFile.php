<?php
$filename = $_GET['File'];
$userID = $_COOKIE['userID'];
$path = './../../User/'.$userID."/";
$now_path = base64_decode(urldecode($_COOKIE['Path']));
if($now_path != "/"){
    $path = $path.$now_path."/";
}else {
    $path = $path."/";
}
$file_path = $path.$filename;

$File_extension = pathinfo($file_path)['extension'];
if($File_extension == "mp4" || $File_extension == "mov" || $File_extension == "MOV"){
    echo GetFile($file_path,$File_extension,"video");
}

if($File_extension == "jpg" || $File_extension == "jfif" || $File_extension == "jpeg" || $File_extension == "png"){
    echo file_get_contents($file_path);
}

if($File_extension == "m4a" || $File_extension == "mp3" || $File_extension == "ogg"){
    echo GetFile($file_path,$File_extension,"music");
}

function GetFile($file,$File_extension,$Music) { 
    $size = filesize($file); 
    header("Content-type: ".$Music."/".$File_extension); 
    header("Accept-Ranges: bytes"); 
    if(isset($_SERVER['HTTP_RANGE'])){ 
        header("HTTP/1.1 206 Partial Content"); 
        list($name, $range) = explode("=", $_SERVER['HTTP_RANGE']); 
        list($begin, $end) =explode("-", $range); 
        if($end == 0){ 
            $end = $size - 1; 
        } 
    }else { 
        $begin = 0; $end = $size - 1; 
    } 
    header("Content-Length: " . ($end - $begin + 1)); 
    header("Content-Disposition: filename=".basename($file)); 
    header("Content-Range: bytes ".$begin."-".$end."/".$size); 
    $fp = fopen($file, 'rb'); 
    fseek($fp, $begin); 
    while(!feof($fp)) { 
        $p = min(1024, $end - $begin + 1); 
        $begin += $p; 
        echo fread($fp, $p); 
    } 
    fclose($fp); 
} 
?>