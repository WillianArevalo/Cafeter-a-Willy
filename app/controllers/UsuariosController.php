<?php

require_once "app/database/connection.php";

class UsuariosController
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
        verifyRole("admin");
        verifySession();
        $usuario = new Usuario($this->conn);
        $usuarios = $usuario->getAll();
        loadView("usuarios", "index", ["usuarios" => $usuarios], true, true);
    }

    public function nuevo()
    {
        verifyRole("admin");
        verifySession();
        loadView("usuarios", "new", [], true, true);
    }

    public function agregar()
    {
        $usuario = new Usuario($this->conn);
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $direccion = $_POST["direccion"];
        $rol = $_POST["rol"];
        $token = $_POST["_token"];

        if (validateToken($token) == false) {
            echo json_encode(["status" => "error", "title" => "ERROR", "message" => "Token de seguridad inválido"]);
            return;
        }

        if (isset($_FILES["imagen"])) {
            $imagen = uploadImage("usuarios", "imagen");
        } else {
            $imagen = null;
        }

        $data = [
            "username" => $username,
            "email" => $email,
            "password" => password_hash($password, PASSWORD_DEFAULT),
            "direccion" => $direccion,
            "imagen" => $imagen,
            "rol" => $rol
        ];

        $add = $usuario->add($data);
        if ($add) {
            echo json_encode(["status" => "success", "title" => "Éxito", "message" => "Usuario agregado correctamente", "redirect" => url("/usuarios")]);
        } else {
            echo json_encode(["status" => "error", "title" => "ERROR", "message" => "Error al agregar el usuario"]);
        }
    }

    public function eliminar()
    {
        $usuario = new Usuario($this->conn);
        $id = $_POST["id"];
        $token = $_POST["_token"];

        if (validateToken($token) == false) {
            echo json_encode(["status" => "error", "title" => "ERROR", "message" => "Token de seguridad inválido"]);
            return;
        }

        $delete = $usuario->delete($id);
        if ($delete) {
            echo json_encode(["status" => "success", "title" => "Éxito", "message" => "Usuario eliminado correctamente", "redirect" => url("/usuarios")]);
        } else {
            echo json_encode(["status" => "error", "title" => "ERROR", "message" => "Error al eliminar el usuario"]);
        }
    }

    public function editar()
    {
        verifyRole("admin");
        verifySession();
        $usuario = new Usuario($this->conn);
        $id = $this->id;
        $search = $usuario->getById($id);
        if (!$search) {
            loadView("error", "404", ["title" => "404 PÁGINA NO ENCONTRADA", "message" => "Usuario no encontrado"], false, true);
        }
        loadView("usuarios", "edit", ["usuario" => $search], true, true);
    }

    public function actualizar()
    {
        $usuario = new Usuario($this->conn);
        $id = $_POST["id"];
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $direccion = $_POST["direccion"];
        $rol = $_POST["rol"];
        $token = $_POST["_token"];

        if (validateToken($token) == false) {
            echo json_encode(["status" => "error", "title" => "ERROR", "message" => "Token de seguridad inválido"]);
            return;
        }

        $search = $usuario->getById($id);
        if (!$search) loadView("error", "404", ["title" => "ERROR", "message" => "Usuario no encontrado"], false, true);

        if ($search["imagen"] == "" || $search["imagen"] == null) {
            $imagen = uploadImage("usuarios", "imagen");
        }

        if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0) {
            if (!removeImage("usuarios", $search["imagen"])) {
                echo json_encode(["status" => "error", "title" => "ERROR", "message" => "Error al eliminar la imagen anterior"]);
                return;
            }
            $imagen = uploadImage("usuarios", "imagen");
        } else {
            $imagen = $search["imagen"];
        }

        if ($_POST["password"] == "") {
            $password = $search["clave"];
        } else {
            $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        }

        $data = [
            "username" => $username,
            "email" => $email,
            "password" => $password,
            "rol" => $rol,
            "imagen" => $imagen,
            "direccion" => $direccion,
            "id" => $id
        ];

        $edit = $usuario->edit($data);
        if ($edit) {
            $_SESSION["user"] = $usuario->getById($id);
            echo json_encode(["status" => "success", "title" => "Éxito", "message" => "Usuario editado correctamente", "redirect" => url("/usuarios")]);
        } else {
            echo json_encode(["status" => "error", "title" => "ERROR", "message" => "Error al editar el usuario"]);
        }
    }
}