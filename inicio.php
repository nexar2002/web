<?php
session_start();
if (!isset($_SESSION['ci'])) {
    header("Location: login.html");
    exit();
}

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "galb"; 

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$ci = $_SESSION['ci'];
$sql = "SELECT nombre FROM user WHERE ci='$ci'";
$result = $conn->query($sql);
$user_name = "Usuario";

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_name = $row['nombre'];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body {
            background-color: #fff;
            color: #000;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }
        .container {
            width: 90%;
            max-width: 400px;
            padding: 20px;
            background-color: #f8f8f8;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        .container img {
            width: 100px;
            margin-bottom: 20px;
        }
        .container h1 {
            margin-bottom: 10px;
        }
        .container p {
            margin-bottom: 20px;
        }
        .menu {
            width: 100%;
            max-width: 400px;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }
        .menu a {
            display: block;
            width: 100%;
            padding: 15px;
            background-color: #000;
            color: white;
            text-decoration: none;
            font-size: 18px;
            text-align: center;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .menu a.logout {
            background-color: red;
        }
        .menu a:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>

    <div class="container">
        <img src="img/icon.jpg" alt="Logo">
        <h1>Bienvenido, <?php echo htmlspecialchars($user_name); ?></h1>
        <p>Has iniciado sesión correctamente.</p>
        <div class="menu">
        
        <a href="consulta_ahorro.html">
    Consulta de ahorro
</a>

    
        <a href="consulta_prestamo.html">Consulta de préstamo</a>
        <a href="historial.html">Historial</a>
        <a href="calculadora.html">Calculadora de préstamo</a>
        <a href="logout.php" class="logout">Cerrar sesión</a>
    </div>
    </div>

    

</body>
</html>
