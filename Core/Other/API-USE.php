<?php
function API_USE($name){
    $API_USE = json_decode(file_get_contents("./../../Config/API-USE.json"),true);
    $result = $API_USE[$name];
    return $result;
}
?>