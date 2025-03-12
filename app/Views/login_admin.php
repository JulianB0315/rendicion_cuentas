<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registrar Asistencia</title>
    <link
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        rel="stylesheet" />
    <link
		rel="stylesheet"
	    href="https://site-assets.fontawesome.com/releases/v6.7.2/css/all.css"
	/>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Encode+Sans+Semi+Expanded:wght@100;200;300;400;500;600;700;800;900&family=Asap:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url("styles/index.css") ?>" />
    <link rel="stylesheet" href="<?= base_url("styles/form.css") ?>" />
    <link rel="stylesheet" href="<?= base_url("styles/login.css") ?>" />
</head>

<body>
    <header>
        <nav class="nav-header w-100 p-3">
            <div class="d-flex align-items-center logo-container">
                <img src="<?= base_url("img/logo.jpg") ?>" alt="Logo" class="nav-logo img-fluid">
            </div>
        </nav>
    </header>
    <section class="text-center my-4">
        <h2 class="animate__animated animate__fadeInDown header-title">
            Iniciar sesión como administrador
        </h2>
    </section>
    <main class="container main my-5">
        <div class="row">
            <div class="col-12">
                <form action="<?= base_url('session') ?>" method="post" class="form-container" id="form-registro">
                    <div id="admin-info">
                        <div class="form-group text">
                            <input
                                type="text"
                                class="form-part"
                                id="dni"
                                name="dni"
                                pattern="\d{8}"
                                title="Por favor, ingresar bien su DNI"
                                required
                                placeholder=" " />
                            <label for="dni">DNI*</label>
                        </div>
                        <div class="error" id="dni-error"></div>
                        <div class="form-group text">
                            <input
                                type="text"
                                class="form-part"
                                id="nombre"
                                name="nombre"
                                title="Por favor, ingresar solo letras"
                                placeholder=" "
                                required
                                readonly />
                            <label for="nombre">Nombres y Apellidos</label>
                        </div>
                        <div class="form-group text">
                            <input
                                type="password"
                                class="form-part"
                                id="password"
                                name="password"
                                placeholder=" "
                                minlength="8"
                                required />
                            <label for="password">Contraseña</label>
                            <button type="button" class="toggle-password" id="togglePassword">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </div>
                        <button
							type="submit"
							class="btn btn-form"
							id="submit-button"
						>
							Enviar
						</button>
                </form>
            </div>
        </div>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>
    </main>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="<?= base_url("js/login.js") ?>"></script>
</body>

</html>