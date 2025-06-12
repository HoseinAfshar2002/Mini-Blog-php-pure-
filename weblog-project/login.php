<?php
session_start();

include "database/pdo.php";



if (isset($_SESSION['user'])) {
    unset($_SESSION['user']);
}


$err = "";


// بررسی پر شدن مقادیر ورودی در فرم ثبت نام
if (
    isset($_POST['email']) && $_POST['email'] !== ''
    && isset($_POST['password']) && $_POST['password'] !== ''
) {


    //بررسی مقادیر فرم با مقادیر دیتابیس
    if (isset($_POST['sub'])) {

        $email = $_POST['email'];
        $password = $_POST['password'];
        $res = $connection->prepare("SELECT * FROM users WHERE email=? AND password=?");
        $res->bindValue(1, $email);
        $res->bindValue(2, $password);
        $res->execute();
        // بررسی وجود کاربر در دیتا بیس
        if ($res->rowCount() >= 1) {
            $_SESSION['user'] = $_POST['email'];
            header("location:panel\index.php");
        }else {
        $err = "اطلاعات ورودی نادرست است ...!";
    }
    } 
} else {
    $err =  "فرم را پر کنید";
}
























?>













<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="styles/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/css/style.css">
    <link rel="stylesheet" href="styles/css/auth.css">
    <!-- Css Reset -->
    <link rel="stylesheet" href="styles/css/reset.css">
    <!-- Vazir Font -->
    <link rel="stylesheet" href="fonts/vazir.css">
    <!-- Fontawsome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>ورود به حساب کاربری</title>
</head>

<body>
    <section class="d-flex justify-content-center align-items-center min-h-screen bg">
        <div id="overlay"></div>
        <div class="form-container">
            <form action="#" method="POST">
                <section style="display: flex; justify-content: center; color: red;"><?php if ($err !== "") echo $err ?></section>
                <br>
                <h1 class="title">ورود به حساب کاربری</h1>
                <div class="mt-3 position-relative">
                    <input type="email" name="email" class="field" placeholder="ایمیل ...">
                    <i class="fa fa-user field_icon"></i>
                </div>
                <div class="mt-3 position-relative">
                    <input type="password" name="password" class="field" id="fieldPass" placeholder="رمز عبور ...">
                    <i class="fa fa-lock field_icon"></i>
                    <button type="button" id="showPass"></button>
                </div>
                <div class="mt-3">
                    <button type="submit" name="sub" class="btn-submit bg-primary">
                        <i class="fa fa-sign-in ms-1"></i>
                        <span>ورود به حساب کاربری</span>
                    </button>
                </div>

                <p class="text">
                    حساب کاربری ندارید ؟ <a href="register.php" class="text-primary">یکی بسازید</a>
                </p>
            </form>
        </div>
    </section>

    <script src="js/showPassword.js"></script>
    <script src="js/darkMode.js"></script>
</body>

</html>