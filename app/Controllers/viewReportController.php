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
        $usuarios = $this->UsuarioModel->where('id_rendicion', $id_rendicion)->findAll();
        $asistencia_si = $this->UsuarioModel->where('id_rendicion', $id_rendicion)->where('asistencia', 'si')->countAllResults();
        $asistencia_no = $this->UsuarioModel->where('id_rendicion', $id_rendicion)->where('asistencia', 'no')->countAllResults();

        foreach ($usuarios as &$usuario) {
            $usuario['preguntas'] = $this->PreguntaModel->where('id_usuario', $usuario['id_usuario'])->findAll();
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Reporte de Usuarios');

        // Encabezados
        $sheet->setCellValue('A1', 'DNI');
        $sheet->setCellValue('B1', 'Nombre');
        $sheet->setCellValue('C1', 'Sexo');
        $sheet->setCellValue('D1', 'Tipo de Participación');
        $sheet->setCellValue('E1', 'Título');
        $sheet->setCellValue('F1', 'RUC');
        $sheet->setCellValue('G1', 'Nombre de la Organización');
        $sheet->setCellValue('H1', 'Asistencia');
        $sheet->setCellValue('I1', 'Preguntas');

        // Datos de los usuarios
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
            $preguntas = '';
            if (!empty($usuario['preguntas'])) {
                foreach ($usuario['preguntas'] as $pregunta) {
                    $preguntas .= $pregunta['contenido'] . "\n";
                }
            } else {
                $preguntas = 'No hay preguntas para este usuario.';
            }
            $sheet->setCellValue('I' . $row, $preguntas);
            $row++;
        }

        foreach (range('A', 'I') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Estadísticas
        $sheet->setCellValue('K1', 'Estadísticas');
        $sheet->setCellValue('K2', 'Total de Usuarios');
        $sheet->setCellValue('L2', count($usuarios));
        $sheet->setCellValue('K3', 'Asistencia Sí');
        $sheet->setCellValue('L3', $asistencia_si);
        $sheet->setCellValue('K4', 'Asistencia No');
        $sheet->setCellValue('L4', $asistencia_no);

        $writer = new Xlsx($spreadsheet);
        $filename = 'reporte_usuarios_' . $id_rendicion . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }
}