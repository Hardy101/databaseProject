<?php

@include 'assets/includes/config.php';

session_start();
if (!isset($_SESSION['user_name'])) {
    header('location:login.php');
}
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
    <button class="max"><img src="assets/img/right-arrow.png" alt=""></button>
    <main class="flex-btw">
        <!-- side bar -->
        <div class="sidebar">
            <h1 class="expense-h1">Et</h1>

            <ul class="side-links">
                <li class="side-content active"><a href=""><img src="assets/img/home.png" width="25" height="25" alt=""></a></li>
                <!-- <li><a href=""><i class="fa fa-wallet"></i></a></li> -->
                <li class="side-content"><a href="" class="flex-btw"><img src="assets/img/pie-chart.png" width="25" height="25" alt=""></a></li>
                <li class="side-content"><a href="expense.php"><img src="assets/img/expenses.png" width="25" height="25" alt=""></a></li>
                <li class="side-content"><a href=""><img src="assets/img/wallet.png" width="25" height="25" alt=""></a></li>
            </ul>
            <a class="prof"><?php echo $_SESSION['user_name'][0] ?></a>
            <div class="t-tip hide">
                <a href="logout.php">Logout</a>
            </div>

        </div>
        <script src="assets/js/app.js"></script>
</body>

</html>