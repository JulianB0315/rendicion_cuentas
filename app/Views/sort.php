<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sorteo de Preguntas - <?= $eje['tematica'] ?></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Encode+Sans+Semi+Expanded:wght@100;200;300;400;500;600;700;800;900&family=Asap:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url("styles/index.css") ?>" />
    <link rel="stylesheet" href="<?= base_url("styles/conferencias.css") ?>" />
    <link rel="stylesheet" href="<?= base_url("styles/form.css") ?>" />
    <link rel="stylesheet" href="<?= base_url("styles/sort.css") ?>" />
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
    <div class="container mt-5">
        <h1 class="animate__animated animate__fadeInDown header-title text-center">Sorteo de Preguntas - <?= $eje['tematica'] ?></h1>
        <!-- aqui iba el formulario innecesario xd -->

        <?php if (isset($preguntas) && !empty($preguntas)): ?>
            <div class="mt-5">
                <h2 class="header-subtitle">Preguntas</h2>
                <form action="<?= base_url('procesar_seleccion') ?>" method="post" id="form-preguntas">
                    <input type="hidden" name="id_eje_seleccionado" value="<?= $id_eje_seleccionado ?>">
                    <table class="table text-center table-ejes">
                        <thead>
                            <tr>
                                <th>Pregunta</th>
                                <th class="text-center">Selección</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- TODO: ARREGLAR QUE LOS CHECKBOX NO SE PUEDEN MARCAR COMO CHECK LOL -->
                            <?php foreach ($preguntas as $pregunta): ?>
                                <tr>
                                    <td><?= $pregunta['contenido'] ?></td>
                                    <td class="text-center">
                                        <div class="form-check">
                                            <input class="form-check-input"
                                                type="checkbox"
                                                name="preguntas_seleccionadas[]"
                                                value="<?= $pregunta['id_pregunta'] ?>"
                                                id="pregunta_<?= $pregunta['id_pregunta'] ?>">
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="text-center mb-3">
                        <button type="submit" class="btn btn-form">
                            Guardar Selección
                        </button>
                    </div>
                </form>
            </div>
        <?php else: ?>
            <div class="alert alert-warning mt-5">
                No se encontraron preguntas para este eje.
            </div>
        <?php endif; ?>
    </div>
</body>

</html>