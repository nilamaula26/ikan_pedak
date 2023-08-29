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
?>

<h2>Pendaftaran Pengguna Baru</h2>
    <form action="proses-registrasi.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="jabatan">Jabatan:</label>
        <select id="jabatan" name="jabatan" required>
            <option value="Carik">Carik</option>
            <option value="Kades">Kepala Desa</option>
            <option value="Perdes">Lainnya</option>
        </select><br><br>

        <button type="submit" name="register">Daftar</button>
    </form>