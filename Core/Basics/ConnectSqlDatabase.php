<?php
$Basics_ConncetSqlDataBase_Get_info = json_decode(file_get_contents('./Config/basics.json'),true);
$Basics_ConncetSqlDataBase = mysqli_connect($Basics_ConncetSqlDataBase_Get_info['Sql_host'],$Basics_ConncetSqlDataBase_Get_info['Sql_username'],$Basics_ConncetSqlDataBase_Get_info['Sql_password'],$Basics_ConncetSqlDataBase_Get_info['Sql_dbname'],$Basics_ConncetSqlDataBase_Get_info['Sql_port']);
?>