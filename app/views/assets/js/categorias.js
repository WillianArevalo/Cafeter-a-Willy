document.addEventListener("DOMContentLoaded", function () {
  const formCategory = document.getElementById("form-categoria");
  const categoryParent = document.querySelector(".select-selected.categoria");
  if (formCategory) {
    formCategory.addEventListener("submit", function (event) {
      event.preventDefault();
      const nombre = document.getElementById("nombre").value;
      const descripcion = document.getElementById("descripcion").value;
      const imagen = document.getElementById("imagen-categoria").files[0];
      const categoryValue = categoryParent.textContent.trim();

      if (nombre === "" || descripcion === "" || imagen === "") {
        Swal.fire({
          title: "Error",
          text: "Todos los campos son requeridos",
          icon: "error",
          confirmButtonText: "Aceptar",
        });
        return;
      } else {
        var data = new FormData($("#form-categoria")[0]);
        data.append("categoria_padre", categoryValue);
        console.log(categoryValue);
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
              }).then((result) => {
                if (result.isConfirmed) {
                  window.location.href = data.redirect;
                }
              });
            } else {
              Swal.fire(data.title, data.message, data.status);
            }
          },
        });
      }
    });
  }

  $("#tabla-categorias tbody").on("click", ".delete-category", function () {
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

  $("#tabla-categorias tbody").on("click", ".get-subcategories", function () {
    const id = this.getAttribute("data-id");
    const url = this.getAttribute("data-url");
    const token = document.querySelector('meta[name="csrf-token"]').content;
    $.ajax({
      url: url,
      type: "POST",
      data: { id: id, _token: token },
      success: function (respuesta) {
        var data = JSON.parse(respuesta);
        if (data.status == "success") {
          Swal.fire({
            title: data.title,
            html: data.html,
            confirmButtonText: "Aceptar",
          });
        } else {
          Swal.fire(data.title, data.message, data.status);
        }
      },
    });
  });

  document.addEventListener("click", function (event) {
    if (event.target.classList.contains("delete-subcategory")) {
      const btn = event.target;
      Swal.fire({
        title: "¿Estás seguro de eliminar la subcategoría?",
        text: "Una vez eliminado, no podrás recuperar este registro",
        icon: "error",
        showCancelButton: true,
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar",
      }).then((result) => {
        if (result.isConfirmed) {
          const id = btn.getAttribute("data-id");
          const url = btn.getAttribute("data-url");
          const token = document.querySelector(
            'meta[name="csrf-token"]'
          ).content;

          $.ajax({
            url: url,
            type: "POST",
            data: {
              id: id,
              _token: token,
            },
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
    }
  });
});
