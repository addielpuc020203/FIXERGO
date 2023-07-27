<?php
// Función para iniciar la sesión con un identificador único para cada usuario
function startCustomSession($userId) {
    // Si la sesión ya está iniciada, ciérrala
    if (session_status() === PHP_SESSION_ACTIVE) {
        session_write_close();
    }

    // Genera un identificador único para la sesión basado en el ID de usuario
    $sessionId = "user_" . $userId;

    // Remueve caracteres no permitidos del identificador de sesión
    $sessionId = preg_replace('/[^a-zA-Z0-9,-]/', '', $sessionId);

    // Configura el identificador de sesión personalizado
    session_id($sessionId);

    // Inicia la sesión
    session_start();
}

include 'conex.php';

// Verifica si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitiza las entradas del usuario para evitar inyecciones SQL
    $login = $conn->real_escape_string($_POST['login']);
    $password = $conn->real_escape_string($_POST['password']);

    // Consulta para verificar si el usuario existe en la base de datos utilizando una consulta preparada
    $query = "SELECT * FROM usuarios WHERE correo_electronico = ? AND contrasena = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $login, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica si la consulta fue exitosa
    if ($result->num_rows === 1) {
        // Usuario encontrado, inicia sesión para el usuario
        $user = $result->fetch_assoc();

        // Inicia la sesión con un identificador único para este usuario
        startCustomSession($user['id']);

        // Almacena los datos del usuario en la sesión
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['correo_electronico'];
        $_SESSION['user_name'] = $user['nombre_usuario'];
        $_SESSION['user_location'] = $user['ubicacion'];
        $_SESSION['account_type'] = $user['account_type']; // Tipo de cuenta del usuario

        // Regenera el ID de sesión para evitar errores de caracteres no permitidos
        session_regenerate_id(true);

        // Redirige a la página de bienvenida después de iniciar sesión exitosamente
        header('Location: ../html/index.php');
        exit;
    } else {
        // Credenciales de inicio de sesión inválidas, muestra un mensaje de error
        $error_message = "Credenciales de inicio de sesión inválidas. Por favor, inténtalo de nuevo.";
        header('Location: ../login/login.html');
        exit;
    }
}
?>
