<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reporte de Rendiciones</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Encode+Sans+Semi+Expanded:wght@100;200;300;400;500;600;700;800;900&family=Asap:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url("styles/report.css") ?>" />
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Reporte de Rendiciones</h1>
        <div class="row">
            <?php if (isset($rendiciones) && !empty($rendiciones)): ?>
            <?php foreach ($rendiciones as $rendicion): ?>
                <div class="col-12 mb-4">
                <form action="<?= base_url('mostrar_reporte/' . $rendicion['id_rendicion']) ?>" method="post">
                    <div class="card">
                    <div class="form-controls">
                        <input type="text" value="<?= $rendicion['id_rendicion'] ?>" hidden />
                        <h5 class="card-title">Fecha: <?= esc($rendicion['fecha']) ?></h5>
                        <button type="submit" class="btn btn-primary">
                        <i class="fas fa-question-circle me-2"></i> Mas información
                        </button>
                    </div>
                    </div>  
                </form>
                </div>
            <?php endforeach; ?>
            <?php else: ?>
            <div class="col-12">
                <div class="alert alert-warning text-center">
                No se encontraron rendiciones.
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>