<?php

@include 'assets/includes/config.php';

session_start();
if (!isset($_SESSION['user_name'])) {
   header('location:login.php');
}
$user_id = $_SESSION['id'];
$user_name = $_SESSION['user_name'];
if (isset($_POST['sort_btn'])) {
   echo '';
}
if (isset($_POST['submit'])) {
   $desc = mysqli_real_escape_string($conn, $_POST['desc']);
   $amnt = mysqli_real_escape_string($conn, $_POST['amnt']);
   $trans_type = $_POST['trans_type'];
   $insert = "INSERT INTO user_transactions(id, name, transact_type, transact_desc, amount) VALUES('$user_id', '$user_name','$trans_type', '$desc', '$amnt')";
   mysqli_query($conn, $insert);
}


// Getting Data from the transactions Tab
$user_transact = 'SELECT id, name, transact_type, transact_desc, amount, created_at FROM user_transactions ORDER BY id';
$result_0 = mysqli_query($conn, $user_transact);
$trans_0 = mysqli_fetch_all($result_0, MYSQLI_ASSOC);
// Gettinig Data from user_details (Cashflow Data)
$user_details = 'SELECT id, user_balance, user_income  FROM user_details ORDER BY id';
$result_2 = mysqli_query($conn, $user_details);
$trans_1 = mysqli_fetch_all($result_2, MYSQLI_ASSOC);
// $user_income = $trans_1[$_SESSION['id']]['user_income'];
?>

<!DOCTYPE html>
<html lang="en">
<?php include 'assets/includes/header.php' ?>
<title>Income page</title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<style>
   body {
      background: #fff;
   }
</style>
</head>

<body>

   <button class="max trans-03"><i class="fa fa-arrow-right"></i></button>
   <form action="" method="POST" class="scale-form hide trans-03">
      <div class="form-input">
         <input type="text" name="desc" id="" placeholder="Income description">
      </div>
      <div class="form-input">
         <label for=""> Income Transaction </label>
         <select name="trans_type" id="">
           
            <option value="income">Income</option>
         </select>
      </div>
      <div class="form-input">
         <input type="number" name="amnt" id="" placeholder="Amount">
      </div>
      <div class="form-input">
         <input type="submit" name="submit" value="Enter transaction">
      </div>
   </form>

   <main>

      <!-- Transactions -->
      <div class="transactions flex-btw space-btw">
         <!-- side bar -->
         <?php
         include_once "siderbar.php" ?>
         

         </div>
         <div class="dish">
         <div class="transact">
            <div class="tract space-btw">
               <h2>Income Transactions</h2>
               <button class="add trans-03"><i class="fa fa-plus"></i></button>
            </div>
            <div class="form-input">
               <input type="search" name="search" id="" placeholder="Search">
            </div>
            <div class="trans-header">
               <div class="header space-btw">
                  <span class="header-info">Net</span>
                  <span class="header-info">Total income</span>
                  
               </div>
               <!-- Cashflow detail values -->
               <div class="info space-btw">
                  <?php foreach ($trans_1 as $user_details) : ?>
                     <?php if ($user_details['id'] == $_SESSION['id']) : ?>
                        <span class="b-info bal-val">$ <?php echo $user_details['user_balance'] ?></span>
                        <span class="b-info">$ <?php echo $user_details['user_income'] ?></span>
                      
                     <?php endif ?>
                  <?php endforeach ?>

               </div>
            </div>
            <hr class="hr" />
            <div class="space-btw">
               <!-- Sorting Buttons -->
               <div class="info sort">
                  <button class="sort-btn active trans-0.3">All</button>
                  <button class="sort-btn trans-0.3">Income</button>
                 
               </div>
               <!-- Filter Button -->
               <button name="sort_btn" type="submit" class="filter trans-0.3">
                  <img src="assets/img/filter.png" alt="">
               </button>
            </div>
            <!-- All Transaction type Tabs -->



            <div class="trans-details all hide">
               <?php foreach ($trans_0 as $details) : ?>
                  <div class="dets space-btw">
                     <div class="info">
                        <h3 class="info-h"><?php echo $details['transact_desc'] ?></h3>
                        <span><?php $details['transact_amount'] ?></span>
                        <span class="info-span"><?php echo $details['created_at'] ?></span>
                     </div>
                     <div class="price">
                        <span>$<?php echo $details['transact_amount'] ?></span>
                     </div>
                  </div>
               <?php endforeach ?>
            </div>
            <!-- End of transaction type -->
            <!-- Income Tabs -->
            <div class="trans-details income" id="income">
               <!-- Details -->
               <?php foreach ($trans_0 as $details) : ?>
                  <?php if ($details['transact_type'] === 'income' && $details['id'] == $user_id) : ?>
                     <div class="dets space-btw">
                        <div class="info">
                           <h3 class="info-h"><?php echo $details['transact_desc'] ?></h3>
                           <span class="info-span"><?php echo $details['created_at'] ?></span>
                        </div>
                        <div class="price">
                           <span>$<?php echo $details['amount'] ?></span>
                        </div>
                     </div>
                  <?php endif ?>
               <?php endforeach ?>
               <!-- End of Income Tab -->

            </div>
            <!-- Expenses Tab -->
            <div class="trans-details expenses">
               <?php foreach ($trans_0 as $details) : ?>
                  <?php if ($details['transact_type'] === 'expense' && $details['id'] == $user_id) : ?>
                     <div class="dets space-btw">
                        <div class="info">
                           <h3 class="info-h"><?php echo $details['transact_desc'] ?></h3>
                           <span class="info-span"><?php echo $details['created_at'] ?></span>
                        </div>
                        <div class="price">
                           <span>$<?php echo $details['amount'] ?></span>
                        </div>
                     </div>
                  <?php endif ?>
               <?php endforeach ?>
               <!-- End of details -->

            </div>
         </div>
         <!-- Overview -->
         <div class="overview">
            <div class="overview-tab">
               <h2>Monthly Overview</h2>
               <div class="over-tab">
               <div class="">
    <canvas id="myChart" width="400" height="400"></canvas>
    <script>
const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
          </div>
                  <div class="overview-expense">
                    <h1>how the market </h1>
                    <p>we have some write up</p>
                  </div>
                  <div class="overview-income"></div>
               </div>
            </div>
         </div>
      </div>
      <!-- End of transactions Div -->

      </div>

   </main>
   <script src="assets/js/app.js"></script>
</body>

</html>