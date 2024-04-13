<?php



class Usuario
{
    private $connection;

    public function __construct($conn)
    {
        $this->connection = $conn;
    }

    public function search_user($username)
    {
        $query = "SELECT * FROM usuario WHERE username = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }

    public function getAll()
    {
        $query = "SELECT * FROM usuario";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function add($data)
    {
        $query = "INSERT INTO usuario (username, email, clave, imagen, direccion,  rol) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("ssssss", $data["username"], $data["email"], $data["password"], $data["imagen"], $data["direccion"], $data["rol"]);
        $stmt->execute();
        return $stmt->affected_rows > 0;
        $stmt->close();
    }

    public function delete($id)
    {
        $query = "DELETE FROM usuario WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->affected_rows > 0;
        $stmt->close();
    }

    public function getById($id)
    {
        $query = "SELECT * FROM usuario WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }

    public function edit($data)
    {
        $query = "UPDATE usuario SET username = ?, email = ?, clave = ?, imagen = ?, direccion = ?, rol = ? WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("ssssssi", $data["username"], $data["email"], $data["password"], $data["imagen"], $data["direccion"], $data["rol"], $data["id"]);
        $stmt->execute();
        return $stmt->affected_rows > 0;
        $stmt->close();
    }
}