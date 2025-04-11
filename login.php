<?php
session_start();
$servername = "localhost"; // Servidor de la base de datos
$username = "root"; // Usuario de MySQL
$password = ""; // Contraseña de MySQL
$dbname = "galb"; // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos del formulario
$ci = $_POST['ci'];
$pass = $_POST['pass'];

// Consulta SQL para verificar usuario y contraseña
$sql = "SELECT * FROM user WHERE ci='$ci' AND pass='$pass'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Iniciar sesión y redirigir al usuario
    $_SESSION['ci'] = $ci;
    header("Location: inicio.php");
} else {
    echo "<script>alert('Usuario o contraseña incorrectos'); window.location.href='login.html';</script>";
}

$conn->close();
?>
