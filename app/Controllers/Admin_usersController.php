<?php 

namespace App\Controllers;

// Aqui las tablas

class Admin_UsersController extends BaseController
{
    public function index()
    {
        return view('admin_users');
    }
}

?>