<?php
// Archivo: controller/new_user.php
header("Content-Type: application/json; charset=UTF-8");

// Incluye la conexión (sube un nivel desde controller hasta model)
include "../model/conne.php";

// Recogemos los datos enviados desde el frontend (JS FormData)
$nombreCliente = $_POST['nombre'] ?? '';
$correo = $_POST['correo'] ?? '';

$nombreProyecto = $_POST['nombreProyecto'] ?? '';
$metros = $_POST['metros'] ?? 0;
$descripcion = $_POST['descripcion'] ?? '';

// Validamos que por lo menos existan datos básicos para evitar filas vacías
if (empty($nombreCliente) || empty($correo) || empty($nombreProyecto)) {
    echo json_encode(["status" => "error", "message" => "Faltan datos obligatorios"]);
    exit;
}

try {
    // 1. Guardar en la tabla "clientes"
    $stmt1 = $conn->prepare("INSERT INTO clientes (nombre, correo) VALUES (?, ?)");
    $stmt1->bind_param("ss", $nombreCliente, $correo);
    $stmt1->execute();
    
    // Obtener el ID del cliente recién guardado
    $clienteId = $stmt1->insert_id;
    $stmt1->close();

    // 2. Guardar en la tabla "proyectos" asociando el cliente_id
    $stmt2 = $conn->prepare("INSERT INTO proyectos (cliente_id, nombre, metros, descrip) VALUES (?, ?, ?, ?)");
    $stmt2->bind_param("isis", $clienteId, $nombreProyecto, $metros, $descripcion);
    $stmt2->execute();
    
    // Obtener ID del proyecto recién creado
    $proyectoId = $stmt2->insert_id;
    $stmt2->close();

    echo json_encode([
        "status" => "success", 
        "message" => "Registro y proyecto guardados exitosamente.",
        "proyecto_id" => $proyectoId
    ]);
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Error de BD: " . $e->getMessage()]);
}

$conn->close();
?>