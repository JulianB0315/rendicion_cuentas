<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gestión de Ejes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
    <link rel="stylesheet" href="<?= RUTA_CSS_ADMIN . 'admin.css' ?>" />
    <link rel="stylesheet" href="<?= RUTA_CSS_CLIENT . 'dashboard.css' ?>" />
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
                                    <li><a href="<?= RUTA_ADMIN_BUSCAR_RENDICION ?>questions" class="dropdown-item">Seleccionar Preguntas</a></li>
                                    <li><a href="<?= RUTA_ADMIN_BUSCAR_RENDICION ?>viewQuestions" class="dropdown-item">Ver preguntas</a></li>
                                    <li><a href="<?= RUTA_ADMIN_BUSCAR_RENDICION ?>report" class="dropdown-item">Reportes</a></li>
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
    <section class="text-center mt-3">
        <h1 class="animate__animated animate__fadeInDown header-title">
            Gestión de Ejes
        </h1>
    </section>
    <main class="container my-5">
        <div class="row">
            <div class="col-md-6 col-sm-12 mb-5">
                <h4>Crear Nuevo Eje</h4>
                <form action="<?= RUTA_ADMIN_CREAR_EJE ?>" method="post" class="form-container">
                    <div class="form-group text">
                        <input
                            type="text"
                            class="form-part"
                            id="nombreEje"
                            name="nombreEje"
                            placeholder=" "
                            required />
                        <label for="nombreEje" class="">Tematica de eje</label>
                    </div>
                    <button type="submit" class="btn-form">
                        Crear Eje
                    </button>
                </form>
            </div>
            <div class="col-md-6 col-sm-12">
                <h4>Lista de Ejes</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Temática</th>
                            <th>Estado</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ejes as $eje): ?>
                            <tr>
                                <td><?= esc($eje['tematica']) ?></td>
                                <td>
                                    <?php if ($eje['estado'] === 'habilitado'): ?>
                                        <span class="badge bg-success">Habilitado</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Deshabilitado</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <form action="<?= RUTA_ADMIN_EDITAR_EJE ?>" method="post" style="display:inline;">
                                        <input type="hidden" name="id_eje" value="<?= esc($eje['id']) ?>">
                                        <input type="hidden" name="estado" value="<?= $eje['estado'] === 'habilitado' ? 'deshabilitado' : 'habilitado' ?>">
                                        <button type="submit" class="btn btn-sm <?= $eje['estado'] === 'habilitado' ? 'btn-danger' : 'btn-success' ?>">
                                            <?= $eje['estado'] === 'habilitado' ? 'Deshabilitar' : 'Habilitar' ?>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
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
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="<?= RUTA_JS_PUBLIC . 'alerts.js' ?>"></script>
</body>

</html>