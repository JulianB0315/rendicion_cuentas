<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Conferencia del dia x</title>
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
    <link rel="stylesheet" href="<?= base_url('styles/conferencias.css') ?>" />
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
                <img
                    src="<?= base_url('img/escudo.webp') ?>"
                    alt="Logo"
                    class="nav-logo img-fluid" />
            </div>
        </nav>
    </header>
    <section class="text-center mt-3">
		<h1 class="animate__animated animate__fadeInDown header-title mb-4">
			<!-- TODO: esto debe obtenerse de la DB -->
            Conferencia I 2025
		</h1>
        <h5 class="animate__animated animate__fadeInDown header-subtitle">
            <!-- Traer de la DB -->
            Fecha: 2025-01-01
        </h5>
        <h5 class="animate__animated animate__fadeInDown header-subtitle">
            Hora: xx:xx
        </h5>
        <h5 class="animate__animated animate__fadeInDown header-subtitle">
            Lugar: Auditorio Municipal MDJLO
        </h5>
	</section>
    <main class="container mt-5">
        <h3 class="mx-5 main-title mb-4">Ejes Seleccionados:</h3>
        <table class="table text-center table-ejes">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Ver Preguntas</th>
                </tr>
            </thead>
            <tbody>
                <!-- Traer de la DB -->
                <tr>
                    <td>Nombre del Eje</td>
                    <td>Descripción del Eje</td>
                    <td>
                        <button class="btn-preguntas">
                            Preguntas <i class="fas fa-question"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>Nombre del Eje</td>
                    <td>Descripción del Eje</td>
                    <td>
                        <button class="btn-preguntas">
                            Preguntas <i class="fas fa-question"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>Nombre del Eje</td>
                    <td>Descripción del Eje</td>
                    <td>
                        <button class="btn-preguntas">
                            Preguntas <i class="fas fa-question"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>Nombre del Eje</td>
                    <td>Descripción del Eje</td>
                    <td>
                        <button class="btn-preguntas">
                            Preguntas <i class="fas fa-question"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </main>
</body>

</html>