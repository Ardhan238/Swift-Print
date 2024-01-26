<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Swift Print</title>
    <link rel="icon" href="img/logo.png" type="image/x-icon">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
</head>
<?php

session_start();
include 'functions.php';

// cek apakah form telah disubmit
if (isset($_POST['login'])) {
    // mengambil data dari form login
    $username = $_POST["username"];
    $password = $_POST["password"];

    // melindungi dari SQL injection
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'")) < 1) {
        echo "
            <script>
                alert('Username/Password Salah!');
                window.location.href='login.php';
            </script>
        ";
        exit;
    }

    // mencari user di database
    $sql = "SELECT * FROM user WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    // verifikasi password
    if (password_verify($password, $user['password'])) {
        if ($user['level'] == 1) {
            $_SESSION["admin"] = true;
            $_SESSION["username"] = $username;
            $_SESSION['id_user'] = $user['id_user'];
            header("Location: admin");
            exit();
        } else if ($user['level'] == 2) {
            $_SESSION["user"] = true;
            $_SESSION["username"] = $username;
            $_SESSION['id_user'] = $user['id_user'];
            header("Location: user");
            exit();
        }
    } else {
        // jika password salah, tampilkan pesan error
        $error = "Username atau password salah";
    }
}
?>

<body>

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center my-5">
            <div class="col-xl-10 col-lg-12 col-md-9 col-sm-12">
                <h4 class="mt-5 text-center">Swift Print - Login</h4>
                <div class="card o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col">
                                <div class="p-2">
                                    <form class="user" method="POST" action="">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="username" placeholder="Masukkan Username" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="password" placeholder="Masukkan Password" required>
                                        </div>
                                        <button type="submit" name="login" class="btn btn-primary btn-block">
                                            Login
                                        </button>
                                    </form>
                                    <br>
                                    <a href="registrasi.php"> Registrasi Akun</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <?php include "footer.php"; ?>

</body>

</html>