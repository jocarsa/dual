<?php
if($action == 'delete' && isset($_GET['id'])){
                    $stmt = $db->prepare("DELETE FROM tutor_empresas WHERE id = ?");
                    $stmt->execute([$_GET['id']]);
                    header("Location: ?module=tutor_empresa");
                    exit;
                }
                if($_SERVER['REQUEST_METHOD'] == 'POST' && $action == 'add'){
                    $stmt = $db->prepare("INSERT INTO tutor_empresas (nombre, apellidos, email, telefono, empresa_id) VALUES (?,?,?,?,?)");
                    $stmt->execute([$_POST['nombre'], $_POST['apellidos'], $_POST['email'], $_POST['telefono'], $_POST['empresa_id']]);
                    header("Location: ?module=tutor_empresa");
                    exit;
                }
                if($action == 'edit' && isset($_GET['id'])){
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $stmt = $db->prepare("UPDATE tutor_empresas SET nombre=?, apellidos=?, email=?, telefono=?, empresa_id=? WHERE id=?");
                        $stmt->execute([$_POST['nombre'], $_POST['apellidos'], $_POST['email'], $_POST['telefono'], $_POST['empresa_id'], $_GET['id']]);
                        header("Location: ?module=tutor_empresa");
                        exit;
                    } else {
                        $stmt = $db->prepare("SELECT * FROM tutor_empresas WHERE id=?");
                        $stmt->execute([$_GET['id']]);
                        $tutor_emp = $stmt->fetch(PDO::FETCH_ASSOC);
                    }
                }
                if($action == 'add' || ($action == 'edit' && isset($tutor_emp))){
                    ?>
                    <h3><?php echo ($action=='add') ? "Añadir Tutor de Empresa" : "Editar Tutor de Empresa"; ?></h3>
                    <form method="post" action="">
                        <label>Nombre:</label>
                        <input type="text" name="nombre" value="<?php echo ($action=='edit') ? $tutor_emp['nombre'] : ''; ?>" required>
                        <label>Apellidos:</label>
                        <input type="text" name="apellidos" value="<?php echo ($action=='edit') ? $tutor_emp['apellidos'] : ''; ?>" required>
                        <label>Email:</label>
                        <input type="email" name="email" value="<?php echo ($action=='edit') ? $tutor_emp['email'] : ''; ?>" required>
                        <label>Teléfono:</label>
                        <input type="text" name="telefono" value="<?php echo ($action=='edit') ? $tutor_emp['telefono'] : ''; ?>" required>
                        <label>Empresa:</label>
                        <select name="empresa_id" required>
                            <option value="">Seleccione</option>
                            <?php
                            $empStmt = $db->query("SELECT * FROM empresas");
                            while($emp = $empStmt->fetch(PDO::FETCH_ASSOC)){
                                $selected = ($action=='edit' && $tutor_emp['empresa_id'] == $emp['id']) ? "selected" : "";
                                echo "<option value='{$emp['id']}' $selected>{$emp['denominacion']}</option>";
                            }
                            ?>
                        </select>
                        <input type="submit" value="Guardar">
                    </form>
                    <?php
                } else {
                    echo "<h3>Tutor de Empresa</h3>";
                    echo "<a href='?module=tutor_empresa&action=add' class='actualizar'>Añadir</a>";
                    $stmt = $db->query("SELECT te.*, e.denominacion as empresa FROM tutor_empresas te LEFT JOIN empresas e ON te.empresa_id = e.id");
                    echo "<table>
                          <thead><tr><th>ID</th><th>Nombre</th><th>Apellidos</th><th>Email</th><th>Teléfono</th><th>Empresa</th><th>Acciones</th></tr></thead>
                          <tbody>";
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        echo "<tr>
                              <td>{$row['id']}</td>
                              <td>{$row['nombre']}</td>
                              <td>{$row['apellidos']}</td>
                              <td>{$row['email']}</td>
                              <td>{$row['telefono']}</td>
                              <td>{$row['empresa']}</td>
                              <td>
                                <a href='?module=tutor_empresa&action=edit&id={$row['id']}' class='actualizar'>Editar</a>
                                <a href='?module=tutor_empresa&action=delete&id={$row['id']}' class='eliminar' onclick=\"return confirm('¿Seguro?')\">Eliminar</a>
                              </td>
                              </tr>";
                    }
                    echo "</tbody></table>";
                }
?>
