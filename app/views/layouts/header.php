<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo getToken() ?>">
    <title>Coffe Willy</title>
    <link rel="shortcut icon" href="<?php echo asset("img", "logotipo.webp") ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo asset("css", "styles.css") ?>">
    <link rel="stylesheet" href="<?php echo asset("css", "navbar-user.css") ?>">
    <link rel="stylesheet" href="<?php echo asset("css", "login.css") ?>">
    <link rel="stylesheet" href="<?php echo asset("css", "modal.css") ?>">
    <link rel="stylesheet" href="<?php echo asset("css", "navbar-admin.css") ?>">
    <link rel="stylesheet" href="<?php echo asset("css", "dashboard.css") ?>">
    <link rel="stylesheet" href="<?php echo asset("css", "categorias.css") ?>">
    <!-- SweetAlert 2 -->
    <link rel="stylesheet" href="<?php echo node_module("sweetalert2", "dist/sweetalert2.css") ?>">
    <script src="<?php echo asset("js", "jquery-3.7.1.min.js") ?>"></script>
</head>

<?php
$user = (getSession("user") == null) ? "" : getSession("user");
$rol = ($user == "") ? "usuario" : $user["rol"];
?>

<body class="body-<?php echo $rol ?>" id="body">
    <div id="overlay">
    </div>