document.addEventListener("DOMContentLoaded", function() {
  // Obtener referencias a los elementos del DOM
  var registerButton = document.getElementById("registerButton");
  var clientButton = document.getElementById("clientButton");
  var workerButton = document.getElementById("workerButton");
  var registerModal = document.getElementById("registerModal");
  var clientForm = document.getElementById("clientForm");
  var workerForm = document.getElementById("workerForm");
  var closeButtons = document.getElementsByClassName("close");

  // Mostrar ventana modal al hacer clic en "REGISTRARTE"
  registerButton.addEventListener("click", function() {
      registerModal.style.display = "block";
  });

  // Mostrar formulario de cliente al hacer clic en "CLIENTE"
  clientButton.addEventListener("click", function() {
      clientForm.style.display = "block";
      registerModal.style.display = "none";
  });

  // Mostrar formulario de trabajador al hacer clic en "TRABAJADOR"
  workerButton.addEventListener("click", function() {
      workerForm.style.display = "block";
      registerModal.style.display = "none";
  });

  // Cerrar ventanas modales al hacer clic en el botón de cerrar
  for (var i = 0; i < closeButtons.length; i++) {
      closeButtons[i].addEventListener("click", function() {
          var modal = this.parentElement.parentElement;
          modal.style.display = "none";
      });
  }
});
