<?php
	// DELETE student
                if($action == 'delete' && isset($_GET['id'])){
                    $stmt = $db->prepare("DELETE FROM students WHERE id = ?");
                    $stmt->execute([$_GET['id']]);
                    header("Location: ?module=students");
                    exit;
                }
                // ADD new student
                if($_SERVER['REQUEST_METHOD'] == 'POST' && $action == 'add'){
                    $stmt = $db->prepare("INSERT INTO students 
                    (nombre, apellidos, dni, nuss, email, telefono, fecha_nacimiento, prl, otra_cert_prl, detalle_otra_cert_prl, discapacidad, medidas_discapacidad, autorizaciones_extra, especificar_autorizaciones, observaciones)
                    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                    $stmt->execute([
                        $_POST['nombre'],
                        $_POST['apellidos'],
                        $_POST['dni'],
                        $_POST['nuss'],
                        $_POST['email'],
                        $_POST['telefono'],
                        $_POST['fecha_nacimiento'],
                        isset($_POST['prl']) ? 1 : 0,
                        isset($_POST['otra_cert_prl']) ? 1 : 0,
                        $_POST['detalle_otra_cert_prl'],
                        isset($_POST['discapacidad']) ? 1 : 0,
                        $_POST['medidas_discapacidad'],
                        isset($_POST['autorizaciones_extra']) ? 1 : 0,
                        $_POST['especificar_autorizaciones'],
                        $_POST['observaciones']
                    ]);
                    header("Location: ?module=students");
                    exit;
                }
                // EDIT student
                if($action == 'edit' && isset($_GET['id'])){
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $stmt = $db->prepare("UPDATE students SET 
                          nombre=?, apellidos=?, dni=?, nuss=?, email=?, telefono=?, fecha_nacimiento=?, prl=?, otra_cert_prl=?, detalle_otra_cert_prl=?, discapacidad=?, medidas_discapacidad=?, autorizaciones_extra=?, especificar_autorizaciones=?, observaciones=?
                          WHERE id=?");
                        $stmt->execute([
                          $_POST['nombre'],
                          $_POST['apellidos'],
                          $_POST['dni'],
                          $_POST['nuss'],
                          $_POST['email'],
                          $_POST['telefono'],
                          $_POST['fecha_nacimiento'],
                          isset($_POST['prl']) ? 1 : 0,
                          isset($_POST['otra_cert_prl']) ? 1 : 0,
                          $_POST['detalle_otra_cert_prl'],
                          isset($_POST['discapacidad']) ? 1 : 0,
                          $_POST['medidas_discapacidad'],
                          isset($_POST['autorizaciones_extra']) ? 1 : 0,
                          $_POST['especificar_autorizaciones'],
                          $_POST['observaciones'],
                          $_GET['id']
                        ]);
                        header("Location: ?module=students");
                        exit;
                    } else {
                        $stmt = $db->prepare("SELECT * FROM students WHERE id=?");
                        $stmt->execute([$_GET['id']]);
                        $student = $stmt->fetch(PDO::FETCH_ASSOC);
                    }
                }
                if($action == 'add' || ($action == 'edit' && isset($student))){
                    ?>
                    <h3><?php echo ($action=='add') ? "Añadir Estudiante" : "Editar Estudiante"; ?></h3>
                    <form method="post" action="">
                        <label>Nombre:</label>
                        <input type="text" name="nombre" value="<?php echo ($action=='edit') ? $student['nombre'] : ''; ?>" required>
                        <label>Apellidos:</label>
                        <input type="text" name="apellidos" value="<?php echo ($action=='edit') ? $student['apellidos'] : ''; ?>" required>
                        <label>DNI:</label>
                        <input type="text" name="dni" value="<?php echo ($action=='edit') ? $student['dni'] : ''; ?>" required>
                        <label>NUSS:</label>
                        <input type="text" name="nuss" value="<?php echo ($action=='edit') ? $student['nuss'] : ''; ?>" required>
                        <label>Email:</label>
                        <input type="email" name="email" value="<?php echo ($action=='edit') ? $student['email'] : ''; ?>" required>
                        <label>Teléfono:</label>
                        <input type="text" name="telefono" value="<?php echo ($action=='edit') ? $student['telefono'] : ''; ?>" required>
                        <label>Fecha de Nacimiento:</label>
                        <input type="date" name="fecha_nacimiento" value="<?php echo ($action=='edit') ? $student['fecha_nacimiento'] : ''; ?>" required>
                        <label>PRL:</label>
                        <input type="checkbox" name="prl" <?php echo ($action=='edit' && $student['prl']) ? "checked" : ""; ?>>
                        <label>Otra certificación PRL:</label>
                        <input type="checkbox" name="otra_cert_prl" <?php echo ($action=='edit' && $student['otra_cert_prl']) ? "checked" : ""; ?>>
                        <label>Detalle otra certificación PRL:</label>
                        <input type="text" name="detalle_otra_cert_prl" value="<?php echo ($action=='edit') ? $student['detalle_otra_cert_prl'] : ''; ?>">
                        <label>Requiere medidas/adaptaciones por discapacidad:</label>
                        <input type="checkbox" name="discapacidad" <?php echo ($action=='edit' && $student['discapacidad']) ? "checked" : ""; ?>>
                        <label>Especificar medidas/adaptaciones:</label>
                        <input type="text" name="medidas_discapacidad" value="<?php echo ($action=='edit') ? $student['medidas_discapacidad'] : ''; ?>">
                        <label>Requiere autorizaciones extraordinarias:</label>
                        <input type="checkbox" name="autorizaciones_extra" <?php echo ($action=='edit' && $student['autorizaciones_extra']) ? "checked" : ""; ?>>
                        <label>Especificar autorizaciones:</label>
                        <input type="text" name="especificar_autorizaciones" value="<?php echo ($action=='edit') ? $student['especificar_autorizaciones'] : ''; ?>">
                        <label>Observaciones:</label>
                        <textarea name="observaciones"><?php echo ($action=='edit') ? $student['observaciones'] : ''; ?></textarea>
                        <input type="submit" value="Guardar">
                    </form>
                    <?php
                } else {
                    echo "<h3>Estudiantes</h3>";
                    echo "<a href='?module=students&action=add' class='actualizar'>Añadir</a>";
                    $stmt = $db->query("SELECT * FROM students");
                    echo "<table>";
                    echo "<thead><tr>
                          <th>ID</th>
                          <th>Nombre</th>
                          <th>Apellidos</th>
                          <th>DNI</th>
                          <th>NUSS</th>
                          <th>Email</th>
                          <th>Teléfono</th>
                          <th>F. Nac.</th>
                          <th>PRL</th>
                          <th>Otra Cert.</th>
                          <th>Detalle Otra Cert.</th>
                          <th>Discapacidad</th>
                          <th>Medidas</th>
                          <th>Autoriz. Extra</th>
                          <th>Especif. Autoriz.</th>
                          <th>Observaciones</th>
                          <th>Acciones</th>
                          </tr></thead>";
                    echo "<tbody>";
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        echo "<tr>
                              <td>{$row['id']}</td>
                              <td>{$row['nombre']}</td>
                              <td>{$row['apellidos']}</td>
                              <td>{$row['dni']}</td>
                              <td>{$row['nuss']}</td>
                              <td>{$row['email']}</td>
                              <td>{$row['telefono']}</td>
                              <td>{$row['fecha_nacimiento']}</td>
                              <td>" . ($row['prl'] ? "Sí" : "No") . "</td>
                              <td>" . ($row['otra_cert_prl'] ? "Sí" : "No") . "</td>
                              <td>{$row['detalle_otra_cert_prl']}</td>
                              <td>" . ($row['discapacidad'] ? "Sí" : "No") . "</td>
                              <td>{$row['medidas_discapacidad']}</td>
                              <td>" . ($row['autorizaciones_extra'] ? "Sí" : "No") . "</td>
                              <td>{$row['especificar_autorizaciones']}</td>
                              <td>{$row['observaciones']}</td>
                              <td>
                                  <a href='?module=students&action=edit&id={$row['id']}' class='actualizar'>Editar</a>
                                  <a href='?module=students&action=delete&id={$row['id']}' class='eliminar' onclick=\"return confirm('¿Seguro?')\">Eliminar</a>
                              </td>
                              </tr>";
                    }
                    echo "</tbody></table>";
                }
?>
