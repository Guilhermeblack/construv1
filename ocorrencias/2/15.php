<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_BancoEscola = "localhost";
$database_BancoEscola = "immob049_construcao";
$username_BancoEscola = "immob049_constru";
$password_BancoEscola = "si171156";
$BancoEscola = mysqli_connect($hostname_BancoEscola, $username_BancoEscola, $password_BancoEscola, $database_BancoEscola) or trigger_error(mysqli_error(),E_USER_ERROR); 
?>