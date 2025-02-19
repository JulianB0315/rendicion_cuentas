<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\PreguntaModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class viewReportController extends BaseController
{
    private $UsuarioModel;
    private $PreguntaModel;

    public function __construct()
    {
        $this->UsuarioModel = new UsuarioModel();
        $this->PreguntaModel = new PreguntaModel();
    }
    public function index()
    {
        return view('viewReport');
    }
    public function generar_excel($id_rendicion)
    {
        // Obtener usuarios y estadísticas usando condiciones compuestas
        $usuarios = $this->UsuarioModel->where('id_rendicion', $id_rendicion)->findAll();
        $asistencia_si = $this->UsuarioModel->where(['id_rendicion' => $id_rendicion, 'asistencia' => 'si'])->countAllResults();
        $asistencia_no = $this->UsuarioModel->where(['id_rendicion' => $id_rendicion, 'asistencia' => 'no'])->countAllResults();
        $sexo_m = $this->UsuarioModel->where(['id_rendicion' => $id_rendicion, 'sexo' => 'm'])->countAllResults();
        $sexo_f = $this->UsuarioModel->where(['id_rendicion' => $id_rendicion, 'sexo' => 'f'])->countAllResults();

        // Agregar preguntas a cada usuario (sin modificar por referencia)
        foreach ($usuarios as $key => $usuario) {
            $usuarios[$key]['preguntas'] = $this->PreguntaModel->where('id_usuario', $usuario['id_usuario'])->findAll();
        }

        // Inicializar la hoja de cálculo
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Reporte de Usuarios');

        // Encabezados de la tabla
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

        // Aplicar estilo a los encabezados
        $headerStyle = [
            'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
            'fill' => [
                'fillType'   => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FF4CAF50']
            ],
        ];
        $sheet->getStyle('A1:I1')->applyFromArray($headerStyle);

        // Rellenar datos de los usuarios
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

            // Concatenar preguntas, usando salto de línea y activando el ajuste de texto
            $preguntas = '';
            if (!empty($usuario['preguntas'])) {
                foreach ($usuario['preguntas'] as $pregunta) {
                    $preguntas .= $pregunta['contenido'] . "\n";
                }
            } else {
                $preguntas = 'No hay preguntas para este usuario.';
            }
            $sheet->setCellValue('I' . $row, $preguntas);
            $sheet->getStyle('I' . $row)->getAlignment()->setWrapText(true);
            $row++;
        }

        // Autoajustar ancho de columnas
        foreach (range('A', 'I') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Agregar estadísticas en columnas K y L
        $sheet->setCellValue('K1', 'Estadísticas');
        $sheet->setCellValue('K2', 'Asistencia Sí');
        $sheet->setCellValue('L2', $asistencia_si);
        $sheet->setCellValue('K3', 'Asistencia No');
        $sheet->setCellValue('L3', $asistencia_no);
        $sheet->setCellValue('K4', 'Sexo Masculino');
        $sheet->setCellValue('L4', $sexo_m);
        $sheet->setCellValue('K5', 'Sexo Femenino');
        $sheet->setCellValue('L5', $sexo_f);

        // Crear gráfico de asistencia (gráfico circular)
        $dataSeriesLabels = [
            new \PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues('String', 'Reporte de Usuarios!$K$2', null, 1),
            new \PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues('String', 'Reporte de Usuarios!$K$3', null, 1),
        ];
        $xAxisTickValues = [
            new \PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues('String', 'Reporte de Usuarios!$K$2:$K$3', null, 2),
        ];
        $dataSeriesValues = [
            new \PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues('Number', 'Reporte de Usuarios!$L$2:$L$3', null, 2),
        ];

        $series = new \PhpOffice\PhpSpreadsheet\Chart\DataSeries(
            \PhpOffice\PhpSpreadsheet\Chart\DataSeries::TYPE_PIECHART,
            null,
            range(0, count($dataSeriesValues) - 1),
            $dataSeriesLabels,
            $xAxisTickValues,
            $dataSeriesValues
        );

        $chart1 = new \PhpOffice\PhpSpreadsheet\Chart\Chart(
            'chart1',
            new \PhpOffice\PhpSpreadsheet\Chart\Title('Asistencia'),
            null,
            new \PhpOffice\PhpSpreadsheet\Chart\PlotArea(null, [$series])
        );
        $chart1->setTopLeftPosition('K7');
        $chart1->setBottomRightPosition('P20');
        $sheet->addChart($chart1);

        // Crear gráfico de sexo (gráfico circular)
        $dataSeriesLabels = [
            new \PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues('String', 'Reporte de Usuarios!$K$4', null, 1),
            new \PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues('String', 'Reporte de Usuarios!$K$5', null, 1),
        ];
        $xAxisTickValues = [
            new \PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues('String', 'Reporte de Usuarios!$K$4:$K$5', null, 2),
        ];
        $dataSeriesValues = [
            new \PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues('Number', 'Reporte de Usuarios!$L$4:$L$5', null, 2),
        ];

        $series = new \PhpOffice\PhpSpreadsheet\Chart\DataSeries(
            \PhpOffice\PhpSpreadsheet\Chart\DataSeries::TYPE_PIECHART,
            null,
            range(0, count($dataSeriesValues) - 1),
            $dataSeriesLabels,
            $xAxisTickValues,
            $dataSeriesValues
        );

        $chart2 = new \PhpOffice\PhpSpreadsheet\Chart\Chart(
            'chart2',
            new \PhpOffice\PhpSpreadsheet\Chart\Title('Sexo'),
            null,
            new \PhpOffice\PhpSpreadsheet\Chart\PlotArea(null, [$series])
        );
        $chart2->setTopLeftPosition('K21');
        $chart2->setBottomRightPosition('P34');
        $sheet->addChart($chart2);

        // Preparar y enviar el archivo Excel con gráficos
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->setIncludeCharts(true);

        // Generar nombre de archivo único usando fecha y hora
        $filename = 'reporte_usuarios_' . $id_rendicion . '_' . date('Ymd_His') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }
}
