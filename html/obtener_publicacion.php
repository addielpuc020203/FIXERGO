<?php
session_start();
include '../login/conex.php';


// Verifica si el usuario ha iniciado sesión y si existe la clave "user_id" en la sesión
if (isset($_SESSION['user_id'])) {
    $idUsuario = $_SESSION['user_id'];
}


$sql = "SELECT p.*, u.nombre_usuario, u.correo_electronico, u.fecha_nacimiento, u.trabajo, u.ubicacion, u.descripcion, u.numero_tel, u.experiencia, u.educacion, u.id_oficial, u.cedula_profesional, u.perfilimg, u.account_type, p.descripcion_p
        FROM publicaciones AS p
        INNER JOIN usuarios AS u ON p.id_usuario = u.id";

$result = $conn->query($sql);

$datosUsuario = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $publicacion = array(
            'id' => $row['id'],
            'id_user' => $row['id_usuario'], 
            'precio' => $row['precio'],
            'img1' => $row['img'],
            'img2' => $row['img2'],
            'img3' => $row['img3'],
            'descripcion' => $row['descripcion'],
            'calif_trabajo' => $row['calif_trabajo'],
            'num_compl' => $row['num_compl'],
            'imgPerfil' => $row['perfilimg'],
            'nombre' => $row['nombre_usuario'],
            'trabajo' => $row['trabajo'],
            'ubicacion' => $row['ubicacion'],
            'correo_electronico' => $row['correo_electronico'],
            'fecha_nacimiento' => $row['fecha_nacimiento'],
            'numero_tel' => $row['numero_tel'],
            'experiencia' => $row['experiencia'],
            'descripcion_p' =>$row['descripcion_p'],
            'educacion' => $row['educacion'],
            'id_oficial' => $row['id_oficial'],
            'cedula_profesional' => $row['cedula_profesional'],
            'account_type' => $row['account_type'] === 1 ? 'TRABAJADOR' : 'TRABAJADOR'
// Agregamos el tipo de cuenta del usuario al array
        );

        // Obtener los comentarios para esta publicación
        $sqlComentarios = "SELECT c.*, u.nombre_usuario AS nombre_comentador
                           FROM comentarios AS c
                           INNER JOIN usuarios AS u ON c.id_usuariocomentador = u.id
                           WHERE c.id_publicacion = '{$publicacion['id']}'";
        $resultComentarios = $conn->query($sqlComentarios);

        $comentarios = array();
        if ($resultComentarios->num_rows > 0) {
            while ($rowComentario = $resultComentarios->fetch_assoc()) {
                $comentario = array(
                    'id_usuariocomentador' => $rowComentario['id_usuariocomentador'],
                    'nombre_comentador' => $rowComentario['nombre_comentador'],
                    'contenido' => $rowComentario['contenido'],
                    'calificacion' => $rowComentario['calificacion']
                );
                $comentarios[] = $comentario;
            }
        }

        // Agregar los comentarios al array de la publicación
        $publicacion['comentarios'] = $comentarios;

        $datosUsuario[] = $publicacion;
    }

    // Devolver las publicaciones en formato JSON
    header('Content-Type: application/json');
    echo json_encode($datosUsuario);
} else {
    // No se encontraron publicaciones
    header('HTTP/1.1 204 No Content');
}

$conn->close();
?>
