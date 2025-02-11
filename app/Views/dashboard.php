<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Rendición de Cuentas</title>
    <!-- <meta name="description" content="The small framework with powerful features"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <!-- HEADER: MENU + HEROE SECTION -->
    <header class="container-fluid headertext-white p-3" style="background-color: #fff; box-shadow: 0px 0px 12px #333;">
        <nav class="w-100 h-100">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center w-100 flex-wrap">
                    <img class="navbar-brand img-fluid" src="https://www.munijlo.gob.pe/web/placeholders/logo_10_21.png"></img>
                    <a href="register" class="text-white register-btn btn my-sm-2 mx-sm-auto" style="background-color: #002F59;">Registra tu asistencia</a>
                </div>
            </div>
        </nav>
    </header>
    <main class="container-fluid w-100 vh-100 mt-3">
            <div class="row">
                <div class="col-12 d-flex justify-content-center align-items-center">
                    <img class="img-fluid w-70 w-xl-50" src="https://static.vecteezy.com/system/resources/thumbnails/001/820/662/small_2x/business-banner-template-simple-geometric-style-vector.jpg" alt="Rendición de Cuentas Banner"> 
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h2>Conferencia de Rendición de Cuentas</h2>
                    <p>Presentación de la info</p>
                </div>
                <div class="col-12">
                    <h2>Conferencias</h2>
                    <p>fechas</p>
                </div>
            </div>
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h2>¿Quieres unirte?</h2>
                            <p>Regístrate para participar en la conferencia</p>
                            <a href="<?= base_url('form') ?>" class="btn btn-primary">Ir al Formulario</a>
                        </div>
                    </div>
                </div>
            </section>
    </main>
    <!-- FOOTER: DEBUG INFO + COPYRIGHTS -->

    <footer>
        <div class="environment">

            <p>Page rendered in {elapsed_time} seconds using {memory_usage} MB of memory.</p>

            <p>Environment: <?= ENVIRONMENT ?></p>

        </div>

        <div class="copyrights">

            <p>&copy; <?= date('Y') ?> CodeIgniter Foundation. CodeIgniter is open source project released under the MIT
                open source licence.</p>

        </div>

    </footer>

    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- -->

</body>

</html>