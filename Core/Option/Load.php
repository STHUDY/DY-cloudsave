<?php
$Option_Load_connect_path = str_replace('/',"",$_SERVER["REQUEST_URI"]);

if($Option_Load_connect_path == ""){
    if($User_Judge_Result == true){
        $Option_Load_connect_path = "main";
    }else {
        $Option_Load_connect_path = "Home";
    }
}else if($Option_Load_connect_path == "index.html"){
    if($User_Judge_Result == true){
        $Option_Load_connect_path = "main";
    }else {
        $Option_Load_connect_path = "Home";
    }
}else if($Option_Load_connect_path == "index.php"){
    if($User_Judge_Result == true){
        $Option_Load_connect_path = "main";
    }else {
        $Option_Load_connect_path = "Home";
    }
}else if($Option_Load_connect_path == "index"){
    if($User_Judge_Result == true){
        $Option_Load_connect_path = "main";
    }else {
        $Option_Load_connect_path = "Home";
    }
}else if($Option_Load_connect_path == "main"){
    if($User_Judge_Result == false){
        $Option_Load_connect_path = "Home";
    }
}else if($Option_Load_connect_path == "load"){
    if($User_Judge_Result == true){
        $Option_Load_connect_path = "main";
    }
}else if($Option_Load_connect_path == "reg"){
    if($User_Judge_Result == true){
        $Option_Load_connect_path = "main";
    }
}

if (isset($Basics_GetAddrass_Array[$Option_Load_connect_path]) == false) {
    $Option_Load_connect_path = 'error';
}
if($Core_Basics_JudgeDevice_Result == true && $Option_Load_connect_path == "main"){
    $Option_Load_connect_path = "app";
    setcookie("device","app",time() + 60*60*24*30,"/");
}else {
    setcookie("device","desktop",time() + 60*60*24*30,"/");
}

$Option_Load_TEXT = file_get_contents($Basics_GetAddrass_Array[$Option_Load_connect_path]);
$Option_Load_Result = $Option_Load_TEXT;

if($User_Judge_Result == true){
    if(isset($_COOKIE['Path']) == false){
        setcookie('Path',urlencode(base64_encode("/")),time() + 60*60*24*30);
        $Option_Load_Result = str_replace("User_Now_Folder","/",$Option_Load_Result);
    }else {
        $Option_Load_Result = str_replace("User_Now_Folder",base64_decode(urldecode($_COOKIE['Path'])),$Option_Load_Result);
    }
    
}


foreach ($Option_GetLanguage_Array as $Option_Load_Value){
    if($User_Judge_Result == true && $Option_GetLanguage_YarrA[$Option_Load_Value] == "Not_Load_User"){
        $Option_Load_Result = str_replace("Not_Load_User",base64_decode(urldecode($_COOKIE['userID'])),$Option_Load_Result);
        continue;
    }
    $Option_Load_Result = str_replace($Option_GetLanguage_YarrA[$Option_Load_Value],$Option_Load_Value,$Option_Load_Result);
}



$Finally_Page_data = $Option_Load_Result;
?>