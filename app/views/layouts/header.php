<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffe Willy</title>
    <link rel="shortcut icon" href="<?php echo asset("img", "logotipo.webp") ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo asset("css", "styles.css") ?>">
    <link rel="stylesheet" href="<?php echo asset("css", "navbar-user.css") ?>">
    <link rel="stylesheet" href="<?php echo asset("css", "login.css") ?>">
    <link rel="stylesheet" href="<?php echo asset("css", "modal.css") ?>">
</head>

<?php
$user = (getSession("user") == null) ? "" : getSession("user");
$rol = ($user == "") ? "usuario" : $user["rol"];
?>

<body class="body-<?php echo $rol ?>">
    <div id="overlay">
    </div>

    <div class="modal" id="modal">
        <div class="modal__title" id="modal-title">
            <h3>Error</h3>
        </div>
        <div class="modal__content">
            <div class="modal__icon" id="modal-icon">
                <span id="error">
                    <?php echo icon("alert") ?>
                </span>
                <span id="success">
                    <?php echo icon("check") ?>
                </span>
            </div>
            <div class="modal__message" id="modal-message">
                <p>Usuario no encontrado</p>
            </div>
        </div>
        <div class="modal__footer">
            <button class="modal__button" id="modal-close">Aceptar</button>
        </div>
    </div>