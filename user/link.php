<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title>Swift Print</title>
<link rel="icon" href="../img/logo.png" type="image/x-icon">
<link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="../css/sb-admin-2.min.css" rel="stylesheet">
<link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link rel="stylesheet" href="../vendor/fontawesome-free/css/fontawesome.css">
<script src="../vendor/jquery/jquery.min.js"></script>
<link rel="stylesheet" href="../vendor/sweetalert2/dist/sweetalert2.min.css">
<?php

session_start();
include '../functions.php';
$id_user = $_SESSION['id_user'];

if (!isset($_SESSION["user"])) {
    header("Location: ../login.php");
    exit;
}

?>