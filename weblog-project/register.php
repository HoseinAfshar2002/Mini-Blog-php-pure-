<?php
include "database/pdo.php";
$err = "";


// بررسی پر شدن مقادیر ورودی در فرم ثبت نام
if (


    isset($_POST['username']) && $_POST['username'] !== ''
    && isset($_POST['email']) && $_POST['email'] !== ''
    && isset($_POST['password']) && $_POST['password'] !== ''
    && isset($_POST['confirm']) && $_POST['confirm'] !== ''
) {
    // بررسی اینکه مقدار پسورد و تاییدیه برابر باشد
    if ($_POST['password'] === $_POST['confirm']) {
        // بررسی اینکه کاربر حداقل 6 کاراکتر را به عنوان رمز وارد کند
        if (strlen($_POST['password']) > 6) {
            $stmt = $connection->prepare("SELECT * FROM users WHERE email=?"); 
            $stmt->execute([$email]); // مقدار ایمن ایمیل  جایگزین ؟ می‌شود
            $user = $stmt->fetch(); //اولین نتیجه جستجو را به صورت یک آرایه برمی‌گرداند.
            //گر کاربری پیدا نشد یوزر را فالس می کند
            if ($user === false) {
                // ذخیره اطلاعات ورودی کاربر در فرم ثبت نام در متغیر 
                if (isset($_POST['sub'])) {
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    // قراردادن مقادیر ستون های دیتا بیس
                    $res = $connection->prepare("INSERT INTO users SET username=? , email=? , password=?");
                    // مقدار اول را نام مقدار دوم را ایمیل و مقدار سوم را پسورد قرار بده
                    $res->bindValue(1, $username);
                    $res->bindValue(2, $email);
                    $res->bindValue(3, $password);


                    $res->execute();
                }
            } else {
                $err = "ایمیل تکراری است ....!";
            }
        } else {
            $err = "تعداد کاراکتر باید بیشتر از 6 باشد ...!";
            //    echo "<script>alert('$err');</script>";
        }
    } else {
        $err = "مقدار رمز عبور و تاییدیه یکی نیست ...!";
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
    <title>ثبت نام</title>
</head>

<body>
    <section class="d-flex justify-content-center align-items-center min-h-screen bg">
        <div id="overlay"></div>
        <div class="form-container">
            <form action="#" method="POST">
                <section style="display: flex; justify-content: center; color: red;"><?php if ($err !== "") echo $err ?></section>
                <br>

                <h1 class="title">ثبت نام در وبلاگ</h1>
                <div class="mt-3 position-relative">
                    <input type="text" name="username" class="field" placeholder="نام ...">
                    <i class="fa fa-user-plus field_icon"></i>
                </div>
                <div class="mt-3 position-relative">
                    <input type="email" name="email" class="field" placeholder="ایمیل ...">
                    <i class="fa fa-envelope field_icon" aria-hidden="true"></i>
                </div>
                <div class="mt-3 position-relative">
                    <input type="password" name="password" class="field" id="fieldPass" placeholder="رمز عبور ...">
                    <i class="fa fa-lock field_icon"></i>
                    <button type="button" id="showPass"></button>
                </div>
                <div class="mt-3 position-relative">
                    <input type="password" name="confirm" class="field" id="fieldPass" placeholder="تکرار رمز عبور ...">
                    <i class="fa fa-check field_icon"></i>
                    <button type="button" id="showPass"></button>
                </div>
                <div class="mt-3">
                    <button type="submit" name="sub" class="btn-submit bg-primary">
                        <i class="fa fa-user-plus ms-1"></i>
                        <span>ثبت نام</span>
                    </button>
                </div>

                <p class="text">
                    قبلا ثبت نام کرده اید ؟ <a href="/login.html" class="text-primary">ورود</a>
                </p>
            </form>
        </div>
    </section>

    <script src="js/showPassword.js"></script>
    <script src="js/darkMode.js"></script>
    <script src="js/scroll.js"></script>
</body>

</html>