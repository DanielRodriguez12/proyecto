<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establecer la conexión a la base de datos (ajusta los valores según tu configuración)
    $servername = "localhost";
    $username = "root";
    $password = "1234";
    $dbname = "proyecto";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $comentario = $_POST['comentario'];

    // Preparar la consulta para insertar el comentario en la base de datos
    $sql = "INSERT INTO comentarios (nombre, comentario) VALUES ('$nombre', '$comentario')";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        echo "Muchas gracias por su tiempo y colaboración, gracias a ti seguimos mejorando nuestro servicio";
    } else {
        echo "Error al guardar el comentario: " . $conn->error;
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    // Redirigir o mostrar un mensaje de error si se accede a este archivo directamente sin enviar datos del formulario
    echo "Acceso no permitido";
}
?>
