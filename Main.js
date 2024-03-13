document.addEventListener("load", () => {
  const btnAdd = document.querySelector("#add");
  const containerForm = document.querySelector(".container_form");

  if (btnAdd) {
    btnAdd.addEventListener("click", () => {
      alert("WEWQEWQE");
      containerForm.classList.toggle("-top-full");
    });
  }
});
