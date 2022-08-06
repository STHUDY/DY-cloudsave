<?php
require("./../Other/API.php");
require("./../Option/GetLanguage_Axaj.php");

$UserID=$_POST['Load_UserID'];
$Password=$_POST['Load_Password'];

if($UserID == "" || $Password == ""){
    die();
}

$sql_info = json_decode(file_get_contents('./../../Config/basics.json'),true);
$con = mysqli_connect($sql_info['Sql_host'],$sql_info['Sql_username'],$sql_info['Sql_password'],$sql_info['Sql_dbname'],$sql_info['Sql_port'],);

if (mysqli_connect_errno()) {
    echo "<script>top.alert('".Language("error_database_connect_fail")."')</script>";
    die();
}

$sql_empty = "SELECT * FROM `User_Load_info` WHERE `userID` = '".$UserID."'";
$sql_empty_run = mysqli_query($con,$sql_empty);
$sql_empty_result = mysqli_fetch_array($sql_empty_run);

$api = array("string"=>"$Password","key"=>"$Password");
$Enc_password = json_decode(API("EncWord",true,$api),true);

if($sql_empty_result['userID'] == ""){
    echo "<script>top.alert('".Language("error_Load_userID")."')</script>";
    die();
}
if($Enc_password['data'] != $sql_empty_result['password']){
    echo "<script>top.alert('".Language("error_Load_userID")."')</script>";
    die();
}else {
    setcookie("userID",urlencode(base64_encode($UserID)),time() + 60*60*24*30,"/");
    echo "<script>top.alert('".Language("success_Load_userID")."');top.location.href='/main';</script>";
}
?>