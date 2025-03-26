<?php
if($action == 'delete' && isset($_GET['id'])){
                    $stmt = $db->prepare("DELETE FROM empresas WHERE id = ?");
                    $stmt->execute([$_GET['id']]);
                    header("Location: ?module=empresas");
                    exit;
                }
                if($_SERVER['REQUEST_METHOD'] == 'POST' && $action == 'add'){
                    $stmt = $db->prepare("INSERT INTO empresas (denominacion, email, cif) VALUES (?,?,?)");
                    $stmt->execute([$_POST['denominacion'], $_POST['email'], $_POST['cif']]);
                    header("Location: ?module=empresas");
                    exit;
                }
                if($action == 'edit' && isset($_GET['id'])){
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $stmt = $db->prepare("UPDATE empresas SET denominacion=?, email=?, cif=? WHERE id=?");
                        $stmt->execute([$_POST['denominacion'], $_POST['email'], $_POST['cif'], $_GET['id']]);
                        header("Location: ?module=empresas");
                        exit;
                    } else {
                        $stmt = $db->prepare("SELECT * FROM empresas WHERE id=?");
                        $stmt->execute([$_GET['id']]);
                        $empresa = $stmt->fetch(PDO::FETCH_ASSOC);
                    }
                }
                if($action == 'add' || ($action == 'edit' && isset($empresa))){
                    ?>
                    <h3><?php echo ($action=='add') ? "Añadir Empresa" : "Editar Empresa"; ?></h3>
                    <form method="post" action="">
                        <label>Denominación:</label>
                        <input type="text" name="denominacion" value="<?php echo ($action=='edit') ? $empresa['denominacion'] : ''; ?>" required>
                        <label>Email:</label>
                        <input type="email" name="email" value="<?php echo ($action=='edit') ? $empresa['email'] : ''; ?>" required>
                        <label>CIF:</label>
                        <input type="text" name="cif" value="<?php echo ($action=='edit') ? $empresa['cif'] : ''; ?>" required>
                        <input type="submit" value="Guardar">
                    </form>
                    <?php
                } else {
                    echo "<h3>Empresas</h3>";
                    echo "<a href='?module=empresas&action=add' class='actualizar'>Añadir</a>";
                    $stmt = $db->query("SELECT * FROM empresas");
                    echo "<table>
                          <thead><tr><th>ID</th><th>Denominación</th><th>Email</th><th>CIF</th><th>Acciones</th></tr></thead>
                          <tbody>";
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        echo "<tr>
                              <td>{$row['id']}</td>
                              <td>{$row['denominacion']}</td>
                              <td>{$row['email']}</td>
                              <td>{$row['cif']}</td>
                              <td>
                                <a href='?module=empresas&action=edit&id={$row['id']}' class='actualizar'>Editar</a>
                                <a href='?module=empresas&action=delete&id={$row['id']}' class='eliminar' onclick=\"return confirm('¿Seguro?')\">Eliminar</a>
                              </td>
                              </tr>";
                    }
                    echo "</tbody></table>";
                }
?>
