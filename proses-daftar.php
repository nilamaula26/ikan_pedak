<?php
require_once("database.php");

if(isset($_POST['register'])){
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $jabatan = $_POST['jabatan'];

    $sql = "INSERT INTO pengguna (username, password, jabatan) VALUES (:username, :password, :jabatan)";
    $stmt = $db->prepare($sql);

    $params = array(
        ":username" => $username,
        ":password" => $password,
        ":jabatan" => $jabatan
    );

    if($stmt->execute($params)){
        // Registrasi sukses, alihkan ke halaman login atau halaman lain yang sesuai
        header("Location: form-userlist.php");
        exit();
    } else {
        // Registrasi gagal, tampilkan pesan error atau alihkan kembali ke halaman registrasi
        header("Location: form-registrasi.php?error=registration_failed");
        exit();
    }
}
?>
