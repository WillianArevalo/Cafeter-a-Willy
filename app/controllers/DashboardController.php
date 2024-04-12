<?php

class DashboardController
{
    private $user;

    public function index()
    {
        $this->user = getSession("user");
        verifyRole("admin");
        verifySession();
        loadView("dashboard", "index", ["user" => $this->user], true, true);
    }
}
