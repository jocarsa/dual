<?php
// /var/www/html/dual/partes/plantillas.php

// Delete plantilla
if ($action == 'delete' && isset($_GET['id'])) {
    $stmt = $db->prepare("DELETE FROM plantillas WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    header("Location: ?module=plantillas");
    exit;
}

// Add new plantilla
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $action == 'add') {
    // When a new plantilla is created, load the default content from modelo.php.
    // This is optional. If you want an empty plantilla, simply set $default_content = '';
    $default_content = file_get_contents("modelo.php");
    $stmt = $db->prepare("INSERT INTO plantillas (grupo_id, contenido) VALUES (?,?)");
    $stmt->execute([$_POST['grupo_id'], $default_content]);
    header("Location: ?module=plantillas");
    exit;
}

// Edit plantilla (non-template fields)
if ($action == 'edit' && isset($_GET['id']) && !isset($_GET['template'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $stmt = $db->prepare("UPDATE plantillas SET grupo_id=?, contenido=? WHERE id=?");
        $stmt->execute([$_POST['grupo_id'], $_POST['contenido'], $_GET['id']]);
        header("Location: ?module=plantillas");
        exit;
    } else {
        $stmt = $db->prepare("SELECT * FROM plantillas WHERE id=?");
        $stmt->execute([$_GET['id']]);
        $plantilla = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

// Edit plantilla using the template (modelo.php) in a frame with iframe toggle control
if (isset($_GET['template']) && isset($_GET['id'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Save the modifications entered in the textarea to the plantilla row.
        $new_content = $_POST['template_content'];
        $stmt = $db->prepare("UPDATE plantillas SET contenido=? WHERE id=?");
        $stmt->execute([$new_content, $_GET['id']]);
        header("Location: ?module=plantillas");
        exit;
    } else {
        $stmt = $db->prepare("SELECT * FROM plantillas WHERE id=?");
        $stmt->execute([$_GET['id']]);
        $plantilla = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    ?>
    <h3>Editar Plantilla (ID: <?php echo $_GET['id']; ?>)</h3>
    <form method="post" action="">
        <!-- Iframe loads modelo.php and is wrapped in a container with a toggle button -->
        <div class="iframe-container" style="position:relative;">
            <button type="button" class="iframe-toggle" style="position:absolute; top:10px; right:10px; z-index:10000;">Expand</button>
            <iframe src="modelo.php" style="width:100%; height:500px;"></iframe>
        </div>
        <label>Modificaciones (HTML/JSON):</label>
        <textarea name="template_content" style="width:100%; height:200px;"><?php echo htmlspecialchars($plantilla['contenido']); ?></textarea>
        <input type="submit" value="Guardar cambios">
    </form>
    <?php
    exit;
}

// Add / Edit form for plantilla (manual editing)
if ($action == 'add' || ($action == 'edit' && isset($plantilla))) {
    ?>
    <h3><?php echo ($action=='add') ? "Añadir Plantilla" : "Editar Plantilla"; ?></h3>
    <form method="post" action="">
        <label>Grupo:</label>
        <select name="grupo_id" required>
            <option value="">Seleccione</option>
            <?php
            $grupoStmt = $db->query("SELECT * FROM grupos");
            while ($grupoRow = $grupoStmt->fetch(PDO::FETCH_ASSOC)) {
                $selected = ($action=='edit' && $plantilla['grupo_id'] == $grupoRow['id']) ? "selected" : "";
                echo "<option value='{$grupoRow['id']}' $selected>{$grupoRow['nombre']}</option>";
            }
            ?>
        </select>
        <label>Contenido de la Plantilla (HTML/JSON):</label>
        <textarea name="contenido" style="width:100%; height:200px;"><?php echo ($action=='edit') ? htmlspecialchars($plantilla['contenido']) : ''; ?></textarea>
        <input type="submit" value="Guardar">
    </form>
    <?php
} else {
    // Display list of plantillas
    echo "<h3>Plantillas</h3>";
    echo "<a href='?module=plantillas&action=add' class='actualizar'>Añadir</a>";
    $stmt = $db->query("SELECT p.*, g.nombre as grupo FROM plantillas p LEFT JOIN grupos g ON p.grupo_id = g.id");
    echo "<table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Grupo</th>
              <th>Contenido</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Show only the first 50 characters of the contenido for preview
        $preview = htmlspecialchars(substr($row['contenido'], 0, 50)) . "...";
        echo "<tr>
              <td>{$row['id']}</td>
              <td>{$row['grupo']}</td>
              <td>{$preview}</td>
              <td>
                <a href='?module=plantillas&action=edit&id={$row['id']}' class='actualizar'>Editar</a>
                <a href='?module=plantillas&template=1&id={$row['id']}' class='actualizar'>Editar Plantilla</a>
                <a href='?module=plantillas&action=delete&id={$row['id']}' class='eliminar' onclick=\"return confirm('¿Seguro?')\">Eliminar</a>
              </td>
              </tr>";
    }
    echo "</tbody></table>";
}
?>

