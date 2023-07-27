<?php
// enviar_mensaje.php

// Verificar si se recibieron los datos del mensaje
if (isset($_POST['mensajeTexto']) && isset($_POST['id_remitente']) && isset($_POST['id_destinatario'])) 
    {
  // Establecer la conexión con la base de datos (reemplaza los valores con los de tu configuración)
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "fixergo";

  $conexion = new mysqli($servername, $username, $password, $dbname);

  if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
  }


  $mensaje = $_POST['mensajeTexto']; 

$id_remitente = $_POST['id_remitente'];
$id_destinatario = $_POST['id_destinatario'];


  $sql = "INSERT INTO mensajes (id_remitente, id_destinatario, contenido, fecha_envio) VALUES ('$id_remitente', '$id_destinatario', '$mensaje', NOW())";

  if ($conexion->query($sql) === TRUE) {
    echo "Mensaje enviado exitosamente.";
  } else {
    echo "Error al enviar el mensaje: " . $conexion->error;
  }

  $conexion->close();
} else {
  echo "No se recibieron los datos del mensaje.";
}
?>
