<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tablas | Gestor Escolar</title>
    <link rel="stylesheet" href="estilo.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h3>Gestor Escolar</h3>
        </div>
        <nav class="sidebar-nav">
            <a href="index.php#dashboard" class="nav-item"><i class="fas fa-chart-line"></i> Dashboard</a>
            <a href="index.php#escuelas" class="nav-item"><i class="fas fa-school"></i> Escuelas</a>
            <a href="index.php#profesores" class="nav-item"><i class="fas fa-chalkboard-teacher"></i> Profesores</a>
            <a href="index.php#clases" class="nav-item"><i class="fas fa-book"></i> Clases</a>
            <a href="index.php#alumnos" class="nav-item"><i class="fas fa-user-graduate"></i> Alumnos</a>
            <a href="index.php#asignaciones" class="nav-item"><i class="fas fa-tasks"></i> Asignaciones</a>
            <a href="#" class="nav-item active"><i class="fas fa-table"></i> Ver Tablas</a>
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

    $stmt_escuelas = $pdo->query("SELECT * FROM Escuela");
    $escuelas = $stmt_escuelas->fetchAll(PDO::FETCH_ASSOC);

    $sql_profesores = "SELECT p.*, e.nombre as nombre_escuela FROM Profesor p LEFT JOIN Escuela e ON p.idEscuela = e.idEscuela";
    $stmt_profesores = $pdo->query($sql_profesores);
    $profesores = $stmt_profesores->fetchAll(PDO::FETCH_ASSOC);

    $sql_clases = "SELECT c.*, p.nombre as nombre_profesor, p.apellido as apellido_profesor, e.nombre as nombre_escuela FROM Clase c LEFT JOIN Profesor p ON c.idProfesor = p.idProfesor LEFT JOIN Escuela e ON c.idEscuela = e.idEscuela";
    $stmt_clases = $pdo->query($sql_clases);
    $clases = $stmt_clases->fetchAll(PDO::FETCH_ASSOC);

    $sql_alumnos = "SELECT a.*, e.nombre as nombre_escuela FROM Alumno a LEFT JOIN Escuela e ON a.idEscuela = e.idEscuela";
    $stmt_alumnos = $pdo->query($sql_alumnos);
    $alumnos = $stmt_alumnos->fetchAll(PDO::FETCH_ASSOC);
    
    $sql_asignaciones = "SELECT asig.*, a.nombre as nombre_alumno, a.apellido as apellido_alumno, c.nombre as nombre_clase FROM Asignacion asig LEFT JOIN Alumno a ON asig.idAlumno = a.idAlumno LEFT JOIN Clase c ON asig.idClase = c.idClase";
    $stmt_asignaciones = $pdo->query($sql_asignaciones);
    $asignaciones = $stmt_asignaciones->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <section id="list-escuelas" class="module-card">
        <h2 class="module-title">Lista de Escuelas</h2>
        <div class="table-container">
            <?php if (empty($escuelas)): ?>
                <p class='no-results'>No hay escuelas registradas.</p>
            <?php else: ?>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($escuelas as $escuela): ?>
                            <tr>
                                <td><?= htmlspecialchars($escuela['idEscuela']) ?></td>
                                <td><?= htmlspecialchars($escuela['nombre']) ?></td>
                                <td><?= htmlspecialchars($escuela['direccion']) ?></td>
                                <td><?= htmlspecialchars($escuela['telefono']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </section>

    <section id="list-profesores" class="module-card">
        <h2 class="module-title">Lista de Profesores</h2>
        <div class="table-container">
            <?php if (empty($profesores)): ?>
                <p class='no-results'>No hay profesores registrados.</p>
            <?php else: ?>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre Completo</th>
                            <th>Especialidad</th>
                            <th>Escuela</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($profesores as $profesor): ?>
                            <tr>
                                <td><?= htmlspecialchars($profesor['idProfesor']) ?></td>
                                <td><?= htmlspecialchars($profesor['nombre'] . ' ' . $profesor['apellido']) ?></td>
                                <td><?= htmlspecialchars($profesor['especialidad']) ?></td>
                                <td><?= htmlspecialchars($profesor['nombre_escuela']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </section>

    <section id="list-clases" class="module-card">
        <h2 class="module-title">Lista de Clases</h2>
        <div class="table-container">
            <?php if (empty($clases)): ?>
                <p class='no-results'>No hay clases registradas.</p>
            <?php else: ?>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Profesor</th>
                            <th>Escuela</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($clases as $clase): ?>
                            <tr>
                                <td><?= htmlspecialchars($clase['idClase']) ?></td>
                                <td><?= htmlspecialchars($clase['nombre']) ?></td>
                                <td><?= htmlspecialchars($clase['descripcion']) ?></td>
                                <td><?= htmlspecialchars($clase['nombre_profesor'] . ' ' . $clase['apellido_profesor']) ?></td>
                                <td><?= htmlspecialchars($clase['nombre_escuela']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </section>

    <section id="list-alumnos" class="module-card">
        <h2 class="module-title">Lista de Alumnos</h2>
        <div class="table-container">
            <?php if (empty($alumnos)): ?>
                <p class='no-results'>No hay alumnos registrados.</p>
            <?php else: ?>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre Completo</th>
                            <th>Edad</th>
                            <th>Escuela</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($alumnos as $alumno): ?>
                            <tr>
                                <td><?= htmlspecialchars($alumno['idAlumno']) ?></td>
                                <td><?= htmlspecialchars($alumno['nombre'] . ' ' . $alumno['apellido']) ?></td>
                                <td><?= htmlspecialchars($alumno['edad']) ?></td>
                                <td><?= htmlspecialchars($alumno['nombre_escuela']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </section>

    <section id="list-asignaciones" class="module-card">
        <h2 class="module-title">Asignaciones de Alumnos a Clases</h2>
        <div class="table-container">
            <?php if (empty($asignaciones)): ?>
                <p class='no-results'>No hay asignaciones registradas.</p>
            <?php else: ?>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID Asignación</th>
                            <th>Alumno</th>
                            <th>Clase</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($asignaciones as $asignacion): ?>
                            <tr>
                                <td><?= htmlspecialchars($asignacion['idAsignacion']) ?></td>
                                <td><?= htmlspecialchars($asignacion['nombre_alumno'] . ' ' . $asignacion['apellido_alumno']) ?></td>
                                <td><?= htmlspecialchars($asignacion['nombre_clase']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </section>

    </main>
</body>
</html>