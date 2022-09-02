<?php
require("./../Option/GetCountry_Axaj.php");
$Country = Country($_COOKIE["Country"]);
$html = file_get_contents("./../../Code/UploadFile/".$Country.".html");
$html = str_replace("Not_Load_User",base64_decode(urldecode($_COOKIE['userID'])),$html);
echo $html;
?>