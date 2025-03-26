<?php
if($action == 'delete' && isset($_GET['id'])){
                    $stmt = $db->prepare("DELETE FROM tutors WHERE id = ?");
                    $stmt->execute([$_GET['id']]);
                    header("Location: ?module=tutors");
                    exit;
                }
                if($_SERVER['REQUEST_METHOD'] == 'POST' && $action == 'add'){
                    $stmt = $db->prepare("INSERT INTO tutors (nombre, apellidos, email, telefono) VALUES (?,?,?,?)");
                    $stmt->execute([$_POST['nombre'], $_POST['apellidos'], $_POST['email'], $_POST['telefono']]);
                    header("Location: ?module=tutors");
                    exit;
                }
                if($action == 'edit' && isset($_GET['id'])){
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $stmt = $db->prepare("UPDATE tutors SET nombre=?, apellidos=?, email=?, telefono=? WHERE id=?");
                        $stmt->execute([$_POST['nombre'], $_POST['apellidos'], $_POST['email'], $_POST['telefono'], $_GET['id']]);
                        header("Location: ?module=tutors");
                        exit;
                    } else {
                        $stmt = $db->prepare("SELECT * FROM tutors WHERE id=?");
                        $stmt->execute([$_GET['id']]);
                        $tutor = $stmt->fetch(PDO::FETCH_ASSOC);
                    }
                }
                if($action == 'add' || ($action == 'edit' && isset($tutor))){
                    ?>
                    <h3><?php echo ($action=='add') ? "Añadir Tutor" : "Editar Tutor"; ?></h3>
                    <form method="post" action="">
                        <label>Nombre:</label>
                        <input type="text" name="nombre" value="<?php echo ($action=='edit') ? $tutor['nombre'] : ''; ?>" required>
                        <label>Apellidos:</label>
                        <input type="text" name="apellidos" value="<?php echo ($action=='edit') ? $tutor['apellidos'] : ''; ?>" required>
                        <label>Email:</label>
                        <input type="email" name="email" value="<?php echo ($action=='edit') ? $tutor['email'] : ''; ?>" required>
                        <label>Teléfono:</label>
                        <input type="text" name="telefono" value="<?php echo ($action=='edit') ? $tutor['telefono'] : ''; ?>" required>
                        <input type="submit" value="Guardar">
                    </form>
                    <?php
                } else {
                    echo "<h3>Tutores</h3>";
                    echo "<a href='?module=tutors&action=add' class='actualizar'>Añadir</a>";
                    $stmt = $db->query("SELECT * FROM tutors");
                    echo "<table>
                          <thead><tr><th>ID</th><th>Nombre</th><th>Apellidos</th><th>Email</th><th>Teléfono</th><th>Acciones</th></tr></thead>
                          <tbody>";
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        echo "<tr>
                              <td>{$row['id']}</td>
                              <td>{$row['nombre']}</td>
                              <td>{$row['apellidos']}</td>
                              <td>{$row['email']}</td>
                              <td>{$row['telefono']}</td>
                              <td>
                                <a href='?module=tutors&action=edit&id={$row['id']}' class='actualizar'>Editar</a>
                                <a href='?module=tutors&action=delete&id={$row['id']}' class='eliminar' onclick=\"return confirm('¿Seguro?')\">Eliminar</a>
                              </td>
                              </tr>";
                    }
                    echo "</tbody></table>";
                }
?>
