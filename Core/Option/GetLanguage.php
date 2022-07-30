<?php
$Option_GetLanguage_Array = json_decode(file_get_contents("./Config/Language/".$Basics_GetConfig_Array[$_COOKIE['Language']].".json"),true);
$Option_GetLanguage_YarrA = array_flip($Option_GetLanguage_Array);
?>