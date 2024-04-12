<?php

require_once "app/database/connection.php";

class CategoriasController
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
        $categoria = new Categoria($this->conn);
        $categorias = $categoria->getAll();
        loadView("categorias", "index", ["categorias" => $categorias], true, true);
    }

    public function nueva()
    {
        verifyRole("admin");
        verifySession();
        $categoria = new Categoria($this->conn);
        $categorias = $categoria->getAll();
        loadView("categorias", "new", ["categorias" => $categorias], true, true);
    }

    public function crear()
    {
        verifyRole("admin");
        verifySession();
        $token = $_POST["_token"];
        if (validateToken($token) == false) {
            echo json_encode(["status" => "error", "title" => "ERROR", "message" => "Token de seguridad inválido"]);
            return;
        }
        $categoria = new Categoria($this->conn);
        $search = $categoria->getByName($_POST["categoria"]);
        $id_categoria_padre = ($search) ? $search["id"] : null;

        if (isset($_FILES["imagen"])) {
            $imagen = uploadImage("categorias", "imagen");
        } else {
            $imagen = null;
        }

        $nombre = $_POST["nombre"];
        $descripcion = $_POST["descripcion"];

        $add = $categoria->add($nombre, $descripcion, $imagen, $id_categoria_padre);
        if ($add) {
            echo json_encode(["status" => "success", "title" => "EXITO", "message" => "Categoría creada correctamente", "redirect" => url("/categorias")]);
        } else {
            echo json_encode(["status" => "error", "title" => "ERROR", "message" => "Error al crear la categoría",]);
        }
    }

    public function eliminar()
    {
        verifyRole("admin");
        verifySession();
        $categoria = new Categoria($this->conn);

        $token = $_POST["_token"];
        if (validateToken($token) == false) {
            echo json_encode(["status" => "error", "title" => "ERROR", "message" => "Token de seguridad inválido"]);
            return;
        }

        $id = $_POST["id"];
        $delete = $categoria->delete($id);
        if ($delete) {
            echo json_encode(["status" => "success", "title" => "EXITO", "message" => "Categoría eliminada correctamente", "redirect" => url("/categorias")]);
        } else {
            echo json_encode(["status" => "error", "title" => "ERROR", "message" => "Error al eliminar la categoría",]);
        }
    }
}
