<?php
if(isset($_COOKIE['userID']) == false){
    die();
}
require("./../Option/GetLanguage_Axaj.php");
require("./../Option/GetCountry_Axaj.php");
$userID = $_COOKIE['userID'];
$path = './../../User/'.$userID;
$Country = Country($_COOKIE["Country"]);

if(is_dir($path) == false){
    die();
}
if($_COOKIE['devide'] == "app"){
    $html = file_get_contents("./../../Code/AppList/".$Country.".html");
}else{
    $html = file_get_contents("./../../Code/List/".$Country.".html");
}
$now_path = base64_decode(urldecode($_COOKIE['Path']));
$list = "";
if($now_path != "/"){
    $path = $path.$now_path."/";
    if(file_exists($path) == false){
        setcookie('Path',urlencode(base64_encode("/")),time() + 60*60*24*30,"/");
        return false;
    }
    $temp = str_replace("+User_File_List_Name+",'• •',$html);
    $temp = str_replace("+User_File_List_True_Name+","..",$temp);
    if($_COOKIE['devide'] == "app"){
        $temp = str_replace("+User_File_Time_Size+","返回",$temp);
    }else{
        $temp = str_replace("+User_File_Time_Size+","返回上一个文件夹",$temp);
    }
    $list = $temp;
    echo $list;
}else {
    $path = $path."/";
}


$arr = array();
$data = scandir($path);
foreach ($data as $value){
    if($value != '.' && $value != '..'){
        $file_path = $path.$value;
        $list = "";
        if(is_dir($file_path) == true){
            
            $temp = str_replace("+User_File_List_Name+",'<i class="bi bi-folder"></i> '.$value,$html);
            $temp = str_replace("+User_File_List_True_Name+",$value,$temp);
            $temp = str_replace("+User_File_List_NO_ICON_Name+",$value,$temp);
            if($_COOKIE['devide'] == "app"){
                $temp = str_replace("+User_File_Time_Size+","",$temp);
            }else {
                $temp = str_replace("+User_File_Time_Size+",date("Y-m-d H:i",filectime($file_path)),$temp);
            }
            $list = $temp;
            echo $list;
        }
    }
}

foreach ($data as $value){
    if($value != '.' && $value != '..'){
        $file_path = $path.$value;
        $list = "";
        if(is_file($file_path) == true){
            $File_extension = pathinfo($file_path)['extension'];
            if(judeg_extension($File_extension) == true){
                $temp = str_replace("+User_File_List_Name+",load_icon($File_extension)." ".$value,$html);
                $temp = str_replace("+User_File_List_True_Name+",$value,$temp);
                $temp = str_replace("+User_File_List_NO_ICON_Name+",$value,$temp);
                if($_COOKIE['devide'] == "app"){
                    $temp = str_replace("+User_File_Time_Size+",get_file_size($file_path),$temp);
                }else {
                    $temp = str_replace("+User_File_Time_Size+",date("Y-m-d H:i",filectime($file_path))." | ".get_file_size($file_path),$temp);
                }
                $list = $temp;
                echo $list;
            }
        }
    }
}

function load_icon($type){
    if($type == "zip"){
        $html_icon = '<i class="bi bi-file-earmark-zip"></i>';
    }else if($type == "gz"){
        $html_icon = '<i class="bi bi-file-earmark-zip"></i>';
    }else if($type == "ini"){
        $html_icon = '<i class="bi bi-file-earmark-ruled"></i>';
    }else if($type == "php"){
        $html_icon = '<i class="bi bi-filetype-php"></i>';
    }else if($type == "png"){
        $html_icon = '<i class="bi bi-file-earmark-image"></i>';
    }else if($type == "jpg"){
        $html_icon = '<i class="bi bi-file-earmark-image"></i>';
    }else if($type == "jfif"){
        $html_icon = '<i class="bi bi-file-earmark-image"></i>';
    }else if($type == "jpeg"){
        $html_icon = '<i class="bi bi-file-earmark-image"></i>';
    }else if($type == "exe"){
        $html_icon = '<i class="bi bi-filetype-exe"></i>';
    }else if($type == "mp4"){
        $html_icon = '<i class="bi bi-file-earmark-play"></i>';
    }else if($type == "MOV"){
        $html_icon = '<i class="bi bi-file-earmark-play"></i>';
    }else if($type == "mov"){
        $html_icon = '<i class="bi bi-file-earmark-play"></i>';
    }else if($type == "mp3"){
        $html_icon = '<i class="bi bi-file-earmark-music"></i>';
    }else if($type == "m4a"){
        $html_icon = '<i class="bi bi-file-earmark-music"></i>';
    }else if($type == "ogg"){
        $html_icon = '<i class="bi bi-file-earmark-music"></i>';
    }else if($type == "flac"){
        $html_icon = '<i class="bi bi-file-earmark-music"></i>';
    }else if($type == "txt"){
        $html_icon = '<i class="bi bi-filetype-txt"></i>';
    }else if($type == "lrc"){
        $html_icon = '<i class="bi bi-file-earmark-text"></i>';
    }else if($type == "jar"){
        $html_icon = '<i class="bi bi-filetype-java"></i>';
    }else if($type == "java"){
        $html_icon = '<i class="bi bi-filetype-java"></i>';
    }else if($type == "class"){
        $html_icon = '<i class="bi bi-filetype-java"></i>';
    }else if($type == "pdf"){
        $html_icon = '<i class="bi bi-filetype-pdf"></i>';
    }else {
        $html_icon = '<i class="bi bi-file-earmark"></i>';
    }
    return $html_icon;
}

function judeg_extension($File_extension){
    if(egaugnaL($_COOKIE['option']) == "User_FIle_Photo_Link"){
        switch ($File_extension){
            case "png":
                return true;
            case "jpg":
                return true;
            case "jpeg":
                return true;
            case "gif":
                return true;
            case "jfif":
                return true;
            default:
                return false;
        }
    }else if(egaugnaL($_COOKIE['option']) == "User_FIle_Video_Link"){
        switch ($File_extension){
            case "mp4":
                return true;
            case "mov":
                return true;
            case "MOV":
                return true;
            default:
                return false;
        }
    }else if(egaugnaL($_COOKIE['option']) == "User_FIle_Music_Link"){
        switch ($File_extension){
            case "mp3":
                return true;
            case "flac":
                return true;
            case "ogg":
                return true;
            case "m4a":
                return true;
            default:
                return false;
        }
    }else if(egaugnaL($_COOKIE['option']) == "User_FIle_Other_Link"){
        if($File_extension == "mp3"){
            return false;
        }else if($File_extension == "flac"){
            return false;
        }else if($File_extension == "ogg"){
            return false;
        }else if($File_extension == "mp4"){
            return false;
        }else if($File_extension == "mov"){
            return false;
        }else if($File_extension == "png"){
            return false;
        }else if($File_extension == "jpg"){
            return false;
        }else if($File_extension == "jpeg"){
            return false;
        }else if($File_extension == "gif"){
            return false;
        }else if($File_extension == "m4a"){
            return false;
        }
        return true;
    }else {
        return true;
    }
}

function get_file_size($paths){
    $size = filesize($paths);
    if($size >= 1073741824){
        $result = strval(round($size/1073741824*100)/100). 'GB';
    }else if($size >= 1048576){
        $result = strval(round($size/1048576*100)/100). 'MB';
    }else if($size >= 1024){
        $result = strval(round($size/1024*100)/100). 'KB';
    }else {
        $result = strval($size).'B';
    }
    return $result;
}
?>