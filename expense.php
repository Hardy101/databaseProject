<?php

@include 'assets/includes/config.php';

session_start();
if (!isset($_SESSION['id'])) {
    header('location:user_page.php');
}
$user_id = $_SESSION['id'];
if (isset($_POST['submit'])) {
    $desc = mysqli_real_escape_string($conn, $_POST['desc']);
    $amnt = mysqli_real_escape_string($conn, $_POST['amnt']);
    $trans_type = $_POST['trans_type'];
    $insert = "INSERT INTO user_action(transact_type, transact_desc, transact_amount) VALUES('$trans_type','$desc','$amnt')";
    mysqli_query($conn, $insert);
}
$selt = 'SELECT id, transact_type, transact_desc, transact_amount, created_at FROM user_action ORDER BY id';
$result_1 = mysqli_query($conn, $selt);
$trans = mysqli_fetch_all($result_1, MYSQLI_ASSOC);
////////////////////
$user_transact = 'SELECT id, name, transact_type, transact_desc, amount, created_at FROM user_transactions ORDER BY id';
$result_0 = mysqli_query($conn, $user_transact);
$trans_0 = mysqli_fetch_all($result_0, MYSQLI_ASSOC);
// <?php print_r($row_1) 
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
    <?php include "assets/includes/nav.php" ?>
    <div class="overlay"></div>
    <main>
        <div class="transactions flex-btw">
            <!-- side bar -->
            <div class="sidebar">
                <h1 class="expense-h1">Et</h1>
                <ul class="side-links">
                    <li class="side-content"><a href="user_page.php" class="flex-side"><img src="assets/img/home-2.png" width="25" height="25" alt="">
                            <span>Dashboard</span></a></li>
                    <li class="side-content"><a href="income.php" class="flex-side"><img src="assets/img/income.png" width="25" height="25" alt="">
                            <span>Income</span></a></li>
                    <li class="side-content active"><a href="expense.php" class="flex-side"><img src="assets/img/expenses.png" width="25" height="25" alt="">
                            <span>Expenses</span></a></li>
                    <li class="side-content"><a href="overview.php" class="flex-side"><img src="assets/img/pie-graph.png" width="25" height="25" alt=""> <span>Overview</span></a></li>
                </ul>
                <div class="down">
                    <a href="logout.php" class="acc-log"> <i class="fa fa-sign-out"></i> Logout</a>
                    <p class="acc-i"><?php echo $_SESSION['user_name'], " ", $_SESSION['last_name'] ?></p>
                </div>

            </div>
            <!-- A div for transactions tab and overview -->
            <div class="trans-over">

                <div class="transact">
                    <div class="tract m-up-d-4 flex-btw">
                        <h2>Expenses</h2>
                        <button class="add-btn max trans-03"><i class="fa fa-bars"></i></button>
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
            </div>
        </div>
    </main>
    <script src="assets/js/other.js"></script>
</body>

</html>