const eye_btn = document.querySelector(".eye-btn");
const acct_bal = document.querySelector(".bal-val");
const acct_income = document.querySelector(".income");
const div_income = document.querySelector("#income");
const acct_expense = document.querySelector(".expenses");
const log_out_btn = document.querySelector(".prof");
const tool_tip = document.querySelector(".t-tip");
const add_btn = document.querySelector(".add");
const update_form = document.querySelector(".scale-form");
const sort_btn = document.querySelectorAll(".sort-btn");
const detail_tab = document.querySelectorAll(".trans-details");
const right_btn = document.querySelector('.max')
const side_bar = document.querySelector('.sidebar');

// eye_btn.addEventListener('click', () => {
//     acct_bal.classList.toggle('hide');
//     acct_bal.classList.toggle('active');
// })
right_btn.addEventListener('click', () => {
  right_btn.classList.toggle('move')
  side_bar.classList.toggle('move')
})
add_btn.addEventListener("click", () => {
  update_form.classList.toggle("hide");
  add_btn.classList.toggle("rotate");
});
if (acct_bal.textContent < 0) {
  acct_bal.style.color = "red";
} else {
  acct_bal.style.color = "#1D1CE5";
}
log_out_btn.addEventListener("click", () => {
  tool_tip.classList.toggle("hide");
});
sort_btn.forEach((btn) => {
  btn.addEventListener("click", handleClick);
});
// Tip Button Click function
function handleClick(event) {
  sort_btn.forEach((btn) => {
    btn.classList.remove("active");
    if (event.target.innerHTML === btn.innerHTML) {
      btn.classList.add("active");
      console.log('deleted');
      if (event.target.textContent === "Expenses") {
        acct_expense.classList.remove("hide");
        div_income.classList.add("hide");

      }else if (event.target.textContent === "Income") {
        div_income.classList.remove("hide");
        acct_expense.classList.add("hide");
      }else{
        div_income.classList.remove("hide");
        acct_expense.classList.remove("hide");
      }
    }
  });
}
