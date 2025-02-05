<?php
$connection = new mysqli("localhost", "root", "root", "vehiculos");

// Verificar conexión
if ($connection->connect_error) {
    die("Error de conexión: " . $connection->connect_error);
}

// 🟢 Obtener órdenes activas de "Fletes Tauro"
$sql_ordenes = "SELECT o.ID, v.Nombre AS Unidad, o.Descripcion, o.Estado, o.Fecha, 
                       IFNULL(v.Asignacion, 'Sin asignar') AS Asignacion, 
                       IFNULL(m.Nombre, 'No asignado') AS Mecanico, 
                       IFNULL(o.Prioridad, 'Sin asignar') AS Prioridad
                FROM ordenes o
                INNER JOIN vehiculos v ON o.Unidad_ID = v.ID 
                LEFT JOIN mecanicos m ON o.Mecanico_ID = m.ID
                WHERE (o.Estado = 'Pendiente' OR o.Estado = 'Activa')
                AND v.Asignacion = 'fletes_tauro'
                ORDER BY o.Fecha DESC";

$result_ordenes = $connection->query($sql_ordenes);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Órdenes Activas - Fletes Tauro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <style>
        .prioridad-alta { background-color: #ff6b6b !important; color: white; }  /* 🔴 Rojo */
        .prioridad-media { background-color: #feca57 !important; color: black; } /* 🟡 Amarillo */
        .prioridad-baja { background-color: #1dd1a1 !important; color: white; }  /* 🟢 Verde */
        .sin-asignar { background-color: #d6e4ff !important; }  /* 🔵 Azul claro */
    </style>
</head>
<body>
    <div class="container my-5">

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Unidad</th>
                    <th>Descripción</th>
                    <th>Mecánico Asignado</th>
                    <th>Prioridad</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result_ordenes->num_rows > 0): ?>
                    <?php while ($row = $result_ordenes->fetch_assoc()): ?>
                        <?php
                        // Determinar la clase CSS según la prioridad
                        $filaClase = match ($row["Prioridad"]) {
                            "ALTA" => "prioridad-alta", // 🔴 Rojo
                            "MEDIA" => "prioridad-media", // 🟡 Amarillo
                            "BAJA" => "prioridad-baja", // 🟢 Verde
                            default => "sin-asignar" // 🔵 Azul claro si está sin asignar
                        };
                        ?>
                        <tr class="<?= $filaClase; ?>">
                            <td><?= $row["Unidad"]; ?></td>
                            <td><?= $row["Descripcion"]; ?></td>
                            <td><?= $row["Mecanico"]; ?></td>
                            <td><?= $row["Prioridad"]; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center text-danger">No hay órdenes activas para Fletes Tauro</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
