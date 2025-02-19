<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reporte de Usuarios</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Encode+Sans+Semi+Expanded:wght@100;200;300;400;500;600;700;800;900&family=Asap:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url("styles/report.css") ?>" />
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Reporte de Usuarios</h1>
        <div class="row">
            <div class="col-12 mb-4">
                <h3>Asistencia</h3>
                <p><strong>Asistieron:</strong> <?= $asistencia_si ?></p>
                <p><strong>No asistieron:</strong> <?= $asistencia_no ?></p>
                <a href="<?= base_url('viewReportController/generar_excel/' . $id_rendicion) ?>" class="btn btn-success">Descargar Excel</a>
            </div>
            <div class="col-12 mb-4">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>DNI</th>
                            <th>Nombre</th>
                            <th>Sexo</th>
                            <th>Tipo de Participación</th>
                            <th>Título</th>
                            <th>RUC</th>
                            <th>Nombre de la Organización</th>
                            <th>Asistencia</th>
                            <th>Pregunta</th>
                        </tr>
                    </thead>
                    <?php if (isset($usuarios) && !empty($usuarios)): ?>
                        <?php foreach ($usuarios as $usuario): ?>
                            <tbody>
                                <tr>
                                    <td><?= esc($usuario['DNI']) ?></td>
                                    <td><?= esc($usuario['nombres']) ?></td>
                                    <td><?= esc($usuario['sexo']) ?></td>
                                    <td><?= esc($usuario['tipo_participacion']) ?></td>
                                    <td><?= esc($usuario['titulo']) ?></td>
                                    <td><?= esc($usuario['ruc_empresa']) ?></td>
                                    <td><?= esc($usuario['nombre_empresa']) ?></td>
                                    <td><?= esc($usuario['asistencia']) ?></td>
                                    <td><?php if (!empty($usuario['preguntas'])): ?>
                                            <?php foreach ($usuario['preguntas'] as $pregunta): ?>
                                                <li><?= esc($pregunta['contenido']) ?></li>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <li>No hay preguntas para este usuario.</li>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            </tbody>
                        <?php endforeach; ?>
                </table>
            </div>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    No se encontraron usuarios.
                </div>
            </div>
        <?php endif; ?>
        </div>
    </div>
</body>

</html>