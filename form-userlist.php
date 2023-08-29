<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION["user"])) {
    header("Location: form-login.php"); // Redirect to login page
    exit(); // Don't forget the semicolon here
}

// Check if the user has the "Carik" role
if ($_SESSION["user"]["jabatan"] !== "Carik") {
    header("Location: Index.php"); // Redirect to a suitable page for non-"Carik" users
    exit(); // Don't forget the semicolon here
}

require_once "database.php";

// Retrieve user data from the database
$sql = "SELECT id_user, username FROM pengguna";
$stmt = $db->query($sql);
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title, mt-3">Data Wajib Ipeda</h3>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "<td>{$no}</td>";
                            echo "<td>{$row['username']}</td>";
                            $passwordLength = strlen($row['password']);
                            $asterisks = str_repeat('*', $passwordLength);
                            echo "<td>{$asterisks}</td>"; // Display password as asterisks for security
                            echo "<td><a href='form-edituser.php?id={$row['id_user']}'>Edit</a> | <a href='delete-user.php?id={$row['id_user']}'>Delete</a></td>";
                            echo "</tr>";
                            $no++;
                        }
                    ?>
                </tbody>