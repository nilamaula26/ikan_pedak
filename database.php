<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "dataipeda";
$db = mysqli_connect($server, $username, $password, $database);

if(!$db){
    die('Koneksi database gagal : ' .mysqli_connect_error());
}?>