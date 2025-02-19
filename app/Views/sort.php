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
        <h1 class="text-center">Sorteo de Preguntas - <?= esc($eje['tematica']) ?></h1>

        <?php if (!empty($preguntas)): ?>
            <form action="<?= base_url('procesar_seleccion') ?>" method="post" id="form-preguntas">
                <input type="hidden" name="id_eje_seleccionado" value="<?= esc($id_eje_seleccionado) ?>">
                <input type="hidden" name="id_rendicion" value="<?= esc($id_rendicion) ?>">

                <div class="d-flex font-weight-bold border-bottom pb-2">
                    <div class="col">Nombre</div>
                    <div class="col">DNI</div>
                    <div class="col">RUC</div>
                    <div class="col">Organización</div>
                    <div class="col">Pregunta</div>
                    <div class="col">Seleccionar</div>
                </div>

                <?php foreach ($preguntas as $pregunta): ?>
                    <div class="d-flex align-items-center border-bottom py-2">
                        <div class="col"><?= esc($pregunta['nombres']) ?></div>
                        <div class="col"><?= esc($pregunta['DNI']) ?></div>
                        <div class="col"><?= esc($pregunta['ruc_empresa']) ?></div>
                        <div class="col"><?= esc($pregunta['nombre_empresa']) ?></div>
                        <div class="col"><?= esc($pregunta['contenido']) ?></div>
                        <div class="col">
                            <input type="checkbox"
                                name="preguntas_seleccionadas[]"
                                value="<?= esc($pregunta['id_pregunta']) ?>"
                                id="pregunta_<?= esc($pregunta['id_pregunta']) ?>">
                        </div>
                    </div>
                <?php endforeach; ?>

                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-primary">Guardar Selección</button>
                </div>
            </form>
        <?php else: ?>
            <div class="alert alert-warning">No se encontraron preguntas para este eje y rendición.</div>
        <?php endif; ?>
    </div>

</body>

</html>