<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Selección de Preguntas - <?= $eje['tematica'] ?></title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous" />
    <link
        rel="stylesheet"
        href="https://site-assets.fontawesome.com/releases/v6.7.2/css/all.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Encode+Sans+Semi+Expanded:wght@100;200;300;400;500;600;700;800;900&family=Asap:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?= RUTA_PUBLIC_CSS . 'index.css' ?>" />
    <link rel="stylesheet" href="<?= RUTA_CSS_ADMIN . 'sort.css' ?>" />
    <link rel="stylesheet" href="<?= RUTA_CSS_CLIENT . 'conferencias.css' ?>" />
    <link rel="stylesheet" href="<?= RUTA_CSS_CLIENT . 'form.css' ?>" />
</head>

<body>
    <header class="">
        <nav class="nav-header w-100 p-3">
            <div class="d-flex align-items-center logo-container">
                <a href="<?= RUTA_ADMIN_HOME ?>">
                    <img
                        src="<?= base_url('rendicion_cuentas/img/logo.png') ?>"
                        alt="Logo"
                        class="nav-logo img-fluid" />
                </a>
            </div>
        </nav>
    </header>
    <div class="container-fluid w-100 mb-3">
        <a href="<?= base_url('admin') ?>" class="btn ms-3"
            style="background-color: var(--primary-color); color: white; font-size: 1.2rem; padding: 0.5rem 1rem; border-radius: 5px; transition: background 0.2s, color 0.2s;"
            onmouseover="this.style.backgroundColor='var(--secondary-color)'; this.style.color='#fff';"
            onmouseout="this.style.backgroundColor='var(--primary-color)'; this.style.color='white';">
            <i class="fa-solid fa-arrow-left"></i>
            Volver
        </a>
    </div>
    <div class="container">
        <h1 class="animate__animated animate__fadeInDown header-title mb-5 text-center">Selección de Preguntas - <?= esc($eje['tematica']) ?></h1>

        <?php if (!empty($preguntas)): ?>
            <form action="<?= RUTA_ADMIN_PROCESAR_SELECCION ?>" method="post" id="form-preguntas">
                <input type="hidden" name="id_eje_seleccionado" value="<?= esc($id_eje_seleccionado) ?>">
                <input type="hidden" name="id_rendicion" value="<?= esc($eje['id']) ?>">

                <table class="table text-center table-ejes">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>DNI</th>
                            <th>RUC</th>
                            <th>Organización</th>
                            <th>Pregunta</th>
                            <th>Seleccionar</th>
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
                                <td>
                                    <div class="form-check d-flex justify-content-center align-items-center">
                                        <input class="form-check-input"
                                            type="checkbox"
                                            name="preguntas_seleccionadas[]"
                                            value="<?= esc($pregunta['id']) ?>"
                                            id="pregunta_<?= esc($pregunta['id']) ?>"
                                            <?= in_array($pregunta['id'], $ids_seleccionados) ? 'checked' : '' ?>>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="text-center my-4">
                    <button type="submit" class="btn btn-form">Guardar Selección</button>
                </div>
            </form>
        <?php else: ?>
            <div class="alert alert-warning" id="warning-alert">
                <div class="alert-icon">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
                <div class="alert-content">
                    No se encontraron preguntas para este eje y rendición.
                </div>
            </div>
        <?php endif; ?>
    </div>

</body>

</html>