<?php
require("./API.php");
require("./API-USE.php");
$type = $_GET['type'];
$result = "";
if($type == "HtmlCode"){
    $api = array("uic"=>API_USE("API-USE-UIC"),"length"=>"4","code_min"=>"24","code_max"=>"32");
    $result = API("HtmlCode",true,$api);
}

echo $result;
?>