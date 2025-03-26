<?php
if($action == 'delete' && isset($_GET['id'])){
                    $stmt = $db->prepare("DELETE FROM ciclos WHERE id = ?");
                    $stmt->execute([$_GET['id']]);
                    header("Location: ?module=ciclos");
                    exit;
                }
                if($_SERVER['REQUEST_METHOD'] == 'POST' && $action == 'add'){
                    $stmt = $db->prepare("INSERT INTO ciclos (nombre_ciclo) VALUES (?)");
                    $stmt->execute([$_POST['nombre_ciclo']]);
                    header("Location: ?module=ciclos");
                    exit;
                }
                if($action == 'edit' && isset($_GET['id'])){
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $stmt = $db->prepare("UPDATE ciclos SET nombre_ciclo=? WHERE id=?");
                        $stmt->execute([$_POST['nombre_ciclo'], $_GET['id']]);
                        header("Location: ?module=ciclos");
                        exit;
                    } else {
                        $stmt = $db->prepare("SELECT * FROM ciclos WHERE id=?");
                        $stmt->execute([$_GET['id']]);
                        $ciclo = $stmt->fetch(PDO::FETCH_ASSOC);
                    }
                }
                if($action == 'add' || ($action == 'edit' && isset($ciclo))){
                    ?>
                    <h3><?php echo ($action=='add') ? "Añadir Ciclo" : "Editar Ciclo"; ?></h3>
                    <form method="post" action="">
                        <label>Nombre del ciclo:</label>
                        <input type="text" name="nombre_ciclo" value="<?php echo ($action=='edit') ? $ciclo['nombre_ciclo'] : ''; ?>" required>
                        <input type="submit" value="Guardar">
                    </form>
                    <?php
                } else {
                    echo "<h3>Ciclos</h3>";
                    echo "<a href='?module=ciclos&action=add' class='actualizar'>Añadir</a>";
                    $stmt = $db->query("SELECT * FROM ciclos");
                    echo "<table>
                          <thead><tr><th>ID</th><th>Nombre del ciclo</th><th>Acciones</th></tr></thead>
                          <tbody>";
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        echo "<tr>
                              <td>{$row['id']}</td>
                              <td>{$row['nombre_ciclo']}</td>
                              <td>
                                <a href='?module=ciclos&action=edit&id={$row['id']}' class='actualizar'>Editar</a>
                                <a href='?module=ciclos&action=delete&id={$row['id']}' class='eliminar' onclick=\"return confirm('¿Seguro?')\">Eliminar</a>
                              </td>
                              </tr>";
                    }
                    echo "</tbody></table>";
                }
?>
