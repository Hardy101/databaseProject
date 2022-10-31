<?php
@include 'assets/includes/config.php';
session_start();
if (isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);

    $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

    $result = mysqli_query($conn, $select);


    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_array($result);

        if ($row['user_type'] == 'admin') {

            $_SESSION['admin_name'] = $row['name'];

            header('location:admin_page.php');
        } elseif ($row['user_type'] == 'user') {


            $_SESSION['id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['last_name'] = $row['lname'];
            $_SESSION['user_balance'] = $row['user_balance'];
            $_SESSION['user_income'] = $row['user_income'];
            $_SESSION['user_expense'] = $row['user_expense'];
            header('location:user_page.php');
        }
    } else {
        $error[] = 'incorrect email or password!';
    }
};
?>
<!DOCTYPE html>
<html lang="en">

<?php include 'assets/includes/header.php' ?>
</header>

<body>
    <section>
        <div class="container">
            <form action="" method="POST">
                <div class="form-input img-input">
                    <img src="assets/img/grp.png" alt="">
                </div>
                <?php
                if (isset($error)) {
                    foreach ($error as $error) {
                        echo '<span class="error-msg">' . $error . '</span>';
                    }
                }
                ?>
                <!-- <div class="form-input">
                    <label for="">Account type</label>
                    <select name="" id="">
                        <option value="">Admin</option>
                        <option value="">User</option>
                    </select>
                </div> -->

                <h1>Account Login</h1>
                <div class="form-input">
                    <label for="">Email</label>
                    <input type="text" name="email" placeholder="Enter your email">
                </div>
                <div class="form-input">
                    <label for="">Password</label>
                    <input type="password" name="password" placeholder="Enter your password">
                </div>
                <div class="form-input">
                    <input name="submit" type="submit" value="Login Now" class="trans-0.3">
                </div>
                <div class="form-input">
                    <p class="last-input">don`t have an account? <a href="register.php">Register now</a></p>
                </div>
            </form>
        </div>
    </section>
</body>

</html>