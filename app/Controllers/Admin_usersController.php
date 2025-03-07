<?php

namespace App\Controllers;

use App\Models\AdministradoresModel;

class Admin_UsersController extends BaseController
{
    private $AdministradoresModel;
    function __construct()
    {
        $this->AdministradoresModel = new AdministradoresModel();
    }
    public function index()
    {
        $admins = $this->AdministradoresModel->select('dni_admin, nombres_admin, categoria_admin')->where('categoria_admin', 'admin')->findAll();
        return view('admin_users', ['admins' => $admins]);
    }
}
