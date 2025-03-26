<?php
if($action == 'delete' && isset($_GET['id'])){
    $stmt = $db->prepare("DELETE FROM dual WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    header("Location: ?module=dual");
    exit;
}

// Edit plantilla action for dual records
if(isset($_GET['template']) && isset($_GET['id'])){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $new_content = $_POST['template_content'];
        $stmt = $db->prepare("UPDATE dual SET plantilla_content=? WHERE id=?");
        $stmt->execute([$new_content, $_GET['id']]);
        header("Location: ?module=dual");
        exit;
    } else {
        $stmt = $db->prepare("SELECT d.*, s.nombre as alumno, s.apellidos as apellidos, g.nombre as grupo FROM dual d 
                              LEFT JOIN students s ON d.alumno_id = s.id 
                              LEFT JOIN grupos g ON d.grupo_id = g.id 
                              WHERE d.id=?");
        $stmt->execute([$_GET['id']]);
        $dual = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    ?>
    <h3>Editar Plantilla para <?php echo $dual['alumno'] . " " . $dual['apellidos']; ?></h3>
    <form method="post" action="">
        <!-- Iframe preview using modelo.php with toggle control -->
        <div class="iframe-container" style="position:relative;">
            <button type="button" class="iframe-toggle" style="position:absolute; top:10px; right:10px; z-index:10000;">Expand</button>
            <iframe src="modelo.php" style="width:100%; height:500px;"></iframe>
        </div>
        <label>Modificaciones (HTML/JSON):</label>
        <textarea name="template_content" style="width:100%; height:200px;"><?php echo htmlspecialchars($dual['plantilla_content']); ?></textarea>
        <input type="submit" value="Guardar cambios">
    </form>
    <?php
    exit;
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && $action == 'add'){
    // Load default content from modelo.php when creating a new dual record
    $default_content = file_get_contents("modelo.php");
    $stmt = $db->prepare("INSERT INTO dual (alumno_id, grupo_id, plantilla_content) VALUES (?,?,?)");
    $stmt->execute([$_POST['alumno_id'], $_POST['grupo_id'], $default_content]);
    header("Location: ?module=dual");
    exit;
}

if($action == 'edit' && isset($_GET['id'])){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $stmt = $db->prepare("UPDATE dual SET alumno_id=?, grupo_id=?, plantilla_content=? WHERE id=?");
        $stmt->execute([$_POST['alumno_id'], $_POST['grupo_id'], $_POST['plantilla_content'], $_GET['id']]);
        header("Location: ?module=dual");
        exit;
    } else {
        $stmt = $db->prepare("SELECT * FROM dual WHERE id=?");
        $stmt->execute([$_GET['id']]);
        $dual = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

if($action == 'add' || ($action == 'edit' && isset($dual))){
    ?>
    <h3><?php echo ($action=='add') ? "Añadir Dual" : "Editar Dual"; ?></h3>
    <form method="post" action="">
        <label>Alumno:</label>
        <select name="alumno_id" required>
            <option value="">Seleccione</option>
            <?php
            $alumnoStmt = $db->query("SELECT * FROM students");
            while($alumnoRow = $alumnoStmt->fetch(PDO::FETCH_ASSOC)){
                $selected = ($action=='edit' && $dual['alumno_id'] == $alumnoRow['id']) ? "selected" : "";
                echo "<option value='{$alumnoRow['id']}' $selected>{$alumnoRow['nombre']} {$alumnoRow['apellidos']}</option>";
            }
            ?>
        </select>
        <label>Grupo:</label>
        <select name="grupo_id" required>
            <option value="">Seleccione</option>
            <?php
            $grupoStmt = $db->query("SELECT * FROM grupos");
            while($grupoRow = $grupoStmt->fetch(PDO::FETCH_ASSOC)){
                $selected = ($action=='edit' && $dual['grupo_id'] == $grupoRow['id']) ? "selected" : "";
                echo "<option value='{$grupoRow['id']}' $selected>{$grupoRow['nombre']}</option>";
            }
            ?>
        </select>
        <?php if($action=='edit'){ ?>
        <label>Plantilla Content (HTML/JSON):</label>
        <textarea name="plantilla_content" style="width:100%; height:200px;"><?php echo htmlspecialchars($dual['plantilla_content']); ?></textarea>
        <?php } ?>
        <input type="submit" value="Guardar">
    </form>
    <?php
} else {
    echo "<h3>Dual - Plantillas Individuales</h3>";
    echo "<a href='?module=dual&action=add' class='actualizar'>Añadir</a>";
    $stmt = $db->query("SELECT d.*, s.nombre as alumno, s.apellidos as apellidos, g.nombre as grupo FROM dual d 
                         LEFT JOIN students s ON d.alumno_id = s.id 
                         LEFT JOIN grupos g ON d.grupo_id = g.id");
    echo "<table>
          <thead><tr><th>ID</th><th>Alumno</th><th>Grupo</th><th>Acciones</th></tr></thead>
          <tbody>";
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo "<tr>
              <td>{$row['id']}</td>
              <td>{$row['alumno']} {$row['apellidos']}</td>
              <td>{$row['grupo']}</td>
              <td>
                <a href='?module=dual&action=edit&id={$row['id']}' class='actualizar'>Editar</a>
                <a href='?module=dual&template=1&id={$row['id']}' class='actualizar'>Editar Plantilla</a>
                <a href='?module=dual&action=delete&id={$row['id']}' class='eliminar' onclick=\"return confirm('¿Seguro?')\">Eliminar</a>
              </td>
              </tr>";
    }
    echo "</tbody></table>";
}
?>

