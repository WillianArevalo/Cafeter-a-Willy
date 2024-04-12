<?php

/**
 * Función para redireccionar a una página
 * @param string $page Página a la que se redireccionará
 * @return string URL completa de la página a la que se redireccionará
 */
function url($page)
{
    $url = $_ENV['URL'] . $page;
    return $url;
}


/**
 * Función para cargar los modelos del proyecto
 * @return void 
 */
function registerModels()
{
    foreach (glob("app/models/*.php") as $fileModel) {
        require_once($fileModel);
    }
}

/**
 * Función para cargar los archivos que contienen las respuestas a las peticiones AJAX
 * @return void
 */

function registerFunctionsAjax()
{
    foreach (glob("app/views/ajax/*.php") as $fileAjax) {
        require_once($fileAjax);
    }
}

/**
 * Función para cargar un asset (archivo css, js, img, svg)
 * @param string $type Tipo de asset (css, js, img, svg)
 * @param string $nameFile Nombre del archivo
 * @return string URL del asset
 */
function asset($type, $nameFile)
{
    return $_ENV['URL'] . "/app/views/assets/" . $type . "/" . $nameFile;
}

/**
 * Función para cargar los archivos que estan en la carpeta node_modules
 * @param string $lib librería a cargar
 * @param string $archivo archivo a cargar
 * @return string url completa del archivo
 */

function node_module($lib, $archivo)
{
    return $_ENV['URL'] . "/node_modules/" . $lib . "/" . $archivo;
}

/**
 * Functión para verificar si un usuario ha iniciado sesión
 * @return void
 */
function verifySession()
{
    if (!isset($_SESSION['user'])) {
        header("Location:" . $_ENV['URL']);
        exit;
    }
}

/**
 * Función para obtener una variable de sesión
 * @param string $name Nombre de la variable de sesión
 * @return mixed Valor de la variable de sesión
 */
function getSession($name)
{
    if (isset($_SESSION[$name])) {
        return $_SESSION[$name];
    } else {
        return null;
    }
}

/**
 * Función para eliminar una variable de sesión
 * @param string $name Nombre de la variable de sesión
 * @return void
 */
function unsetSession($name)
{
    if (isset($_SESSION[$name])) {
        unset($_SESSION[$name]);
    }
}

/**
 * Función para verificar si un usuario tiene un rol específico
 * @param string $role Rol que se verificará
 * @return void
 */

function verifyRole($role)
{
    if ($_SESSION['user']['rol'] != $role) {
        header("Location:" . $_ENV['URL']);
        exit;
    }
}

/**
 * Función para generar un token de seguridad
 * @return void
 */

function generateToken()
{
    if (!isset($_SESSION["crs_token"])) {
        $token = bin2hex(random_bytes(32)) . uniqid();
        $_SESSION["crs_token"] = $token;
    } else {
        $token = $_SESSION["crs_token"];
    }
}


/**
 * Función para obtener el token de seguridad
 * @return string token de seguridad
 */

function getToken()
{
    return getSession("crs_token");
}

/**
 * Función para validar el token de seguridad
 * @param string $token token de seguridad
 * @return boolean true si el token es válido, false si no lo es
 */

function validateToken($token)
{
    if ($token != $_SESSION["crs_token"]) {
        return false;
    }
    return true;
}

/**
 * Función para cargar una vista
 * @param string $controller Nombre del controlador
 * @param string $action Nombre del método del controlador
 * @param array $params Parámetros que se pasarán a la vista
 * @param boolean $layout Indica si se debe cargar el layout de la página (navbar)
 * @param boolean $assets Indica si se deben cargar los assets de la página
 * @return void
 */

function loadView($controller = null, $action = null, $params = [], $layout = true, $assets = true)
{
    $nameContoller = strtolower($controller);
    $view = __DIR__ . "/views/" . $nameContoller . "/" . ($action ? $action . ".view.php" :  "index.view.php");

    if ($assets) {
        require_once(__DIR__ . "/views/layouts/header.php");
    }

    if ($layout) {
        require_once(__DIR__ . "/views/layouts/navbar.php");
    }

    if ($view) {
        if ($params) {
            extract($params);
        }
        require_once($view);
    } else {
        require_once(__DIR__ . "/views/error/404.view.php");
    }

    if ($assets) {
        require_once(__DIR__ . "/views/layouts/footer.php");
    }
}

/**
 * Función para cargar un icono
 * @param string $icon Nombre del icono
 * @return string SVG del icono
 */
function icon($icon)
{
    $file = __DIR__ . "/views/assets/icons/" . $icon . ".svg";
    if (file_exists($file)) {
        $iconSvg =  file_get_contents($file);
        return $iconSvg;
    } else {
        return "Icono no encontrado";
    }
}


/**
 * Función para subir una imagen
 * @param string $directory Directorio donde se guardará la imagen
 * @param string $image Nombre del input file
 * @return string Nombre de la imagen
 */

function uploadImage($directory, $image)
{
    $nameFile = $_FILES[$image]['name'];
    $path = __DIR__ . "/views/assets/img/" . $directory . "/" . $nameFile;
    if (move_uploaded_file($_FILES[$image]['tmp_name'], $path)) {
        return $nameFile;
    } else {
        return "Error al subir la imagen";
    }
}


/**
 * Función para eliminar una imagen
 * @param string $directory Directorio donde se encuentra la imagen
 * @param string $image Nombre de la imagen
 * @return boolean true si la imagen se eliminó, false si no se eliminó
 */

function removeImage($directory, $image)
{
    $path = __DIR__ . "/views/assets/img/" . $directory . "/" . $image;
    if (file_exists($path)) {
        if (unlink($path)) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
