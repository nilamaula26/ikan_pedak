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
            <option value="Kades" <?php if ($userData['jabatan'] === 'Perdes') echo 'selected'; ?>>Lainnya</option>
        </select>
        <label for="new_password">Password:</label>
        <input type="password" id="new_password" name="new_password" value="
        <br>
        <button type="submit" name="submit">Simpan Perubahan</button>
    </form>