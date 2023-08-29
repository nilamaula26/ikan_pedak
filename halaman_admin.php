<?php
require_once "database.php";

// Cek apakah user sudah login
if (!isset($_SESSION["pengguna"])) {
    header("Location: form-login.php"); // Redirect to login page
    exit(); // Don't forget the semicolon here
}

// Check if the user has the "Carik" role
if ($_SESSION["pengguna"]["jabatan"] !== "Carik") {
    header("Location: Index.php"); // Redirect to a suitable page for non-"Carik" users
    exit(); // Don't forget the semicolon here
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Wajib Ipeda</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script>
        function getkey(e) {
            if (window.event) return window.event.keyCode;
            else if (e) return e.which;
            else return null;
        }
        function goodchars(e, goods, field) {
            var key = getkey(e);
            if (key == null) return true;
            var keychar = String.fromCharCode(key).toLowerCase();
            return goods.toLowerCase().indexOf(keychar) != -1;
        }
    </script>
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="Dashboard.php">
                    <i class="glyphicon glyphicon-check"></i>
                </a>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
    <?php
    if (empty($_GET["page"])) {
        include "form-tampil.php";
    } elseif ($_GET['page'] == 'tambah') {
        include "form-tambah.php";
    } elseif ($_GET['page'] == 'ubah') {
        include "form-ubah.php";
    } elseif ($_GET['page'] == 'userlist'){
        include "form-userlist.php";
    } elseif ($_GET['page'] == 'registrasi'){
        include "form-registrasi.php";
    }?>
    </div>
    <footer class="footer bg-light">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 py-4">
                    <p class="text-muted pull-left">&copy; 2023 Kelompok 18 KKN 2 ITS NU Pekalongan</p>
                    <p class="text-muted pull-right">Theme by <a href="http://www.getbootstrap.com" target="_blank">bootstrap</a></p>
                </div>
            </div>
        </div>
    </footer>
    <script src="assets/js/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script>
        $(function(){
            $('.date-picker').datepicker({
                autoclose: true,
                todayHighlight: true
            });
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</body>
</html>
