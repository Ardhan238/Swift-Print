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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
</head>
<?php

session_start();
include 'functions.php';

// cek apakah form telah disubmit
if (isset($_POST['registrasi'])) {
    // mengambil data dari form login
    $username = $_POST["username"];
    $password = $_POST["password"];
    $nohp = $_POST["nohp"];
    $level = '2';

    // melindungi dari SQL injection
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);
    $nohp = mysqli_real_escape_string($conn, $nohp);
    //hashing
    $password = password_hash($password, PASSWORD_DEFAULT);
    $level = mysqli_real_escape_string($conn, $level);


    // mencari user di database dgn username yang sama
    $user = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
    if (mysqli_num_rows($user) > 0) {
        echo "
            <script>
                alert('Username sudah digunakan!');
                window.location.href='registrasi.php';
            </script>
        ";
        exit;
    }

    mysqli_query($conn, "INSERT INTO user VALUES (NULL, '$username', '$password', '$nohp', '$level')");
    echo "
        <script>
            alert('Berhasil Registrasi! Silahkan login...');
            window.location.href='login.php';
        </script>
    ";
    exit;
}
?>

<body>

    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center my-5">
            <div class="col-xl-10 col-lg-12 col-md-9 col-sm-12">
                <h4 class="mt-5 text-center">Swift Print - Registrasi Akun</h4>
                <div class="card o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col">
                                <div class="p-2">
                                    <form class="user" method="POST" action="">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="username"
                                                placeholder="Masukkan Username" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="password"
                                                placeholder="Masukkan Password" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="nohp"
                                                placeholder="Masukkan Nohp (Awali dengan 628)" required>
                                        </div>
                                        <button type="submit" name="registrasi" class="btn btn-primary btn-block">
                                            Registrasi
                                        </button>
                                    </form>
                                    <br>
                                    <a href="login.php"> Login</a>
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