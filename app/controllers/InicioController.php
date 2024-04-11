<?php


class InicioController
{
    public function index()
    {
        unsetSession("user");
        loadView("home", "index", [], true, true);
    }
}
