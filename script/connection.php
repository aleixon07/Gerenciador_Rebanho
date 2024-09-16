<?php

$servername = "localhost";
$username = "root";
$password = "";
$db_name = "eduarda";


$conn = mysqli_connect($servername, $username, $password,$db_name);

if(!$conn){
    die("Sem conexão com o banco");

}else{
    echo " ";
}


?>