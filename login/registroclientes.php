<?php
include 'conex.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $nombre_usuario = $_POST['clientUsername'];
    $correo_electronico = $_POST['clientEmail'];
    $contrasena = $_POST['clientPassword'];
    $account_type = 0; // Tipo de cuenta para clientes

    // Insertar los datos en la base de datos con el tipo de cuenta correcto
    $sql = "INSERT INTO usuarios (nombre_usuario, correo_electronico, contrasena, account_type) 
            VALUES ('$nombre_usuario', '$correo_electronico', '$contrasena', '$account_type')";

    if ($conn->query($sql) === TRUE) {
        // Registro exitoso
        echo '<script>
            Swal.fire({
                icon: "success",
                title: "Registro exitoso",
                text: "Bienvenido, ' . $nombre_usuario . '",
                showConfirmButton: false,
                timer: 3000
            });
        </script>';
        header("Location: login.html"); // Redireccionar usando el encabezado de respuesta
        exit();
    } else {
        // Error en el registro
        echo '<script>
            Swal.fire({
                icon: "error",
                title: "Error en el registro",
                text: "Ha ocurrido un error en el registro. Por favor, inténtalo nuevamente.",
                showConfirmButton: false,
                timer: 3000
            });
        </script>';
        header("Location: login.html"); // Redireccionar usando el encabezado de respuesta
        exit();
    }
}

$conn->close();
?>
