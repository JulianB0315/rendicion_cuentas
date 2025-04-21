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
        $this->updateToken($session);

        // Validar si el token de la cookie coincide con el de la sesión
        $cookieToken = $_COOKIE['auth_token'] ?? null;
        $currentToken = $session->get('auth_token');
        $previousToken = $session->get('previous_auth_token'); // Token anterior

        if (
            !$cookieToken ||
            ($cookieToken !== $currentToken && $cookieToken !== $previousToken) ||
            $session->get('estado') === 'deshabilitado'
        ) {
            if (session_status() === PHP_SESSION_ACTIVE) {
                $session->destroy();
            }
            return redirect()->to(base_url('login'))->with('error', 'Sesión inválida o usuario deshabilitado.');
        }

        // Validar categoría si se pasa como argumento
        if ($arguments && !in_array($session->get('categoria_admin'), $arguments)) {
            return redirect()->to(base_url('login'))->with('error', 'Acceso denegado. Categoría no autorizada.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}

    private function updateToken($session)
    {
        $dni = $session->get('dni_admin');
        $adminModel = new \App\Models\rendicion_cuentas\AdministradoresModel();
        $admin = $adminModel->select('estado, categoria_admin')->where('dni_admin', $dni)->first();

        if (!$admin || $admin['estado'] === 'deshabilitado') {
            if (session_status() === PHP_SESSION_ACTIVE) {
                $session->destroy();
            }
            return redirect()->to(base_url('login'))->with('error', 'Sesión inválida o usuario deshabilitado.');
        }

        // Actualizar la categoría en la sesión si ha cambiado
        if ($admin['categoria_admin'] !== $session->get('categoria_admin')) {
            $session->set('categoria_admin', $admin['categoria_admin']);
        }

        // Generar un nuevo token si no existe o si ha pasado cierto tiempo
        if (!$session->has('auth_token') || $this->isTokenExpired($session)) {
            $newToken = bin2hex(random_bytes(16)); // Generar un token seguro

            // Guardar el token actual como el token anterior
            $session->set('previous_auth_token', $session->get('auth_token'));

            // Actualizar el token actual
            $session->set('auth_token', $newToken);
            $session->set('token_last_updated', time());

            // Actualizar el token en las cookies
            setcookie('auth_token', $newToken, [
                'expires' => time() + 3600,
                'path' => '/',
                'secure' => true,
                'httponly' => true,
                'samesite' => 'Strict',
            ]);
        }
    }

    private function isTokenExpired($session)
    {
        $lastUpdated = $session->get('token_last_updated');
        $currentTime = time();
        $expirationTime = 60; // 1 minuto

        return !$lastUpdated || ($currentTime - $lastUpdated) > $expirationTime;
    }
}
