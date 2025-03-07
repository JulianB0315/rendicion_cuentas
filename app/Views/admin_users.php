<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Administración de Usuarios</title>
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
    <link rel="stylesheet" href="<?= base_url('styles/admin.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('styles/login.css') ?>" />
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
    <header class="container-fluid header p-3 mb-5">
        <nav class="nav-header container">
            <div class="d-flex align-items-center logo-container w-100 justify-content-between">
                <img
                    src="<?= base_url('img/logo.jpg') ?>"
                    alt="Logo"
                    class="nav-logo img-fluid" />
            </div>
        </nav>
    </header>

    <section class="text-center mt-3">
        <h1 class="animate__animated animate__fadeInDown header-title">
            Administración de Usuarios
        </h1>
    </section>

    <main class="container my-5">
        <div class="row">
            <div class="col-md-6 col-sm-12 mb-4">
                <form action="<?= base_url('admin/crear_admin') ?>" method="post" class="form-container">
                    <h4>Registrar Nuevo Administrador</h4>
                    <div class="mb-3 form-group text">
                        <input
                            type="text"
                            class="form-part"
                            id="dni-admin"
                            name="dni-admin"
                            placeholder=" "
                            required />
                        <label for="dni-admin" class="form-label">DNI</label>
                    </div>
                    <div class="mb-3 form-group text">
                        <input
                            type="text"
                            class="form-part"
                            id="name-admin"
                            name="name-admin"
                            placeholder=" "
                            readonly
                            required />
                        <label for="name-admin" class="form-label">Nombres</label>
                    </div>
                    <div class="form-group text">
                        <input
                            type="password"
                            class="form-part"
                            id="password"
                            name="password"
                            placeholder=" "
                            required />
                        <label for="password">Contraseña</label>
                        <button type="button" class="toggle-password" id="togglePassword">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                    </div>
                    <button
                        type="submit"
                        class="btn btn-form"
                        id="submit-button">
                        Registrar
                    </button>
                </form>
            </div>
            <div class="col-md-6 col-sm-12">
                <h4>Administradores Actuales</h4>
                <div class="table-responsive">
                    <?php if(isset($admins)): ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">DNI</th>
                                <th scope="col">Nombres</th>
                                <th scope="col">Categoría</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($admins as $admin): ?>
                            <tr>
                                <td><?= $admin['dni_admin'] ?></td>
                                <td><?= $admin['nombres_admin'] ?></td>
                                <td><?= $admin['categoria_admin'] ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php else:?>
                        <p>No hay administradores registrados</p>
                        <?php endif; ?>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>