<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador - Visualización de Preguntas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 50%;
            margin: auto;
            margin-bottom: 20px;
            /* Agregado para separar los contenedores */
            border: 2px solid #002F59;
        }


        select,
        button,
        input {
            padding: 10px;
            margin: 10px;
            font-size: 16px;
            border-radius: 5px;
        }

        select,
        input {
            border: 1px solid #002F59;
            background-color: #ffffff;
        }

        button {
            background-color: #2E8ACB;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0DC1F2;
        }

        .ejes-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .eje-btn {
            padding: 10px 20px;
            background-color: #2E8ACB;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .eje-btn:hover {
            background-color: #0DC1F2;
        }

        h2,
        h3 {
            color: #002F59;
        }

        .pregunta {
            background-color: #f2f2f2;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            border-left: 5px solid #002F59;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Filtrar Preguntas</h2>
        <label for="year">Selecciona el Año:</label>
        <select id="year">
            <option value="2023">2023</option>
            <option value="2024">2024</option>
        </select>
        <label for="month">Selecciona el Mes:</label>
        <select id="month">
            <option value="mayo">Mayo</option>
            <option value="septiembre">Septiembre</option>
        </select>
        <h3>Selecciona el Eje Temático:</h3>
        <div class="ejes-container">
            <button class="eje-btn" onclick="fetchData('Seguridad Ciudadana')">Seguridad Ciudadana</button>
            <button class="eje-btn" onclick="fetchData('Limpieza Pública')">Limpieza Pública</button>
            <button class="eje-btn" onclick="fetchData('Infraestructura')">Infraestructura</button>
            <button class="eje-btn" onclick="fetchData('Programas Sociales')">Programas Sociales</button>
            <button class="eje-btn" onclick="fetchData('Institucionalidad')">Institucionalidad</button>
        </div>
        <h3>Preguntas Realizadas</h3>
        <div id="results">
            <p>Selecciona un eje temático para ver las preguntas.</p>
        </div>
    </div>

    <script>
        // Array simulado con preguntas para cada eje, año y mes
        const preguntasDatabase = {
            "2023": {
                "mayo": {
                    "Seguridad Ciudadana": ["Pregunta 1 de Seguridad Ciudadana", "Pregunta 2 de Seguridad Ciudadana"],
                    "Limpieza Pública": ["Pregunta 1 de Limpieza Pública", "Pregunta 2 de Limpieza Pública"]
                },
                "septiembre": {
                    "Seguridad Ciudadana": ["Pregunta 1 de Seguridad Ciudadana en Septiembre", "Pregunta 2 de Seguridad Ciudadana en Septiembre"],
                    "Infraestructura": ["Pregunta 1 de Infraestructura", "Pregunta 2 de Infraestructura"]
                }
            },
            "2024": {
                "mayo": {
                    "Programas Sociales": ["Pregunta 1 de Programas Sociales", "Pregunta 2 de Programas Sociales"],
                    "Institucionalidad": ["Pregunta 1 de Institucionalidad", "Pregunta 2 de Institucionalidad"]
                },
                "septiembre": {
                    "Infraestructura": ["Pregunta 1 de Infraestructura en Septiembre", "Pregunta 2 de Infraestructura en Septiembre"],
                    "Seguridad Ciudadana": ["Pregunta 1 de Seguridad Ciudadana en 2024", "Pregunta 2 de Seguridad Ciudadana en 2024"]
                }
            }
        };

        function fetchData(eje) {
            // Obtener los valores seleccionados para el año, mes y eje temático
            let year = document.getElementById("year").value;
            let month = document.getElementById("month").value;

            // Mostrar las preguntas de acuerdo a la selección
            let resultsContainer = document.getElementById("results");
            resultsContainer.innerHTML = ""; // Limpiar el contenedor antes de mostrar las preguntas

            // Simulación de la consulta a la base de datos
            // Aquí va la conexión a la base de datos y la consulta para obtener las preguntas.
            // Ejemplo: SELECT * FROM preguntas WHERE año = year AND mes = month AND eje = eje;
            // Se debe usar el array `preguntasDatabase` para simular lo siguiente:

            if (preguntasDatabase[year] && preguntasDatabase[year][month] && preguntasDatabase[year][month][eje]) {
                let preguntas = preguntasDatabase[year][month][eje];
                preguntas.forEach((pregunta) => {
                    let div = document.createElement("div");
                    div.className = "pregunta";
                    div.textContent = pregunta;
                    resultsContainer.appendChild(div);
                });
            } else {
                resultsContainer.innerHTML = "<p>No se encontraron preguntas para esta selección.</p>";
            }

        }
    </script>


    <div class="container">
        <h2>Sortear Preguntas</h2>
        <label for="ejeSorteo">Eje Temático:</label>
        <select id="ejeSorteo" onchange="mostrarCantidadPreguntas(); actualizarMaxPreguntas()">
            <option value="">Seleccione un eje</option>
            <option value="seguridad">Seguridad Ciudadana</option>
            <option value="limpieza">Limpieza Pública</option>
            <option value="infraestructura">Infraestructura</option>
            <option value="programas">Programas Sociales</option>
            <option value="institucionalidad">Institucionalidad</option>
        </select>
        <div id="cantidadPreguntasContainer" style="display: none;">
            <label for="cantidadPreguntas">Cantidad de preguntas:</label>
            <input type="text" id="cantidadPreguntas" readonly>
        </div>
        <label for="numPreguntas">Número de preguntas a sortear:</label>
        <input type="number" id="numPreguntas" min="1" max="10">
        <button onclick="sortearPreguntas()">Sortear</button>
        <h3>Preguntas Sorteadas:</h3>
        <div id="preguntasSorteadas"></div>
    </div>
    <script>
        const preguntasPorEje = {
            seguridad: 50,
            limpieza: 30,
            infraestructura: 40,
            programas: 25,
            institucionalidad: 35
        };

        function mostrarCantidadPreguntas() {
            let ejeSeleccionado = document.getElementById("ejeSorteo").value;
            let cantidadPreguntasContainer = document.getElementById("cantidadPreguntasContainer");
            let cantidadPreguntas = document.getElementById("cantidadPreguntas");

            if (ejeSeleccionado) {
                cantidadPreguntas.value = preguntasPorEje[ejeSeleccionado] || 0;
                cantidadPreguntasContainer.style.display = "block";
            } else {
                cantidadPreguntasContainer.style.display = "none";
            }
        }

        function actualizarMaxPreguntas() {
            let ejeSeleccionado = document.getElementById("ejeSorteo").value;
            let numPreguntas = document.getElementById("numPreguntas");

            if (ejeSeleccionado) {
                numPreguntas.max = preguntasPorEje[ejeSeleccionado] || 1;
            } else {
                numPreguntas.max = 1;
            }
        }

        function sortearPreguntas() {
            let ejeSeleccionado = document.getElementById("ejeSorteo").value;
            let numPreguntas = parseInt(document.getElementById("numPreguntas").value);
            let contenedorPreguntas = document.getElementById("preguntasSorteadas");

            contenedorPreguntas.innerHTML = ""; // Limpiar preguntas anteriores

            if (!ejeSeleccionado || isNaN(numPreguntas) || numPreguntas < 1) {
                alert("Seleccione un eje y un número válido de preguntas.");
                return;
            }

            let totalPreguntas = preguntasPorEje[ejeSeleccionado];
            let preguntasArray = Array.from({ length: totalPreguntas }, (_, i) => `Pregunta ${i + 1}`);
            let preguntasSorteadas = [];

            for (let i = 0; i < numPreguntas && preguntasArray.length > 0; i++) {
                let index = Math.floor(Math.random() * preguntasArray.length);
                preguntasSorteadas.push(preguntasArray.splice(index, 1)[0]);
            }

            preguntasSorteadas.forEach((pregunta) => {
                let div = document.createElement("div");
                div.className = "pregunta";
                div.textContent = pregunta;
                contenedorPreguntas.appendChild(div);
            });
        }
    </script>
</body>

</html>