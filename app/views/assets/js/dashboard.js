document.addEventListener("DOMContentLoaded", function () {
  const body = document.getElementById("body");
  const buttonMore = document.querySelectorAll(".button-more");
  const menuDropdown = document.querySelectorAll(".reminder__dropdown");

  if (buttonMore) {
    buttonMore.forEach((button) => {
      button.addEventListener("click", function () {
        const container = button.parentElement;
        const dropDown = container.nextElementSibling;

        menuDropdown.forEach((dropdown) => {
          if (dropdown !== dropDown) {
            dropdown.classList.remove("show");
          }
        });
        dropDown.classList.toggle("show");
      });
    });
  }

  document.addEventListener("click", function (event) {
    if (!event.target.closest(".button-more")) {
      menuDropdown.forEach((dropdown) => {
        dropdown.classList.remove("show");
        body.classList.remove("overflow-hidden");
      });
    }
  });

  document.addEventListener("scroll", function () {
    menuDropdown.forEach((dropdown) => {
      dropdown.classList.remove("show");
    });
  });

  const overlay = document.getElementById("overlay");
  const buttonAddReminder = document.getElementById("button-add-redminder");
  const modalReminder = document.getElementById("modal-reminder");
  const closeReminder = document.getElementById("button-cancel-reminder");

  if (buttonAddReminder) {
    buttonAddReminder.addEventListener("click", function () {
      Swal.fire({
        title: "Crear recordatorio",
        html: `
           <div class="form">
                <div class="form-group icon">
                    <span>
                       <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#000000" fill="none">
                          <path d="M6 4V20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                          <path d="M18 4V20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                          <path d="M6 12H18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                    <input type="text" class="form-group__input" id="reminder-title" placeholder="Título">
                </div>
                <div class="form-group icon">
                    <span>
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#000000" fill="none">
                        <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5" />
                        <path d="M12 8V12L14 14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                      </svg>
                    </span>
                    <input type="time" class="form-group__input" id="reminder-time" placeholder="Hora">
                </div>
                <div class="form-group icon-textarea">
                    <textarea name="reminder-description" id="reminder-description" cols="30" rows="5"
                        placeholder="Descripción"></textarea>
                </div>
            </div>
            `,
        showCancelButton: true,
        confirmButtonText: "Guardar",
        cancelButtonText: "Cancelar",
        focusConfirm: false,
        preConfirm: true,
        preConfirm: () => {
          const title = document.getElementById("reminder-title").value;
          const time = document.getElementById("reminder-time").value;
          const description = document.getElementById(
            "reminder-description"
          ).value;
          if (title === "" || time === "") {
            Swal.showValidationMessage("Todos los campos son requeridos");
          } else {
            return { title: title, time: time, description: description };
          }
        },
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            "Guardado",
            `El recordatorio "${result.value.title}" a las ${result.value.time} ha sido guardado`,
            "success"
          );
        }
      });
    });
  }

  if (closeReminder) {
    closeReminder.addEventListener("click", function () {
      closeModal();
    });
  }

  document.addEventListener("keydown", function (event) {
    if (event.key === "Escape") {
      closeModal();
    }
  });

  overlay.addEventListener("click", closeModal);

  function closeModal() {
    body.classList.remove("hidden");
    overlay.style.display = "none";
    modalReminder.classList.remove("show");
  }

  function openModal() {
    body.classList.add("hidden");
    overlay.style.display = "block";
    modalReminder.classList.add("show");
  }
});
