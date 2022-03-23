let spanEl = document.querySelector(".input_photo");
let inputFile = document.getElementById("file-upload");
inputFile.addEventListener("change", function (el) {
  spanEl.textContent = el.target.value.split("\\").pop();
});
