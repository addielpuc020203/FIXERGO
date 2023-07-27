<?php
include 'conex.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $nombre_usuario = $_POST['workerFullName'];
    $correo_electronico = $_POST['workerEmail'];
    $contrasena = $_POST['workerPassword'];
    $account_type = 1;

    $workerProfileImg = "";
    if ($_FILES['workerImage']['error'] === 0) {
        $targetDir = "../imgtodo/";
        $timestamp = time();
        $filename = str_replace(' ', '', $_FILES['workerImage']['name']);
        $targetFile = $targetDir . $timestamp . '_' . $filename;

        if (move_uploaded_file($_FILES['workerImage']['tmp_name'], $targetFile)) {
            $workerProfileImg = $timestamp . '_' . $filename;
        }
    }

    $workerBirthDate = $_POST['workerBirthDate'];
    $workerJob = $_POST['workerJob'];
    $workerLocation = $_POST['workerLocation'];
    $workerDescription = $_POST['workerDescription'];
    $workerphone = $_POST['workerphone'];
    $experiencia = $_POST['experiencia'];
    $id_oficial = $_POST['id_oficial'];
    $cedula_profesional = $_POST['cedula_profesional'];
    $educacion = $_POST['educacion'];


    $sql = "INSERT INTO usuarios (nombre_usuario, correo_electronico, contrasena, fecha_nacimiento, trabajo, ubicacion, descripcion, numero_tel, experiencia, educacion, id_oficial, cedula_profesional, perfilimg, account_type) 
        VALUES ('$nombre_usuario', '$correo_electronico', '$contrasena', '$workerBirthDate', '$workerJob', '$workerLocation', '$workerDescription', '$workerphone', '$experiencia', '$educacion', '$id_oficial', '$cedula_profesional', '$workerProfileImg', '$account_type')";

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
        header("Location: login.html");
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
        header("Location: login.html");
        exit();
    }
}

$conn->close();
?>
