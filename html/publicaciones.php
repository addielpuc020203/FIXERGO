<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.min.css">
</head>
<body>
<?php
session_start();
include '../login/conex.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['precio'])) {
    $precio = "<i class='bi bi-coin w-25 '></i><i class='bi bi-coin w-25 '></i>";
    $img1 = $_FILES['img']['name'];
    $img1TmpName = $_FILES['img']['tmp_name'];
    $img2 = $_FILES['img2']['name'];
    $img2TmpName = $_FILES['img2']['tmp_name'];
    $img3 = $_FILES['img3']['name'];
    $img3TmpName = $_FILES['img3']['tmp_name'];
    $descripcion = $_POST['descripcion'];
    $califTrabajo = "<i class='bi bi-star-fill'></i><i class='bi bi-star-fill'></i><i class='bi bi-star-fill'></i><i class='bi bi-star-fill'></i><i class='bi bi-star-half'></i>";
    $numCompl = $_POST['num_compl'];

    $descripcion = htmlspecialchars($descripcion);

    $idUsuario = $_SESSION['user_id']; // Obtener el ID del usuario de la sesión

    $imageTimestamp = time();
    $img1NewName = $imageTimestamp . '_' . $img1;
    $img2NewName = $imageTimestamp . '_' . $img2;
    $img3NewName = $imageTimestamp . '_' . $img3;

    $targetDirectory = '../imgtodo/';

    $img1FilePath = $targetDirectory . $img1NewName;
    $img2FilePath = $targetDirectory . $img2NewName;
    $img3FilePath = $targetDirectory . $img3NewName;

    move_uploaded_file($img1TmpName, $img1FilePath);
    move_uploaded_file($img2TmpName, $img2FilePath);
    move_uploaded_file($img3TmpName, $img3FilePath);

    $precio = mysqli_real_escape_string($conn, $precio);
    $califTrabajo = mysqli_real_escape_string($conn, $califTrabajo);

    $sql = "INSERT INTO publicaciones (precio, img, img2, img3, descripcion_p, calif_trabajo, num_compl, id_usuario) 
            VALUES ('$precio', '$img1NewName', '$img2NewName', '$img3NewName', '$descripcion', '$califTrabajo', '$numCompl', '$idUsuario')";

    if ($conn->query($sql) === TRUE) {
        $usuarioId = $conn->insert_id;

        // Alerta de registro exitoso
        echo '<script>
            Swal.fire({
                icon: "success",
                title: "PUBLICACION LISTA",
                text: "ID del usuario: ' . $usuarioId . '",
                showConfirmButton: false,
                timer: 3000
            }).then(() => {
                window.location.href = "../html/index.php"; // Redirigir al index.html
            });
        </script>';
    } else {
        // Alerta de error en el registro
        echo '<script>
            Swal.fire({
                icon: "error",
                title: "Error en la publicacion",
                text: "' . $conn->error . '",
                showConfirmButton: false,
                timer: 3000
            }).then(() => {
                window.location.href = "../html/index.php";
            });
        </script>';
    }

    $conn->close();
}
?>

</body>
</html>
