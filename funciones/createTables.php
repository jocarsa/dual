<?php
// Create tables if they don't exist
function createTables($db) {
    // Students table
    $db->exec("CREATE TABLE IF NOT EXISTS students (
       id INTEGER PRIMARY KEY AUTOINCREMENT,
       nombre TEXT,
       apellidos TEXT,
       dni TEXT,
       nuss TEXT,
       email TEXT,
       telefono TEXT,
       fecha_nacimiento TEXT,
       prl INTEGER,
       otra_cert_prl INTEGER,
       detalle_otra_cert_prl TEXT,
       discapacidad INTEGER,
       medidas_discapacidad TEXT,
       autorizaciones_extra INTEGER,
       especificar_autorizaciones TEXT,
       observaciones TEXT
    )");
    // Centro educativo
    $db->exec("CREATE TABLE IF NOT EXISTS centros (
       id INTEGER PRIMARY KEY AUTOINCREMENT,
       denomination TEXT,
       email TEXT,
       codigo TEXT
    )");
    // Tutor
    $db->exec("CREATE TABLE IF NOT EXISTS tutors (
       id INTEGER PRIMARY KEY AUTOINCREMENT,
       nombre TEXT,
       apellidos TEXT,
       email TEXT,
       telefono TEXT
    )");
    // Empresas
    $db->exec("CREATE TABLE IF NOT EXISTS empresas (
       id INTEGER PRIMARY KEY AUTOINCREMENT,
       denominacion TEXT,
       email TEXT,
       cif TEXT
    )");
    // Tutor de empresa
    $db->exec("CREATE TABLE IF NOT EXISTS tutor_empresas (
       id INTEGER PRIMARY KEY AUTOINCREMENT,
       nombre TEXT,
       apellidos TEXT,
       email TEXT,
       telefono TEXT,
       empresa_id INTEGER,
       FOREIGN KEY (empresa_id) REFERENCES empresas(id)
    )");
    // Ciclos
    $db->exec("CREATE TABLE IF NOT EXISTS ciclos (
       id INTEGER PRIMARY KEY AUTOINCREMENT,
       nombre_ciclo TEXT
    )");
    // Cursos
    $db->exec("CREATE TABLE IF NOT EXISTS cursos (
       id INTEGER PRIMARY KEY AUTOINCREMENT,
       curso TEXT
    )");
    // Modalidades (new table)
    $db->exec("CREATE TABLE IF NOT EXISTS modalidades (
       id INTEGER PRIMARY KEY AUTOINCREMENT,
       nombre TEXT
    )");
    // Grupos (modified to include modalidad_id and tutor_id)
    $db->exec("CREATE TABLE IF NOT EXISTS grupos (
       id INTEGER PRIMARY KEY AUTOINCREMENT,
       nombre TEXT,
       ciclo_id INTEGER,
       curso_id INTEGER,
       modalidad_id INTEGER,
       tutor_id INTEGER,
       FOREIGN KEY (ciclo_id) REFERENCES ciclos(id),
       FOREIGN KEY (curso_id) REFERENCES cursos(id),
       FOREIGN KEY (modalidad_id) REFERENCES modalidades(id),
       FOREIGN KEY (tutor_id) REFERENCES tutors(id)
    )");
    // Matrículas
    $db->exec("CREATE TABLE IF NOT EXISTS matriculas (
       id INTEGER PRIMARY KEY AUTOINCREMENT,
       alumno_id INTEGER,
       grupo_id INTEGER,
       empresa_id INTEGER,
       FOREIGN KEY (alumno_id) REFERENCES students(id),
       FOREIGN KEY (grupo_id) REFERENCES grupos(id),
       FOREIGN KEY (empresa_id) REFERENCES empresas(id)
    )");
    // Módulos
    $db->exec("CREATE TABLE IF NOT EXISTS modulos (
       Identificador INTEGER PRIMARY KEY AUTOINCREMENT,
       modulo TEXT,
       ciclo TEXT,
       curso INTEGER
    )");
    // Resultados
    $db->exec("CREATE TABLE IF NOT EXISTS resultados (
       modulo INTEGER,
       resultado TEXT
    )");
    // Actividades
    $db->exec("CREATE TABLE IF NOT EXISTS actividades (
       Identificador INTEGER PRIMARY KEY AUTOINCREMENT,
       modulos_modulo INTEGER,
       resultado TEXT,
       criterio TEXT
    )");
    // Plantillas
    $db->exec("CREATE TABLE IF NOT EXISTS plantillas (
       id INTEGER PRIMARY KEY AUTOINCREMENT,
       grupo_id INTEGER,
       contenido TEXT,
       FOREIGN KEY (grupo_id) REFERENCES grupos(id)
    )");
    // Dual (new table for student's plantilla)
    $db->exec("CREATE TABLE IF NOT EXISTS dual (
       id INTEGER PRIMARY KEY AUTOINCREMENT,
       alumno_id INTEGER,
       grupo_id INTEGER,
       plantilla_content TEXT,
       FOREIGN KEY (alumno_id) REFERENCES students(id),
       FOREIGN KEY (grupo_id) REFERENCES grupos(id)
    )");
}
?>

