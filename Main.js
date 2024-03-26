// const btnAdd = document.querySelector("#add");
// const btnAddHidden = document.querySelector("#hidden");
// const containerForm = document.querySelector(".container_form");

// localStorage.setItem("state_owner", false);

// btnAdd.addEventListener('click', () => {
//   localStorage.setItem("state_owner", true);
// })

// btnAdd.addEventListener('click', () => {
//   localStorage.setItem("state_owner", false);
// })


const btnAdd = document.querySelector("#add");
const btnAddHidden = document.querySelector("#hidden");
const containerForm = document.querySelector(".container_form");

// Verificar el estado en el localStorage y mostrar u ocultar el contenedor en consecuencia
if (localStorage.getItem("state_owner") === "true") {
  containerForm.classList.remove('hidden');
} else {
  containerForm.classList.add('hidden');
}

// Abrir el contenedor al hacer clic en el botón #add
btnAdd.addEventListener('click', () => {
  containerForm.classList.remove('hidden');
  localStorage.setItem("state_owner", true);
});

// Cerrar el contenedor al hacer clic en el botón #hidden
btnAddHidden.addEventListener('click', () => {
  containerForm.classList.add('hidden');
  localStorage.setItem("state_owner", false);
});



document.addEventListener("DOMContentLoaded", function() {
  const dataTable = document.getElementById("dataTable");
  const searchInput = document.getElementById("searchInput");

 
  function removeAccents(str) {
      return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
  }

  
  searchInput.addEventListener("input", function() {
      const searchTerm = removeAccents(searchInput.value.toLowerCase().trim()); 
      const rows = dataTable.querySelectorAll("tbody tr");

      rows.forEach(row => {
          const columns = row.querySelectorAll("td");

          let found = false; 

          columns.forEach(column => {
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
