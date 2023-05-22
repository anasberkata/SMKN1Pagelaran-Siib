<?php
if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
    exit;
}

require "../functions.php";

$id = $_SESSION['id'];
$user = query(
    "SELECT * FROM users
    INNER JOIN users_role ON users.role_id = users_role.id_role
    WHERE id_user = $id"
)[0];

ini_set('display_errors', 1); //Atau error_reporting(E_ALL && ~E_NOTICE);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/logo sekolah.png">
    <title>
        Sistem Informasi Inventaris Barang
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />

    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="../assets/online/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="../assets/online/icon.css" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.5" rel="stylesheet" />

    <!-- Datatables -->
    <link rel="stylesheet" href="../vendor/simple-datatables/style.css">
</head>

<body class="g-sidenav-show  bg-gray-200">
    <?php
    include "sidebar.php";
    ?>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        <?php
        include "topbar.php";
        ?>

        <div class="container-fluid py-4">