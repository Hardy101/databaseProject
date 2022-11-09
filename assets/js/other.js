const right_btn = document.querySelector(".max");
const side_bar = document.querySelector(".sidebar");
const overlay = document.querySelector(".overlay");
alert('help')
// ==== Functions === //
right_btn.addEventListener("click", () => {
  side_bar.classList.toggle("move");
  overlay.classList.add("show");
});

overlay.addEventListener("click", () => {
  side_bar.classList.remove("move");
  overlay.classList.remove("show");
  update_form.classList.add("remove");
});
