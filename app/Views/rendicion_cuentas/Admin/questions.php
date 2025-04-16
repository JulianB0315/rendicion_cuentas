<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sorteo de Preguntas</title>
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
    <link rel="stylesheet" href="<?= base_url('rendicion_cuentas/styles/admin/questions.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('rendicion_cuentas/styles/admin/admin.css') ?>" />

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
                <a href="<?= RUTA_ADMIN_HOME ?>">
                    <img
                        src="<?= base_url('img/logo.png') ?>"
                        alt="Logo"
                        class="nav-logo img-fluid" />
                </a>
                <div class="links-container">
                    <ul class="list-unstyled d-flex align-items-center justify-content-evenly links-list">
                        <li>
                            <div class="dropdown">
                                <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Acciones
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="<?= RUTA_ADMIN_BUSCAR_RENDICION ?>questions" class="dropdown-item">Seleccionar Preguntas</a></li>
                                    <li><a href="<?= RUTA_ADMIN_BUSCAR_RENDICION ?>viewQuestions" class="dropdown-item">Ver preguntas</a></li>
                                    <li><a href="<?= RUTA_ADMIN_BUSCAR_RENDICION ?>report" class="dropdown-item">Reportes</a></li>
                                    <?php if (isset($categoria) && $categoria === 'super_admin'): ?>
                                        <li>
                                            <a href="<?= base_url('admin/admin_users') ?>" class="dropdown-item">Administrar Usuarios</a>
                                        </li>
                                        <li>
                                            <a
                                                class="dropdown-item"
                                                href="<?= RUTA_ADMIN_HISTORIAL ?>"
                                                title="Ver tu historial">
                                                Ver historial
                                            </a>

                                        </li>
                                    <?php endif; ?>
                                    <li>
                                        <a href="<?= base_url('logout') ?>" class="dropdown-item logout">Cerrar Sesión</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            </div>
        </nav>
    </header>
    <div class="container my-5">
        <div class="row d-flex justify-content-center align-items-center flex-direction-column">
            <h1 class="animate__animated animate__fadeInDown header-title text-center">Seleccionar preguntas</h1>
            <div class="col-md-6 col-sm-12 p-4">
                <form action="<?= base_url('admin/questions/buscar_rendecion_admin') ?>" method="get" class="mt-2">
                    <div class="form-group">
                        <label for="id">Fecha de la Rendición:</label>
                        <select class="form-select" id="id" name="id" required>
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
    </div>

    <?php if (isset($ejes) && !empty($ejes)): ?>
        <div class="container my-5">
            <div class="row d-flex justify-content-center align-items-center flex-direction-column">
                <h3 class="header-title text-center">Ejes de la Rendición</h3>
                <div class="col-md-6 col-sm-12 p-4">
                    <ul class="list-group">
                        <?php foreach ($ejes as $eje): ?>
                            <li class="list-group-item">
                                <form action="<?= base_url('admin/sorteo_preguntas/' . $eje['id']) ?>" method="get">
                                    <span class="eje-info">
                                        <?= $eje['tematica'] ?>
                                        <small class="text-muted">
                                            (<?= $eje['cantidad_preguntas'] ?> preguntas)
                                        </small>
                                    </span>
                                    <div class="form-controls">
                                        <input type="hidden" name="id_eje_seleccionado"
                                            value="<?= $eje['id'] ?>" />
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-random me-2"></i>Seleccionar
                                        </button>
                                    </div>
                                </form>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>