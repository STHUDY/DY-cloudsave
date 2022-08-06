<?php
function Country($value){
    $language = json_decode(file_get_contents("./../../Config/config.json"),true);
    $result = $language[$_COOKIE['Country']];
    return $result;
}
?>