<?php
$User_Judge_Result = true;
if(isset($_COOKIE['userID']) == true){
    $User_Judge_sql = "SELECT * FROM `User_Load_info` WHERE `userID` = '".base64_decode(urldecode($_COOKIE['userID']))."'";
    $User_Judge_sql_run = mysqli_query($Basics_ConncetSqlDataBase,$User_Judge_sql);
    $User_Judge_sql_result = mysqli_fetch_array($User_Judge_sql_run);
    if($User_Judge_sql_result['userID'] == ""){
        setcookie('userID',"",time() - 1,"/");
        $User_Judge_Result = false;
    }
}else{
    $User_Judge_Result = false;
}
?>