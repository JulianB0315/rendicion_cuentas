<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8" />
	<title>Rendición de Cuentas</title>
	<!-- <meta name="description" content="The small framework with powerful features"> -->
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
	<link rel="stylesheet" href="<?= base_url('styles/dashboard.css') ?>" />
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
	<header class="container-fluid header p-3">
		<nav class="container">
			<div
				class="d-flex justify-content-between align-items-center w-100">
				<div
					class="d-flex align-items-center justify-content-center">
					<img
						class="navbar-brand img-fluid nav-logo"
						src="<?= base_url('img/logo.jpg') ?>" />
					<h3
						class="animate__animated animate__jackInTheBox titles nav-title d-flex flex-column">
						<span> Municipalidad Distrital de </span>
						<span> José Leonardo Ortiz </span>
					</h3>
				</div>
				<a
					href="<?= !empty($rendiciones) ? base_url('form') : '#' ?>"
					class="text-white register-btn btn p-md-3 p-sm-1 btn-header-register <?= empty($rendiciones) ? 'disabled' : '' ?>">
					Registra tu asistencia
				</a>
			</div>
		</nav>
	</header>

	<main class="container-fluid w-100 h-100 my-3">
		<div class="row">
			<div
				class="col-12 d-flex justify-content-center align-items-center">
				<img
					style="border-radius: 1rem;"
					class="img-fluid w-70 w-xl-50"
					src="<?= !empty($firstBanner) ? base_url('img/' . $firstBanner) : base_url('img/bannerstatic.jpg') ?>"
					alt="Rendición de Cuentas Banner" />
			</div>
		</div>
		<div class="row my-3">
			<div class="col-12 py-3 px-5 info-section">
				<h2 class="text-center my-3 titles">
					Conferencia de Rendición de Cuentas
				</h2>
				<p class="text-center">
					La Municipalidad Distrital de José Leonardo Ortiz te
					invita a nuestras Audiencias Públicas de Rendición de
					Cuentas. En cada sesión, que se celebra en nuestro
					Auditorio Municipal, donde presentamos personalmente los
					detalles de nuestra gestión.
				</p>
				<div class="row gap-3 gap-md-0 info-cards my-4">
					<div class="col-md-4 col-sm-12">
						<div class="card text-dark w-md-1 info-card">
							<div
								class="card-img-top d-flex justify-content-center align-items-center"
								style="min-height: 100px; max-height: 100px">
								<i
									class="fa-solid fa-people-group info-card-icon"></i>
							</div>
							<div class="card-body">
								<h5 class="card-title text-center titles">
									Participación Ciudadana
								</h5>
								<p class="card-text">
									Tu opinión es importante para nosotros.
									Participa activamente en nuestras
									Audiencias Públicas de Rendición de
									Cuentas.
								</p>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-12">
						<div class="card text-dark w-md-1 info-card">
							<div
								class="card-img-top d-flex justify-content-center align-items-center"
								style="min-height: 100px; max-height: 100px">
								<i
									class="fa-solid fa-handshake info-card-icon"></i>
							</div>
							<div class="card-body">
								<h5 class="card-title text-center titles">
									Transparencia
								</h5>
								<p class="card-text">
									Te presentamos los detalles de nuestra
									gestión: cómo utilizamos los recursos,
									los logros alcanzados y los desafíos que
									enfrentamos.
								</p>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-12">
						<div class="card text-dark w-md-1 info-card">
							<div
								class="card-img-top d-flex justify-content-center align-items-center"
								style="min-height: 100px; max-height: 100px">
								<i
									class="fa-solid fa-clipboard-list-check info-card-icon"></i>
							</div>
							<div class="card-body">
								<h5 class="card-title text-center titles">
									Informes Completos
								</h5>
								<p class="card-text">
									Consulta los informes completos en
									nuestro portal de transparencia. La
									información es un derecho de todos.
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 py-3 px-5 conferences-section mt-3">
				<h2 class="text-center my-2 fs-1 titles">Rendiciones de Cuentas</h2>
				<p class="fs-4 text-center">
					Las fechas de nuestras rendiciones de cuentas este año:
				</p>
				<div class="container mt-4">
					<?php if (!empty($rendiciones)): ?>
						<ul
							class="list-unstyled conferences-list d-flex flex-column justify-content-center align-items-center">
							<?php foreach ($rendiciones as $rendicion): ?>
								<li class="text-center d-flex justify-content-around align-items-center">
									<span>
										<?= formatear_fecha_esp(esc($rendicion['fecha']), 'dashboard') ?>
									</span>
									<a class="btn rounded-pill btn-conference" href="<?= base_url('conferencias/' . $rendicion['id']) ?>">
										<i class="fa-solid fa-arrow-right"></i>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php else: ?>
						<h3 class="text-center">
							No hay rendiciones programadas
						</h3>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<section class="py-5 text-dark">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-md-8 col-12 text-center">
						<h2 class="mb-4 fw-light titles">
							Sé parte del cambio
						</h2>
						<p class="mb-4 lead">
							Únete a nuestras conferencias y participa
							activamente en el desarrollo de nuestra ciudad.
							Tu opinión es importante para construir un mejor
							José Leonardo Ortiz.
						</p>
						<a
							href="<?= !empty($rendiciones) ? base_url('form') : '#' ?>"
							class="btn text-white btn-lg px-4 rounded-pill register-btn <?= empty($rendiciones) ? 'disabled' : '' ?> ">
							<i class="fa-solid fa-user-plus me-2"></i>
							Registrarme
						</a>
					</div>
				</div>
			</div>
		</section>
		<?php if (session()->getFlashdata('success')): ?>
			<div class="alert alert-success" id="success-alert">
				<div class="alert-icon">
					<i class="fa-solid fa-circle-check"></i>
				</div>
				<div class="alert-content">
					<?= session()->getFlashdata('success') ?>
				</div>
				<button type="button" class="close-alert">
					<i class="fa-solid fa-xmark"></i>
				</button>
			</div>
		<?php endif; ?>

		<?php if (session()->getFlashdata('error')): ?>
			<div class="alert alert-danger" id="error-alert">
				<div class="alert-icon">
					<i class="fa-solid fa-circle-x"></i>
				</div>
				<div class="alert-content">
					<?= session()->getFlashdata('error') ?>
				</div>
				<button type="button" class="close-alert">
					<i class="fa-solid fa-xmark"></i>
				</button>
			</div>
		<?php endif; ?>

		<?php if (session()->getFlashdata('warning')): ?>
			<div class="alert alert-warning" id="warning-alert">
				<div class="alert-icon">
					<i class="fa-solid fa-triangle-exclamation"></i>
				</div>
				<div class="alert-content">
					<?= session()->getFlashdata('warning') ?>
				</div>
				<button type="button" class="close-alert">
					<i class="fa-solid fa-xmark"></i>
				</button>
			</div>
		<?php endif; ?>
	</main>
	<footer
		class="container-fluid text-white"
		style="background-color: #002f59; padding: 20px 0">
		<div class="container">
			<div class="row justify-content-center align-items-start">
				<div class="col-md-4 col-sm-12 my-4">
					<h5 class="fs-2 mb-4 text-center titles">
						Redes Sociales:
					</h5>
					<ul class="socials-list list-unstyled text-center">
						<li>
							<a
								href="https://www.instagram.com/municipalidadjoseleonardoortiz"
								target="_blank"
								class="socials-link">
								<i class="fa-brands fa-instagram"></i>
								municipalidadjoseleonardoortiz
							</a>
						</li>
						<li>
							<a
								href="https://www.facebook.com/munijlo"
								target="_blank"
								class="socials-link">
								<i class="fa-brands fa-facebook"></i>
								munijlo
							</a>
						</li>
						<li>
							<a
								href="https://www.tiktok.com/@muni.jlo"
								target="_blank"
								class="socials-link">
								<i class="fa-brands fa-tiktok"></i> muni.jlo
							</a>
						</li>
					</ul>
				</div>
				<div class="col-md-4 col-sm-12 my-4">
					<h5 class="fs-2 text-center mb-3 titles">Sedes:</h5>
					<p class="px-3 place-text text-center">
						<i class="fa-solid fa-map-location-dot me-2"></i>
						<span>
							Sede central: Av. Sáenz Peña N.º 2151 - Urb.
							Latina - José Leonardo Ortiz - Chiclayo -
							Lambayeque - Perú
						</span>
					</p>
				</div>
				<div class="col-md-4 col-sm-12 my-4">
					<div class="text-center">
						<div class="mb-4">
							<h5 class="fs-2 mb-3 titles">
								Horario de Atención:
							</h5>
							<p class="mb-0">
								<i class="fa-solid fa-clock me-2"></i>
								Lunes a Viernes: 8:00 a.m - 4:00 p.m
							</p>
						</div>
						<div>
							<h5 class="fs-2 mb-3 titles">
								Horario de Mesa de Partes:
							</h5>
							<p class="mb-0">
								<i class="fa-solid fa-clock me-2"></i>
								Lunes a Viernes: 8:00 a.m - 4:00 p.m
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>

	<!-- SCRIPTS -->
	<script
		src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
		crossorigin="anonymous"></script>
	<script src="<?= base_url('js/dashboard.js') ?>"></script>
	<script src="<?= base_url('js/alerts.js') ?>"></script>
	<!-- -->
</body>

</html>