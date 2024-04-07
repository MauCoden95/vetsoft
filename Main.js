//Mostrar formularios
const btnAdd = document.querySelector("#add");
const btnAddHidden = document.querySelector("#hidden");
const containerForm = document.querySelector(".container_form");

if (btnAdd) {
  btnAdd.addEventListener("click", () => {
    containerForm.classList.remove("hidden");
    localStorage.setItem("state_owner", true);
  });
}

btnAddHidden.addEventListener("click", () => {
  containerForm.classList.add("hidden");
  localStorage.setItem("state_owner", false);
});

document.addEventListener("DOMContentLoaded", function () {
  //Filtrar datos con el buscador
  const dataTable = document.getElementById("dataTable");
  const searchInput = document.getElementById("searchInput");

  function removeAccents(str) {
    return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
  }

  searchInput.addEventListener("input", function () {
    const searchTerm = removeAccents(searchInput.value.toLowerCase().trim());
    const rows = dataTable.querySelectorAll("tbody tr");

    rows.forEach((row) => {
      const columns = row.querySelectorAll("td");

      let found = false;

      columns.forEach((column) => {
        const text = removeAccents(column.textContent.toLowerCase());
        if (text.includes(searchTerm)) {
          found = true;
        }
      });

      if (found) {
        row.style.display = "";
      } else {
        row.style.display = "none";
      }
    });
  });





});
