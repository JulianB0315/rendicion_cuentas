<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registrar Asistencia</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Encode+Sans+Semi+Expanded:wght@100;200;300;400;500;600;700;800;900&family=Asap:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url("styles/form.css") ?>" />
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Registrar Asistencia</h1>
        <form action="<?= base_url('questions/search') ?>" method="post" class="mt-4">
            <div class="form-group">
                <label for="rendicion_date">Fecha de la Rendición:</label>
                <input type="date" class="form-control" id="rendicion_date" name="rendicion_date" required>
            </div>
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>

        <?php if (isset($ejes) && !empty($ejes)): ?>
            <div class="mt-5">
                <h2>Ejes de la Rendición</h2>
                <ul class="list-group">
                    <?php foreach ($ejes as $eje): ?>
                        <li class="list-group-item">
                            <?= $eje['nombre'] ?> - <?= count($eje['preguntas']) ?> preguntas
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="mt-5">
                <h2>Sorteo de Preguntas</h2>
                <form action="<?= base_url('questions/sort') ?>" method="post">
                    <div class="form-group">
                        <label for="cantidad_preguntas">Cantidad de Preguntas:</label>
                        <input type="number" class="form-control" id="cantidad_preguntas" name="cantidad_preguntas" required>
                    </div>
                    <button type="submit" class="btn btn-success">Sortear</button>
                </form>

                <?php if (isset($preguntas_sorteadas) && !empty($preguntas_sorteadas)): ?>
                    <div class="mt-4">
                        <h3>Preguntas Sorteadas</h3>
                        <ul class="list-group">
                            <?php foreach ($preguntas_sorteadas as $pregunta): ?>
                                <li class="list-group-item">
                                    <?= $pregunta['contenido'] ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>