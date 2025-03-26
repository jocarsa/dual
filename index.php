<?php
session_start();

// Open (or create) SQLite database
try {
    $db = new PDO('sqlite:../databases/dual.sqlite');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Enable foreign keys
    $db->exec("PRAGMA foreign_keys = ON");
} catch (PDOException $e) {
    die("Error connecting to database: " . $e->getMessage());
}

// Create tables if they don't exist
include "funciones/createTables.php";
createTables($db);

// Logout and Login handling
include "inc/logout.php";
include "inc/login.php";

// If logged in, continue to dashboard

// Get the current module and action from the URL, default to 'students'
$module = isset($_GET['module']) ? $_GET['module'] : 'students';
$action = isset($_GET['action']) ? $_GET['action'] : '';

// Function to build navigation links
function getNavLink($moduleName, $label) {
    $active = (isset($_GET['module']) && $_GET['module'] == $moduleName) ? "class='activo'" : "";
    return "<a href='?module=$moduleName' $active>$label</a>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>jocarsa | dual</title>
    <link rel="stylesheet" href="css/escritorio.css">
        <script src="js/iframeControl.js"></script>

</head>
<body>
    <header>
        jocarsa | dual - <a href="?logout=1" style="color:white;">Logout</a>
    </header>
    <main>
        <nav>
        <label>Centro</label>
        <hr>
            <?php echo getNavLink('centros', 'Centros Educativos'); ?>
              
               
                
                <?php  echo getNavLink('tutors', 'Tutores'); ?>
                
                
                <label>Empresa</label>
               <hr>
               
               <?php  echo getNavLink('empresas', 'Empresas'); ?>
                <?php  echo getNavLink('tutor_empresa', 'Tutor de Empresa'); ?>
               
               <label>Estudiante</label>
               <hr>
               
               <?php  echo getNavLink('students', 'Estudiantes'); ?>
                <?php  echo getNavLink('matriculas', 'Matrículas'); ?>
              
                <?php  echo getNavLink('dual', 'Dual'); ?>
              <label>Configuración</label>
              <hr>
               <?php  echo getNavLink('ciclos', 'Ciclos'); ?>
               <?php  echo getNavLink('cursos', 'Cursos'); ?>
               <?php  echo getNavLink('grupos', 'Grupos'); ?>
              
               <?php  echo getNavLink('modulos', 'Módulos'); ?>
               <?php  echo getNavLink('resultados', 'Resultados'); ?>
               <?php  echo getNavLink('actividades', 'Actividades'); ?>
               <?php  echo getNavLink('plantillas', 'Plantillas'); ?>
               <?php  echo getNavLink('modalidades', 'Modalidades'); ?>
              
           
        </nav>
        <section>
            <?php
            // Load the corresponding module file based on the URL parameter
            if($module == 'students'){
                include "partes/estudiantes.php";
            }
            elseif($module == 'centros'){
                include "partes/centros.php";
            }
            elseif($module == 'tutors'){
                include "partes/tutores.php";
            }
            elseif($module == 'empresas'){
                include "partes/empresas.php";
            }
            elseif($module == 'tutor_empresa'){
                include "partes/tutordeempresa.php";
            }
            elseif($module == 'ciclos'){
                include "partes/ciclos.php";
            }
            elseif($module == 'cursos'){
                include "partes/cursos.php";
            }
            elseif($module == 'grupos'){
                include "partes/grupos.php";
            }
            elseif($module == 'matriculas'){
                include "partes/matriculas.php";
            }
            // New CRUD modules
            elseif($module == 'modulos'){
                include "partes/modulos.php";
            }
            elseif($module == 'resultados'){
                include "partes/resultados.php";
            }
            elseif($module == 'actividades'){
                include "partes/actividades.php";
            }
            elseif($module == 'plantillas'){
                include "partes/plantillas.php";
            }
            elseif($module == 'modalidades'){
                include "partes/modalidades.php";
            }
            elseif($module == 'dual'){
                include "partes/dual.php";
            }
            ?>
        </section>
    </main>
    <footer>
        (c) 2025 jocarsa
    </footer>
</body>
</html>

