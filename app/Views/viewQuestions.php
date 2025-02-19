<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mostrar preguntas seleccionadas</title>
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
    <link rel="stylesheet" href="<?= base_url('styles/questions.css') ?>" />
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
    <header class="">
        <nav class="nav-header w-100 p-3">
            <div class="d-flex align-items-center logo-container">
                <img
                    src="<?= base_url('img/escudo.webp') ?>"
                    alt="Logo"
                    class="nav-logo img-fluid" />
            </div>
        </nav>
    </header>
    <div class="container my-5">
        <div class="row d-flex justify-content-center align-items-center flex-direction-column">
            <h1 class="animate__animated animate__fadeInDown header-title text-center">Mostrar preguntas seleccionadas</h1>
            <div class="col-md-6 col-sm-12 p-4">
                <form action="<?= base_url('viewQuestions/buscar_rendecion_admin') ?>" method="post" class="mt-2">
                    <div class="form-group">
                        <label for="id_rendicion">Fecha de la Rendición:</label>
                        <select class="form-select" id="id_rendicion" name="id_rendicion" required>
                            <option value="" disabled selected>
                                Seleccione una fecha de rendición
                            </option>
                            <?php if (isset($rendiciones) && !empty($rendiciones)): ?>
                                <?php foreach ($rendiciones as $rendicion): ?>
                                    <option value="<?= $rendicion['id_rendicion'] ?>"><?=formatear_fecha_esp(esc($rendicion['fecha'])) ?></option>
                                <?php endforeach; ?>
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
                                <form action="<?= base_url('mostrar_preguntas_seleccionadas/' . $eje['id_eje_seleccionado']) ?>" method="post">
                                    <span class="eje-info">
                                        <?= $eje['tematica'] ?>
                                    </span>
                                    <div class="form-controls">
                                        <input type="hidden" name="id_eje_seleccionado"
                                            value="<?= $eje['id_eje_seleccionado'] ?>" />
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-question-circle me-2"></i>Mostrar preguntas seleccionadas
                                        </button>
                                    </div>
                                </form>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            </div>
</body>

</html>