<?php
// Archivo: controller/guardar_proyeccion.php
header("Content-Type: application/json; charset=UTF-8");
include "../model/conne.php";

$proyecto_id = $_POST['proyecto_id'] ?? 0;
$modo = $_POST['modo'] ?? '';
$inversion_inicial = $_POST['inversion_inicial'] ?? 0;
$frecuencia = $_POST['frecuencia'] ?? '';
$plazo = $_POST['plazo'] ?? 0;
$interes = $_POST['interes'] ?? 0;
$total_final = $_POST['total_final'] ?? 0;

if (empty($proyecto_id)) {
    echo json_encode(["status" => "error", "message" => "No se envió el ID del proyecto."]);
    exit;
}

try {
    $stmt = $conn->prepare("INSERT INTO proyecciones (proyecto_id, modo, inversion_inicial, frecuencia, plazo, interes, total_final) VALUES (?, ?, ?, ?, ?, ?, ?)");
    
    // d = double (decimal), i = int, s = string
    $stmt->bind_param("isddidd", $proyecto_id, $modo, $inversion_inicial, $frecuencia, $plazo, $interes, $total_final);
    
    $stmt->execute();
    $stmt->close();

    echo json_encode(["status" => "success", "message" => "Proyección guardada con éxito."]);
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Error de BD: " . $e->getMessage()]);
}

$conn->close();
?>
