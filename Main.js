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

if (btnAddHidden) {
  btnAddHidden.addEventListener("click", () => {
    containerForm.classList.add("hidden");
    localStorage.setItem("state_owner", false);
  });
}

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

  //Popups para eliminar elemento
  const btnsDeletePat = document.querySelectorAll(".delete_pat");

  btnsDeletePat.forEach((btnDeletePat) => {
    if (btnDeletePat) {
      var id = btnDeletePat.dataset.id;
      btnDeletePat.addEventListener("click", () => {
        deleteItem("Paciente", `http://localhost/VetSoft/Patient/delete/${id}`);
      });
    }
  });

  const btnsDeleteOwn = document.querySelectorAll(".delete_own");

  btnsDeleteOwn.forEach((btnDeleteOwn) => {
    if (btnDeleteOwn) {
      var id = btnDeleteOwn.dataset.id;
      btnDeleteOwn.addEventListener("click", () => {
        deleteItem("Cliente", `http://localhost/VetSoft/Owner/delete/${id}`);
      });
    }
  });

  const btnsDeleteVet = document.querySelectorAll(".delete_vet");

  btnsDeleteVet.forEach((btnDeleteVet) => {
    if (btnDeleteVet) {
      var id = btnDeleteVet.dataset.id;
      btnDeleteVet.addEventListener("click", () => {
        deleteItem(
          "Veterinario",
          `http://localhost/VetSoft/Veterinary/delete/${id}`
        );
      });
    }
  });

  

  const btnsDeleteTur = document.querySelectorAll(".delete_tur");

  btnsDeleteTur.forEach((btnDeleteTur) => {
    btnDeleteTur.addEventListener("click", () => {
      var id = btnDeleteTur.dataset.id;
      deleteItem("Turno", `http://localhost/VetSoft/Turn/delete/${id}`);
    });
  });

  const btnsDeleteHis = document.querySelectorAll(".delete_his");

  btnsDeleteHis.forEach((btnDeleteHis) => {
    if (btnDeleteHis) {
      var id = btnDeleteHis.dataset.id;
      btnDeleteHis.addEventListener("click", () => {
        deleteItem("Registro", `http://localhost/VetSoft/History/delete/${id}`);
      });
    }
  });

  
});


const btnsDeleteTur = document.querySelectorAll(".delete_tur");

  btnsDeleteTur.forEach((btnDeleteTur) => {
    btnDeleteTur.addEventListener("click", () => {
      var id = btnDeleteTur.dataset.id;
      deleteItem("Turno", `http://localhost/VetSoft/Turn/delete/${id}`);
    });
  });

  const btnsDeleteHis = document.querySelectorAll(".delete_his");

  btnsDeleteHis.forEach((btnDeleteHis) => {
    if (btnDeleteHis) {
      var id = btnDeleteHis.dataset.id;
      btnDeleteHis.addEventListener("click", () => {
        deleteItem("Registro", `http://localhost/VetSoft/History/delete/${id}`);
      });
    }
  });


  const btnsDeleteUser = document.querySelectorAll(".delete_user");

  btnsDeleteUser.forEach((btnDeleteUser) => {
    if (btnDeleteUser) {
      btnDeleteUser.addEventListener("click", () => {
        var id = btnDeleteUser.dataset.id;
        deleteItem("Usuario", `http://localhost/VetSoft/User/delete/${id}`);
      }); 
    }
  });



//Popup cerrar sesión
const btnLogout = document.getElementById('btn_logout');

if (btnLogout) {
  btnLogout.addEventListener('click', () => {
    showPopupDelete();
  });
}

const showPopupDelete = () => {
  let timerInterval;
  Swal.fire({
    title: "Saliendo del sistema",
    timer: 2000,
    timerProgressBar: true,
    didOpen: () => {
      Swal.showLoading();
      const timer = Swal.getPopup().querySelector("b");
      timerInterval = setInterval(() => {
        timer.textContent = `${Swal.getTimerLeft()}`;
      }, 100);
    },
    willClose: () => {
      $.ajax({
        url: "http://localhost/VetSoft/User/logout",
        type: "post",
        success: function (response) {
         
          window.location.href = 'http://localhost/VetSoft/User/index';
        },
        error: function (xhr, status, error) {},
      });
    },
  }).then((result) => {
    if (result.dismiss === Swal.DismissReason.timer) {
      console.log("I was closed by the timer");
    }
  });
};





function deleteItem(param, url) {
  Swal.fire({
    text: "¿Está seguro que desea eliminar a este " + param + "?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: url,
        type: "post",
        success: function (response) {
          Swal.fire({
            position: "center",
            icon: "success",
            title: param + " eliminado con exito!!!",
            showConfirmButton: false,
          });
          setTimeout(function () {
            location.reload();
          }, 2000);
        },
        error: function (xhr, status, error) {},
      });
    }
  });
}
