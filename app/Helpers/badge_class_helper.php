<?php
if (!function_exists('get_badge_class')) {
    function get_badge_class(string $accion): string 
    {
        return match ($accion) {
            'deshabilitar' => 'bg-danger',
            'habilitar' => 'bg-success',
            'editar_password' => 'bg-warning',
            'crear' => 'bg-primary',
            default => 'bg-secondary'
        };
    }
}