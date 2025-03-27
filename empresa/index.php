<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PLAN DE FORMACIÓN</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }
    th, td {
      border: 1px solid #000;
      padding: 0px 8px;
      vertical-align: top;
    }
    blockquote {
      margin: 0;
      padding: 0;
      display: inline-block;
    }
    .text-center {
      text-align: center;
    }
    sup {
      vertical-align: super;
      font-size: smaller;
    }
    input {
      border: none;
      border-bottom: 1px solid lightgrey;
    }
    /*
    .secundario {
      display: none;
    }
    .resultado {
      display: none;
    }
    */
    .oculto{
      display:none;
    }
    #session-link,#mensaje{
    	text-align:center;
    }
  </style>
</head>
<body>
  <!-- Unique session link displayed here -->
  <p id="mensaje">Enlace permanente a la sesión (Guarda este enlace por si necesitas acceder de nuevo en el futuro)</p>
  <div id="session-link" style="margin-bottom:20px;"></div>
<p>1.-Indica los datos de la empresa</p>
  <table>
    <colgroup>
      <col style="width: 12%">
      <col style="width: 3%">
      <col style="width: 4%">
      <col style="width: 11%">
      <col style="width: 2%">
      <col style="width: 7%">
      <col style="width: 3%">
      <col style="width: 3%">
      <col style="width: 0%">
      <col style="width: 3%">
      <col style="width: 12%">
      <col style="width: 3%">
      <col style="width: 3%">
      <col style="width: 2%">
      <col style="width: 7%">
      <col style="width: 1%">
      <col style="width: 15%">
    </colgroup>
    <thead>
      <tr>
        <th colspan="2"></th>
        <th colspan="13">
          <blockquote>
            <p><strong>PLAN DE FORMACIÓN</strong></p>
            <p>Resultados de aprendizaje en periodos de formación en empresa u organismo equiparado Régimen(general/intensivo):</p>
            <p>Fecha: / Curso escolar</p>
            <p><strong>CURSO:</strong></p>
          </blockquote>
          <!-- Here the input is associated to the label "CURSO:" -->
          <input type="text" data-field="CURSO:">
        </th>
        <th colspan="2">
          <blockquote>
            <p><strong>Dirección General de Formación Profesional</strong></p>
          </blockquote>
          <input type="text" data-field="Dirección General de Formación Profesional">
        </th>
      </tr>
    </thead>
    <tbody>
      <tr class="oculto">
        <td colspan="3">
          <blockquote>
            <p>Ciclo formativo/Curso de especialización</p>
          </blockquote>
          <input type="text" data-field="Ciclo formativo/Curso de especialización">
        </td>
        <td colspan="10"></td>
        <td colspan="4">
          <blockquote>
            <p>Grupo:</p>
          </blockquote>
          <input type="text" data-field="Grupo:">
        </td>
      </tr>
      <tr class="oculto">
        <td colspan="2" rowspan="2">
          <blockquote>
            <p>Alumno/a</p>
          </blockquote>
          <input type="text" data-field="Alumno/a">
        </td>
        <td colspan="4">
          <blockquote>
            <p>Nombre y apellidos:</p>
          </blockquote>
          <input type="text" data-field="Nombre y apellidos:">
        </td>
        <td colspan="4">
          <blockquote>
            <p>DNI:</p>
          </blockquote>
          <input type="text" data-field="DNI:">
        </td>
        <td>
          <blockquote>
            <p>NUSS:</p>
          </blockquote>
          <input type="text" data-field="NUSS:">
        </td>
        <td colspan="4">
          <blockquote>
            <p>Email:</p>
          </blockquote>
          <input type="text" data-field="Email:">
        </td>
        <td colspan="2">
          <blockquote>
            <p>Teléfono:</p>
          </blockquote>
          <input type="text" data-field="Teléfono:">
        </td>
      </tr>
      <tr class="oculto">
        <td colspan="2">
          <blockquote>
            <p>Fecha de nacimiento: / /</p>
          </blockquote>
          <input type="text" data-field="Fecha de nacimiento: / /">
        </td>
        <td colspan="5">
          <blockquote>
            <p>Dispone del nivel básico de PRL <input type="checkbox"></p>
          </blockquote>
          <input type="text" data-field="Dispone del nivel básico de PRL">
        </td>
        <td colspan="4">
          <blockquote>
            <p>Dispone de otra certificación adicional de PRL <input type="checkbox"></p>
          </blockquote>
          <input type="text" data-field="Dispone de otra certificación adicional de PRL">
        </td>
        <td colspan="4">
          <blockquote>
            <p>Especificar:</p>
          </blockquote>
          <input type="text" data-field="Especificar:">
        </td>
      </tr>
      <tr class="oculto">
        <td colspan="2">
          <blockquote>
            <p>Centro educativo</p>
          </blockquote>
          <input type="text" data-field="Centro educativo">
        </td>
        <td colspan="6" rowspan="2"></td>
        <td colspan="5">
          <blockquote>
            <p>Email:</p>
          </blockquote>
          <input type="text" data-field="Email:">
        </td>
        <td colspan="4">
          <blockquote>
            <p>Código:</p>
          </blockquote>
          <input type="text" data-field="Código:">
        </td>
      </tr>
      <tr class="oculto">
        <td colspan="2">
          <blockquote>
            <p>Tutor/a del centro educativo</p>
          </blockquote>
          <input type="text" data-field="Tutor/a del centro educativo">
        </td>
        <td colspan="5">
          <blockquote>
            <p>Email:</p>
          </blockquote>
          <input type="text" data-field="Email:">
        </td>
        <td colspan="4">
          <blockquote>
            <p>Teléfono:</p>
          </blockquote>
          <input type="text" data-field="Teléfono:">
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <blockquote>
            <p>Empresa<sup>1</sup></p>
          </blockquote>
          <input type="text" data-field="Empresa">
        </td>
        <td colspan="6">
          <blockquote>
            <p>Denominación:</p>
          </blockquote>
          <input type="text" data-field="Denominación:">
        </td>
        <td colspan="5">
          <blockquote>
            <p>Email:</p>
          </blockquote>
          <input type="text" data-field="Email:">
        </td>
        <td colspan="4">
          <blockquote>
            <p>CIF:</p>
          </blockquote>
          <input type="text" data-field="CIF:">
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <blockquote>
            <p>Tutor/a de empresa</p>
          </blockquote>
          <input type="text" data-field="Tutor/a de empresa">
        </td>
        <td colspan="6">
          <blockquote>
            <p>Nombre y apellidos:</p>
          </blockquote>
          <input type="text" data-field="Nombre y apellidos:">
        </td>
        <td colspan="5">
          <blockquote>
            <p>Email:</p>
          </blockquote>
          <input type="text" data-field="Email:">
        </td>
        <td colspan="4">
          <blockquote>
            <p>Teléfono:</p>
          </blockquote>
          <input type="text" data-field="Teléfono:">
        </td>
      </tr>
      
      <tr class="oculto">
        <td rowspan="2" class="text-center">
          <blockquote>
            <p>Requiere medidas o adaptaciones extraordinarias por discapacidad</p>
          </blockquote>
          <input type="text" data-field="Requiere medidas o adaptaciones extraordinarias por discapacidad">
        </td>
        <td class="text-center">
          <blockquote>
            <p>SÍ <input type="checkbox"></p>
          </blockquote>
          <input type="text" data-field="SÍ">
        </td>
        <td colspan="2" rowspan="2">
          <blockquote>
            <p>Especificar</p>
          </blockquote>
          <input type="text" data-field="Especificar">
        </td>
        <td colspan="3" rowspan="2">
          <blockquote>
            <p>Requiere autorizaciones extraordinarias</p>
          </blockquote>
          <input type="text" data-field="Requiere autorizaciones extraordinarias">
        </td>
        <td colspan="2">
          <blockquote>
            <p>SÍ <input type="checkbox"></p>
          </blockquote>
          <input type="text" data-field="SÍ">
        </td>
        <td colspan="4" rowspan="2">
          <blockquote>
            <p>Especificar:</p>
            <p>- Para realizar actividades de formación fuera del entorno socioeconómico del centro educativo.</p>
          </blockquote>
          <input type="text" data-field="Especificar: - Para realizar actividades de formación fuera del entorno socioeconómico del centro educativo.">
          <p>-</p>
        </td>
        <td colspan="4" rowspan="2">
          <blockquote>
            <p>Observaciones:</p>
          </blockquote>
          <input type="text" data-field="Observaciones:">
        </td>
      </tr>
      <tr class="oculto">
        <td class="text-center">
          <blockquote>
            <p>NO <input type="checkbox"></p>
          </blockquote>
          <input type="text" data-field="NO">
        </td>
        <td colspan="2">
          <blockquote>
            <p>NO <input type="checkbox"></p>
          </blockquote>
          <input type="text" data-field="NO">
        </td>
      </tr>
      <tr class="oculto">
        <td colspan="2">
          <blockquote>
            <p>Intervalo de formación</p>
          </blockquote>
          <input type="text" data-field="Intervalo de formación">
        </td>
        <td colspan="3" class="text-center">
          <blockquote>
            <p>Diario <input type="checkbox"></p>
          </blockquote>
          <input type="text" data-field="Diario">
        </td>
        <td colspan="5" class="text-center">
          <blockquote>
            <p>Semanal <input type="checkbox"></p>
          </blockquote>
          <input type="text" data-field="Semanal">
        </td>
        <td colspan="2">
          <blockquote>
            <p>Mensual <input type="checkbox"></p>
          </blockquote>
          <input type="text" data-field="Mensual">
        </td>
        <td colspan="4" class="text-center">
          <blockquote>
            <p>Otros <input type="checkbox"></p>
          </blockquote>
          <input type="text" data-field="Otros">
        </td>
        <td>
          <blockquote>
            <p>Varias empresas <input type="checkbox"></p>
          </blockquote>
          <input type="text" data-field="Varias empresas">
        </td>
      </tr>
      <tr class="oculto">
        <td colspan="2" rowspan="2">
          <blockquote>
            <p>PERIODOS DE FORMACIÓN EN EMPRESA</p>
          </blockquote>
          <input type="text" data-field="PERIODOS DE FORMACIÓN EN EMPRESA">
        </td>
        <td colspan="5">
          <blockquote>
            <p>1<sup>er</sup> Periodo. Calendario y horario</p>
          </blockquote>
          <input type="text" data-field="1er Periodo. Calendario y horario">
        </td>
        <td colspan="7">
          <blockquote>
            <p>Horas:</p>
          </blockquote>
          <input type="text" data-field="Horas:">
        </td>
        <td colspan="3">
          <blockquote>
            <p>Empresa/s:</p>
          </blockquote>
          <input type="text" data-field="Empresa/s:">
        </td>
      </tr>
      <tr class="oculto">
        <td colspan="5" rowspan="2">
          <blockquote>
            <p>2º Periodo. Calendario y horario</p>
          </blockquote>
          <input type="text" data-field="2º Periodo. Calendario y horario">
        </td>
        <td colspan="7" rowspan="2">
          <blockquote>
            <p>Horas:</p>
          </blockquote>
          <input type="text" data-field="Horas:">
        </td>
        <td colspan="3" rowspan="2">
          <blockquote>
            <p>Empresa/s:</p>
          </blockquote>
          <input type="text" data-field="Empresa/s:">
        </td>
      </tr>
      <tr class="oculto">
        <td>
          <blockquote>
            <p>TOTAL, HORAS</p>
          </blockquote>
          <input type="text" data-field="TOTAL, HORAS">
        </td>
        <td></td>
      </tr>
    </tbody>
  </table>

  <p>2.-A continuación indica las actividades que está previsto que el alumno realice en la empresa</p>

  <?php
    $db = new PDO("sqlite:../../databases/dual.sqlite");
    $query = "SELECT * FROM modulos WHERE ciclo = 'Ciclo Formativo de Grado Superior en Desarrollo de Aplicaciones Multiplataforma' AND curso = '1'";
    $result = $db->query($query);
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      echo '
      <table>
        <colgroup>
          <col style="width: 10%">
          <col style="width: 3%">
          <col style="width: 40%">
          <col style="width: 10%" class="oculto">
          <col style="width: 10%" class="oculto">
          <col style="width: 15%" class="oculto">
        </colgroup>
        <thead>
          <tr>
            <th><strong>Módulo profesional<sup>2</sup></strong></th>
            <th><strong>Código</strong></th>
            <th><strong>Resultados de aprendizaje</strong></th>
            <th class="oculto"><strong>Desarrollado en el centro (marcar con x)</strong></th>
            <th class="oculto"><strong>Desarrollado en la empresa (marcar con x)</strong></th>
            <th class="oculto"><strong>Empresa</strong></th>
          </tr>
        </thead>
        <tbody>
      ';
      $query2 = "SELECT * FROM resultados WHERE modulo = " . $row['Identificador'] . "";
      $result2 = $db->query($query2);
      $contador = 0;
      while ($row2 = $result2->fetch(PDO::FETCH_ASSOC)) {
        echo '<tr ';
        if($contador != 0){
          echo 'class="secundario"';
        }
        echo '>';
        if($contador == 0){
          echo '<td rowspan="20">
                  <blockquote>
                    ' . $row['modulo'] . '
                    <p class="oculto">Se imparte de forma completa en el centro <input type="checkbox" data-table="modulos" data-rowid="' . $row['Identificador'] . '"></p>
                    <p class="oculto">Se imparte en colaboración con empresas <input type="checkbox" class="imparteempresa" data-table="modulos" data-rowid="' . $row['Identificador'] . '"> Número de horas a desarrollar en la empresa: 0</p>
                    <p class="oculto">Indicar el reparto de resultados de aprendizaje (RA)</p>
                  </blockquote> 
                </td>';
          echo '<td rowspan="20">' . $row['Identificador'] . '</td>';
        }
        echo '<td>
                <p class="resultado">' . $row2['resultado'] . '</p>
                <ul>';
        $query3 = "SELECT * FROM actividades WHERE resultado = '" . $row2['resultado'] . "'";
        $result3 = $db->query($query3);
        while ($row3 = $result3->fetch(PDO::FETCH_ASSOC)) {
          echo '<li><input type="checkbox" data-table="actividades" data-rowid="' . $row3['Identificador'] . '">' . $row3['criterio'] . '</li>';
        }
        echo '  </ul>
              </td>
              <td class="oculto"><input type="checkbox" class="centro" data-table="resultados" data-modulo="' . $row2['modulo'] . '"></td>
              <td class="oculto"><input type="checkbox" class="empresa" data-table="resultados" data-modulo="' . $row2['modulo'] . '"></td>
              <td class="oculto"></td>
            </tr>';
        $contador++;
      }
      echo '
          </tbody>
      </table>
      ';
    }
  ?>

  <style>
  /*
    ul {
      display: none;
    }
    */
  </style>
  <script>
  /*
    let empresas = document.querySelectorAll(".empresa")
    empresas.forEach(function(empresa){
      empresa.onchange = function(){
        console.log(this.checked)
        if(this.checked){
          this.parentElement.previousElementSibling.previousElementSibling.querySelector('ul').style.display = "block";
        } else {
          this.parentElement.previousElementSibling.previousElementSibling.querySelector('ul').style.display = "none";
        }
      }
    })
    let imparteempresas = document.querySelectorAll(".imparteempresa")
    imparteempresas.forEach(function(imparteempresa){
      imparteempresa.onchange = function(){
        console.log(this.checked)
        if(this.checked){
          let elementosmostrar = this.parentElement.parentElement.parentElement.parentElement.parentElement.querySelectorAll('.secundario')
          elementosmostrar.forEach(function(elementomostrar){
            console.log("ok")
            elementomostrar.style.display = "table-row"
          })
          let resultadosmostrar = this.parentElement.parentElement.parentElement.parentElement.parentElement.querySelectorAll('.resultado')
          console.log(resultadosmostrar)
          resultadosmostrar.forEach(function(resultadomostrar){
            resultadomostrar.style.display = "block"
          })
        } else {
          let elementosmostrar = this.parentElement.parentElement.parentElement.parentElement.parentElement.querySelectorAll('.secundario')
          elementosmostrar.forEach(function(elementomostrar){
            elementomostrar.style.display = "none"
          })
          let resultadosmostrar = this.parentElement.parentElement.parentElement.parentElement.parentElement.querySelectorAll('.resultado')
          resultadosmostrar.forEach(function(resultadomostrar){
            resultadomostrar.style.display = "none"
          })
        }
      }
    })
    */
  </script>

  <!-- New JavaScript for session management and saving/recovering form data -->
  <script>
    // Utility: get a URL query parameter by name
    function getQueryParam(param) {
      let urlParams = new URLSearchParams(window.location.search);
      return urlParams.get(param);
    }

    // Generate a unique session id if not provided in the URL
    let sessionId = getQueryParam('session');
    if (!sessionId) {
      sessionId = Date.now() + '-' + Math.random().toString(36).substr(2, 9);
      // Update the URL (without reloading) to include the session id
      const newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?session=' + sessionId;
      window.history.replaceState({path: newUrl}, '', newUrl);
    }

    // Display a persistent link with the session id for the user
    document.addEventListener('DOMContentLoaded', function() {
      const sessionLinkDiv = document.getElementById('session-link');
      const link = document.createElement('a');
      link.href = window.location.href;
      link.textContent =  window.location.href;
      sessionLinkDiv.appendChild(link);

      // If session data exists, load it to repopulate the form
      fetch('load_data.php?session=' + encodeURIComponent(sessionId))
        .then(response => response.json())
        .then(data => {
          if (data) {
            // Loop over each saved field and set the value/checked status
            for (const key in data) {
              if (data.hasOwnProperty(key)) {
                // Try to find input by data-field first...
                let input = document.querySelector('input[data-field="'+key+'"]');
                if (!input) {
                  // If not found, try to find inputs that may have been saved from data-table based keys
                  input = document.querySelector('input[data-table][data-rowid="'+key.split('_')[1]+'"]') ||
                          document.querySelector('input[data-table][data-modulo="'+key.split('_')[1]+'"]');
                }
                if (input) {
                  if (input.type === 'checkbox') {
                    input.checked = data[key];
                  } else {
                    input.value = data[key];
                  }
                }
              }
            }
          }
        })
        .catch(error => {
          console.error('Error loading session data:', error);
        });
    });

    // Function to collect all form data from inputs with a "data-field" or "data-table" attribute
    function getFormData() {
      // Select inputs that have either data-field or data-table attribute
      const inputs = document.querySelectorAll('input[data-field], input[data-table]');
      const data = {};
      inputs.forEach(input => {
        // Use data-field if available; otherwise, build a key from data-table and a unique attribute
        let key = input.getAttribute('data-field');
        if (!key) {
          // Use data-table along with data-rowid or data-modulo to create a unique key
          const table = input.getAttribute('data-table');
          const rowId = input.getAttribute('data-rowid');
          const modulo = input.getAttribute('data-modulo');
          key = table + '_' + (rowId ? rowId : (modulo ? modulo : ''));
        }
        if (input.type === 'checkbox') {
          data[key] = input.checked;
        } else {
          data[key] = input.value;
        }
      });
      return data;
    }

    // Function to save form data via fetch POST to the PHP backend
    function saveFormData() {
      const formData = getFormData();
      formData.session = sessionId; // include the session id in the data
      fetch('save_data.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(formData)
      })
      .then(response => response.json())
      .then(result => {
        console.log('Data saved:', result);
      })
      .catch(error => {
        console.error('Error saving data:', error);
      });
    }

    // Listen for changes on any input with data-field or data-table attributes (this includes checkboxes)
    document.addEventListener('change', function(event) {
      if (event.target.matches('input[data-field], input[data-table]')) {
        saveFormData();
      }
    });
  </script>
</body>
</html>

