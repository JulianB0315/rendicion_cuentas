<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?= base_url('procesar-formulario') ?>" method="post" class="container mt-5" style="max-width: 600px; margin: auto; background-color: #e9edf6; padding: 20px; border-radius: 10px; border: 2px solid #002F59;">
        <div class="form-group">
            <label for="numero" style="color: #000000; font-size: 1.2em;">DNI</label>
            <input type="text" class="form-control" name="numero" pattern="\d{8}" title="Por favor, ingresar bien su DNI" required style="background-color: transparent; border: none; border-bottom: 1px solid #000000; width: 100%; margin-top: 5px;">
        </div>
        <div class="form-group">
            <label for="nombre" style="color: #000000; font-size: 1.2em;">Nombres y Apellidos</label>
            <input type="text" class="form-control" name="nombre" pattern="[A-Za-z\s]+" title="Por favor, ingresar solo letras" required style="background-color: transparent; border: none; border-bottom: 1px solid #000000; width: 100%; margin-top: 5px;">
        </div>
        <div class="form-group">
            <label for="participacion" style="color: #000000; font-size: 1.2em;">Participación</label><br>
            <div class="form-check form-check-inline">
            <input type="radio" class="form-check-input" id="asistente" name="participacion" value="Asistente" required>
            <label class="form-check-label" for="asistente" style="color: #000000; font-size: 1.2em;">Asistente</label>
            </div>
            <div class="form-check form-check-inline">
            <input type="radio" class="form-check-input" id="orador" name="participacion" value="Orador" required>
            <label class="form-check-label" for="orador" style="color: #000000; font-size: 1.2em;">Orador</label>
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
            <div class="form-group">
                <label for="ruc" style="color: #000000; font-size: 1.2em;">Nº RUC</label>
                <input type="text" class="form-control" name="ruc" pattern="\d{11}" title="Por favor, ingresar un RUC válido" style="background-color: transparent; border: none; border-bottom: 1px solid #000000; width: 100%; margin-top: 5px;">
            </div>
            <div class="form-group">
                <label for="nombre_organizacion" style="color: #000000; font-size: 1.2em;">Nombre de la Organización</label>
                <input type="text" class="form-control" name="nombre_organizacion" maxlength="80" style="background-color: transparent; border: none; border-bottom: 1px solid #000000; width: 100%; margin-top: 5px;">
            </div>
            </div>
            <div class="form-group">
            <label for="eje" style="color: #000000; font-size: 1.2em;">EJE Tematico</label>
            <select name="eje" class="form-control" style="background-color: transparent; border: none; border-bottom: 1px solid #000000; width: 100%; margin-top: 5px;">
                <option value="" disabled selected>Seleccione un EJE Tematico</option>
                <option value="Seguridad Ciudadana">Seguridad Ciudadana</option>
                <option value="Limpieza Pública">Limpieza Pública</option>
                <option value="Infraestructura">Infraestructura</option>
                <option value="Programas Sociales">Programas Sociales</option>
                <option value="Institucionalidad">Institucionalidad</option>
            </select>
            </div>
            <div class="form-group">
            <label for="pregunta" style="color: #000000; font-size: 1.2em;">Pregunta</label>
                <input type="text" class="form-control" name="pregunta" pattern="[A-Za-z\s]{1,200}" title="Por favor, ingresar solo letras (máximo 200 caracteres)" style="background-color: transparent; border: none; border-bottom: 1px solid #000000; width: 100%; margin-top: 5px;">
            </div>
        </div>
            <button type="submit">enviar</button>
        </div>
    </form>
</body>
<script>
    document.getElementById('orador').addEventListener('change', function () {
        document.getElementById('orador-info').style.display = 'block';
    });
    document.getElementById('asistente').addEventListener('change', function () {
        document.getElementById('orador-info').style.display = 'none';
    });
    document.getElementById('organizacion').addEventListener('change', function () {
        document.getElementById('organizacion-info').style.display = 'block';
    });

    document.getElementById('personal').addEventListener('change', function () {
        document.getElementById('organizacion-info').style.display = 'none';
    });
</script>

</html>