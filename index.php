<?php
require("./Core/Basics/ConnectSqlDatabase.php");
require("./Core/User/JudgeUerID.php");
require("./Core/Option/JudgeLanguage.php");
require("./Core/Basics/GetConfig.php");
require("./Core/Basics/GetAddress.php");
require("./Core/Option/GetLanguage.php");
require("./Core/Option/Load.php");
?>
<html 
    <head>
        <title><?php echo $Option_GetLanguage_Array["Language_Navber_Name"]; ?></title>
        <meta charset="utf-8">
        <meta name='description' content="DY云储存,你所用过的最好的网盘">
        <link rel="icon" href="./LZY.ico" type="image/x-icon">
        <link rel="shortcut icon" href="./LZY.ico" type="image/x-icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href='./Basics/CSS/BootStrap/bootstrap-icons.css' rel='stylesheet'>
        <link href='./Basics/CSS/BootStrap/bootstrap.min.css' rel='stylesheet'>
        <link href='./Basics/CSS/Self/basics.css' rel='stylesheet'>
        <script src='./Basics/JavaScript/BootStrap/bootstrap.min.js'></script>
        <script src='./Basics/JavaScript/Self/Basics.js'></script>
    </head>
    <body class='full-screen bg-white'>
        <?php
        echo $Finally_Page_data;
        ?>
    </body>
    <iframe src="" frameborder="0" name="form-submit" style='display:none'></iframe>
</html>