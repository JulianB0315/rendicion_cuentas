<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reporte de Rendiciones</title>
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
    <link rel="stylesheet" href="<?= RUTA_CSS_CLIENT . 'dashboard.css' ?>" />
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
                                    <li><a href="<?= RUTA_ADMIN_BUSCAR_RENDICION ?>editarRendicion" class="dropdown-item">Editar Rendición</a></li>
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
    <div class="container my-5">
        <div class="row d-flex justify-content-center align-items-center flex-direction-column">
            <h1 class="animate__animated animate__fadeInDown header-title text-center">Reporte de Rendiciones</h1>
            <div class="col-md-6 col-sm-12 p-4">
                <form class="mt-2">
                    <div class="form-group">
                        <label for="id_rendicion">Fecha de la Rendición:</label>
                        <select class="form-select" id="id_rendicion" name="id_rendicion" required>
                            <option value="" disabled <?= empty($id_rendicion) ? 'selected' : '' ?>>
                                Seleccione una fecha de rendición
                            </option>
                            <?php
                            $rendicionesPerYear = [];
                            foreach ($rendiciones as $rendicion) {
                                $year = date('Y', strtotime($rendicion['fecha']));
                                $rendicionesPerYear[$year][] = $rendicion;
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="<?= RUTA_JS_HELPERS . 'appHelpers.js' ?>"></script>
    <script>
        initRendicionSelect({
            selectId: 'id_rendicion',
            paramName: 'id_rendicion',
            baseUrl: '<?= base_url('admin/mostrar_reporte') ?>',
            selectedId: '<?= isset($id_rendicion) ? $id_rendicion : '' ?>'
        });
    </script>
</body>

</html>