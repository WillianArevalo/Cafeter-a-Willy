document.addEventListener("DOMContentLoaded", function () {
  const loginForm = document.getElementById("form-login");
  const username = document.getElementById("username");
  const password = document.getElementById("password");

  if (loginForm) {
    loginForm.addEventListener("submit", function (event) {
      event.preventDefault();
      if (username.value == "") {
        var formGroup = username.parentElement;
        var icon = formGroup.querySelector("span svg");
        var message = formGroup.nextElementSibling;
        formGroup.classList.add("has-error");
        icon.classList.add("has-error");
        message.classList.add("has-error");
        message.innerHTML = "El nombre de usuario es requerido.";
      }

      if (password.value == "") {
        var formGroup = password.parentElement;
        var icon = formGroup.querySelector("span svg");
        var message = formGroup.nextElementSibling;
        formGroup.classList.add("has-error");
        icon.classList.add("has-error");
        icon.classList.add("has-error");
        message.classList.add("has-error");
        message.innerHTML = "La contraseña es requerida.";
      }

      if (username.value != "" && password.value != "") {
        $.ajax({
          url: this.action,
          type: this.method,
          data: $(this).serialize(),
          success: function (response) {
            var data = JSON.parse(response);
            if (data.status == "success") {
              Swal.fire({
                title: data.title,
                text: data.message,
                icon: data.status,
                confirmButtonText: "Aceptar",
              }).then(() => {
                window.location.href = data.redirect;
              });
            } else {
              Swal.fire({
                title: data.title,
                text: data.message,
                icon: data.status,
              });
            }
          },
        });
      }
    });
  }

  $("#username, #password").on("input", function () {
    if (this.value !== "") {
      var formGroup = this.parentElement;
      var icon = formGroup.querySelector("span svg");
      var message = formGroup.nextElementSibling;
      formGroup.classList.remove("has-error");
      icon.classList.remove("has-error");
      message.classList.remove("has-error");
      message.innerHTML = "";
    } else {
      var formGroup = this.parentElement;
      var icon = formGroup.querySelector("span svg");
      var message = formGroup.nextElementSibling;
      formGroup.classList.add("has-error");
      icon.classList.add("has-error");
      message.classList.add("has-error");
      message.innerHTML = "El campo es requerido.";
    }
  });
});
