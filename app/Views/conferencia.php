<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Conferencia del dia <?= date('d-m', strtotime(esc($fecha))) ?></title>
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
    <link rel="stylesheet" href="<?= base_url('styles/index.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('styles/dashboard.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('styles/conferencias.css') ?>" />

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
                    src="<?= base_url('img/escudo.webp') ?>"
                    alt="Logo"
                    class="nav-logo img-fluid" />
                <a href="<?= base_url('usuarioQuestions') ?>" class="text-white register-btn btn py-md-3 px-4 py-sm-2 btn-header-register">
                    Ver Reporte
                </a>
            </div>
        </nav>
    </header>
    <section class="text-center mt-3">
        <h1 class="animate__animated animate__fadeInDown header-title mb-4">
            Rendición <?= $number ?> <?= $year ?>
        </h1>
        <h5 class="animate__animated animate__fadeInDown header-subtitle">
            <!-- Traer de la DB -->
            Fecha: <?= $fecha ?>
        </h5>
        <h5 class="animate__animated animate__fadeInDown header-subtitle">
            Hora: <?= $hora_rendicion ?>
        </h5>
        <h5 class="animate__animated animate__fadeInDown header-subtitle">
            Lugar: Auditorio Municipal MDJLO
        </h5>
    </section>
    <main class="container mt-5">
        <h3 class="mx-5 main-title mb-4">Ejes Seleccionados:</h3>
        <table class="table text-center table-ejes">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Ver Preguntas</th>
                </tr>
            </thead>
            <tbody>
                <!-- Traer de la DB -->
                <?php foreach ($ejes as $eje): ?>
                    <tr>
                        <td><?= $eje['tematica'] ?></td>
                        <td>Descripción del eje <?= $eje['tematica'] ?></td>
                        <td>
                            <button class="btn btn-primary btn-preguntas"
                                data-id-eje="<?= $eje['id_eje'] ?>"
                                data-id-rendicion="<?= $id_rendicion ?>"
                                data-tematica="<?= $eje['tematica'] ?>">
                                Ver Preguntas
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="modal-pregunta" id="modal-pregunta">
            <div class="modal-content" id="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Preguntas Eje: <span id="eje-titulo"></span></h5>
                    <button class=" close" id="btn-close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="modal-list" id="preguntas-list">
                    </ul>
                </div>
            </div>
        </div>
    </main>
    <script src="<?= base_url('js/conferencias.js') ?>"></script>
</body>

</html>