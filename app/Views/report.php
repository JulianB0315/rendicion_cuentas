<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reporte de Rendiciones</title>
    <link rel="shortcut icon" type="image/png" href="/favicon.ico" />
		<link
			href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
			rel="stylesheet"
			integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
			crossorigin="anonymous"
		/>
		<link
			rel="stylesheet"
			href="https://site-assets.fontawesome.com/releases/v6.7.2/css/all.css"
		/>
		<link rel="stylesheet" href="<?= base_url('styles/index.css') ?>" />
		<link rel="stylesheet" href="<?= base_url('styles/dashboard.css') ?>" />
		<link
			rel="stylesheet"
			href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
		/>
		<link rel="preconnect" href="https://fonts.googleapis.com" />
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
		<link
			href="https://fonts.googleapis.com/css2?family=Encode+Sans+Semi+Expanded:wght@100;200;300;400;500;600;700;800;900&family=Asap:ital,wght@0,100..900;1,100..900&display=swap"
			rel="stylesheet"
		/>
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
    <div class="container my-5">
        <h1 class="animate__animated animate__fadeInDown header-title text-center">Reporte de Rendiciones</h1>
        <div class="row my-5">
            <?php if (isset($rendiciones) && !empty($rendiciones)): ?>
                <div class="col-12 mb-4">
                    <ul class="list-unstyled conferences-list d-flex flex-column justify-content-center align-items-center">
                        <?php foreach ($rendiciones as $rendicion): ?>
                            <li class="text-center d-flex justify-content-around align-items-center">
                                <form action="<?= base_url('mostrar_reporte/' . $rendicion['id_rendicion']) ?>" class="text-center d-flex justify-content-around align-items-center w-100" method="get">
                                    <input type="text" value="<?= $rendicion['id_rendicion'] ?>" hidden />
                                    <span><?= formatear_fecha_esp(esc($rendicion['fecha']), 'dashboard') ?></span>
                                    <button type="submit" class="btn rounded-pill btn-conference">
                                        <i class="fa-solid fa-arrow-right"></i>
                                    </button>
                                </form>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
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