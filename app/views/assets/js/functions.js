var modal = document.getElementById("modal");
var overlay = document.getElementById("overlay");
var close = document.getElementById("modal-close");

function showModal(title, message, status) {
  var modalTitle = document.getElementById("modal-title");
  var modalStatus = document.getElementById("modal-icon");
  var modalMessage = document.getElementById("modal-message");
  modalTitle.innerHTML = title;
  modalMessage.innerHTML = message;
  modalStatus.classList.remove("success", "error");
  modalMessage.classList.remove("success", "error");
  modalStatus.classList.add(status);
  modalMessage.classList.add(status);
  modal.classList.add("show");
  overlay.style.display = "block";
}

function closeModal() {
  modal.classList.remove("show");
  overlay.style.display = "none";
}

overlay.addEventListener("click", closeModal);

document.addEventListener("keydown", function (event) {
  if (event.key === "Escape") {
    closeModal();
  }
});

close.addEventListener("click", closeModal);

export { showModal, closeModal };
