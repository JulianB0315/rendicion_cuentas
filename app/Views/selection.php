<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Preguntas Selecionadas- <?= $eje['tematica'] ?></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Encode+Sans+Semi+Expanded:wght@100;200;300;400;500;600;700;800;900&family=Asap:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url("styles/index.css") ?>" />
    <link rel="stylesheet" href="<?= base_url("styles/conferencias.css") ?>" />
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
    <div class="container">
        <h1 class="animate__animated animate__fadeInDown header-title mb-5 text-center">Preguntas Seleccionadas - <?= esc($eje['tematica']) ?></h1>
        <?php if (!empty($preguntas)): ?>
            <table class="table text-center table-ejes">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>DNI</th>
                        <th>RUC</th>
                        <th>Organización</th>
                        <th>Pregunta</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($preguntas as $pregunta): ?>
                        <tr>
                            <td><?= esc($pregunta['nombres']) ?></td>
                            <td><?= esc($pregunta['DNI']) ?></td>
                            <td><?= esc($pregunta['ruc_empresa']) ?></td>
                            <td><?= esc($pregunta['nombre_empresa']) ?></td>
                            <td><?= esc($pregunta['contenido']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-warning">No se encontraron preguntas seleccionadas para este eje y rendición.</div>
        <?php endif; ?>
    </div>
</body>

</html>