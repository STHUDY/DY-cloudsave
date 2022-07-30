<?php
if(isset($_COOKIE['userID']) == false){
    $Option_JudgeLanguage_Reflush = false;
    if(isset($_COOKIE['Language']) == false){
        setcookie("Language","JXU3QjgwJXU0RjUzJXU0RTJEJXU2NTg3",time() + 60*60*24*30,'/');
        $Option_JudgeLanguage_Reflush = true;
    }
    if(isset($_COOKIE['Country']) == false){
        setcookie("Country","JXU3QjgwJXU0RjUzJXU0RTJEJXU2NTg3",time() + 60*60*24*30,'/');
        $Option_JudgeLanguage_Reflush = true;
    }
    if($Option_JudgeLanguage_Reflush == true){
        error_reporting(0);
        sleep(1);
        header("Refresh:0");
    }
}
?>