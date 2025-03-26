<?php
if($action == 'delete' && isset($_GET['id'])){
                    $stmt = $db->prepare("DELETE FROM centros WHERE id = ?");
                    $stmt->execute([$_GET['id']]);
                    header("Location: ?module=centros");
                    exit;
                }
                if($_SERVER['REQUEST_METHOD'] == 'POST' && $action == 'add'){
                    $stmt = $db->prepare("INSERT INTO centros (denomination, email, codigo) VALUES (?,?,?)");
                    $stmt->execute([$_POST['denomination'], $_POST['email'], $_POST['codigo']]);
                    header("Location: ?module=centros");
                    exit;
                }
                if($action == 'edit' && isset($_GET['id'])){
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $stmt = $db->prepare("UPDATE centros SET denomination=?, email=?, codigo=? WHERE id=?");
                        $stmt->execute([$_POST['denomination'], $_POST['email'], $_POST['codigo'], $_GET['id']]);
                        header("Location: ?module=centros");
                        exit;
                    } else {
                        $stmt = $db->prepare("SELECT * FROM centros WHERE id=?");
                        $stmt->execute([$_GET['id']]);
                        $centro = $stmt->fetch(PDO::FETCH_ASSOC);
                    }
                }
                if($action == 'add' || ($action == 'edit' && isset($centro))){
                    ?>
                    <h3><?php echo ($action=='add') ? "Añadir Centro Educativo" : "Editar Centro Educativo"; ?></h3>
                    <form method="post" action="">
                        <label>Denomination:</label>
                        <input type="text" name="denomination" value="<?php echo ($action=='edit') ? $centro['denomination'] : ''; ?>" required>
                        <label>Email:</label>
                        <input type="email" name="email" value="<?php echo ($action=='edit') ? $centro['email'] : ''; ?>" required>
                        <label>Código:</label>
                        <input type="text" name="codigo" value="<?php echo ($action=='edit') ? $centro['codigo'] : ''; ?>" required>
                        <input type="submit" value="Guardar">
                    </form>
                    <?php
                } else {
                    echo "<h3>Centros Educativos</h3>";
                    echo "<a href='?module=centros&action=add' class='actualizar'>Añadir</a>";
                    $stmt = $db->query("SELECT * FROM centros");
                    echo "<table>
                          <thead><tr><th>ID</th><th>Denomination</th><th>Email</th><th>Código</th><th>Acciones</th></tr></thead>
                          <tbody>";
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        echo "<tr>
                              <td>{$row['id']}</td>
                              <td>{$row['denomination']}</td>
                              <td>{$row['email']}</td>
                              <td>{$row['codigo']}</td>
                              <td>
                                <a href='?module=centros&action=edit&id={$row['id']}' class='actualizar'>Editar</a>
                                <a href='?module=centros&action=delete&id={$row['id']}' class='eliminar' onclick=\"return confirm('¿Seguro?')\">Eliminar</a>
                              </td>
                              </tr>";
                    }
                    echo "</tbody></table>";
                }
?>
