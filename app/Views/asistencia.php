<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar Asistencia</title>
    <link
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        rel="stylesheet" />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Encode+Sans+Semi+Expanded:wght@100;200;300;400;500;600;700;800;900&family=Asap:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url("styles/index.css") ?>" />
    <link rel="stylesheet" href="<?= base_url("styles/asistencia.css") ?>" />
</head>

<body>
    <header>
        <nav class="nav-header w-100 p-3">
            <div class="d-flex align-items-center logo-container">
                <img src="<?= base_url("img/logo.jpg") ?>" alt="Logo" class="nav-logo img-fluid">
            </div>
        </nav>
    </header>
    <section class="text-center my-4">
        <h2 class="animate__animated animate__fadeInDown header-title">
            Rendición <?= $number ?> <?= $year ?>
        </h2>
        <p class="animate__animated animate__fadeInUp header-date">
            Fecha: <?= formatear_fecha_esp(esc($fecha)) ?>
        </p>
    </section>
    <main class="container main my-5">
        <div class="row">
            <div class="col-12">
                <form action="<?= base_url('/procesar_asistencia') ?>" method="post" class="form-container mb-4" id="form-asistencia">
                    <div id="">
                        <div class="form-group text">
                            <input
                                type="text"
                                class="form-part"
                                id="dni-asistencia"
                                name="dni"
                                pattern="\d{8}"
                                title="Por favor, ingresar bien su DNI"
                                required
                                placeholder=" " />
                            <label for="dni">DNI*</label>
                        </div>
                        <div class="error" id="error"></div>
                        <button
                            type="submit"
                            class="btn btn-form"
                            id="submit-asistencia"
                            style="display: block">
                            Marcar Asistencia
                        </button>
                </form>
            </div>
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
        </div>
    </main>
    <script src="<?= base_url('js/asistencia.js') ?>"></script>
</body>

</html>