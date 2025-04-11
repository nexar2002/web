<?php
session_start();
include 'conexion.php'; // Archivo de conexión a la base de datos

// Verificar si la sesión está iniciada
if (!isset($_SESSION['ci'])) {
    echo json_encode(["error" => "No se ha iniciado sesión o la sesión expiró"]);
    exit;
}

$ci = $_SESSION['ci']; // Obtener el CI del usuario autenticado

// Depuración: Verificar si el CI se está obteniendo correctamente
error_log("CI en sesión: " . $ci);

// Consulta los préstamos asociados al CI
$sql = "SELECT N, FECHA_PRESTAMO, CI, ACCIONISTA, VALOR_CREDITO, MODALIDAD, N_CUOTA, CAPITAL, INTERES, CUOTA_GENERADA, FECHA_PAGO, FECHA_VENCE, ESTADO 
        FROM prestamo 
        WHERE CI = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $ci);
$stmt->execute();
$resultado = $stmt->get_result();

$datos = [];
while ($fila = $resultado->fetch_assoc()) {
    $datos[] = $fila;
}

// Enviar el CI junto con los datos de préstamos
$response = [
    "ci" => $ci,
    "prestamos" => $datos
];

echo json_encode($response);

$stmt->close();
$conn->close();
?>
