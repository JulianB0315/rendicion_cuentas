<?php

namespace App\Controllers\rendicion_cuentas\Admin;

use App\Controllers\BaseController;
use App\Models\rendicion_cuentas\RendicionModel;
use App\Models\rendicion_cuentas\EjeModel;
use App\Models\rendicion_cuentas\Ejes_SeleccionadosModel;
use App\Models\rendicion_cuentas\PreguntaModel;
use App\Models\rendicion_cuentas\Preguntas_seleccionadasModel;
use App\Models\rendicion_cuentas\UsuarioModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;
use PhpOffice\PhpSpreadsheet\Chart\Chart;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\Title;

class GestionAdminController extends BaseController
{
    private $rendicionModel;
    private $ejeModel;
    private $ejesSeleccionadosModel;
    private $preguntaModel;
    private $preguntasSeleccionadasModel;
    private $usuarioModel;
    public function __construct()
    {
        $this->rendicionModel = new RendicionModel();
        $this->ejeModel = new EjeModel();
        $this->ejesSeleccionadosModel = new Ejes_SeleccionadosModel();
        $this->preguntaModel = new PreguntaModel();
        $this->preguntasSeleccionadasModel = new Preguntas_seleccionadasModel();
        $this->usuarioModel = new UsuarioModel();
    }
    //Funciones de Gestion de rendiciones
    public function CreateID($table)
    {
        $prefixes = [
            'historial' => 'ha',
            'rendicion' => 're',
            'eje' => 'ej',
            'ejesSeleccionados' => 'es',
            'pregunta' => 'pr',
            'preguntasSeleccionadas' => 'ha',
            'usuario' => 'us',
        ];
        if (!isset($prefixes[$table])) {
            throw new \InvalidArgumentException("Invalid table name: $table");
        }
        $model = $this->{$table . 'Model'};
        $prefix = $prefixes[$table];
        do {
            $uuid = $prefix . strtoupper(substr(bin2hex(random_bytes(3)), 0, 6));
        } while ($model->where('id', $uuid)->first());
        return $uuid;
    }
    //Funciones de Dashboard

    public function buscarEjes()
    {
        $data['ejes'] = $this->ejeModel->findAll();
        $data['categoria'] = session()->get('categoria_admin');
        return view('rendicion_cuentas/Admin/admin', $data);
    }

    public function CrearEje()
    {
        $data_eje = [
            'id' => $this->CreateID('eje'),
            'tematica' => $this->request->getPost('nombreEje')
        ];
        $this->ejeModel->insert($data_eje);
        session()->setFlashdata('success', 'Eje creado correctamente');
        return redirect()->to(RUTA_ADMIN_HOME);
    }

    public function CrearRendicion()
    {
        $banner = $this->request->getFile('bannerRendicion');
        if (!$banner || !$banner->isValid() || $banner->hasMoved()) {
            session()->setFlashdata('error', 'Error uploading banner');
            return redirect()->to(RUTA_ADMIN_HOME);
        }

        $uploadPath = FCPATH . 'img';
        if (!is_dir($uploadPath) && !mkdir($uploadPath, 0777, true) && !is_dir($uploadPath)) {
            session()->setFlashdata('error', 'Failed to create upload directory');
            return redirect()->to(RUTA_ADMIN_HOME);
        }

        $bannerPath = uniqid() . '.' . $banner->getClientExtension();
        if (!$banner->move($uploadPath, $bannerPath)) {
            session()->setFlashdata('error', 'Failed to move uploaded file');
            return redirect()->to(RUTA_ADMIN_HOME);
        }

        $horaRendicion = $this->request->getPost('horaRendicion');
        if (empty($horaRendicion)) {
            session()->setFlashdata('error', 'Hora de rendición no proporcionada');
            return redirect()->to(RUTA_ADMIN_HOME);
        }

        $data = [
            'id' => $this->CreateID('rendicion'),
            'fecha' => $this->request->getPost('fechaRendicion'),
            'hora_rendicion' => $horaRendicion,
            'banner_rendicion' => $bannerPath
        ];

        $this->rendicionModel->insert($data);

        $ejes_seleccionados = $this->request->getPost('ejes');
        if (empty($ejes_seleccionados)) {
            session()->setFlashdata('error', 'Debe seleccionar al menos un eje');
            return redirect()->to(RUTA_ADMIN_HOME);
        }

        foreach ($ejes_seleccionados as $eje) {
            $this->ejesSeleccionadosModel->insert([
                'id' => $this->CreateID('ejesSeleccionados'),
                'id_rendicion' => $data['id'],
                'id_eje' => $eje
            ]);
        }

        session()->setFlashdata('success', 'Rendición creada correctamente');
        return redirect()->to(RUTA_ADMIN_HOME);
    }
    //Funcion para gestionar preguntas
    public function cargarFechas($Vista)
    {
        $session = session();
        $categoria = $session->get('categoria_admin'); 
        $rendiciones = $this->rendicionModel->findAll();

        return view('rendicion_cuentas/Admin/' . $Vista, [
            'rendiciones' => $rendiciones,
            'categoria' => $categoria, 
        ]);
    }

    public function BuscarRendicion()
    {
        $id = $this->request->getGet('id');
        $ejes_seleccionados = $this->ejesSeleccionadosModel
            ->where('id_rendicion', $id)
            ->findAll();
        $ejes = array_map(function ($eje) {
            $ejeData = $this->ejeModel->find($eje['id_eje']);
            return [
                'tematica'          => $ejeData['tematica'],
                'cantidad_preguntas' => $eje['cantidad_preguntas'],
                'id' => $eje['id']
            ];
        }, $ejes_seleccionados);
        $rendiciones = $this->rendicionModel->findAll();
        return view('rendicion_cuentas/Admin/questions', ['ejes' => $ejes, 'rendiciones' => $rendiciones]);
    }

    public function BuscarPreguntas($id_eje_seleccionado)
    {
        $eje_seleccionado = $this->ejesSeleccionadosModel->find($id_eje_seleccionado);
        if (!$eje_seleccionado) {
            throw new \Exception("Eje seleccionado no encontrado.");
        }

        $eje = $this->ejeModel->find($eje_seleccionado['id_eje']);
        if (!$eje) {
            throw new \Exception("Eje no encontrado.");
        }

        // Get IDs of already selected questions
        $preguntas_seleccionadas = $this->preguntasSeleccionadasModel
            ->where('id_eje_seleccionado', $id_eje_seleccionado)
            ->findAll();
        $ids_seleccionados = array_column($preguntas_seleccionadas, 'id_pregunta');

        // Exclude selected questions
        $preguntasQuery = $this->preguntaModel
            ->select('pregunta.*, usuario.nombres, usuario.DNI, usuario.ruc_empresa, usuario.nombre_empresa')
            ->join('usuario', 'usuario.id = pregunta.id_usuario')
            ->where('pregunta.id_eje', $eje_seleccionado['id_eje'])
            ->where('usuario.id_rendicion', $eje_seleccionado['id_rendicion']);

        if (!empty($ids_seleccionados)) {
            $preguntasQuery->whereNotIn('pregunta.id', $ids_seleccionados);
        }

        $preguntas = $preguntasQuery->findAll();

        return view('rendicion_cuentas/Admin/sort', [
            'eje'                 => $eje,
            'preguntas'           => $preguntas,
            'id_eje_seleccionado' => $id_eje_seleccionado,
            'ids_seleccionados'   => $ids_seleccionados
        ]);
    }

    public function SeleccionarPreguntas()
    {
        $id_eje_seleccionado = $this->request->getPost('id_eje_seleccionado');
        $preguntas_seleccionadas = $this->request->getPost('preguntas_seleccionadas');

        if (empty($preguntas_seleccionadas)) {
            return redirect()->back()->with('error', 'No se seleccionaron preguntas.');
        }

        foreach ($preguntas_seleccionadas as $id_pregunta) {
            $data = [
                'id' => $this->CreateID('preguntasSeleccionadas'),
                'id_eje_seleccionado'      => $id_eje_seleccionado,
                'id_pregunta'              => $id_pregunta
            ];
            $this->preguntasSeleccionadasModel->insert($data);
        }

        return $this->BuscarPreguntas($id_eje_seleccionado);
    }

    public function preguntasSeleccionadas()
    {
        $id_rendicion = $this->request->getGet('id_rendicion');
        $ejes_seleccionados = $this->ejesSeleccionadosModel
            ->where('id_rendicion', $id_rendicion)
            ->findAll();

        $ejes = array_map(function ($eje) {
            $ejeData = $this->ejeModel->find($eje['id_eje']);
            $preguntas = $this->preguntasSeleccionadasModel
                ->select('preguntas_seleccionadas.id, pregunta.contenido, pregunta.fecha_registro, usuario.nombres')
                ->join('pregunta', 'pregunta.id = preguntas_seleccionadas.id_pregunta')
                ->join('usuario', 'usuario.id = pregunta.id_usuario')
                ->where('preguntas_seleccionadas.id_eje_seleccionado', $eje['id'])
                ->findAll();

            return [
                'tematica' => $ejeData['tematica'],
                'id_eje_seleccionado' => $eje['id'],
                'preguntas' => $preguntas
            ];
        }, $ejes_seleccionados);

        $rendiciones = $this->rendicionModel->findAll();
        return view('rendicion_cuentas/Admin/viewQuestions', ['ejes' => $ejes, 'rendiciones' => $rendiciones]);
    }

    public function QuitarPregunta()
    {
        $id_pregunta_seleccionada = $this->request->getPost('id_pregunta_seleccionada');
        $pregunta_seleccionada = $this->preguntasSeleccionadasModel->find($id_pregunta_seleccionada);
        if (!$pregunta_seleccionada) {
            return redirect()->back()->with('error', 'Pregunta no encontrada.');
        }
        if ($this->preguntasSeleccionadasModel->delete($id_pregunta_seleccionada)) {
            return redirect()->back()->with('success', 'Pregunta borrada correctamente.');
        }
        return redirect()->back()->with('error', 'No se pudo borrar la pregunta.');
    }

    public function MostrarReporte()
    {
        $id_rendicion = $this->request->getGet('id_rendicion');
        $usuarios = $this->usuarioModel->where('id_rendicion', $id_rendicion)->findAll();
        $asistencia_si = $this->usuarioModel->where('id_rendicion', $id_rendicion)->where('asistencia', 'si')->countAllResults();
        $asistencia_no = $this->usuarioModel->where('id_rendicion', $id_rendicion)->where('asistencia', 'no')->countAllResults();
        $ejes = $this->ejeModel->findAll();

        // Obtener preguntas de cada usuario
        foreach ($usuarios as &$usuario) {
            $usuario['preguntas'] = $this->preguntaModel
                ->select('pregunta.*, preguntas_seleccionadas.id_eje_seleccionado, eje.tematica')
                ->join('preguntas_seleccionadas', 'preguntas_seleccionadas.id_pregunta = pregunta.id')
                ->join('ejes_seleccionados', 'ejes_seleccionados.id = preguntas_seleccionadas.id_eje_seleccionado')
                ->join('eje', 'eje.id = ejes_seleccionados.id_eje')
                ->where('pregunta.id_usuario', $usuario['id'])
                ->findAll();
        }

        return view('rendicion_cuentas/Admin/viewReport', [
            'usuarios' => $usuarios,
            'asistencia_si' => $asistencia_si,
            'asistencia_no' => $asistencia_no,
            'id_rendicion' => $id_rendicion
        ]);
    }

    public function GenerarExcel($id_rendicion)
    {
        set_time_limit(0);
        ini_set('memory_limit', '512M');

        // Obtener usuarios y estadísticas
        $usuarios = $this->usuarioModel->where('id_rendicion', $id_rendicion)->findAll();
        $asistencia_si = $this->usuarioModel->where(['id_rendicion' => $id_rendicion, 'asistencia' => 'si'])->countAllResults();
        $asistencia_no = $this->usuarioModel->where(['id_rendicion' => $id_rendicion, 'asistencia' => 'no'])->countAllResults();
        $sexo_m = $this->usuarioModel->where(['id_rendicion' => $id_rendicion, 'sexo' => 'm'])->countAllResults();
        $sexo_f = $this->usuarioModel->where(['id_rendicion' => $id_rendicion, 'sexo' => 'f'])->countAllResults();

        foreach ($usuarios as $key => $usuario) {
            $usuarios[$key]['preguntas'] = $this->preguntaModel
                ->where('id_usuario', $usuario['id_usuario'])
                ->findAll();
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Reporte de Usuarios');

        $headers = [
            'A1' => 'DNI',
            'B1' => 'Nombre',
            'C1' => 'Sexo',
            'D1' => 'Tipo de Participación',
            'E1' => 'Título',
            'F1' => 'RUC',
            'G1' => 'Nombre de la Organización',
            'H1' => 'Asistencia',
            'I1' => 'Preguntas'
        ];

        foreach ($headers as $cell => $text) {
            $sheet->setCellValue($cell, $text);
        }

        $headerStyle = [
            'font' => [
                'bold'  => true,
                'color' => ['argb' => 'FFFFFFFF'],
            ],
            'fill' => [
                'fillType'   => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FF4CAF50'],
            ],
        ];
        $sheet->getStyle('A1:I1')->applyFromArray($headerStyle);

        $row = 2;
        foreach ($usuarios as $usuario) {
            $sheet->setCellValue('A' . $row, $usuario['DNI']);
            $sheet->setCellValue('B' . $row, $usuario['nombres']);
            $sheet->setCellValue('C' . $row, $usuario['sexo']);
            $sheet->setCellValue('D' . $row, $usuario['tipo_participacion']);
            $sheet->setCellValue('E' . $row, $usuario['titulo']);
            $sheet->setCellValue('F' . $row, $usuario['ruc_empresa']);
            $sheet->setCellValue('G' . $row, $usuario['nombre_empresa']);
            $sheet->setCellValue('H' . $row, $usuario['asistencia']);

            // Concatenar las preguntas del usuario
            $preguntas = '';
            if (!empty($usuario['preguntas'])) {
                foreach ($usuario['preguntas'] as $pregunta) {
                    $preguntas .= $pregunta['contenido'] . "\n";
                }
            } else {
                $preguntas = 'No hay preguntas para este usuario.';
            }
            $sheet->setCellValue('I' . $row, $preguntas);
            // Activar ajuste de texto para visualizar correctamente los saltos de línea
            $sheet->getStyle('I' . $row)->getAlignment()->setWrapText(true);
            $row++;
        }

        // Autoajustar el ancho de las columnas A a I
        foreach (range('A', 'I') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Agregar estadísticas en las columnas K y L
        $sheet->setCellValue('K1', 'Estadísticas');
        $sheet->setCellValue('K2', 'Asistencia Sí');
        $sheet->setCellValue('L2', $asistencia_si);
        $sheet->setCellValue('K3', 'Asistencia No');
        $sheet->setCellValue('L3', $asistencia_no);
        $sheet->setCellValue('K4', 'Sexo Masculino');
        $sheet->setCellValue('L4', $sexo_m);
        $sheet->setCellValue('K5', 'Sexo Femenino');
        $sheet->setCellValue('L5', $sexo_f);

        /* ----- GRÁFICO DE ASISTENCIA ----- */
        $dataSeriesLabels = [
            new DataSeriesValues('String', "'Reporte de Usuarios'!\$K\$2", null, 1),
            new DataSeriesValues('String', "'Reporte de Usuarios'!\$K\$3", null, 1),
        ];
        $xAxisTickValues = [
            new DataSeriesValues('String', "'Reporte de Usuarios'!\$K\$2:\$K\$3", null, 2),
        ];
        $dataSeriesValues = [
            new DataSeriesValues('Number', "'Reporte de Usuarios'!\$L\$2:\$L\$3", null, 2),
        ];
        $series = new DataSeries(
            DataSeries::TYPE_PIECHART,
            null,
            range(0, count($dataSeriesValues) - 1),
            $dataSeriesLabels,
            $xAxisTickValues,
            $dataSeriesValues
        );
        $plotArea = new PlotArea(null, [$series]);
        $chartTitle = new Title('Asistencia');
        $chart1 = new Chart(
            'chart1',
            $chartTitle,
            null,
            $plotArea
        );
        $chart1->setTopLeftPosition('K7');
        $chart1->setBottomRightPosition('P20');
        $sheet->addChart($chart1);

        /* ----- GRÁFICO DE SEXO ----- */
        $dataSeriesLabels2 = [
            new DataSeriesValues('String', "'Reporte de Usuarios'!\$K\$4", null, 1),
            new DataSeriesValues('String', "'Reporte de Usuarios'!\$K\$5", null, 1),
        ];
        $xAxisTickValues2 = [
            new DataSeriesValues('String', "'Reporte de Usuarios'!\$K\$4:\$K\$5", null, 2),
        ];
        $dataSeriesValues2 = [
            new DataSeriesValues('Number', "'Reporte de Usuarios'!\$L\$4:\$L\$5", null, 2),
        ];
        $series2 = new DataSeries(
            DataSeries::TYPE_PIECHART,
            null,
            range(0, count($dataSeriesValues2) - 1),
            $dataSeriesLabels2,
            $xAxisTickValues2,
            $dataSeriesValues2
        );
        $plotArea2 = new PlotArea(null, [$series2]);
        $chartTitle2 = new Title('Sexo');
        $chart2 = new Chart(
            'chart2',
            $chartTitle2,
            null,
            $plotArea2
        );
        $chart2->setTopLeftPosition('K21');
        $chart2->setBottomRightPosition('P34');
        $sheet->addChart($chart2);

        // Preparar y enviar el archivo Excel con gráficos incluidos
        $writer = new Xlsx($spreadsheet);
        $writer->setIncludeCharts(true);

        // Generar un nombre de archivo único usando fecha y hora
        $filename = 'reporte_usuarios_' . $id_rendicion . '_' . date('Ymd_His') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }
}
