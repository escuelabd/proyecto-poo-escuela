<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Gestor Escolar</title>
    <link rel="stylesheet" href="estilo.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h3>Gestor Escolar</h3>
        </div>
        <nav class="sidebar-nav">
            <a href="#dashboard" class="nav-item"><i class="fas fa-chart-line"></i> Dashboard</a>
            <a href="#escuelas" class="nav-item"><i class="fas fa-school"></i> Escuelas</a>
            <a href="#profesores" class="nav-item"><i class="fas fa-chalkboard-teacher"></i> Profesores</a>
            <a href="#clases" class="nav-item"><i class="fas fa-book"></i> Clases</a>
            <a href="#alumnos" class="nav-item"><i class="fas fa-user-graduate"></i> Alumnos</a>
            <a href="#asignaciones" class="nav-item"><i class="fas fa-tasks"></i> Asignaciones</a>
            <a href="tablas.php" class="nav-item"><i class="fas fa-table"></i> Ver Tablas</a>
        </nav>
    </div>

    <main class="content-wrapper">
    
    <?php
    require_once 'utils/Database.php';
    require_once 'clases/Escuela.php';
    require_once 'clases/Profesor.php';
    require_once 'clases/Clase.php';
    require_once 'clases/Alumno.php';
    require_once 'clases/Asignacion.php';

    $db = new Database();
    $pdo = $db->connect();

    $mensaje = '';
    $error = '';
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['crear_escuela'])) {
            $nombre = $_POST['nombre_escuela'];
            $direccion = $_POST['direccion'];
            $telefono = $_POST['telefono'];

            $sql = "INSERT INTO Escuela (nombre, direccion, telefono) VALUES (?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([$nombre, $direccion, $telefono])) {
                $mensaje = "Escuela creada exitosamente.";
            } else {
                $error = "Error al crear la escuela.";
            }
        }
        if (isset($_POST['crear_profesor'])) {
            $nombre = $_POST['nombre_profesor'];
            $apellido = $_POST['apellido_profesor'];
            $especialidad = $_POST['especialidad'];
            $idEscuela = $_POST['escuela_id'];

            $sql = "INSERT INTO Profesor (nombre, apellido, especialidad, idEscuela) VALUES (?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([$nombre, $apellido, $especialidad, $idEscuela])) {
                $mensaje = "Profesor creado exitosamente.";
            } else {
                $error = "Error al crear el profesor.";
            }
        }
        if (isset($_POST['crear_clase'])) {
            $nombre = $_POST['nombre_clase'];
            $descripcion = $_POST['descripcion'];
            $idProfesor = $_POST['profesor_id'];
            $idEscuela = $_POST['escuela_id'];

            $sql = "INSERT INTO Clase (nombre, descripcion, idProfesor, idEscuela) VALUES (?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([$nombre, $descripcion, $idProfesor, $idEscuela])) {
                $mensaje = "Clase creada exitosamente.";
            } else {
                $error = "Error al crear la clase.";
            }
        }
        if (isset($_POST['crear_alumno'])) {
            $nombre = $_POST['nombre_alumno'];
            $apellido = $_POST['apellido_alumno'];
            $edad = $_POST['edad'];
            $idEscuela = $_POST['escuela_id'];

            $sql = "INSERT INTO Alumno (nombre, apellido, edad, idEscuela) VALUES (?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([$nombre, $apellido, $edad, $idEscuela])) {
                $mensaje = "Alumno creado exitosamente.";
            } else {
                $error = "Error al crear el alumno.";
            }
        }
        if (isset($_POST['asignar_alumno'])) {
            $idAlumno = $_POST['alumno_id'];
            $idClase = $_POST['clase_id'];

            $sql_check = "SELECT * FROM Asignacion WHERE idAlumno = ? AND idClase = ?";
            $stmt_check = $pdo->prepare($sql_check);
            $stmt_check->execute([$idAlumno, $idClase]);
            
            if ($stmt_check->rowCount() > 0) {
                $error = "El alumno ya está asignado a esta clase.";
            } else {
                $sql = "INSERT INTO Asignacion (idAlumno, idClase) VALUES (?, ?)";
                $stmt = $pdo->prepare($sql);
                if ($stmt->execute([$idAlumno, $idClase])) {
                    $mensaje = "Alumno asignado a la clase exitosamente.";
                } else {
                    $error = "Error al asignar el alumno.";
                }
            }
        }
    }
    
    if (!empty($mensaje)) {
        echo "<div class='mensaje exito'>{$mensaje}</div>";
    }
    if (!empty($error)) {
        echo "<div class='mensaje error'>{$error}</div>";
    }

    $total_escuelas = $pdo->query("SELECT COUNT(*) FROM Escuela")->fetchColumn();
    $total_profesores = $pdo->query("SELECT COUNT(*) FROM Profesor")->fetchColumn();
    $total_clases = $pdo->query("SELECT COUNT(*) FROM Clase")->fetchColumn();
    $total_alumnos = $pdo->query("SELECT COUNT(*) FROM Alumno")->fetchColumn();

    $stmt_escuelas = $pdo->query("SELECT * FROM Escuela");
    $escuelas = $stmt_escuelas->fetchAll(PDO::FETCH_ASSOC);

    $stmt_profesores = $pdo->query("SELECT * FROM Profesor");
    $profesores = $stmt_profesores->fetchAll(PDO::FETCH_ASSOC);

    $stmt_clases = $pdo->query("SELECT * FROM Clase");
    $clases = $stmt_clases->fetchAll(PDO::FETCH_ASSOC);

    $stmt_alumnos = $pdo->query("SELECT * FROM Alumno");
    $alumnos = $stmt_alumnos->fetchAll(PDO::FETCH_ASSOC);

    ?>

    <section id="dashboard" class="dashboard-section">
        <h2 class="section-title">Dashboard</h2>
        <div class="metrics-grid">
            <div class="metric-card">
                <i class="fas fa-school icon-large"></i>
                <div class="metric-info">
                    <span class="metric-number"><?= $total_escuelas ?></span>
                    <span class="metric-label">Total de Escuelas</span>
                </div>
            </div>
            <div class="metric-card">
                <i class="fas fa-chalkboard-teacher icon-large"></i>
                <div class="metric-info">
                    <span class="metric-number"><?= $total_profesores ?></span>
                    <span class="metric-label">Total de Profesores</span>
                </div>
            </div>
            <div class="metric-card">
                <i class="fas fa-book icon-large"></i>
                <div class="metric-info">
                    <span class="metric-number"><?= $total_clases ?></span>
                    <span class="metric-label">Total de Clases</span>
                </div>
            </div>
            <div class="metric-card">
                <i class="fas fa-user-graduate icon-large"></i>
                <div class="metric-info">
                    <span class="metric-number"><?= $total_alumnos ?></span>
                    <span class="metric-label">Total de Alumnos</span>
                </div>
            </div>
        </div>

        <div class="quick-actions-grid">
            <a href="#alumnos" class="action-card">
                <i class="fas fa-plus"></i>
                <span>Nuevo Alumno</span>
            </a>
            <a href="#clases" class="action-card">
                <i class="fas fa-plus"></i>
                <span>Nueva Clase</span>
            </a>
            <a href="#profesores" class="action-card">
                <i class="fas fa-plus"></i>
                <span>Nuevo Profesor</span>
            </a>
            <a href="#asignaciones" class="action-card">
                <i class="fas fa-tasks"></i>
                <span>Asignar Clase</span>
            </a>
        </div>
    </section>

    <section id="escuelas" class="module-card">
        <h2 class="module-title">Crear Nueva Escuela</h2>
        <div class="module-content">
            <form method="POST" action="index.php#escuelas" class="form-section full-width">
                <input type="hidden" name="crear_escuela" value="1">
                <div class="form-group">
                    <label for="nombre_escuela">Nombre de la escuela</label>
                    <input type="text" id="nombre_escuela" name="nombre_escuela" required>
                </div>
                <div class="form-group">
                    <label for="direccion">Dirección</label>
                    <input type="text" id="direccion" name="direccion" required>
                </div>
                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="text" id="telefono" name="telefono" required>
                </div>
                <button type="submit" class="btn">Crear Escuela</button>
            </form>
        </div>
    </section>

    <section id="profesores" class="module-card">
        <h2 class="module-title">Crear Nuevo Profesor</h2>
        <div class="module-content">
            <form method="POST" action="index.php#profesores" class="form-section full-width">
                <input type="hidden" name="crear_profesor" value="1">
                <div class="form-group">
                    <label for="nombre_profesor">Nombre</label>
                    <input type="text" id="nombre_profesor" name="nombre_profesor" required>
                </div>
                <div class="form-group">
                    <label for="apellido_profesor">Apellido</label>
                    <input type="text" id="apellido_profesor" name="apellido_profesor" required>
                </div>
                <div class="form-group">
                    <label for="especialidad">Especialidad</label>
                    <input type="text" id="especialidad" name="especialidad" required>
                </div>
                <div class="form-group">
                    <label for="profesor_escuela_id">Escuela</label>
                    <select id="profesor_escuela_id" name="escuela_id" required>
                        <option value="">-- Seleccionar Escuela --</option>
                        <?php foreach ($escuelas as $escuela): ?>
                            <option value="<?= $escuela['idEscuela'] ?>"><?= htmlspecialchars($escuela['nombre']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn">Crear Profesor</button>
            </form>
        </div>
    </section>

    <section id="clases" class="module-card">
        <h2 class="module-title">Crear Nueva Clase</h2>
        <div class="module-content">
            <form method="POST" action="index.php#clases" class="form-section full-width">
                <input type="hidden" name="crear_clase" value="1">
                <div class="form-group">
                    <label for="nombre_clase">Nombre de la clase</label>
                    <input type="text" id="nombre_clase" name="nombre_clase" required>
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <input type="text" id="descripcion" name="descripcion">
                </div>
                <div class="form-group">
                    <label for="clase_profesor_id">Profesor</label>
                    <select id="clase_profesor_id" name="profesor_id" required>
                        <option value="">-- Seleccionar Profesor --</option>
                        <?php foreach ($profesores as $profesor): ?>
                            <option value="<?= $profesor['idProfesor'] ?>"><?= htmlspecialchars($profesor['nombre'] . ' ' . $profesor['apellido']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="clase_escuela_id">Escuela</label>
                    <select id="clase_escuela_id" name="escuela_id" required>
                        <option value="">-- Seleccionar Escuela --</option>
                        <?php foreach ($escuelas as $escuela): ?>
                            <option value="<?= $escuela['idEscuela'] ?>"><?= htmlspecialchars($escuela['nombre']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn">Crear Clase</button>
            </form>
        </div>
    </section>

    <section id="alumnos" class="module-card">
        <h2 class="module-title">Crear Nuevo Alumno</h2>
        <div class="module-content">
            <form method="POST" action="index.php#alumnos" class="form-section full-width">
                <input type="hidden" name="crear_alumno" value="1">
                <div class="form-group">
                    <label for="nombre_alumno">Nombre</label>
                    <input type="text" id="nombre_alumno" name="nombre_alumno" required>
                </div>
                <div class="form-group">
                    <label for="apellido_alumno">Apellido</label>
                    <input type="text" id="apellido_alumno" name="apellido_alumno" required>
                </div>
                <div class="form-group">
                    <label for="edad">Edad</label>
                    <input type="number" id="edad" name="edad" required>
                </div>
                <div class="form-group">
                    <label for="alumno_escuela_id">Escuela</label>
                    <select id="alumno_escuela_id" name="escuela_id" required>
                        <option value="">-- Seleccionar Escuela --</option>
                        <?php foreach ($escuelas as $escuela): ?>
                            <option value="<?= $escuela['idEscuela'] ?>"><?= htmlspecialchars($escuela['nombre']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn">Crear Alumno</button>
            </form>
        </div>
    </section>

    <section id="asignaciones" class="module-card">
        <h2 class="module-title">Asignar Alumno a Clase</h2>
        <div class="module-content">
            <form method="POST" action="index.php#asignaciones" class="form-section full-width">
                <input type="hidden" name="asignar_alumno" value="1">
                <div class="form-group">
                    <label for="asignacion_alumno_id">Alumno</label>
                    <select id="asignacion_alumno_id" name="alumno_id" required>
                        <option value="">-- Seleccionar Alumno --</option>
                        <?php foreach ($alumnos as $alumno): ?>
                            <option value="<?= $alumno['idAlumno'] ?>"><?= htmlspecialchars($alumno['nombre'] . ' ' . $alumno['apellido']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="asignacion_clase_id">Clase</label>
                    <select id="asignacion_clase_id" name="clase_id" required>
                        <option value="">-- Seleccionar Clase --</option>
                        <?php foreach ($clases as $clase): ?>
                            <option value="<?= $clase['idClase'] ?>"><?= htmlspecialchars($clase['nombre']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn">Asignar a Clase</button>
            </form>
        </div>
    </section>

    </main>
</body>
</html>