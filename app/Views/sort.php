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
    <link rel="stylesheet" href="<?= base_url("styles/admin.css") ?>" />
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Sorteo de Preguntas - <?= $eje['tematica'] ?></h1>
        <form action="<?= base_url('questions/sorteo_preguntas/' . $id_eje_seleccionado) ?>" method="post" class="mt-4">
            <div class="form-group">
                <label for="cantidad_preguntas">Cantidad de Preguntas:</label>
                <input type="number" class="form-control" id="cantidad_preguntas" name="cantidad_preguntas" required>
            </div>
            <button type="submit" class="btn btn-primary">Sortear</button>
        </form>

        <?php if (isset($preguntas) && !empty($preguntas)): ?>
            <div class="mt-5">
                <h2>Preguntas</h2>
                <ul class="list-group">
                    <?php foreach ($preguntas as $pregunta): ?>
                        <li class="list-group-item"><?= $pregunta['contenido'] ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php else: ?>
            <div class="alert alert-warning mt-5">
                No se encontraron preguntas para este eje.
            </div>
        <?php endif; ?>
    </div>
</body>

</html>