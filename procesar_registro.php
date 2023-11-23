<!DOCTYPE html>
<html>
<head>
    <title>Registro de Usuario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 400px;
            margin: 100px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="tel"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        /* Estilos para el mensaje de éxito */
        .mensaje-exito {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .mensaje-exito a {
            color: #155724;
            text-decoration: none;
        }
        .mensaje-exito a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container">
       <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $servername = "localhost";
            $username = "root";
            $password = "1234";
            $dbname = "proyecto";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            $nombre = $_POST['nombre'];
            $apellidos = $_POST['apellidos'];
            $contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT); // Hashear la contraseña
            $email = $_POST['email'];
            $telefono = $_POST['telefono'];
            $localidad = $_POST['localidad'];
            $codigo_postal = $_POST['codigo_postal'];
            $sexo = $_POST['sexo'];
            $direccion = $_POST['direccion'];

            $sql = "INSERT INTO usuarios (nombre, apellidos, contraseña, email, telefono, localidad, codigo_postal, sexo, direccion)
            VALUES ('$nombre', '$apellidos', '$contraseña', '$email', '$telefono', '$localidad', '$codigo_postal', '$sexo', '$direccion')";

            if ($conn->query($sql) === TRUE) {
                echo "<div class='mensaje-exito'>Se ha registrado correctamente. Bienvenido. <a href='inicio.php'>Iniciar sesión</a></div>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
        }
        ?>
    </div>

</body>
</html>

