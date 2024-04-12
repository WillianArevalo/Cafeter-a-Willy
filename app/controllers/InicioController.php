<?php


class InicioController
{
    public function index()
    {
        unsetSession("user");
        generateToken();
        loadView("inicio", "index", [], true, true);
    }
}
