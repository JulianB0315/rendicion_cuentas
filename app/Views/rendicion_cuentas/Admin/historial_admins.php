<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Historial de cambios - Administradores</title>
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
    <link rel="stylesheet" href="<?= base_url('rendicion_cuentas/styles/index.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('rendicion_cuentas/styles/client/conferencias.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('rendicion_cuentas/styles/admin/sort.css') ?>" />
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
    <header>
        <nav class="nav-header w-100 p-3">
            <div class="d-flex align-items-center logo-container">
                <img src="<?= base_url("img/logo.png") ?>" alt="Logo" class="nav-logo img-fluid">
            </div>
        </nav>
    </header>
    <section class="text-center mt-3">
        <h1 class="animate__animated animate__fadeInDown header-title">
            Historial de cambios - Administradores
        </h1>
    </section>
    <main class="container my-5">
        <div class="row">
            <div class="col-12">
                <table class="table table-ejes text-center">
                    <thead>
                        <tr>
                            <th scope="col">Administrador</th>
                            <th scope="col">Acción</th>
                            <th scope="col">Motivo</th>
                            <th scope="col">Realizado por</th>
                            <th scope="col">Fecha Modificación</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($historial as $registro) : ?>
                            <tr>
                                <td>
                                    <?= esc($registro['nombres_admin']) ?>
                                    <span class="badge bg-info"><?= esc($registro['categoria_admin']) ?></span>
                                </td>
                                <td>
                                    <span class="badge <?= get_badge_class($registro['accion']) ?>">
                                        <?= ucfirst(esc($registro['accion'])) ?>
                                    </span>
                                </td>
                                <td><?= esc($registro['motivo']) ?? '-' ?></td>
                                <td><?= esc($registro['realizado_por_nombre']) ?></td>
                                <td><?= formatear_fecha_esp($registro['fecha_accion']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>

</html>