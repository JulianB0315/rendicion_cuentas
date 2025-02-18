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
                        <form action="" method="post">
                            <?= $eje['tematica'] ?> - <?= $eje['cantidad_preguntas'] ?> preguntas
                            <input type="hidden" name="id_eje_seleccionado" value="<?= $eje['id_eje_seleccionado'] ?>" />
                            <input type="number" name="cantidad_preguntas" value="1" />
                            <button type="submit" class="btn btn-primary">Sortear preguntas</button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    </div>
</body>

</html>