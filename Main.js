const btnAdd = document.querySelector("#add");
const btnAddHidden = document.querySelector("#hidden");
const containerForm = document.querySelector(".container_form");

document.getElementById("add").addEventListener("click", function () {
  containerForm.classList.remove("hidden");
  containerForm.classList.remove("translate-y-full");
});

document.getElementById("hidden").addEventListener("click", function () {
  containerForm.classList.add("translate-y-full");
    containerForm.classList.add("hidden");
});
