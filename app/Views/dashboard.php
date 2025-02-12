<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Rendición de Cuentas</title>
    <!-- <meta name="description" content="The small framework with powerful features"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/all.css">
    <link rel="stylesheet" href="<?= base_url('styles/index.css') ?>">
    <style>
        .card {
            transition: all .3s ease;
            cursor: pointer;
        }

        .card:hover {
            box-shadow: 0px 0px 12px #002F59;
        }

        /* TODO: */
        /* .card:not(:hover){
            box-shadow: none;
            
        } */
    </style>
</head>

<body>
    <header class="container-fluid header p-3">
        <nav class="container">
            <div class="d-flex justify-content-between align-items-center w-100">
                <img class="navbar-brand img-fluid h-sm-25"
                    src="https://www.munijlo.gob.pe/web/placeholders/logo_10_21.png">
                <a href="<?= base_url('form') ?>"
                    class="text-white register-btn btn"
                    style="background-color: #002F59;">
                    Registra tu asistencia
                </a>
            </div>
        </nav>
    </header>

    <main class="container-fluid w-100 h-100 my-3">
        <div class="row">
            <div class="col-12 d-flex justify-content-center align-items-center">
                <img class="img-fluid w-70 w-xl-50" src="https://static.vecteezy.com/system/resources/thumbnails/001/820/662/small_2x/business-banner-template-simple-geometric-style-vector.jpg" alt="Rendición de Cuentas Banner">
            </div>
        </div>
        <div class="row my-3">
            <div class="col-12 py-3 px-5" style="background-color: #2E8ACB; color: #fff; backdrop-filter: blur(20px);">
                <h2 class="mx-auto text-center my-3">Conferencia de Rendición de Cuentas</h2>
                <p class="text-center">La Municipalidad Distrital de José Leonardo Ortiz te invita a nuestras Audiencias Públicas de Rendición de Cuentas. En cada sesión, que se celebra en nuestro Auditorio Municipal, donde presentamos personalmente los detalles de nuestra gestión.</p>
                <div class="row gap-3 gap-md-0 info-cards">
                    <div class="col-md-4 col-sm-12">
                        <div class="card text-dark w-md-1 info-card" style="max-height: 400px; max-height: 400px;">
                            <div class="card-img-top d-flex justify-content-center align-items-center" style="min-height: 100px; max-height: 100px;">
                                <i class="fa-solid fa-people-group" style="color: #002F59; font-size: 4rem;"></i>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title text-center">Participación Ciudadana</h5>
                                <p class="card-text">Tu opinión es importante para nosotros. Participa activamente en nuestras Audiencias Públicas de Rendición de Cuentas.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="card text-dark w-md-1 info-card" style="max-height: 400px; max-height: 400px;">
                            <div class="card-img-top d-flex justify-content-center align-items-center" style="min-height: 100px; max-height: 100px;">
                                <i class="fa-solid fa-handshake" style="color: #002F59; font-size: 4rem;"></i>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title text-center">Transparencia</h5>
                                <p class="card-text">Te presentamos los detalles de nuestra gestión: cómo utilizamos los recursos, los logros alcanzados y los desafíos que enfrentamos.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="card text-dark w-md-1 info-card" style="max-height: 400px; max-height: 400px;">
                            <div class="card-img-top d-flex justify-content-center align-items-center" style="min-height: 100px; max-height: 100px;">
                                <i class="fa-solid fa-clipboard-list-check" style="color: #002F59; font-size: 4rem;"></i>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title text-center">Informes Completos</h5>
                                <p class="card-text">Consulta los informes completos en nuestro portal de transparencia. La información es un derecho de todos.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <h2>Conferencias</h2>
                <p>Las fechas de nuestras conferencias este año:</p>
                <!-- recorrer las fechas de la DB y mostrarlas con un boton  -->
                <!-- Placeholder: -->
                <div class="container">
                    <ul>
                        <li>Conferencia 1: 15 de Agosto <button><i class="fa-solid fa-arrow-right"></i></button></li>
                        <li>Conferencia 2: 15 de Setiembre <button><i class="fa-solid fa-arrow-right"></i></button></li>
                    </ul>
                </div>
            </div>
        </div>
        <section class="py-5 text-dark">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-12 text-center">
                        <h2 class="mb-4 fw-light">Sé parte del cambio</h2>
                        <p class="mb-4 lead">Únete a nuestras conferencias y participa activamente en el desarrollo de nuestra ciudad. Tu opinión es importante para construir un mejor José Leonardo Ortiz.</p>
                        <a href="<?= base_url('form') ?>" class="btn text-white btn-lg px-4 rounded-pill" style="background-color: #002F59;">
                            <i class="fa-solid fa-user-plus me-2"></i>
                            Registrarme
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer class="container-fluid text-white" style="background-color: #002F59; padding: 20px 0;">
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center gap-2 gap-md-0">
                <div class="col-md-4 col-sm-12 text-center text-md-start mb-4">
                    <h5>Redes Sociales:</h5>
                    <ul class="list-unstyled">
                        <li>
                            <a href="https://www.instagram.com/municipalidadjoseleonardoortiz" class="text-white">
                                <i class="fa-brands fa-instagram"></i> municipalidadjoseleonardoortiz
                            </a>
                        </li>
                        <li>
                            <a href="https://www.facebook.com/munijlo" class="text-white">
                                <i class="fa-brands fa-facebook"></i> munijlo
                            </a>
                        </li>
                        <li>
                            <a href="https://www.tiktok.com/@muni.jlo" class="text-white">
                                <i class="fa-brands fa-tiktok"></i> muni.jlo
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4 col-sm-12 text-center text-md-start mb-4">
                    <h5>Sedes:</h5>
                    <p>
                        <i class="fa-solid fa-map-location-dot"></i>
                        Sede central: Av. Sáenz Peña N.º 2151 - Urb. Latina - José Leonardo Ortiz - Chiclayo - Lambayeque - Perú
                    </p>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="row gap-3">
                        <div class="col-12 col-md-6 text-center text-md-start">
                            <h5>Horario de Atención:</h5>
                            <p><i class="fa-solid fa-clock"></i> Lunes a Viernes: 8:00 a.m - 4:00 p.m</p>
                        </div>
                        <div class="col-12 col-md-6 text-center text-md-start">
                            <h5>Horario de Mesa de Partes:</h5>
                            <p><i class="fa-solid fa-clock"></i> Lunes a Viernes: 8:00 a.m - 4:00 p.m</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- -->

</body>

</html>