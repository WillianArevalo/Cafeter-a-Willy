document.addEventListener("DOMContentLoaded", function () {
  const perfilImage = document.getElementById("image-perfil");
  const dropdownMenu = document.querySelector(".top-bar__user-dropdown");
  const sunButton = document.getElementById("sunButton");
  const moonButton = document.getElementById("moonButton");
  const linkProduct = document.querySelector(".link-product");
  const dropdownMenuProduct = document.querySelector(".dropdown-menu-product");

  perfilImage.addEventListener("click", function () {
    dropdownMenu.classList.toggle("show");
  });

  function toggleActive(button) {
    sunButton.classList.remove("active");
    moonButton.classList.remove("active");
    button.classList.add("active");
  }

  sunButton.addEventListener("click", function () {
    toggleActive(sunButton);
  });

  moonButton.addEventListener("click", function () {
    toggleActive(moonButton);
  });

  linkProduct.addEventListener("click", function () {
    dropdownMenuProduct.classList.toggle("active");
  });
});
