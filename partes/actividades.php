<?php
if ($action == 'delete' && isset($_GET['id'])) {
    $stmt = $db->prepare("DELETE FROM actividades WHERE Identificador = ?");
    $stmt->execute([$_GET['id']]);
    header("Location: ?module=actividades");
    exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $action == 'add') {
    $stmt = $db->prepare("INSERT INTO actividades (modulos_modulo, resultado, criterio) VALUES (?,?,?)");
    $stmt->execute([$_POST['modulos_modulo'], $_POST['resultado'], $_POST['criterio']]);
    header("Location: ?module=actividades");
    exit;
}
if ($action == 'edit' && isset($_GET['id'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $stmt = $db->prepare("UPDATE actividades SET modulos_modulo=?, resultado=?, criterio=? WHERE Identificador=?");
        $stmt->execute([$_POST['modulos_modulo'], $_POST['resultado'], $_POST['criterio'], $_GET['id']]);
        header("Location: ?module=actividades");
        exit;
    } else {
        $stmt = $db->prepare("SELECT * FROM actividades WHERE Identificador=?");
        $stmt->execute([$_GET['id']]);
        $actividad = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
if ($action == 'add' || ($action == 'edit' && isset($actividad))) {
    ?>
    <h3><?php echo ($action=='add') ? "Añadir Actividad" : "Editar Actividad"; ?></h3>
    <form method="post" action="">
        <label>Modulo (ID):</label>
        <input type="text" name="modulos_modulo" value="<?php echo ($action=='edit') ? $actividad['modulos_modulo'] : ''; ?>" required>
        <label>Resultado:</label>
        <input type="text" name="resultado" value="<?php echo ($action=='edit') ? $actividad['resultado'] : ''; ?>" required>
        <label>Criterio:</label>
        <input type="text" name="criterio" value="<?php echo ($action=='edit') ? $actividad['criterio'] : ''; ?>" required>
        <input type="submit" value="Guardar">
    </form>
    <?php
} else {
    echo "<h3>Actividades</h3>";
    echo "<a href='?module=actividades&action=add' class='actualizar'>Añadir</a>";
    $stmt = $db->query("SELECT * FROM actividades");
    echo "<table>
          <thead><tr><th>Identificador</th><th>Modulo</th><th>Resultado</th><th>Criterio</th><th>Acciones</th></tr></thead>
          <tbody>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>
              <td>{$row['Identificador']}</td>
              <td>{$row['modulos_modulo']}</td>
              <td>{$row['resultado']}</td>
              <td>{$row['criterio']}</td>
              <td>
                <a href='?module=actividades&action=edit&id={$row['Identificador']}' class='actualizar'>Editar</a>
                <a href='?module=actividades&action=delete&id={$row['Identificador']}' class='eliminar' onclick=\"return confirm('¿Seguro?')\">Eliminar</a>
              </td>
              </tr>";
    }
    echo "</tbody></table>";
}
?>

