<?php

session_start();


    $accountType = $_SESSION['account_type'];


    if ($accountType === "1") {
        echo "Tipo de cuenta: " . $accountType; 
        echo '
            <div class="text-end crear-publicacion-btn" id="crearPublicacionBtn">
                <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#crearPublicacionModal">
                    <i class="bi bi-plus"></i> Crear Publicación
                </button>
            </div>
        ';
    }

?>
