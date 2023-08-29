<?php
session_start();
require_once("database.php");

if (isset($_POST['login'])) {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $sql = "SELECT * FROM pengguna WHERE username = :username";
    $stmt = $db->prepare($sql);

    // Bind parameter to the query
    $stmt->bindParam(":username", $username, PDO::PARAM_STR);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the user exists
    if ($user) {
        // Verify hashed password
        if (password_verify($password, $user["password"])) {
            // Create a session
            $_SESSION["pengguna"] = $user;
            
            if ($user['jabatan'] == "Carik") {
                // Set session variables for admin
                $_SESSION['username'] = $username;
                $_SESSION['jabatan'] = "Carik";
                // Redirect to admin dashboard
                header("location: halaman_admin.php");
                exit();
            } elseif ($user['jabatan'] !== "Carik"){
                // Redirect to user dashboard
                header("location: halaman_user.php");
                exit();
            }
        } else {
            // Redirect back to login page with an error message
            header("Location: form-login.php?error=invalid");
            exit();
        }
    } else {
        // Redirect back to login page with an error message
        header("Location: form-login.php?error=invalid");
        exit();
    }
}
?>
