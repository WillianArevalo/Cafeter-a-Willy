<?php

if (!isset($_SESSION['user'])) {
    $role = "user";
} else {
    $role = $_SESSION['user']['rol'];
}

$navbar = "app/views/layouts/navbars/$role.navbar.php";

if (file_exists($navbar)) {
    require_once $navbar;
} else {
    require_once "app/views/layouts/navbars/user.navbar.php";
}
