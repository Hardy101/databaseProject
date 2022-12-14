<?php
include 'assets/includes/config.php';

if (isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($conn, $_POST['fname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);
    $user_type = $_POST['user_type'];

    $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $error[] = 'user already exist!';
    } else {
        if ($pass != $cpass) {
            $error[] = 'password not matched!';
        } else {
            $insert = "INSERT INTO user_form(name, email, password, user_type, fname, lname) VALUES('$name','$email','$pass','$user_type', '$fname', '$lname')";
            $insert_1 = "INSERT INTO user_details(name) VALUES('$name')";
            mysqli_query($conn, $insert);
            mysqli_query($conn, $insert_1);
            header('location:login.php');
        }
    }
};

?>
<!DOCTYPE html>
<html lang="en">
<?php include 'assets/includes/header.php' ?>

<body>
    <?php include "assets/includes/nav_1.php" ?>
    <section>
        <div class="container">
            <form action="" method="POST">
                <div class="form-input img-input">
                    <img src="assets/img/grp.png" alt="">
                </div>
                <h1>Create Account</h1>
                <?php
                if (isset($error)) {
                    foreach ($error as $error) {
                        echo '<span class="error-msg trans-03">' . $error . '</span>';
                    }
                }
                ?>
                <div class="form-input flex-btw">
                    <button class="fa fa-user form-btn func"></button>
                    <label for="">Email</label>
                    <input type="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-input flex-btw">
                    <div class="label">
                        <label for="">First Name <span class="required">*</span></label>
                        <label for="" class="lname-label">Last Name <span class="required">*</span></label>
                    </div>
                    <div class="input">
                        <input type="text" name="fname" placeholder="Enter first name" class="fname" required>
                        <input type="text" name="lname" placeholder="Enter Last name" class="lname" required>
                    </div>
                </div>

                <div class="form-input flex-btw">
                    <button class="fa fa-eye form-btn func"></button>
                    <label for="">Password</label>
                    <input type="password" name="password" placeholder="Enter your password" class="password">
                </div>
                <div class="form-input flex-btw">
                    <button class="fa fa-eye form-btn func"></button>
                    <label for="">Repeat Password</label>
                    <input type="password" name="cpassword" placeholder="Confirm password" class="password">
                </div>
                <div class="form-input flex-btw">
                    <label for="">Account type</label>
                    <select name="user_type" id="" required>
                        <option value="user">User</option>
                    </select>
                </div>
                <div class="form-input flex-btw">
                    <input type="submit" name="submit" value="Register Now" class="trans-0.3">
                </div>
                <div class="form-input flex-btw">
                    <p class="last-input">already have an account? <a href="login.php">Login now</a></p>
                </div>
                <div class="form-input">
                    <button class="input-btn func" onclick="showPassword()">Show Password</button>
                </div>
            </form>
        </div>
    </section>
    <script>
        const password = document.querySelectorAll('.password')
        const formBtn = document.querySelectorAll('.func')
        const inputBtn = document.querySelector('.input-btn')
        formBtn.forEach((btn) => {
            btn.addEventListener('click', (e) => {
                e.preventDefault()
            })
        })
        const showPassword = () => {
            password.forEach((password) => {
                if (password.type === "password") {
                    password.type = 'text'
                    inputBtn.textContent = 'Hide Password'
                } else {
                    password.type = 'password'
                    inputBtn.textContent = 'Show Password'
                }
            })
        }
    </script>
</body>

</html>