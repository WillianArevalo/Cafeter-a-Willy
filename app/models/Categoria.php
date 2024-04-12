<?php


class Categoria
{

    private $connection;

    public function __construct($conn)
    {
        $this->connection = $conn;
    }

    public function add($nombre, $descripcion, $imagen, $id_padre = null)
    {
        $query = "INSERT INTO categoria (nombre, descripcion, imagen,  id_categoria_padre) VALUES (?, ?, ?, ?)";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("sssi", $nombre, $descripcion, $imagen, $id_padre);
        $stmt->execute();
        return $stmt->affected_rows > 0;
        $stmt->close();
    }

    public function getAll()
    {
        $query = "SELECT * FROM categoria";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllParent()
    {
        $query = "SELECT * FROM categoria WHERE id_categoria_padre IS NULL";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllChilds($id)
    {
        $query = "SELECT * FROM categoria WHERE id_categoria_padre = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function delete($id)
    {
        $query = "DELETE FROM categoria WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->affected_rows > 0;
        $stmt->close();
    }

    public function getById($id)
    {
        $query = "SELECT * FROM categoria WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }

    public function getByName($name)
    {
        $query = "SELECT * FROM categoria WHERE nombre = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }

    public function update($data)
    {
        $query = "UPDATE categoria SET nombre = ?, descripcion = ?, imagen = ?, id_categoria_padre = ? WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("sssii", $data["nombre"], $data["descripcion"], $data["imagen"], $data["id_categoria_padre"], $data["id"]);
        $stmt->execute();
        return $stmt->affected_rows > 0;
        $stmt->close();
    }
}
