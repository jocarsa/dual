<?php
if ($action == 'delete' && isset($_GET['id'])) {
    $stmt = $db->prepare("DELETE FROM resultados WHERE rowid = ?");
    $stmt->execute([$_GET['id']]);
    header("Location: ?module=resultados");
    exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $action == 'add') {
    $stmt = $db->prepare("INSERT INTO resultados (modulo, resultado) VALUES (?,?)");
    $stmt->execute([$_POST['modulo'], $_POST['resultado']]);
    header("Location: ?module=resultados");
    exit;
}
if ($action == 'edit' && isset($_GET['id'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $stmt = $db->prepare("UPDATE resultados SET modulo=?, resultado=? WHERE rowid=?");
        $stmt->execute([$_POST['modulo'], $_POST['resultado'], $_GET['id']]);
        header("Location: ?module=resultados");
        exit;
    } else {
        $stmt = $db->prepare("SELECT rowid as id, * FROM resultados WHERE rowid=?");
        $stmt->execute([$_GET['id']]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
if ($action == 'add' || ($action == 'edit' && isset($resultado))) {
    ?>
    <h3><?php echo ($action=='add') ? "Añadir Resultado" : "Editar Resultado"; ?></h3>
    <form method="post" action="">
        <label>Módulo (ID):</label>
        <input type="text" name="modulo" value="<?php echo ($action=='edit') ? $resultado['modulo'] : ''; ?>" required>
        <label>Resultado:</label>
        <input type="text" name="resultado" value="<?php echo ($action=='edit') ? $resultado['resultado'] : ''; ?>" required>
        <input type="submit" value="Guardar">
    </form>
    <?php
} else {
    echo "<h3>Resultados</h3>";
    echo "<a href='?module=resultados&action=add' class='actualizar'>Añadir</a>";
    $stmt = $db->query("SELECT rowid as id, * FROM resultados");
    echo "<table>
          <thead><tr><th>ID</th><th>Módulo</th><th>Resultado</th><th>Acciones</th></tr></thead>
          <tbody>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>
              <td>{$row['id']}</td>
              <td>{$row['modulo']}</td>
              <td>{$row['resultado']}</td>
              <td>
                <a href='?module=resultados&action=edit&id={$row['id']}' class='actualizar'>Editar</a>
                <a href='?module=resultados&action=delete&id={$row['id']}' class='eliminar' onclick=\"return confirm('¿Seguro?')\">Eliminar</a>
              </td>
              </tr>";
    }
    echo "</tbody></table>";
}
?>

