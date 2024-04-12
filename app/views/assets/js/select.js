document.addEventListener("DOMContentLoaded", function () {
  var selects = document.querySelectorAll(".custom-select__content");
  var selectParent = document.querySelector(".custom-select.select-padre");
  if (selects) {
    selects.forEach((select) => {
      select.addEventListener("click", function () {
        var selectItems = this.parentNode.querySelector(".select-items");
        selectItems.classList.toggle("select-hide");
        if (!selectItems.classList.contains("select-hide")) {
          selectItems.style.display = "block";
        } else {
          selectItems.style.display = "none";
        }
      });
    });
  }

  var options = document.querySelectorAll(".select-items div");
  options.forEach((option) => {
    option.addEventListener("click", function () {
      var select =
        this.closest(".custom-select").querySelector(".select-selected");
      select.textContent = this.textContent;

      if (this.textContent == "Subcategoría") {
        selectParent.classList.add("active");
      } else if (this.textContent == "Categoría principal") {
        selectParent.classList.remove("active");
      }
      closeAllSelects(select);
    });
  });

  document.addEventListener("click", function (e) {
    var selects = document.querySelectorAll(".custom-select");
    selects.forEach((select) => {
      if (!select.contains(e.target)) {
        var selectItems = select.querySelector(".select-items");
        selectItems.style.display = "none";
        selectItems.classList.toggle("select-hide");
      }
    });
  });

  function closeAllSelects(element) {
    var selects = document.querySelectorAll(".custom-select");
    selects.forEach((select) => {
      var selectItems = select.querySelectorAll(".select-items");
      if (element != select && element != selectItems) {
        selectItems.forEach((selectItem) => {
          selectItem.style.display = "none";
          selectItem.classList.toggle("select-hide");
        });
      }
    });
  }
});
