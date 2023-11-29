<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Información de servicios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }

        .caja {
            background-color: #f4f4f4;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .caja h2 {
            margin-top: 0;
        }

        .error_mensaje {
            color: #ff0000;
        }
    </style>
</head>
<body>

<?php
session_start();

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "proyecto";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener la localidad de la sesión (asumiendo que ya está establecida)
$localidad_usuario = $_SESSION['provincia'] ?? ''; // Aquí obtienes el valor de $_SESSION['provincia']

// Inicializar la variable $concesionario
$direccion_concesionario = "";

// Verificar si la localidad está en la base de datos
if ($localidad_usuario) {
    $sql = "SELECT numero_contacto, concesionario FROM asistencia WHERE provincia = '$localidad_usuario'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $telefono_localidad = $row["numero_contacto"];
        $direccion_concesionario = $row["concesionario"];
?>
        <div class="caja">
            <h2>Bienvenido a nuestro soporte</h2>
            <p>Hemos detectado que su municipio es <?php echo $localidad_usuario; ?>. Si desea asistencia online o pedir una cita puede contactarnos al teléfono: <?php echo $telefono_localidad; ?>.<br> 
            Para asistencia presencial, puede dirigirse a <?php echo $direccion_concesionario; ?>.<br>Puede indicarnos su experiencia haciendo click <a href="comentario.html">aquí</a></p>
        </div>
<?php
    }
} else {
?>
    <div class="error_mensaje">
        <p>No se encontró información de localidad en la sesión.</p>
    </div>
<?php
}
$conn->close();
?>

</body>
</html>

