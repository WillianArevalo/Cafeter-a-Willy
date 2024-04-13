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
        loadView("usuarios", "index", [], true, true);
    }
}
