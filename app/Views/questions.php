<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sorteo de Preguntas</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Encode+Sans+Semi+Expanded:wght@100;200;300;400;500;600;700;800;900&family=Asap:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url("styles/admin.css") ?>" />
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Sorteo de preguntas</h1>
        <form action="<?= base_url('questions/buscar_rendecion_admin') ?>" method="post" class="mt-4">
            <div class="form-group">
                <label for="id_rendicion">Fecha de la Rendición:</label>
                <select class="form-control" id="id_rendicion" name="id_rendicion" required>
                    <?php if (isset($rendiciones) && !empty($rendiciones)): ?>
                        <?php foreach ($rendiciones as $rendicion): ?>
                            <option value="<?= $rendicion['id_rendicion'] ?>"><?= $rendicion['fecha'] ?></option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="">No hay rendiciones disponibles</option>
                    <?php endif; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>
    </div>

    <?php if (isset($ejes) && !empty($ejes)): ?>
        <div class="mt-5">
            <h2>Ejes de la Rendición</h2>
            <ul class="list-group">
                <?php foreach ($ejes as $eje): ?>
                    <li class="list-group-item">
                        <?= $eje['tematica'] ?> - <?= $eje['cantidad_preguntas'] ?> preguntas
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="mt-5">
            <h2>Sorteo de Preguntas por cada eje</h2>
            <form action="<?= base_url('questions/sorteo_preguntas') ?>" method="post">
                <div class="form-group">
                    <label for="cantidad_preguntas">Cantidad de Preguntas:</label>
                    <input type="number" class="form-control" id="cantidad_preguntas" name="cantidad_preguntas" required>
                    <label for="id_rendicion">Fecha de la Rendición:</label>
                    <select class="form-control" id="id_rendicion" name="id_rendicion" required>
                        <?php if (isset($rendiciones) && !empty($rendiciones)): ?>
                            <?php foreach ($rendiciones as $rendicion): ?>
                                <option value="<?= $rendicion['id_rendicion'] ?>"><?= $rendicion['fecha'] ?></option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option value="">No hay rendiciones disponibles</option>
                        <?php endif; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Sortear</button>
            </form>
        </div>
    <?php endif; ?>

    <?php if (!empty($preguntas_sorteadas)): ?>
        <div class="mt-5">
            <h2>Preguntas Sorteadas</h2>
            <ul class="list-group">
                <?php foreach ($preguntas_sorteadas as $sorteo): ?>
                    <li class="list-group-item">
                        <strong>Usuario:</strong> <?= esc($sorteo['usuario']['nombres']) ?>
                        <ul>
                            <?php foreach ($sorteo['ejes'] as $eje): ?>
                                <h4 class="text-primary">Eje: <?= esc($eje['nombre']) ?></h4>
                                <?php foreach ($eje['preguntas'] as $pregunta): ?>
                                    <li><?= esc($pregunta['contenido']) ?></li>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php else: ?>
        <div class="alert alert-warning mt-5">No hay preguntas sorteadas.</div>
    <?php endif; ?>
    </div>
</body>

</html>