<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Editar Rendición</title>
    <link rel="shortcut icon" type="image/png" href="/favicon.ico" />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous" />
    <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.7.2/css/all.css" />
    <link rel="stylesheet" href="<?= RUTA_PUBLIC_CSS . 'index.css' ?>" />
    <link rel="stylesheet" href="<?= RUTA_CSS_ADMIN . 'questions.css' ?>" />
    <link rel="stylesheet" href="<?= RUTA_CSS_ADMIN . 'admin.css' ?>" />
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
                        src="<?= base_url('rendicion_cuentas/img/logo.png') ?>"
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
                                    <li><a href="<?= RUTA_ADMIN_GESTION_EJES ?>" class="dropdown-item">Gestión de Ejes</a></li>
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
    <div class="container-fluid w-100 mb-3">
        <a href="<?= base_url('admin') ?>" class="btn ms-3"
            style="background-color: var(--primary-color); color: white; font-size: 1.2rem; padding: 0.5rem 1rem; border-radius: 5px; transition: background 0.2s, color 0.2s;"
            onmouseover="this.style.backgroundColor='var(--secondary-color)'; this.style.color='#fff';"
            onmouseout="this.style.backgroundColor='var(--primary-color)'; this.style.color='white';">
            <i class="fa-solid fa-arrow-left"></i>
            Volver
        </a>
    </div>
    <div class="container mt-5">
        <div class="row d-flex justify-content-center align-items-center flex-direction-column">
            <h1 class="animate__animated animate__fadeInDown header-title text-center">Editar Rendición</h1>
            <div class="col-md-6 col-sm-12 p-4">
                <form class="mt-2">
                    <div class="form-group">
                        <label for="id">Fecha de la Rendición:</label>
                        <select class="form-select" id="id" name="id" required>
                            <option value="" disabled <?= empty($id_rendicion) ? 'selected' : '' ?>>
                                Seleccione una fecha de rendición
                            </option>
                            <?php
                            $rendicionesPerYear = [];
                            foreach ($rendiciones as $rendicion_item) {
                                $year = date('Y', strtotime($rendicion_item['fecha']));
                                $rendicionesPerYear[$year][] = $rendicion_item;
                            }
                            krsort($rendicionesPerYear);
                            foreach ($rendicionesPerYear as $year => $rendiciones_year):
                                // Ordena por fecha descendente dentro del año
                                usort($rendiciones_year, function ($a, $b) {
                                    return strtotime($b['fecha']) <=> strtotime($a['fecha']);
                                });
                            ?>
                                <optgroup label="<?= $year ?>">
                                    <?php foreach ($rendiciones_year as $rendicion_item): ?>
                                        <option value="<?= $rendicion_item['id'] ?>" <?= (isset($id_rendicion) && $id_rendicion == $rendicion_item['id']) ? 'selected' : '' ?>>
                                            <?= formatear_fecha_esp(esc($rendicion_item['fecha'])) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </optgroup>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php if (isset($rendicion)): ?>
        <div class="container my-2">
            <div class="row d-flex justify-content-center align-items-center flex-direction-column">
                <div class="col-md-6 col-sm-12 p-4">
                    <form action="<?= RUTA_ADMIN_EDITAR_RENDICION ?>" method="post" class="form-container" enctype="multipart/form-data">
                        <input type="hidden" name="id_rendicion" value="<?= $rendicion['id'] ?>" />
                        <h4>Editar rendición</h4>
                        <div class="mb-3 form-group text">
                            <input
                                type="date"
                                class="form-part"
                                id="fechaRendicion"
                                name="fechaRendicion"
                                value="<?= $rendicion['fecha'] ?>"
                                required />
                            <label for="fechaRendicion" class="form-label">Fecha de Rendición</label>
                        </div>
                        <div class="mb-3 form-group text">
                            <input
                                type="time"
                                class="form-part"
                                id="horaRendicion"
                                name="horaRendicion"
                                value="<?= $rendicion['hora_rendicion'] ?>"
                                required />
                            <label for="horaRendicion" class="form-label">Hora de Rendición</label>
                        </div>
                        <div class="mb-3 form-group">
                            <label for="bannerRendicion" class="btn-banner">
                                Cambiar banner de rendición
                                <i class="fa-regular fa-image" style="margin-left: 7px; font-size: 1.3rem;"></i>
                            </label>
                            <input
                                type="file"
                                class="form-part"
                                id="bannerRendicion"
                                name="bannerRendicion"
                                accept="image/*"
                                hidden />
                        </div>
                        <div id="preview-container" class="mt-3 mb-3 <?= empty($rendicion['banner_rendicion']) ? 'd-none' : '' ?>">
                            <div class="preview-header d-flex justify-content-between align-items-center mb-2">
                                <span id="file-name" class="text-muted">
                                    <?= $rendicion['banner_rendicion'] ?> (Banner Actual)
                                </span>
                                <button type="button" id="cancel-image" class="btn btn-sm btn-danger" style="display: none;">
                                    <i class="fa-solid fa-xmark"></i> Cancelar
                                </button>
                            </div>
                            <div class="preview-image-container">
                                <img id="preview-image" src="<?= base_url('rendicion_cuentas/img/' . $rendicion['banner_rendicion']) ?>" alt="Banner actual" class="img-fluid" style="max-height: 200px; border-radius: 8px;">
                            </div>
                        </div>
                        <button type="submit" class="btn-form" id="btn-crear-rendicion">Confirmar edición</button>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success" id="success-alert">
            <div class="alert-icon">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <div class="alert-content">
                <?= session()->getFlashdata('success') ?>
            </div>
            <button type="button" class="close-alert">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger" id="error-alert">
            <div class="alert-icon">
                <i class="fa-solid fa-circle-x"></i>
            </div>
            <div class="alert-content">
                <?= session()->getFlashdata('error') ?>
            </div>
            <button type="button" class="close-alert">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('warning')): ?>
        <div class="alert alert-warning" id="warning-alert">
            <div class="alert-icon">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <div class="alert-content">
                <?= session()->getFlashdata('warning') ?>
            </div>
            <button type="button" class="close-alert">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    <?php endif; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="<?= RUTA_JS_HELPERS . 'appHelpers.js' ?>"></script>
    <script src="<?= RUTA_JS_ADMIN . 'editRendicion.js' ?>"></script>
    <script src="<?= RUTA_JS_PUBLIC . 'alerts.js' ?>"></script>
    <script>
        initRendicionSelect({
            selectId: 'id',
            paramName: 'id',
            baseUrl: '<?= base_url('admin/buscar_edit') ?>',
            selectedId: '<?= isset($id_rendicion) ? $id_rendicion : '' ?>'
        });
    </script>
</body>

</html>