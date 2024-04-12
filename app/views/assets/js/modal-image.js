document.addEventListener("DOMContentLoaded", function () {
  var mainImagen = document.querySelectorAll(".main-image");
  var modal = document.getElementById("modal-image");
  var imagenModal = document.getElementById("image-modal");
  const body = document.getElementById("body");

  if (mainImagen) {
    mainImagen.forEach((imagen) => {
      imagen.addEventListener("click", function () {
        modal.style.display = "block";
        body.classList.add("active");
        imagenModal.src = this.src;
      });
    });
  }

  var close = document.getElementById("close-modal");
  if (close) {
    close.addEventListener("click", function () {
      body.classList.remove("active");
      modal.style.display = "none";
    });
  }
});
