const eye_btn = document.querySelector(".eye-btn");
const txt_income = document.querySelector(".income-label");
const txt_expense = document.querySelector(".expense-label");
const bal_expense = document.querySelector(".bal-label");
const acct_income = document.querySelector(".income");
const div_income = document.querySelector("#income");
const acct_expense = document.querySelector(".expenses");
const add_btn = document.querySelector(".add");
const update_form = document.querySelector(".scale-form");
const sort_btn = document.querySelectorAll(".sort-btn");
const detail_tab = document.querySelectorAll(".trans-details");
const right_btn = document.querySelector(".max");
const side_bar = document.querySelector(".sidebar");
const cancel_btn = document.querySelectorAll(".cancel");
const overlay = document.querySelector(".overlay");

// Icon selects
right_btn.addEventListener("click", () => {
  side_bar.classList.add("move");
  overlay.classList.add("show");
});
overlay.addEventListener("click", () => {
  side_bar.classList.remove("move");
  overlay.classList.remove("show");
  update_form.classList.add("remove");
});
add_btn.addEventListener("click", () => {
  update_form.classList.toggle("remove");
  add_btn.classList.toggle("rotate");
  overlay.classList.add("show");
});
sort_btn.forEach((btn) => {
  btn.addEventListener("click", handleClick);
});
cancel_btn.forEach((btn) => {
  btn.addEventListener("click", (e) => {
    update_form.classList.toggle("remove");
    overlay.classList.remove("show");
    if (btn.textContent == "cancel transaction") {
      e.preventDefault();
    }
  });
});
// Tip Button Click function
function handleClick(event) {
  sort_btn.forEach((btn) => {
    btn.classList.remove("active");
    if (event.target.innerHTML === btn.innerHTML) {
      btn.classList.add("active");
      console.log("deleted");
      if (event.target.textContent === "Expenses") {
        acct_expense.classList.remove("hide");
        div_income.classList.add("hide");
      } else if (event.target.textContent === "Income") {
        div_income.classList.remove("hide");
        acct_expense.classList.add("hide");
      } else {
        div_income.classList.remove("hide");
        acct_expense.classList.remove("hide");
      }
    }
  });
}
if (overlay.classList.contains("show")) {
  document.body.classList.add("hidden");
  console.log("It is i");
} else {
  document.body.classList.remove("hidden");
  console.log("It is i");
}
// Chart
var xValues = ["Income", "Expenses", "Balance"];
var yValues = [
  parseInt(txt_income.textContent),
  parseInt(txt_expense.textContent),
  parseInt(bal_expense.textContent),
];
var barColors = ["rgb(0, 235, 0)", "rgb(235, 0, 0)", "#2b5797"];

new Chart("myChart", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [
      {
        backgroundColor: barColors,
        data: yValues,
      },
    ],
  },
  options: {
    title: {
      display: true,
      text: "Total Overview",
    },
  },
});
