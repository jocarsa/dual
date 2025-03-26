<?php
if($action == 'delete' && isset($_GET['id'])){
                    $stmt = $db->prepare("DELETE FROM matriculas WHERE id = ?");
                    $stmt->execute([$_GET['id']]);
                    header("Location: ?module=matriculas");
                    exit;
                }
                if($_SERVER['REQUEST_METHOD'] == 'POST' && $action == 'add'){
                    $stmt = $db->prepare("INSERT INTO matriculas (alumno_id, grupo_id, empresa_id) VALUES (?,?,?)");
                    $stmt->execute([$_POST['alumno_id'], $_POST['grupo_id'], $_POST['empresa_id']]);
                    header("Location: ?module=matriculas");
                    exit;
                }
                if($action == 'edit' && isset($_GET['id'])){
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $stmt = $db->prepare("UPDATE matriculas SET alumno_id=?, grupo_id=?, empresa_id=? WHERE id=?");
                        $stmt->execute([$_POST['alumno_id'], $_POST['grupo_id'], $_POST['empresa_id'], $_GET['id']]);
                        header("Location: ?module=matriculas");
                        exit;
                    } else {
                        $stmt = $db->prepare("SELECT * FROM matriculas WHERE id=?");
                        $stmt->execute([$_GET['id']]);
                        $matricula = $stmt->fetch(PDO::FETCH_ASSOC);
                    }
                }
                if($action == 'add' || ($action == 'edit' && isset($matricula))){
                    ?>
                    <h3><?php echo ($action=='add') ? "Añadir Matrícula" : "Editar Matrícula"; ?></h3>
                    <form method="post" action="">
                        <label>Alumno:</label>
                        <select name="alumno_id" required>
                            <option value="">Seleccione</option>
                            <?php
                            $alumnoStmt = $db->query("SELECT * FROM students");
                            while($alumnoRow = $alumnoStmt->fetch(PDO::FETCH_ASSOC)){
                                $selected = ($action=='edit' && $matricula['alumno_id'] == $alumnoRow['id']) ? "selected" : "";
                                echo "<option value='{$alumnoRow['id']}' $selected>{$alumnoRow['nombre']} {$alumnoRow['apellidos']}</option>";
                            }
                            ?>
                        </select>
                        <label>Grupo:</label>
                        <select name="grupo_id" required>
                            <option value="">Seleccione</option>
                            <?php
                            $grupoStmt = $db->query("SELECT g.*, c.nombre_ciclo, cu.curso FROM grupos g 
                                                      LEFT JOIN ciclos c ON g.ciclo_id = c.id 
                                                      LEFT JOIN cursos cu ON g.curso_id = cu.id");
                            while($grupoRow = $grupoStmt->fetch(PDO::FETCH_ASSOC)){
                                $selected = ($action=='edit' && $matricula['grupo_id'] == $grupoRow['id']) ? "selected" : "";
                                echo "<option value='{$grupoRow['id']}' $selected>{$grupoRow['nombre']} - {$grupoRow['nombre_ciclo']} - {$grupoRow['curso']}</option>";
                            }
                            ?>
                        </select>
                        <label>Empresa:</label>
                        <select name="empresa_id" required>
                            <option value="">Seleccione</option>
                            <?php
                            $empresaStmt = $db->query("SELECT * FROM empresas");
                            while($empresaRow = $empresaStmt->fetch(PDO::FETCH_ASSOC)){
                                $selected = ($action=='edit' && $matricula['empresa_id'] == $empresaRow['id']) ? "selected" : "";
                                echo "<option value='{$empresaRow['id']}' $selected>{$empresaRow['denominacion']}</option>";
                            }
                            ?>
                        </select>
                        <input type="submit" value="Guardar">
                    </form>
                    <?php
                } else {
                    echo "<h3>Matrículas</h3>";
                    echo "<a href='?module=matriculas&action=add' class='actualizar'>Añadir</a>";
                    $stmt = $db->query("SELECT m.*, s.nombre as alumno, s.apellidos as apellidos, g.nombre as grupo, e.denominacion as empresa FROM matriculas m 
                                          LEFT JOIN students s ON m.alumno_id = s.id 
                                          LEFT JOIN grupos g ON m.grupo_id = g.id 
                                          LEFT JOIN empresas e ON m.empresa_id = e.id");
                    echo "<table>
                          <thead><tr><th>ID</th><th>Alumno</th><th>Grupo</th><th>Empresa</th><th>Acciones</th></tr></thead>
                          <tbody>";
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        echo "<tr>
                              <td>{$row['id']}</td>
                              <td>{$row['alumno']} {$row['apellidos']}</td>
                              <td>{$row['grupo']}</td>
                              <td>{$row['empresa']}</td>
                              <td>
                                <a href='?module=matriculas&action=edit&id={$row['id']}' class='actualizar'>Editar</a>
                                <a href='?module=matriculas&action=delete&id={$row['id']}' class='eliminar' onclick=\"return confirm('¿Seguro?')\">Eliminar</a>
                              </td>
                              </tr>";
                    }
                    echo "</tbody></table>";
                }
?>
