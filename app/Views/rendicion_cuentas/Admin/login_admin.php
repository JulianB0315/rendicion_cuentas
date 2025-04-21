<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Iniciar Sesión</title>
    <link
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        rel="stylesheet" />
    <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.7.2/css/all.css" />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Encode+Sans+Semi+Expanded:wght@100;200;300;400;500;600;700;800;900&family=Asap:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url("rendicion_cuentas/styles/index.css") ?>" />
    <link rel="stylesheet" href="<?= base_url("rendicion_cuentas/styles/client/form.css") ?>" />
    <link rel="stylesheet" href="<?= base_url("rendicion_cuentas/styles/admin/login.css") ?>" />
</head>

<body>
    <header>
        <nav class="nav-header w-100 p-3">
            <div class="d-flex align-items-center logo-container">
                <img src="<?= base_url("rendicion_cuentas/img/logo.png") ?>" alt="Logo" class="nav-logo img-fluid">
            </div>
        </nav>
    </header>
    <section class="text-center my-4">
        <h2 class="animate__animated animate__fadeInDown header-title">
            Iniciar sesión como administrador
        </h2>
    </section>
    <main class="container main my-5">
        <div class="row">
            <div class="col-12">
                <form action="<?= RUTA_SESSION ?>" method="post" class="form-container" id="form-registro">
                    <div id="admin-info">
                        <div class="form-group text">
                            <input
                                type="text"
                                class="form-part"
                                id="dni"
                                name="dni"
                                maxlength="8"
                                title="Por favor, ingresar bien su DNI"
                                required
                                placeholder=" " />
                            <label for="dni">DNI*</label>
                        </div>
                        <div id="dni-loading" class="spinner-container d-none">
                            <div class="spinner-border text-primary spinner-sm" role="status">
                            </div>
                            <span class="ms-5">Consultando DNI...</span>
                        </div>
                        <div class="error" id="dni-error"></div>
                        <div class="form-group text">
                            <input
                                type="text"
                                class="form-part"
                                id="nombre"
                                name="nombre"
                                title="Por favor, ingresar solo letras"
                                placeholder=" "
                                required
                                readonly />
                            <label for="nombre">Nombres y Apellidos</label>
                        </div>
                        <div class="form-group text">
                            <input
                                type="password"
                                class="form-part"
                                id="password"
                                name="password"
                                placeholder=" "
                                minlength="8"
                                required />
                            <label for="password">Contraseña</label>
                            <button type="button" class="toggle-password" id="togglePassword">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </div>
                        <button
                            type="submit"
                            class="btn btn-form"
                            id="submit-button">
                            Enviar
                        </button>
                </form>
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

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="<?= base_url("rendicion_cuentas/js/helpers/appHelpers.js") ?>"></script>
    <script src="<?= base_url("rendicion_cuentas/js/admin/login.js") ?>"></script>
	<script src="<?= base_url('rendicion_cuentas/js/public/alerts.js') ?>"></script>
</body>

</html>