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
    <link rel="stylesheet" href="<?= base_url("styles/form.css") ?>" />
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
                <h4 class="header-welcome">Bienvenid@, <?= esc($nombre) ?></h4>
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
                <form action="<?= base_url('admin/crear_admin') ?>" method="get" class="form-container">
                    <h4>Registrar Nuevo Administrador</h4>
                    <div class="mb-3 form-group text">
                        <input
                            type="text"
                            class="form-part"
                            id="dni"
                            name="dni-admin"
                            placeholder=" "
                            required />
                        <label for="dni-admin" class="form-label">DNI</label>
                    </div>
                    <div class="error" id="dni-error"></div>
                    <div class="mb-3 form-group text">
                        <input
                            type="text"
                            class="form-part"
                            id="nombre"
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
                    <div class="form-group">
                        <label for="eje">Categoria</label>
                        <select
                            name="categoria"
                            class="form-part form-select"
                            id="eje-select">
                            <option value="" disabled selected>
                                Categoria de Admin
                            </option>
                            <option value="admin">
                                Admin
                            </option>
                            <option value="super_admin">
                                Super Admin
                            </option>
                        </select>
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
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <?php if (isset($admins) && !empty($admins)): ?>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">DNI</th>
                                            <th scope="col">Nombres</th>
                                            <th scope="col">Categoría</th>
                                            <th class="text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($admins as $admin): ?>
                                            <tr>
                                                <td><?= esc($admin['dni_admin']) ?></td>
                                                <td><?= esc($admin['nombres_admin']) ?></td>
                                                <td><?= esc($admin['categoria_admin']) ?></td>
                                                <td class="d-flex justify-content-around align-items-center flex-wrap">
                                                    <btn
                                                        onclick="toggleUpdatePassword('<?= esc($admin['dni_admin']) ?>')"
                                                        class="btn-action-admin update m-1">
                                                        <i class="fa-light fa-user-pen"></i>
                                                    </btn>
                                                    <btn
                                                        onclick="toggleDeleteAdmin('<?= esc($admin['dni_admin']) ?>')"
                                                        class="btn-action-admin delete m-1">
                                                        <i class="fa-light fa-user-times"></i>
                                                    </btn>
                                                </td>
                                            </tr>
                                            <tr id="update-password-<?= esc($admin['dni_admin']) ?>" class="d-none update-password-row">
                                                <td colspan="4">
                                                    <div class="d-flex justify-content-between align-items-center w-100 p-2">
                                                        <span class="me-3">Actualizar contraseña:</span>
                                                        <form action="<?= base_url('admin/editar_admin/' . $admin['dni_admin']) ?>" method="post" class="d-flex flex-grow-1">
                                                            <input type="password"
                                                                name="password"
                                                                class="form-control me-2 password-input"
                                                                placeholder="Nueva contraseña">
                                                            <button type="submit" class="btn btn-update">
                                                                <i class="fa-solid fa-pen-to-square"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="delete-<?= esc($admin['dni_admin']) ?>" class="delete-admin-row d-none">
                                                <td colspan="4">
                                                    <div class="d-flex justify-content-between align-items-center w-100 p-2">
                                                        <span class="me-3">¿Estás seguro de realizar esta acción?</span>
                                                        <form action="<?= base_url('admin/deshabilitar_admin/' . $admin['dni_admin']) ?>" method="get" class="d-flex gap-3">
                                                            <button type="button" class="btn btn-cancel" data-dni="<?= esc($admin['dni_admin']) ?>">
                                                                <i class="fa-solid fa-xmark-large"></i>
                                                            </button>
                                                            <button type="submit" class="btn btn-outline-danger btn-delete">
                                                                <i class="fa-solid fa-badge-check"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <p class="mt-3">No hay administradores registrados</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-12">
                        <h4>Buscar Administradores</h4>
                        <div class="d-flex justify-content-between align-items-center w-100 p-2">
                            <form action="<?= base_url('admin/buscar_admin/') ?>" method="get" class="d-flex flex-grow-1">
                                <input type="text"
                                    name="text"
                                    class="form-control me-2 dni-input"
                                    placeholder="Ingresar DNI"
                                    id="dni-input-search"
                                    required
                                >
                                <button type="submit" class="btn btn-search" id="btn-search">
                                    <i class="fa-solid fa-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('js/login.js') ?>"></script>
    <script src="<?= base_url('js/editAdmin.js') ?>"></script>
</body>

</html>