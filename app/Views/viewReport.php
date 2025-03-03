<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reporte de Usuarios</title>
    <link rel="shortcut icon" type="image/png" href="/favicon.ico" />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous" />
    <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.7.2/css/all.css" />
    <link rel="stylesheet" href="<?= base_url('styles/index.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('styles/conferencias.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('styles/admin.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('styles/view-report.css') ?>" />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Encode+Sans+Semi+Expanded:wght@100;200;300;400;500;600;700;800;900&family=Asap:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet" />
</head>

<body>
    <header class="container-fluid header p-3 mb-5">
        <nav class="nav-header container">
            <div class="d-flex align-items-center logo-container w-100 justify-content-between">
                <img
                    src="<?= base_url('img/logo.jpg') ?>"
                    alt="Logo"
                    class="nav-logo img-fluid" />
                <div class="links-container">
                    <ul class="list-unstyled d-flex align-items-center justify-content-evenly links-list">
                        <li>
                            <div class="dropdown">
                                <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Asistencia
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <p class="dropdown-item"><strong class="me-3">Asistieron:</strong> <?= $asistencia_si ?></p>
                                    </li>
                                    <li>
                                        <p class="dropdown-item"><strong class="me-3">No asistieron:</strong> <?= $asistencia_no ?></p>
                                    </li>
                                    <li>
                                        <a href="<?= base_url('viewReportController/generar_excel/' . $id_rendicion) ?>" class="btn btn-success text-center w-100">
                                            Descargar Excel <i class="fa-solid fa-file-excel" style="margin-left: .6rem;"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="container my-4">
        <h1 class="animate__animated animate__fadeInDown header-title text-center">Reporte de Usuarios</h1>
        <div class="row">
            <div class="col-12 mb-4">
                <?php if (isset($usuarios) && !empty($usuarios)): ?>
                    <table class="table text-center table-ejes">
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
                                <th>Eje</th>
                                <th>Pregunta</th>
                            </tr>
                        </thead>
                        <?php foreach ($usuarios as $usuario): ?>
                            <tbody>
                                <?php if (!empty($usuario['preguntas'])): ?>
                                    <?php foreach ($usuario['preguntas'] as $pregunta): ?>
                                        <tr>
                                            <td><?= esc($usuario['DNI']) ?></td>
                                            <td><?= esc($usuario['nombres']) ?></td>
                                            <td><?= esc($usuario['sexo']) ?></td>
                                            <td><?= esc($usuario['tipo_participacion']) ?></td>
                                            <td><?= esc($usuario['titulo']) ?></td>
                                            <td><?= esc($usuario['ruc_empresa']) ?></td>
                                            <td><?= esc($usuario['nombre_empresa']) ?></td>
                                            <td><?= esc($usuario['asistencia']) ?></td>
                                            <td><?= esc($pregunta['tematica']) ?></td>
                                            <td class="pregunta-container">
                                                <button class="btn btn-form btn-pregunta" data-pregunta="<?= esc($pregunta['contenido']) ?>">
                                                    Ver Pregunta
                                                </button>
                                                <div class="pregunta-content">
                                                    <?= esc($pregunta['contenido']) ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td><?= esc($usuario['DNI']) ?></td>
                                        <td><?= esc($usuario['nombres']) ?></td>
                                        <td><?= esc($usuario['sexo']) ?></td>
                                        <td><?= esc($usuario['tipo_participacion']) ?></td>
                                        <td><?= esc($usuario['titulo']) ?></td>
                                        <td><?= esc($usuario['ruc_empresa']) ?></td>
                                        <td><?= esc($usuario['nombre_empresa']) ?></td>
                                        <td><?= esc($usuario['asistencia']) ?></td>
                                        <td><span class="text-muted">Sin eje asignado</span></td>
                                        <td><span class="text-muted">Sin preguntas</span></td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        <?php endforeach; ?>
                    </table>
                <?php else: ?>
                    <div class="col-12 my-4">
                        <div class="alert alert-warning text-center">
                            No se encontraron usuarios.
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="<?= base_url('js/viewReport.js') ?>"></script>
</body>

</html>