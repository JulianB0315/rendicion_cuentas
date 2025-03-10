<?php

namespace App\Controllers;

use App\Models\AdministradoresModel;

class Admin_loginController extends BaseController
{
    private $AdministradoresModel;
    function __construct()
    {
        $this->AdministradoresModel = new AdministradoresModel();
    }
    public function index()
    {
        return view('login_admin');
    }
    public function login()
    {
        $dni = $this->request->getGet('dni');
        $password = $this->request->getGet('password');

        $admin = $this->AdministradoresModel
            ->select('dni_admin, nombres_admin, categoria_admin, password')
            ->where('dni_admin', $dni)->first();

        if ($admin && password_verify($password, $admin['password'])) {
            $session = session();
            $session->set([
                'dni_admin' => $admin['dni_admin'],
                'nombres_admin' => $admin['nombres_admin'],
                'categoria_admin' => $admin['categoria_admin'],
                'isLoggedIn' => true,
            ]);
            return redirect()->to(base_url('admin/inicio'));
        } else {
            return redirect()->back()->with('error', 'DNI o contraseña incorrectos');
        }
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }
    // public function insertarAdmin()
    // {
    //     $dni = "40346175";
    //     $nombres = "MARTHA LUZ TUÑOQUE JULCAS";
    //     $categoria = "super_admin";
    //     $password = "12345678"; 
    
    //     $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    
    //     $data = [
    //         'dni_admin' => $dni,
    //         'nombres_admin' => $nombres,
    //         'password' => $hashedPassword, 
    //         'categoria_admin' => $categoria,
    //     ];
    
    //     $this->AdministradoresModel->insert($data);
    //     echo "Admin insertado";
    // }
}
