<?php 
if (!function_exists('formatear_fecha_esp')) {
    function formatear_fecha_esp($fecha) {
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

        $fecha_formateada = date('d \d\e F', strtotime($fecha));
        return strtr($fecha_formateada, $meses);
    }
}
?>