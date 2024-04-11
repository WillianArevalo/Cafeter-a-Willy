<?php

class DashboardController
{
    private $user;

    public function index()
    {
        $this->user = getSession("user");
        loadView("dashboard", "index", ["user" => $this->user], true, true);
    }
}
