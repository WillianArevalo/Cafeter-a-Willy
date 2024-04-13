<?php


class ErrorController
{
    public function index()
    {
        $user = (getSession("user") != null) ?  getSession("user") : null;
        loadView("error", "404", ["title" => "404 PAGE NOT FOUND", "message" => "Página no encontrada", "user" => $user], false, true);
    }
}