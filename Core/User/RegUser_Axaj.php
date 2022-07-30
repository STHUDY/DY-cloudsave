<?php
require("./../Other/API.php");
require("./../Option/GetLanguage_Axaj.php");

$UserID=$_POST['Reg_UserID'];
$Password=$_POST['Reg_Password'];

if($UserID == "" || $Password == ""){
    die();
}

if(strlen($UserID) > 16){
    echo "<script>top.alert('".Language("error_REG_userID_fail")."')</script>";
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

if($sql_empty_result['userID'] != ""){
    echo "<script>top.alert('".Language("error_REG_userID_repeat")."')</script>";
    die();
}

$api = array("string"=>"$Password","key"=>"$Password");
$Enc_password = json_decode(API("EncWord",true,$api),true);
$sql = "INSERT INTO `User_Load_info` (`userID`, `password`, `Time`) VALUES ('".$UserID."', '".$Enc_password['data']."', DATE_FORMAT(now(),'%Y-%m-%d'))";

mysqli_query($con,$sql);

$sql_empty_run = mysqli_query($con,$sql_empty);
$sql_empty_result = mysqli_fetch_array($sql_empty_run);

if($sql_empty_result['userID'] != ""){
    setcookie("userID",$UserID,time() + 60*60*24*30,"/");
    echo "<script>top.alert('".Language("success_REG_userID")."');top.location.href='/main';</script>";
}else {
    echo "<script>top.alert('".Language("error_REG_userID_fail_two")."')</script>";
}
?>