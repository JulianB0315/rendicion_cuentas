<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class SuperAdmin implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // Check if the user is logged in and has the 'super_admin' category
        if (!$session->has('categoria_admin') || $session->get('categoria_admin') !== 'super_admin') {
            return redirect()->to(base_url('login'))->with('error', 'Acceso denegado. Solo para Super Administradores.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No action needed after the request
    }
}
