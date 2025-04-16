<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mostrar preguntas</title>
    <link rel="shortcut icon" type="image/png" href="/favicon.ico" />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous" />
    <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.7.2/css/all.css" />
    <link rel="stylesheet" href="<?= base_url('rendicion_cuentas/styles/index.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('rendicion_cuentas/stylesadmin/questions.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('rendicion_cuentas/styles/client/conferencias.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('rendicion_cuentas/styles/admin/admin.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('rendicion_cuentas/styles/admin/sort.css') ?>" />
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
                    src="<?= base_url('img/logo.png') ?>"
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
                                        <p class="dropdown-item">Asistentes Totales: <?= $contador_asistencia ?></p>
                                    </li>
                                    <li>
                                        <p class="dropdown-item">Oradores Totales: <?= $contador_oradores?></p>
                                    </li>
                                    <li>
                                        <p class="dropdown-item">Asistentes Femeninos: <?= $contador_femenino?></p>
                                    </li>
                                    <li>
                                        <p class="dropdown-item">Asistentes Masculinos: <?= $contador_masculino?></p>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="container my-5">
        <div class="row d-flex justify-content-center align-items-center flex-direction-column">
            <h1 class="animate__animated animate__fadeInDown header-title text-center">Reporte Público</h1>
            <div class="col-md-6 col-sm-12 p-4">
                <form action="<?= base_url('usuarioQuestions/buscar_rendecion_admin') ?>" method="get" class="mt-2">
                    <div class="form-group">
                        <label for="id_rendicion">Fecha de la Rendición:</label>
                        <select class="form-select" id="id_rendicion" name="id_rendicion" required>
                            <option value="" disabled selected>
                                Seleccione una fecha de rendición
                            </option>
                            <?php if (isset($rendiciones) && !empty($rendiciones)): ?>
                                <?php
                                $rendicionesPerYear = [];
                                foreach ($rendiciones as $rendicion) {
                                    $year = date('Y', strtotime($rendicion['fecha']));
                                    $rendicionesPerYear[$year][] = $rendicion;
                                }
                                krsort($rendicionesPerYear);
                                foreach ($rendicionesPerYear as $year => $rendiciones): ?>
                                    <optgroup label="<?= $year ?>">
                                        <?php foreach ($rendiciones as $rendicion): ?>
                                            <option value="<?= $rendicion['id'] ?>"><?= formatear_fecha_esp(esc($rendicion['fecha'])) ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                <?php endforeach ?>
                            <?php else: ?>
                                <option value="">No hay rendiciones disponibles</option>
                            <?php endif; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-form">Buscar</button>
                </form>
            </div>
        </div>
        <div class="row mt-5">
            <h2 class="text-center">Usuarios y Preguntas</h2>
            <?php if (isset($usuarios) && !empty($usuarios)): ?>
                <table class="table table-ejes">
                    <thead>
                        <tr>
                            <th>Nombre Usuario</th>
                            <th>Organización</th>
                            <th>Pregunta</th>
                            <th>Eje</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuarios as $usuario): ?>
                            <tr>
                                <td><?= esc($usuario['nombres']) ?></td>
                                <td><?= esc($usuario['organizacion']) ?></td>
                                <td><?= esc($usuario['pregunta_contenido']) ?></td>
                                <td><?= esc($usuario['eje_tema']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-center">No hay usuarios disponibles</p>
            <?php endif; ?>
        </div>
    </div>
    ...

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>