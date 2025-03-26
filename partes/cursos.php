<?php
if($action == 'delete' && isset($_GET['id'])){
                    $stmt = $db->prepare("DELETE FROM cursos WHERE id = ?");
                    $stmt->execute([$_GET['id']]);
                    header("Location: ?module=cursos");
                    exit;
                }
                if($_SERVER['REQUEST_METHOD'] == 'POST' && $action == 'add'){
                    $stmt = $db->prepare("INSERT INTO cursos (curso) VALUES (?)");
                    $stmt->execute([$_POST['curso']]);
                    header("Location: ?module=cursos");
                    exit;
                }
                if($action == 'edit' && isset($_GET['id'])){
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $stmt = $db->prepare("UPDATE cursos SET curso=? WHERE id=?");
                        $stmt->execute([$_POST['curso'], $_GET['id']]);
                        header("Location: ?module=cursos");
                        exit;
                    } else {
                        $stmt = $db->prepare("SELECT * FROM cursos WHERE id=?");
                        $stmt->execute([$_GET['id']]);
                        $curso = $stmt->fetch(PDO::FETCH_ASSOC);
                    }
                }
                if($action == 'add' || ($action == 'edit' && isset($curso))){
                    ?>
                    <h3><?php echo ($action=='add') ? "Añadir Curso" : "Editar Curso"; ?></h3>
                    <form method="post" action="">
                        <label>Curso:</label>
                        <input type="text" name="curso" value="<?php echo ($action=='edit') ? $curso['curso'] : ''; ?>" required>
                        <input type="submit" value="Guardar">
                    </form>
                    <?php
                } else {
                    echo "<h3>Cursos</h3>";
                    echo "<a href='?module=cursos&action=add' class='actualizar'>Añadir</a>";
                    $stmt = $db->query("SELECT * FROM cursos");
                    echo "<table>
                          <thead><tr><th>ID</th><th>Curso</th><th>Acciones</th></tr></thead>
                          <tbody>";
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        echo "<tr>
                              <td>{$row['id']}</td>
                              <td>{$row['curso']}</td>
                              <td>
                                <a href='?module=cursos&action=edit&id={$row['id']}' class='actualizar'>Editar</a>
                                <a href='?module=cursos&action=delete&id={$row['id']}' class='eliminar' onclick=\"return confirm('¿Seguro?')\">Eliminar</a>
                              </td>
                              </tr>";
                    }
                    echo "</tbody></table>";
                }
?>
