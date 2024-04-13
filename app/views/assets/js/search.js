document.addEventListener("DOMContentLoaded", function () {
  var searchInput = document.getElementById("search");
  var searchBuutons = document.querySelectorAll(".button-search");
  searchInput.addEventListener("keyup", function () {
    let filter = searchInput.value.toUpperCase();
    filterTable(filter);
  });

  function filterTable(filter) {
    let table = document.getElementById("tabla-categorias");
    let tbody = table.getElementsByTagName("tbody")[0];
    let rows = tbody.getElementsByTagName("tr");

    for (let i = 0; i < rows.length; i++) {
      let cells = rows[i].getElementsByTagName("td");
      let found = false;
      for (let j = 0; j < cells.length; j++) {
        let cell = cells[j];
        if (cell) {
          let txtValue = cell.textContent || cell.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            found = true;
            break;
          }
        }
      }
      if (found) {
        rows[i].classList.add("slide-in");
        rows[i].classList.remove("slide-out");
        rows[i].style.display = "";
      } else {
        rows[i].classList.add("slide-out");
        rows[i].classList.remove("slide-in");

        rows[i].addEventListener("animationend", function () {
          if (rows[i].classList.contains("slide-out")) {
            rows[i].style.display = "none";
          }
        });
      }
    }
  }

  searchBuutons.forEach(function (button) {
    button.addEventListener("click", function () {
      searchBuutons.forEach(function (button) {
        button.classList.remove("active");
      });

      button.classList.toggle("active");
      const filter = button.getAttribute("data-filter");
      const url = button.getAttribute("data-url");
      $.ajax({
        url: url,
        type: "POST",
        data: { filtro: filter },
        success: function (response) {
          var data = JSON.parse(response);
          if (data.status == "success") {
            $("#tabla-categorias tbody").html(data.html);
          }
        },
      });
    });
  });
});
