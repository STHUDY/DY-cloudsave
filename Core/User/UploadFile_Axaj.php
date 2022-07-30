<?php
require("./../Option/GetCountry_Axaj.php");
$Country = Country($_COOKIE["Country"]);
$html = file_get_contents("./../../Code/UploadFile/".$Country.".html");
echo $html;
?>