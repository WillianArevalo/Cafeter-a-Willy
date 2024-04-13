document.addEventListener("DOMContentLoaded", function () {
  const perfilImage = document.getElementById("image-perfil");
  const dropdownMenu = document.querySelector(".top-bar__user-dropdown");
  const sunButton = document.getElementById("sunButton");
  const moonButton = document.getElementById("moonButton");
  const linkProduct = document.querySelector(".link-product");
  const dropdownMenuProduct = document.querySelector(".dropdown-menu-product");

  if (perfilImage) {
    perfilImage.addEventListener("click", function () {
      dropdownMenu.classList.toggle("show");
    });
  }

  document.addEventListener("click", function (event) {
    const element = event.target;
    if (
      !element.classList.contains("top-bar__user-dropdown") &&
      element.id !== "image-perfil"
    ) {
      dropdownMenu.classList.remove("show");
    }
  });

  function toggleActive(button) {
    sunButton.classList.remove("active");
    moonButton.classList.remove("active");
    button.classList.add("active");
  }

  if (sunButton) {
    sunButton.addEventListener("click", function () {
      toggleActive(sunButton);
    });
  }

  if (moonButton) {
    moonButton.addEventListener("click", function () {
      toggleActive(moonButton);
    });
  }

  if (linkProduct) {
    linkProduct.addEventListener("click", function () {
      dropdownMenuProduct.classList.toggle("active");
    });
  }

  $(".link-logout").on("click", function () {
    const url = this.getAttribute("data-url");
    Swal.fire({
      title: "¿Estás seguro?",
      text: "¿Deseas cerrar sesión?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Cerrar sesión",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = url;
      }
    });
  });
});
