// Obtener el contenedor donde se mostrarán las publicaciones
let postear = document.getElementById("publicacion");

// Realizar la solicitud para obtener el JSON
fetch("../html/obtener_publicacion.php")
  .then((response) => response.json())
  .then((data) => {
    // Iterar sobre los datos recibidos (publicaciones)
    for (let usuario of data) {
      // Crear variables para los identificadores de los modales
      const modalId = `profileModal${usuario.id}`;
      const modal2Id = `profileModal2${usuario.id}`;
      const contentId = `content-${usuario.id}`;

      // Plantilla para mostrar una publicación y sus comentarios
      const postnew = `
        <!-- Contenedor de la publicación -->
        <div class="container mt-5" id="${contentId}">
            <div class="card">
                <div class="card-header">
                    <!-- Información del usuario -->
                    <div class="d-flex align-items-center">
                        <img src="../imgtodo/${usuario.imgPerfil}" alt="" class="rounded-circle me-3" width="50">
                        <div>
                            <h5 class="card-title mb-0">${usuario.nombre}</h5>
                            <span>${usuario.trabajo} (${usuario.calif_trabajo}) <i class="bi bi-check-circle-fill"></i></span>
                            <br>
                            <span>Completados (${usuario.num_compl}) <i class="bi bi-briefcase-fill"></i></span>
                            <br>
                            <span>${usuario.ubicacion}</span>
                            <br>
                            <span>
                                ${usuario.calif_trabajo}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Descripción de la publicación -->
                    <p class="card-text">
                        <p>${usuario.descripcion_p}</p>
                    </p>
                    <!-- Imágenes de la publicación -->
                    <div class="post_button">
                        <div class="post_media">
                            <img src="../imgtodo/${usuario.img1}" alt="1">
                            <img src="../imgtodo/${usuario.img2}" alt="2">
                            <img src="../imgtodo/${usuario.img3}" alt="3">
                        </div>
                    </div>
                    <!-- Acceso rápido a acciones de la publicación -->
                    <div class="post_access">
                        <span>${usuario.precio}</span>
                        <button class="btn btn-success me-2" onclick="abrirModalMensaje('${usuario.id_user}')">Message <i class="bi bi-send-fill"></i></button><br>



                        <button class="btn btn-secondary" onclick="showAdditionalContent('${contentId}')">See More <i class="bi bi-arrow-right"></i></button>
                    </div>
                </div>
            </div>
        </div><br>

        <!-- Contenedor adicional (por defecto oculto) para más detalles -->
        <div class="container mt-5" id="${contentId}-additional" style="display: none;">
            <div class="card">
                <div class="card-header">
                    <!-- Información del usuario -->
                    <div class="d-flex align-items-center">
                        <img src="../imgtodo/${usuario.imgPerfil}" alt="" class="rounded-circle me-3" width="50">
                        <div>
                            <h5 class="card-title mb-0">${usuario.nombre}</h5>
                            <span>${usuario.trabajo} (${usuario.calif_trabajo}) <i class="bi bi-check-circle-fill"></i></span>
                            <br>
                            <span>Completados (${usuario.num_compl}) <i class="bi bi-briefcase-fill"></i></span>
                            <br>
                            <span>${usuario.ubicacion}</span>
                            <br>
                            <span>
                                ${usuario.calif_trabajo}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Descripción detallada de la publicación -->
                    <p class="card-text">
                        <p>${usuario.descripcion}</p>
                    </p>
                    <!-- Carousel de imágenes de la publicación -->
                    <div class="post_button">
                        <div id="carouselExample" class="carousel slide text-center" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="../imgtodo/${usuario.img1}" alt="" class="carousel-image">
                                </div>
                                <div class="carousel-item">
                                    <img src="../imgtodo/${usuario.img2}" alt="" class="carousel-image">
                                </div>
                                <div class="carousel-item">
                                    <img src="../imgtodo/${usuario.img3}" alt="" class="carousel-image">
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    <!-- Acceso rápido a acciones adicionales de la publicación -->
                    <div class="post_button">
                        <div class="post_media2">
                            <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#${modalId}">Profile <i class="bi bi-card-text"></i></button>
                            <button class="btn btn-outline-danger"onclick="showAdditionalContent('${contentId}')">Request Service <i class="bi bi-bag"></i></button>
                            ${usuario.comentarios && usuario.comentarios.length > 0
                              ? `<button class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#${modal2Id}">Comments <i class="bi bi-chat-right-text"></i></button>`
                              : ''
                            }
                        </div>
                        <div class="post_access">
                            <button class="btn btn-outline-secondary" onclick="goBack('${contentId}')">Return <i class="bi bi-arrow-left"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>

        <!-- Modales -->
        <!-- Modal de perfil del usuario -->
        <div class="modal fade custom-modal" id="${modalId}" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content post_user_info3">
                    <div class="modal-header1 imgc">
                        <div>
                            <div class="centrado">
                                <img src=../imgtodo/${usuario.imgPerfil}
                                
                                 alt="" class="rounded-circle  modal-avatar">
                                <h5 class="modal-title user_info2 text-white" id="profileModalLabel">${usuario.nombre}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body content-user">
                        <h5>Email:</h5>
                        <p>${usuario.correo_electronico}</p>
                        <h5>Phone:</h5>
                        <p>${usuario.numero_tel}</p>
                        <h5>Account Type:</h5>
                        <p>${usuario.account_type}</p>
                    </div>
                    <div class="scrolling-content modal-body">
                        <h5>Work Information</h5>
                        <p>${usuario.descripcion}<p>
                        <h5>Profession/Occupation:</h5>
                        <p>${usuario.trabajo}</p>
                        <h5>Work Experience:</h5>
                        <p>${usuario.experiencia}</p>
                        <h5>Educational Level:</h5>
                        <p>${usuario.educacion}</p>
                        <h5>Official Identification:</h5>
                        <p>${usuario.id_oficial}</p>
                        <h5>Professional License:</h5>
                        <p>${usuario.cedula_profesional}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de comentarios -->
        <div class="modal fade custom-modal" id="${modal2Id}" tabindex="-1" aria-labelledby="profileModalLabel2" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content post_user_info3">
                    <div class="centrado">
                        <h5 class="modal-title user_info4 justify-content-center text-center text-white">Comments</h5>
                    </div>
                    <br><span class="close text-white" data-bs-dismiss="modal">&times;</span>
                    <div class="modal-body content-user">
                        <div class="centrado">
                            ${usuario.comentarios && usuario.comentarios.length > 0
                              ? `
                                <!-- Mostrar el primer comentario si existen comentarios -->
                                <h5 class="modal-content post_user_info3 modal-title text-center bg-secondary text-white">
                                    ${usuario.comentarios[0].nombre_comentador}
                                    <span>${usuario.comentarios[0].calificacion}</span>
                                </h5>
                                <p>"${usuario.comentarios[0].contenido}"</p>
                              `
                              : `
                                <!-- Mostrar mensaje si no hay comentarios -->
                                <p>No hay comentarios disponibles.</p>
                              `
                            }
                        </div>
                    </div>
                </div>
            </div>
        </div>
      `;

      postear.innerHTML += postnew;
    }
  })
  .catch((error) => console.error(error));

function showAdditionalContent(contentId) {
  var content1 = document.getElementById(contentId);
  content1.style.display = 'none';

  var content2 = document.getElementById(`${contentId}-additional`);
  content2.style.display = 'block';
}

function goBack(contentId) {
  var content1 = document.getElementById(contentId);
  content1.style.display = 'block';

  var content2 = document.getElementById(`${contentId}-additional`);
  content2.style.display = 'none';
}

function showProfileModal() {
  var profileModal = new bootstrap.Modal(document.getElementById('profileModal'), {
    backdrop: 'static',
    keyboard: false
  });
  profileModal.show();
}

function showProfileModal2() {
  var profileModal2 = new bootstrap.Modal(document.getElementById('profileModal2'), {
    backdrop: 'static',
    keyboard: false
  });
  profileModal2.show();
}

function showService() {
  var profileModal3 = new bootstrap.Modal(document.getElementById('profileModal3'), {
    backdrop: 'static',
    keyboard: false
  });
  profileModal3.show();
}
// Modificar la función abrirModalMensaje() para recibir solo el ID del destinatario
function abrirModalMensaje(destinatarioId) {
    // Configura el ID del destinatario en el input del modal
    document.getElementById("destinatarioNombre").innerText = destinatarioId;
    // Muestra el modal
    var messageModal = new bootstrap.Modal(document.getElementById("messageModal"));
    messageModal.show();
    
    // Obtener el ID del usuario en sesión mediante la función obtenerIdUsuarioSesion()
    let remitenteId = recibidor_remitente()

        // Pasar el ID del usuario en sesión como segundo argumento a enviarMensaje()
        enviarMensaje(destinatarioId, usuarioId);
    };

function recibidor_remitente(remitenteId){

}

// Resto del código JavaScript


function enviarMensaje(destinatarioId, remitenteId) {
    // Obtener el contenido del mensaje del textarea
    const mensajeTexto = document.getElementById("mensajeTexto").value;

    // Crear un objeto con los datos del mensaje a enviar
    const mensajeData = {
        destinatarioId: destinatarioId,
        remitenteId: remitenteId,
        mensajeTexto: mensajeTexto,
    };

    // Realizar una solicitud al servidor para enviar el mensaje
    fetch("../html/enviar_mensaje.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(mensajeData),
    })
    .then((response) => response.json())
    .then((data) => {
        // Aquí puedes agregar cualquier lógica adicional que desees después de enviar el mensaje
        // Por ejemplo, puedes mostrar una notificación de éxito, actualizar la lista de mensajes, etc.
        console.log("Mensaje enviado con éxito:", data);
        // Cerrar el modal después de enviar el mensaje
        var messageModal = new bootstrap.Modal(document.getElementById("messageModal"));
        messageModal.hide();
    })
    .catch((error) => {
        console.error("Error al enviar el mensaje:", error);
        // Aquí puedes mostrar una notificación o mensaje de error si algo sale mal
    });
}
