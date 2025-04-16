<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        $request = service('request');
        $token = $request->getCookie('auth_token');

        if (
            !$session->has('categoria_admin') || 
            !$session->has('dni_admin') || 
            !$session->has('nombres_admin') || 
            !$token || 
            $session->get('estado') === 'deshabilitado'
        ) {
            $session->destroy();
            return redirect()->to(base_url('login'))->with('error', 'Sesión inválida o usuario deshabilitado.');
        }

        // Validar categoría si se pasa como argumento
        if ($arguments && !in_array($session->get('categoria_admin'), $arguments)) {
            $session->destroy();
            return redirect()->to(base_url('login'))->with('error', 'Acceso denegado. Categoría no autorizada.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No action needed after the request
    }
}
