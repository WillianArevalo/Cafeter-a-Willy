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
        $categorias = $categoria->getAllParent();
        loadView("categorias", "index", ["categorias" => $categorias], true, true);
    }

    public function nueva()
    {
        verifyRole("admin");
        verifySession();
        $categoria = new Categoria($this->conn);
        $categorias = $categoria->getAllParent();
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
        $search = $categoria->getByName($_POST["categoria_padre"]);
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
        $id = $_POST["id"];
        if (validateToken($token) == false) {
            echo json_encode(["status" => "error", "title" => "ERROR", "message" => "Token de seguridad inválido"]);
            return;
        }

        $search = $categoria->getById($id);
        if (!$search) {
            echo json_encode(["status" => "error", "title" => "ERROR", "message" => "La categoría no existe"]);
            return;
        }

        if (!removeImage("categorias", $search["imagen"])) {
            echo json_encode(["status" => "error", "title" => "ERROR", "message" => "Error al eliminar la imagen"]);
            return;
        }

        $delete = $categoria->delete($id);
        if ($delete) {
            echo json_encode(["status" => "success", "title" => "EXITO", "message" => "Categoría eliminada correctamente", "redirect" => url("/categorias")]);
        } else {
            echo json_encode(["status" => "error", "title" => "ERROR", "message" => "Error al eliminar la categoría",]);
        }
    }

    public function editar()
    {
        verifyRole("admin");
        verifySession();
        $modeloCategoria = new Categoria($this->conn);
        $id = $this->id;
        $categorias = $modeloCategoria->getAllParent();
        $categoria = $modeloCategoria->getById($id);

        if (!$categoria) {
            loadView("error", "404", ["title" => "404 PÁGINA NO ENCONTRADA", "message" => "Categoria no encontrada"], false, true);
        }

        if ($categoria["id_categoria_padre"] != null) {
            $categoriaPadre = $modeloCategoria->getById($categoria["id_categoria_padre"]);
        } else {
            $categoriaPadre = null;
        }

        loadView("categorias", "edit", ["categorias" => $categorias, "categoria" => $categoria, "categoriaPadre" => $categoriaPadre], true, true);
    }

    public function actualizar()
    {
        verifyRole("admin");
        verifySession();
        $categoria = new Categoria($this->conn);
        $token = $_POST["_token"];
        $nombre = $_POST["nombre"];
        $descripcion = $_POST["descripcion"];
        $id = $_POST["id"];

        if (validateToken($token) == false) {
            echo json_encode(["status" => "error", "title" => "ERROR", "message" => "Token de seguridad inválido"]);
            return;
        }

        $search = $categoria->getById($id);
        if (!$search) {
            echo json_encode(["status" => "error", "title" => "ERROR", "message" => "La categoría no existe"]);
            return;
        }

        $categoriaPadre = $categoria->getByName($_POST["categoria_padre"]);
        $id_categoria_padre = ($categoriaPadre) ? $categoriaPadre["id"] : null;

        if ($id == $id_categoria_padre) {
            echo json_encode(["status" => "error", "title" => "ERROR", "message" => "La categoría no puede ser su propia subcategoría"]);
            return;
        }

        if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0) {
            if (!removeImage("categorias", $search["imagen"])) {
                echo json_encode(["status" => "error", "title" => "ERROR", "message" => "Error al eliminar la imagen anterior"]);
                return;
            }
            $imagen = uploadImage("categorias", "imagen");
        } else {
            $imagen = $search["imagen"];
        }

        $data = array(
            "nombre" => $nombre,
            "descripcion" => $descripcion,
            "imagen" => $imagen,
            "id_categoria_padre" => $id_categoria_padre,
            "id" => $id
        );

        $update = $categoria->update($data);
        if ($update) {
            echo json_encode(["status" => "success", "title" => "EXITO", "message" => "Categoría actualizada correctamente", "redirect" => url("/categorias")]);
        } else {
            echo json_encode(["status" => "error", "title" => "ERROR", "message" => "Error al actualizar la categoría",]);
        }
    }

    public function subcategorias()
    {
        $categoria = new Categoria($this->conn);
        $id = $_POST["id"];
        $subcategorias = $categoria->getAllChildsById($id);
        if ($subcategorias) {
            $html = getSubcategories($subcategorias);
            echo json_encode(["title" => "Subcategorías", "status" => "success", "subcategorias" => $subcategorias, "html" => $html]);
        } else {
            echo json_encode(["title" => "No se encontraron subcategorias", "status" => "info", "message" => ""]);
        }
    }

    public function filtrar()
    {
        $categoria = new Categoria($this->conn);
        $filtro = $_POST["filtro"];
        $categorias = "";
        switch ($filtro) {
            case "all":
                $categorias = $categoria->getAll();
                break;
            case "subcategorys":
                $categorias = $categoria->getAllChilds();
                break;
            default:
                $categorias = $categoria->getAllParent();
                break;
        }
        $html = getAlls($categorias);
        echo json_encode(["status" => "success", "html" => $html]);
    }
}
