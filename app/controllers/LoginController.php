<?php

require_once "app/database/connection.php";

class LoginController
{
    private $id;
    private $conn;
    private $sessionUser;

    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }

    public function set_id($id)
    {
        $this->id = $id;
    }

    public function index()
    {
        loadView("login", "index", [], false, true);
    }

    public function validate_user()
    {
        $token = $_POST["_token"];

        if (validateToken($token) == false) {
            echo json_encode(["title" => "Error", "status" => "error", "message" => "Token de seguridad inválido"]);
            return;
        }

        $username = $_POST["username"];
        $clave = $_POST["password"];
        $usuario = new Usuario($this->conn);
        $user = $usuario->search_user($username);
        if ($user) {
            if ($user["clave"] == $clave) {
                $_SESSION["user"] = $user;
                $url = "";
                if ($user["rol"] == "admin") {
                    $url = url("/dashboard");
                } else {
                    $url = url("/inicio");
                }
                echo json_encode(["title" => "¡Bienvenido!", "status" => "success", "message" => "Inicio de sesión exitoso", "redirect" => $url]);
            } else {
                echo json_encode(["title" => "Error", "status" => "error", "message" => "Contraseña incorrecta"]);
            }
        } else {
            echo json_encode(["title" => "Error", "status" => "error", "message" => "Usuario no encontrado"]);
        }
    }
}
