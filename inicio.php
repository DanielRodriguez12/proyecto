<!DOCTYPE html>
<html>
<head>
    <title>Iniciar Sesión</title>
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
        input[type="email"],
        input[type="password"],
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
        p {
            text-align: center;
            margin-top: 10px;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container">
        <?php
        $mensaje = '';

        // Conexión a la base de datos
        $servidor = "localhost";
        $usuario = "root";
        $contraseña_db = "1234";
        $base_de_datos = "proyecto";

        $conexion = new mysqli($servidor, $usuario, $contraseña_db, $base_de_datos);

        // Verificar la conexión
        if ($conexion->connect_error) {
            die("Error de conexión a la base de datos: " . $conexion->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email_login = isset($_POST['email_login']) ? $_POST['email_login'] : "";
            $contraseña_login = isset($_POST['contraseña_login']) ? $_POST['contraseña_login'] : "";

            $sql = "SELECT email, contraseña FROM usuarios WHERE email = ?";
            $stmt = $conexion->prepare($sql);

            $stmt->bind_param("s", $email_login);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                if (password_verify($contraseña_login, $row['contraseña'])) {
                    $mensaje = "Bienvenido, inicio de sesión correcto. <a href='modelos.html'>Ver modelos</a>";
                } else {
                    $mensaje = "La contraseña es incorrecta, por favor asegúrese de que la contraseña que ha introducido es correcta.";
                }
            } else {
                $mensaje = "El correo introducido es incorrecto o no está registrado.";
            }
        }
        ?>

        <?php if (empty($mensaje)) : ?>
        <h2>Iniciar Sesión</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="email_login">Correo Electrónico:</label>
            <input type="email" name="email_login" required><br><br>
            <label for="contraseña_login">Contraseña:</label>
            <input type="password" name="contraseña_login" required><br><br>
            <input type="submit" value="Iniciar Sesión">
        </form>
        <?php endif; ?>

        <p><?php echo $mensaje; ?></p>
    </div>

</body>
</html>
