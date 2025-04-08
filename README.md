# Rendición de Cuentas

## Descripción del Proyecto

El proyecto **Rendición de Cuentas** es una plataforma web desarrollada en PHP utilizando el framework **CodeIgniter 4**. Su objetivo es facilitar la gestión y transparencia de las audiencias públicas de rendición de cuentas, permitiendo a los ciudadanos registrar su asistencia, realizar preguntas y consultar información relevante sobre las actividades municipales.

## Características Principales

- **Gestión de Audiencias:** Registro de fechas, horarios y banners de las audiencias públicas.
- **Registro de Asistencia:** Los ciudadanos pueden registrarse como asistentes u oradores.
- **Participación Ciudadana:** Los oradores pueden enviar preguntas relacionadas con ejes temáticos específicos.
- **Portal de Transparencia:** Consulta de informes y estadísticas de las audiencias realizadas.
- **Panel de Administración:** Gestión de usuarios, audiencias y ejes temáticos.

## Requisitos del Servidor

El proyecto requiere **PHP 8.1 o superior** con las siguientes extensiones habilitadas:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)
- [json](http://php.net/manual/en/json.installation.php) (habilitada por defecto)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) (para usar MySQL)
- [libcurl](http://php.net/manual/en/curl.requirements.php) (para la biblioteca HTTP\CURLRequest)

> **Nota:** Se recomienda actualizar a PHP 8.1 o superior, ya que las versiones anteriores han alcanzado su fin de vida útil.

## Instalación

1. Clona el repositorio:
   ```bash
   git clone https://github.com/tu-usuario/rendicion_cuentas.git
   ```
2. Configura el entorno:
   - Copia el archivo `.env.example` a `.env` y ajusta las configuraciones según tu entorno.
   - Configura la base de datos en el archivo `.env`.

3. Instala las dependencias:
   ```bash
   composer install
   ```

4. Ejecuta las migraciones:
   ```bash
   php spark migrate
   ```

5. Inicia el servidor de desarrollo:
   ```bash
   php spark serve
   ```

## Colaboradores

Agradecimientos especiales a los colaboradores de este proyecto:

- [JulianB0315](https://github.com/JulianB0315)
- [Diego17cp](https://github.com/Diego17cp)
- [JimmyDelaCruzvg](https://github.com/JimmyDelaCruzvg)