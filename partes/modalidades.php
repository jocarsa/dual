<?php
if($action == 'delete' && isset($_GET['id'])){
    $stmt = $db->prepare("DELETE FROM modalidades WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    header("Location: ?module=modalidades");
    exit;
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && $action == 'add'){
    $stmt = $db->prepare("INSERT INTO modalidades (nombre) VALUES (?)");
    $stmt->execute([$_POST['nombre']]);
    header("Location: ?module=modalidades");
    exit;
}
if($action == 'edit' && isset($_GET['id'])){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $stmt = $db->prepare("UPDATE modalidades SET nombre=? WHERE id=?");
        $stmt->execute([$_POST['nombre'], $_GET['id']]);
        header("Location: ?module=modalidades");
        exit;
    } else {
        $stmt = $db->prepare("SELECT * FROM modalidades WHERE id=?");
        $stmt->execute([$_GET['id']]);
        $modalidad = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
if($action == 'add' || ($action == 'edit' && isset($modalidad))){
    ?>
    <h3><?php echo ($action=='add') ? "Añadir Modalidad" : "Editar Modalidad"; ?></h3>
    <form method="post" action="">
        <label>Modalidad:</label>
        <input type="text" name="nombre" value="<?php echo ($action=='edit') ? $modalidad['nombre'] : ''; ?>" required>
        <input type="submit" value="Guardar">
    </form>
    <?php
} else {
    echo "<h3>Modalidades</h3>";
    echo "<a href='?module=modalidades&action=add' class='actualizar'>Añadir</a>";
    $stmt = $db->query("SELECT * FROM modalidades");
    echo "<table>
          <thead><tr><th>ID</th><th>Modalidad</th><th>Acciones</th></tr></thead>
          <tbody>";
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo "<tr>
              <td>{$row['id']}</td>
              <td>{$row['nombre']}</td>
              <td>
                <a href='?module=modalidades&action=edit&id={$row['id']}' class='actualizar'>Editar</a>
                <a href='?module=modalidades&action=delete&id={$row['id']}' class='eliminar' onclick=\"return confirm('¿Seguro?')\">Eliminar</a>
              </td>
              </tr>";
    }
    echo "</tbody></table>";
}
?>

