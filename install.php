<?php
$host = "";
$username = "";
$password = "";
$dbname = "";
$port = "";
$API_USE_user = "";
$API_USE_uic = "";
if(isset($_GET["host"]) == false){
    
    echo '<h1>数据库设置:</h1><span>地址(host):</span><input type="text" id="host" value="localhost" /><br>';
}else {
    $host = $_GET["host"];
}
if(isset($_GET["username"]) == false){
    echo '<span>用户(username):</span><input type="text" id="username" /><br>';
}else {
    $username = $_GET["username"];
}
if(isset($_GET["password"]) == false){
    echo '<span>密码(password):</span><input type="text" id="password" /><br>';
}else {
    $password = $_GET["password"];
}
if(isset($_GET["dbname"]) == false){
    echo '<span>库名(dbname):</span><input type="text" id="dbname" /><br>';
}else {
    $dbname = $_GET["dbname"];
}
if(isset($_GET["port"]) == false){
    echo '<span>端口(port):</span><input type="text" id="port" value="888"/>';

}else {
    $port = $_GET["port"];
}
if(isset($_GET["API_USE_user"]) == false){
    echo '<h1>API-USE:</h1><span>API-USE账号(user):</span><input type="text" id="API-USE-user" value="pneumonoultramicroscopicsilicovo" /><br>';
}else {
    $API_USE_user = $_GET["API_USE_user"];
}
if(isset($_GET["API_USE_uic"]) == false){
    echo '<span>API-USE身份识别码(uic):</span><input type="text" id="API-USE-uic" value="101655625233194" /><br><br><button onclick="install()">安装</button>';
}else {
    $API_USE_uic = $_GET["API_USE_uic"];
}
$data = array("Sql_host"=>$host,"Sql_username"=>$username,"Sql_password"=>$password,"Sql_dbname"=>$dbname,"Sql_port"=>$port);

$API_USE = array("API-USE-NAME"=>$API_USE_user,"API-USE-UIC"=>$API_USE_uic);

file_put_contents("./Config/basics.json",json_encode($data));
file_put_contents("./Config/API-USE.json",json_encode($API_USE));

?>
<html>
    <head>
        <meta charset="utf-8">
        <title>安装文件</title>
        <script>
            function install(){
                address = "./install.php?host="+document.getElementById("host").value+"&username="+document.getElementById("username").value+"&password="+document.getElementById("password").value+"&dbname="+document.getElementById("dbname").value+"&port="+document.getElementById("port").value+"&API_USE_user="+document.getElementById("API-USE-user").value+"&API_USE_uic="+document.getElementById("API-USE-uic").value
                window.location.href=address
            }
        </script>
    </head>
    <body>
    </body>
</html>