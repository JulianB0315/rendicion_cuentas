<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Asistencia</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Encode+Sans+Semi+Expanded:wght@100;200;300;400;500;600;700;800;900&family=Asap:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url("styles/form.css") ?>" />
</head>

<body>
    <header>
        <nav class="nav-header w-100 p-3">
            <div class="d-flex align-items-center logo-container">
                <img src="<?= base_url("img/escudo.webp") ?>" alt="Logo" class="nav-logo img-fluid">
            </div>
        </nav>
    </header>
    <section class="text-center my-4">
        <h2 class="animate__animated animate__fadeInDown header-title">
            Rendición de Cuentas - 2024 II
        </h2>
        <p class="animate__animated animate__fadeInUp header-date">
            Fecha: Viernes, 27 de Septiembre del 2025
        </p>
    </section>
    <main class="container main my-3">
        <div class="row">
            <div class="col-12">
                <form action="" class="form-container">
                    <div id="persona-info">
                        <div class="form-group text">
                            <input type="text" class="form-part" id="dni" name="dni" oninput="buscar_persona()" pattern="\d{8}" title="Por favor, ingresar bien su DNI" required placeholder=" ">
                            <label for="dni">DNI*</label>
                        </div>
                        <div class="form-group text">
                            <input type="text" class="form-part" id="nombre" name="nombre" title="Por favor, ingresar solo letras" placeholder=" " required disabled>
                            <label for="nombre">Nombres y Apellidos</label>
                        </div>
                        <div class="form-group">
                            <label class="d-block mb-3">Participación</label>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="asistente"
                                    name="participacion" value="Asistente" required>
                                <label class="form-check-label" for="asistente">Asistente</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="orador"
                                    name="participacion" value="Orador" required>
                                <label class="form-check-label" for="orador">Orador</label>
                            </div>
                        </div>
                    </div>
                    <div id="orador-info" style="display: none;">
                        <div class="form-group">
                            <label for="titular" style="color: #000000; font-size: 1.2em;">Su participación sera a titulo...</label><br>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="personal" name="titular" value="PERSONAL">
                                <label class="form-check-label" for="personal" style="color: #000000; font-size: 1.2em;">Personal</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="organizacion" name="titular" value="ORGANIZACION">
                                <label class="form-check-label" for="organizacion" style="color: #000000; font-size: 1.2em;">Organización</label>
                            </div>
                        </div>
                        <div id="organizacion-info" style="display: none;">
                            <div class="form-group text">
                                <input type="text" class="form-part" name="ruc" id="ruc" oninput="buscar_organizacion()" pattern="\d{11}" title="Por favor, ingresar un RUC válido" >
                                <label for="ruc">Nº RUC</label>
                            </div>
                            <div class="form-group text">
                                <input type="text" class="form-part" id="nombre-organizacion" name="nombre_organizacion" maxlength="80" readonly>
                                <label for="nombre_organizacion">Nombre de la Organización</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="eje">EJE Tematico</label>
                            <select name="eje" class="form-control" style="background-color: transparent; border: none; border-bottom: 1px solid #000000; width: 100%; margin-top: 5px;">
                                <option value="" disabled selected>Seleccione un EJE Tematico</option>
                                <option value="Seguridad Ciudadana">Seguridad Ciudadana</option>
                                <option value="Limpieza Pública">Limpieza Pública</option>
                                <option value="Infraestructura">Infraestructura</option>
                                <option value="Programas Sociales">Programas Sociales</option>
                                <option value="Institucionalidad">Institucionalidad</option>
                            </select>
                        </div>
                        <div class="form-group text">
                            <input type="text" class="form-part" name="pregunta" pattern="[A-Za-z\s]{1,200}" title="Por favor, ingresar solo letras (máximo 200 caracteres)">
                            <label for="pregunta">Pregunta</label>
                        </div>
                    </div>
                    <div id="submit-buttons">
                        <button type="submit" class="btn btn-form" id="submit-button" style="display: block;">Enviar</button>
                        <button type="button" class="btn btn-form" id="next-button" style="display: none;" disabled>Siguiente</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="<?= base_url("js/form.js") ?>"></script>
    </script>
</body>

</html>