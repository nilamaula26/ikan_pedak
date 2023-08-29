<?php
session_start();

require_once("database.php");

// Check if user is logged in
if (!isset($_SESSION["user"])) {
    header("Location: form-login.php");
    exit();
}

// Check if user has the necessary privileges (admin)
if ($_SESSION["user"]["jabatan"] !== "Carik") {
    header("Location: form-userlist.php"); // Redirect to appropriate page
    exit();
}

// Check if user ID is provided in the URL
if (!isset($_GET["id"])) {
    header("Location: form-userlist.php"); // Redirect back to user list
    exit();
}

// Get user ID from the URL
$userID = $_GET["id"];

// Check if user data exists
$sql = "SELECT * FROM pengguna WHERE id_user = :id_user";
$stmt = $db->prepare($sql);
$stmt->bindParam(":id_user", $userID, PDO::PARAM_INT);
$stmt->execute();
$userData = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if user data exists
if (!$userData) {
    header("Location: userlist.php"); // Redirect back to user list
    exit();
}

// Process form submission
if (isset($_POST["submit"])) {
    $newUsername = filter_input(INPUT_POST, "new_username", FILTER_SANITIZE_STRING);
    $newJabatan = filter_input(INPUT_POST, "new_jabatan", FILTER_SANITIZE_STRING);
    $newPassword = filter_input(INPUT_POST, "new_password", FILTER_SANITIZE_STRING);

    // Update user data in the database
    $updateSql = "UPDATE pengguna SET username = :username, jabatan = :jabatan WHERE id_user = :id_user";
    $updateStmt = $db->prepare($updateSql);
    $updateStmt->bindParam(":username", $newUsername, PDO::PARAM_STR);
    $updateStmt->bindParam(":jabatan", $newJabatan, PDO::PARAM_STR);
    // Hash password
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    $updateStmt->bindParam(":password", $hashedPassword, PDO::PARAM_STR);
    
    $updateStmt->bindParam(":id_user", $userID, PDO::PARAM_INT);

    if ($updateStmt->execute()) {
        header("Location: userlist.php"); // Redirect back to user list after successful update
        exit();
    } else {
        $error = "Failed to update user data.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <!-- Include your CSS and other head content here -->
</head>
<body>
    <h1>Edit User</h1>
    
    <?php if (isset($error)) { ?>
        <p>Error: <?php echo $error; ?></p>
    <?php } ?>

    <form action="" method="post">
        <label for="new_username">Username:</label>
        <input type="text" id="new_username" name="new_username" value="<?php echo $userData['username']; ?>">
        <br>
        <label for="new_jabatan">Jabatan:</label>
        <select id="new_jabatan" name="new_jabatan">
            <option value="Carik" <?php if ($userData['jabatan'] === 'Carik') echo 'selected'; ?>>Carik</option>
            <option value="Kades" <?php if ($userData['jabatan'] === 'Kades') echo 'selected'; ?>>Kades</option>
        </select>
        <br>
        <button type="submit" name="submit">Simpan Perubahan</button>
    </form>
    
    <!-- Include your footer content here -->
</body>
</html>
