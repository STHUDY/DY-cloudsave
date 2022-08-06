<?php
function Language($value){
    $language = json_decode(file_get_contents("./../../Config/config.json"),true);
    $language_file_name = $language[$_COOKIE['Language']];
    $language_value = json_decode(file_get_contents("./../../Config/Language/".$language_file_name.".json"),true);
    $result = $language_value[$value];
    return $result;
}
function egaugnaL($value){
    $language = json_decode(file_get_contents("./../../Config/config.json"),true);
    $language_file_name = $language[$_COOKIE['Language']];
    $language_value = array_flip(json_decode(file_get_contents("./../../Config/Language/".$language_file_name.".json"),true));
    $result = $language_value[$value];
    return $result;
}
?>