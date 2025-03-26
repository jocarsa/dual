<?php
if($action == 'delete' && isset($_GET['id'])){
    $stmt = $db->prepare("DELETE FROM grupos WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    header("Location: ?module=grupos");
    exit;
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && $action == 'add'){
    $stmt = $db->prepare("INSERT INTO grupos (nombre, ciclo_id, curso_id, modalidad_id, tutor_id) VALUES (?,?,?,?,?)");
    $stmt->execute([
        $_POST['nombre'],
        $_POST['ciclo_id'],
        $_POST['curso_id'],
        $_POST['modalidad_id'],
        $_POST['tutor_id']
    ]);
    header("Location: ?module=grupos");
    exit;
}
if($action == 'edit' && isset($_GET['id'])){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $stmt = $db->prepare("UPDATE grupos SET nombre=?, ciclo_id=?, curso_id=?, modalidad_id=?, tutor_id=? WHERE id=?");
        $stmt->execute([
            $_POST['nombre'],
            $_POST['ciclo_id'],
            $_POST['curso_id'],
            $_POST['modalidad_id'],
            $_POST['tutor_id'],
            $_GET['id']
        ]);
        header("Location: ?module=grupos");
        exit;
    } else {
        $stmt = $db->prepare("SELECT * FROM grupos WHERE id=?");
        $stmt->execute([$_GET['id']]);
        $grupo = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
if($action == 'add' || ($action == 'edit' && isset($grupo))){
    ?>
    <h3><?php echo ($action=='add') ? "Añadir Grupo" : "Editar Grupo"; ?></h3>
    <form method="post" action="">
        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?php echo ($action=='edit') ? $grupo['nombre'] : ''; ?>" required>
        
        <label>Ciclo:</label>
        <select name="ciclo_id" required>
            <option value="">Seleccione</option>
            <?php
            $cicloStmt = $db->query("SELECT * FROM ciclos");
            while($cicloRow = $cicloStmt->fetch(PDO::FETCH_ASSOC)){
                $selected = ($action=='edit' && $grupo['ciclo_id'] == $cicloRow['id']) ? "selected" : "";
                echo "<option value='{$cicloRow['id']}' $selected>{$cicloRow['nombre_ciclo']}</option>";
            }
            ?>
        </select>
        
        <label>Curso:</label>
        <select name="curso_id" required>
            <option value="">Seleccione</option>
            <?php
            $cursoStmt = $db->query("SELECT * FROM cursos");
            while($cursoRow = $cursoStmt->fetch(PDO::FETCH_ASSOC)){
                $selected = ($action=='edit' && $grupo['curso_id'] == $cursoRow['id']) ? "selected" : "";
                echo "<option value='{$cursoRow['id']}' $selected>{$cursoRow['curso']}</option>";
            }
            ?>
        </select>
        
        <label>Modalidad:</label>
        <select name="modalidad_id" required>
            <option value="">Seleccione</option>
            <?php
            $modalidadStmt = $db->query("SELECT * FROM modalidades");
            while($modalidadRow = $modalidadStmt->fetch(PDO::FETCH_ASSOC)){
                $selected = ($action=='edit' && $grupo['modalidad_id'] == $modalidadRow['id']) ? "selected" : "";
                echo "<option value='{$modalidadRow['id']}' $selected>{$modalidadRow['nombre']}</option>";
            }
            ?>
        </select>
        
        <label>Tutor:</label>
        <select name="tutor_id" required>
            <option value="">Seleccione</option>
            <?php
            $tutorStmt = $db->query("SELECT * FROM tutors");
            while($tutorRow = $tutorStmt->fetch(PDO::FETCH_ASSOC)){
                $selected = ($action=='edit' && $grupo['tutor_id'] == $tutorRow['id']) ? "selected" : "";
                echo "<option value='{$tutorRow['id']}' $selected>{$tutorRow['nombre']} {$tutorRow['apellidos']}</option>";
            }
            ?>
        </select>
        
        <input type="submit" value="Guardar">
    </form>
    <?php
} else {
    echo "<h3>Grupos</h3>";
    echo "<a href='?module=grupos&action=add' class='actualizar'>Añadir</a>";
    $stmt = $db->query("SELECT g.*, c.nombre_ciclo, cu.curso, m.nombre as modalidad, t.nombre as tutor, t.apellidos as tutor_apellidos FROM grupos g 
                          LEFT JOIN ciclos c ON g.ciclo_id = c.id 
                          LEFT JOIN cursos cu ON g.curso_id = cu.id
                          LEFT JOIN modalidades m ON g.modalidad_id = m.id
                          LEFT JOIN tutors t ON g.tutor_id = t.id");
    echo "<table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Ciclo</th>
              <th>Curso</th>
              <th>Modalidad</th>
              <th>Tutor</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>";
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo "<tr>
              <td>{$row['id']}</td>
              <td>{$row['nombre']}</td>
              <td>{$row['nombre_ciclo']}</td>
              <td>{$row['curso']}</td>
              <td>{$row['modalidad']}</td>
              <td>{$row['tutor']} {$row['tutor_apellidos']}</td>
              <td>
                <a href='?module=grupos&action=edit&id={$row['id']}' class='actualizar'>Editar</a>
                <a href='?module=grupos&action=delete&id={$row['id']}' class='eliminar' onclick=\"return confirm('¿Seguro?')\">Eliminar</a>
              </td>
              </tr>";
    }
    echo "</tbody></table>";
}
?>

