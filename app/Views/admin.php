<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Rendiciones</title>
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
    <link rel="stylesheet" href="<?= base_url('styles/index.css') ?>" />
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
                <img src="<?= base_url('img/escudo.webp') ?>" alt="Logo" class="nav-logo img-fluid">
            </div>
        </nav>
    </header>
    <section class="text-center my-4">
        <h2 class="animate__animated animate__fadeInDown header-title">
            Administración de Rendiciones
        </h2>
    </section>
    <main class="container main my-5">
        <form>
            <div class="mb-3">
                <label for="fechaRendicion" class="form-label">Fecha de Rendición</label>
                <input type="date" class="form-control" id="fechaRendicion" name="fechaRendicion" required>
            </div>
            <div class="mb-3">
                <label for="ejes" class="form-label">Seleccionar Ejes</label>
                <div id="ejes">
                    <?php foreach ($ejes as $eje): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="eje_<?= esc($eje['id_eje']) ?>" name="ejes[]" value="<?= esc($eje['id_eje']) ?>">
                            <label class="form-check-label" for="eje_<?= esc($eje['id_eje']) ?>">
                                <?= esc($eje['tematica']) ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Crear</button>
        </form>
        <div class="mt-5">
            <h3>Administrar Ejes</h3>
            <ul class="list-group">
                <?php foreach ($ejes as $eje): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?= $eje['tematica'] ?>
                        <div>
                            <button class="btn btn-danger btn-sm">Borrar</button>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div class="mt-4">
                <h4>Crear Nuevo Eje</h4>
                <form action="<?= base_url('/crear_eje') ?>" method="post">
                    <div class="mb-3">
                        <label for="nombreEje" class="form-label">Tematica de eje</label>
                        <input type="text" class="form-control" id="nombreEje" name="nombreEje" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Crear Eje</button>
                </form>
            </div>
        </div>
    </main>
</body>

</html>