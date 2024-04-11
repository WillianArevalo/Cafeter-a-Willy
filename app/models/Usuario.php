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
}
