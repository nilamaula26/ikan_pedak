<?php
require_once "database.php";

// Cek apakah user sudah login
if (!isset($_SESSION["pengguna"])) {
    header("Location: form-login.php"); // Redirect to login page
    exit(); // Don't forget the semicolon here
}?>
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
    <section class="login">
		<div class="login_box">
			<div class="left">
				<div class="contact">
                    <form action="" method="POST">
						<h3>LOG IN</h3>
						<input type="text" name="username" placeholder="USERNAME">
						<input type="password" name="password" id="password" placeholder="Password">
                        <button type="button" id="showPassword">Show Password</button>
                        <script>
                            const passwordInput = document.getElementById('password');
                            const showPasswordToggle = document.getElementById('showPassword');
                            showPasswordToggle.addEventListener('change', () => {
                                if (showPasswordToggle.checked) {
                                    passwordInput.type = 'text';
                                } else {
                                    passwordInput.type = 'password';
                                }
                            });
                        </script>
						<button type="submit" class="submit" name="login">LOG IN</button>
					</form>
                </div>
				</div>
			</div>
			<div class="right">
				<div class="right-text">
					<h2>DATA WAJIB IPEDA</h2>
					<h5>DESA ROWOSARI</h5>
				</div>
				<div class="right-inductor"><img src="https://lh3.googleusercontent.com/fife/ABSRlIoGiXn2r0SBm7bjFHea6iCUOyY0N2SrvhNUT-orJfyGNRSMO2vfqar3R-xs5Z4xbeqYwrEMq2FXKGXm-l_H6QAlwCBk9uceKBfG-FjacfftM0WM_aoUC_oxRSXXYspQE3tCMHGvMBlb2K1NAdU6qWv3VAQAPdCo8VwTgdnyWv08CmeZ8hX_6Ty8FzetXYKnfXb0CTEFQOVF4p3R58LksVUd73FU6564OsrJt918LPEwqIPAPQ4dMgiH73sgLXnDndUDCdLSDHMSirr4uUaqbiWQq-X1SNdkh-3jzjhW4keeNt1TgQHSrzW3maYO3ryueQzYoMEhts8MP8HH5gs2NkCar9cr_guunglU7Zqaede4cLFhsCZWBLVHY4cKHgk8SzfH_0Rn3St2AQen9MaiT38L5QXsaq6zFMuGiT8M2Md50eS0JdRTdlWLJApbgAUqI3zltUXce-MaCrDtp_UiI6x3IR4fEZiCo0XDyoAesFjXZg9cIuSsLTiKkSAGzzledJU3crgSHjAIycQN2PH2_dBIa3ibAJLphqq6zLh0qiQn_dHh83ru2y7MgxRU85ithgjdIk3PgplREbW9_PLv5j9juYc1WXFNW9ML80UlTaC9D2rP3i80zESJJY56faKsA5GVCIFiUtc3EewSM_C0bkJSMiobIWiXFz7pMcadgZlweUdjBcjvaepHBe8wou0ZtDM9TKom0hs_nx_AKy0dnXGNWI1qftTjAg=w1920-h979-ft" alt=""></div>
			</div>
		</div>
    </section>
    <div class="container-fluid">
        <?php
        if (empty($_GET["page"])) {
            include "form-tampil.php";
        }
        ?>
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
