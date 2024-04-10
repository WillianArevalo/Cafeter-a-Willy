<?php

/**
 * Clase para establecer la conexión a la base de datos
 */
class Connection
{
    private $host;
    private $user;
    private $password;
    private $database;
    private $connection;

    public function __construct($host, $user, $password, $database)
    {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->database = $database;

        $this->connection = new mysqli($this->host, $this->user, $this->password, $this->database);

        if ($this->connection->connect_errno) {
            echo "Error al conectarse a MySQL: " . $this->connection->connect_error;
            exit();
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function __destruct()
    {
        $this->connection->close();
    }
}


$connectionBD = new Connection(
    $_ENV['MYSQL_HOST'],
    $_ENV['MYSQL_USER'],
    $_ENV['MYSQL_PASSWORD'],
    $_ENV['MYSQL_DATABASE']
);

// Establecer la conexión a la base de datos
$conn = $connectionBD->getConnection();
