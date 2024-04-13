document.addEventListener("DOMContentLoaded", function () {
  $("#tabla-usuarios tbody").on("click", ".delete-user", function () {
    Swal.fire({
      title: "¿Estás seguro?",
      text: "Una vez eliminado, no podrás recuperar este registro",
      icon: "error",
      showCancelButton: true,
      confirmButtonText: "Sí, eliminar",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.isConfirmed) {
        const id = this.getAttribute("data-id");
        const url = this.getAttribute("data-url");
        const token = document.querySelector('meta[name="csrf-token"]').content;
        console.log(token);
        $.ajax({
          url: url,
          type: "POST",
          data: { id: id, _token: token },
          success: function (respuesta) {
            var data = JSON.parse(respuesta);
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
              Swal.fire(data.title, data.message, data.status);
            }
          },
        });
      }
    });
  });

  $("#form-usuario").submit("click", function (e) {
    e.preventDefault();
    const username = document.getElementById("username").value;
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    const direccion = document.getElementById("direccion").value;
    const imagen = document.getElementById("imagen-usuario").files[0];

    if (username == "" || email == "" || password == "" || direccion == "") {
      Swal.fire("Error", "Todos los campos son obligatorios", "error");
      return;
    }
    var data = new FormData($("#form-usuario")[0]);
    console.log(this.action);
    $.ajax({
      url: this.action,
      type: this.method,
      data: data,
      contentType: false,
      processData: false,
      success: function (respuesta) {
        var data = JSON.parse(respuesta);
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
          Swal.fire(data.title, data.message, data.status);
        }
      },
    });
  });
});
