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
      openModal();
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
