<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
	<link rel="stylesheet" href="<?= base_url('styles/admin.css') ?>" />
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
					src="<?= base_url('img/logo.png') ?>"
					alt="Logo"
					class="nav-logo img-fluid" />
				<div class="links-container">
					<ul class="list-unstyled d-flex align-items-center justify-content-evenly links-list">
						<li>
							<div class="dropdown">
								<button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
									Acciones
								</button>
								<ul class="dropdown-menu">
									<li>
										<a href="<?= base_url('admin/questions/'.$ruta='questions') ?>" class="dropdown-item">Seleccionar Preguntas</a>
									</li>
									<li>
										<a href="<?= base_url('admin/viewQuestions/'.$ruta='viewQuestions') ?>" class="dropdown-item">Ver preguntas</a>
									</li>
									<li>
										<a href="<?= base_url('admin/report/'.$ruta='report') ?>" class="dropdown-item">Reportes</a>
									</li>
									<?php if ($categoria == 'super_admin'): ?>
										<li>
											<a href="<?= base_url('admin/admin_users') ?>" class="dropdown-item">Administrar Usuarios</a>
										</li>
									<?php endif; ?>
									<li>
										<a href="<?= base_url('logout') ?>" class="dropdown-item logout">Cerrar Sessión</a>
									</li>
								</ul>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</header>
	<section class="text-center mt-3">
		<h1 class="animate__animated animate__fadeInDown header-title">
			Administración de Rendiciones
		</h1>
	</section>
	<main class="container my-5">
		<div class="row">
			<div class="col-md-6 col-sm-12 mb-4">
				<form action="<?= base_url('admin/crear_rendicion') ?>" method="post" class="form-container" enctype="multipart/form-data">
					<h4>Registrar rendición</h4>
					<div class="mb-3 form-group text">
						<input
							type="date"
							class="form-part"
							id="fechaRendicion"
							name="fechaRendicion"
							value=""
							required />
						<label for="fechaRendicion" class="form-label">Fecha de Rendición</label>
					</div>
					<div class="mb-3 form-group text">
						<input
							type="time"
							class="form-part"
							id="horaRendicion"
							name="horaRendicion"
							value=""
							required />
						<label for="horaRendicion" class="form-label">Hora de Rendición</label>
					</div>
					<div class="mb-3 form-group">
						<label for="bannerRendicion" class="btn-banner">
							Seleccionar banner de rendición 
							<i class="fa-regular fa-image" style="margin-left: 7px; font-size: 1.3rem;"></i>
						</label>
						<input
							type="file"
							class="form-part"
							id="bannerRendicion"
							name="bannerRendicion"
							accept="image/*"
							hidden
							required />
					</div>
					<div class="" id="select-eje-container">
						<h4 class="mt-4 mb-3">Seleccionar ejes para la rendición</h4>
						<div id="ejes">
							<?php foreach ($ejes as $eje): ?>
								<div class="form-check">
									<input
										class="form-check-input"
										type="checkbox"
										id="eje_<?= esc($eje['id']) ?>"
										name="ejes[]"
										value="<?= esc($eje['id']) ?>" />
									<label
										class="form-check-label"
										for="eje_<?= esc($eje['id']) ?>">
										<?= esc($eje['tematica']) ?>
									</label>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
					<button type="submit" class="btn-form" id="btn-crear-rendicion">Registrar rendición</button>
				</form>
			</div>
			<div class="col-md-6 col-sm-12">
				<h4>Crear Nuevo Eje</h4>
				<form action="<?= base_url('admin/crear_eje') ?>" method="post" class="form-container">
					<div class="form-group text">
						<input
							type="text"
							class="form-part"
							id="nombreEje"
							name="nombreEje"
							placeholder=" "
							required />
						<label for="nombreEje" class="">Tematica de eje</label>
					</div>
					<button type="submit" class="btn-form">
						Crear Eje
					</button>
				</form>
			</div>
		</div>
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
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<script src="<?= base_url('js/admin.js') ?>"></script>
	<script src="<?= base_url('js/alerts.js') ?>"></script>
</body>

</html>