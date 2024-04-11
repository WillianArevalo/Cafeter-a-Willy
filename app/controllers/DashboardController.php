<?php

class DashboardController
{

    public function index()
    {
        loadView("dashboard", "index", [], true, true);
    }
}
