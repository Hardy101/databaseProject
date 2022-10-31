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
// Getting Data from the transactions Tab
$user_transact = 'SELECT id, name, transact_type, transact_desc, amount, created_at FROM user_transactions ORDER BY id';
$result_0 = mysqli_query($conn, $user_transact);
$trans_0 = mysqli_fetch_all($result_0, MYSQLI_ASSOC);
// Gettinig Data from user_details (Cashflow Data)
$user_details = 'SELECT id, user_balance, user_income, user_expense FROM user_details ORDER BY id';
$result_2 = mysqli_query($conn, $user_details);
$trans_1 = mysqli_fetch_all($result_2, MYSQLI_ASSOC);
$acct_id = $_SESSION["id"];
// $user_income = $trans_1[$_SESSION['id']]['user_income'];
/////////////////
if (isset($_POST['submit'])) {
   $desc = mysqli_real_escape_string($conn, $_POST['desc']);
   $amnt = mysqli_real_escape_string($conn, $_POST['amnt']);
   $trans_type = $_POST['trans_type'];
   $insert = "INSERT INTO user_transactions(id, name, transact_type, transact_desc, amount) VALUES('$user_id', '$user_name','$trans_type', '$desc', '$amnt')";
   mysqli_query($conn, $insert);
   // Updating record
   foreach ($trans_1 as $user_details) {
      if ($user_details['id'] == $_SESSION['id']) {
         if ($trans_type == 'expense') {
            $update_balance = "UPDATE user_details SET user_balance = user_balance - $amnt WHERE id = $acct_id";
            $update = "UPDATE user_details SET user_expense = user_expense + $amnt WHERE id = $acct_id";
            mysqli_query($conn, $update);
            mysqli_query($conn, $update_balance);
         } elseif ($trans_type == 'income') {
            $update_balance = "UPDATE user_details SET user_balance = user_balance + $amnt WHERE id = $acct_id";
            $update = "UPDATE user_details SET user_income = user_income + $amnt WHERE id = $acct_id";
            mysqli_query($conn, $update);
            mysqli_query($conn, $update_balance);
         }
      }
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include 'assets/includes/header.php' ?>
<title>user page</title>
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
         <input type="text" name="desc" id="" placeholder="Transaction description">
      </div>
      <div class="form-input">
         <label for="">Transaction type</label>
         <select name="trans_type" id="">
            <option value="expense">Expense</option>
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
      <div class="transactions flex-btw">
         <!-- side bar -->
         <div class="sidebar">
            <h1 class="expense-h1">Et</h1>
            <ul class="side-links">
               <li class="side-content active"><a href=""><img src="assets/img/home.png" width="25" height="25" alt=""></a></li>
               <!-- <li><a href=""><i class="fa fa-wallet"></i></a></li> -->
               <li class="side-content"><a href="" class="flex-btw"><img src="assets/img/pie-chart.png" width="25" height="25" alt=""></a></li>
               <li class="side-content"><a href=""><img src="assets/img/expenses.png" width="25" height="25" alt=""></a></li>
               <li class="side-content"><a href=""><img src="assets/img/wallet.png" width="25" height="25" alt=""></a></li>
            </ul>
            <a class="prof"><?php echo $_SESSION['user_name'][0] ?></a>
            <div class="t-tip hide">
               <a href="logout.php">Logout</a>
            </div>

         </div>
         <!-- A div for transactions tab and overview -->
         <div class="trans-over">

            <div class="transact">
               <h1 class="top-h" style="text-align: left; ">Hello, <?php echo $_SESSION['user_name'] ?></h1>
               <div class="tract flex-btw">
                  <h2>Transactions</h2>
                  <button class="add trans-03"><i class="fa fa-plus"></i></button>
               </div>
               <div class="form-input">
                  <input type="search" name="search" id="" placeholder="Search">
               </div>
               <div class="trans-header">
                  <div class="header flex-btw">
                     <span class="header-info">Net</span>
                     <span class="header-info">Total income</span>
                     <span class="header-info">Total expense</span>
                  </div>
                  <!-- Cashflow detail values -->
                  <div class="info flex-btw">
                     <?php foreach ($trans_1 as $user_details) : ?>
                        <?php if ($user_details['id'] == $_SESSION['id']) : ?>
                           <span class="b-info bal-val">$ <?php echo $user_details['user_balance'] ?></span>
                           <span class="b-info">$ <?php echo $user_details['user_income'] ?></span>
                           <span class="b-info">$ <?php echo $user_details['user_expense'] ?></span>
                        <?php endif ?>
                     <?php endforeach ?>

                  </div>
               </div>
               <hr class="hr" />
               <div class="flex-btw">
                  <!-- Sorting Buttons -->
                  <div class="info sort">
                     <button class="sort-btn active trans-0.3">All</button>
                     <button class="sort-btn trans-0.3">Income</button>
                     <button class="sort-btn trans-0.3">Expenses</button>
                  </div>
                  <!-- Filter Button -->
                  <button name="sort_btn" type="submit" class="filter trans-0.3">
                     <img src="assets/img/filter.png" alt="">
                  </button>
               </div>
               <!-- All Transaction type Tabs -->



               <div class="trans-details all hide">
                  <?php foreach ($trans_0 as $details) : ?>
                     <div class="dets flex-btw">
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
                        <div class="dets flex-btw">
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
                        <div class="dets flex-btw">
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
                     <div class="overview-expense"></div>
                     <div class="overview-income"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- End of transactions Div -->



   </main>
   <script src="assets/js/app.js"></script>
</body>

</html>