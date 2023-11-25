<?php
$servidor= "mysql:dbname=empresa2;host=127.0.0.1";
$user= "root";
$password="";
try{
$conexion=new PDO($servidor, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES UTF8"));
echo "conexion exitosa";
}catch(PDOException $e){
    echo "error de conexion".$e-> getMessage();
}

?>