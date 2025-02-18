<?php 
if (!function_exists('formatear_fecha_esp')) {
    function formatear_fecha_esp($fecha, $formato = 'completo') {
        $meses = array(
            'January' => 'Enero',
            'February' => 'Febrero',
            'March' => 'Marzo',
            'April' => 'Abril',
            'May' => 'Mayo',
            'June' => 'Junio',
            'July' => 'Julio',
            'August' => 'Agosto',
            'September' => 'Septiembre',
            'October' => 'Octubre',
            'November' => 'Noviembre',
            'December' => 'Diciembre'
        );

        switch ($formato) {
            case 'Y':
                return date('Y', strtotime($fecha));
            case 'numerico':
                return date('d/m/Y', strtotime($fecha));
            case 'dashboard':
                $fecha_formateada = date('d \d\e F', strtotime($fecha));
                return strtr($fecha_formateada, $meses);
            case 'completo':
            default:
                $fecha_formateada = date('d \d\e F \d\e\l Y', strtotime($fecha));
                return strtr($fecha_formateada, $meses);
        }
    }
}
?>