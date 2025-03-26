<?php
if ($action == 'delete' && isset($_GET['id'])) {
    $stmt = $db->prepare("DELETE FROM modulos WHERE Identificador = ?");
    $stmt->execute([$_GET['id']]);
    header("Location: ?module=modulos");
    exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $action == 'add') {
    $stmt = $db->prepare("INSERT INTO modulos (modulo, ciclo, curso) VALUES (?,?,?)");
    $stmt->execute([$_POST['modulo'], $_POST['ciclo'], $_POST['curso']]);
    header("Location: ?module=modulos");
    exit;
}
if ($action == 'edit' && isset($_GET['id'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $stmt = $db->prepare("UPDATE modulos SET modulo=?, ciclo=?, curso=? WHERE Identificador=?");
        $stmt->execute([$_POST['modulo'], $_POST['ciclo'], $_POST['curso'], $_GET['id']]);
        header("Location: ?module=modulos");
        exit;
    } else {
        $stmt = $db->prepare("SELECT * FROM modulos WHERE Identificador=?");
        $stmt->execute([$_GET['id']]);
        $modulo = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
if ($action == 'add' || ($action == 'edit' && isset($modulo))) {
    ?>
    <h3><?php echo ($action=='add') ? "Añadir Módulo" : "Editar Módulo"; ?></h3>
    <form method="post" action="">
        <label>Módulo:</label>
        <input type="text" name="modulo" value="<?php echo ($action=='edit') ? $modulo['modulo'] : ''; ?>" required>
        <label>Ciclo:</label>
        <input type="text" name="ciclo" value="<?php echo ($action=='edit') ? $modulo['ciclo'] : ''; ?>" required>
        <label>Curso:</label>
        <input type="text" name="curso" value="<?php echo ($action=='edit') ? $modulo['curso'] : ''; ?>" required>
        <input type="submit" value="Guardar">
    </form>
    <?php
} else {
    echo "<h3>Módulos</h3>";
    echo "<a href='?module=modulos&action=add' class='actualizar'>Añadir</a>";
    $stmt = $db->query("SELECT * FROM modulos");
    echo "<table>
          <thead><tr><th>Identificador</th><th>Módulo</th><th>Ciclo</th><th>Curso</th><th>Acciones</th></tr></thead>
          <tbody>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>
              <td>{$row['Identificador']}</td>
              <td>{$row['modulo']}</td>
              <td>{$row['ciclo']}</td>
              <td>{$row['curso']}</td>
              <td>
                <a href='?module=modulos&action=edit&id={$row['Identificador']}' class='actualizar'>Editar</a>
                <a href='?module=modulos&action=delete&id={$row['Identificador']}' class='eliminar' onclick=\"return confirm('¿Seguro?')\">Eliminar</a>
              </td>
              </tr>";
    }
    echo "</tbody></table>";
}
?>

