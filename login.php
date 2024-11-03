<?php
session_start();
require 'function.php';

if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    $result = "SELECT gmail FROM user WHERE id = $id";

    $str = mysqli_query($conn, $result);

    $row = mysqli_fetch_assoc($str);

    if ($key === $row['gmail']) {
        $_SESSION['login'] = true;
    }
}

if (isset($_SESSION["login"])) {
    header('Location: index.php');

    exit;
}



if (isset($_POST["login"])) {
    $gmail = $_POST["gmail"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE gmail = '$gmail'");

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row["password"])) {
            // sesi 
            $_SESSION["login"] = true;

            // set cookie
            if (isset($_POST['remember'])) {
                setcookie('id', $row['id'], time() + 60);
                setcookie('key', $row['gmail'], time() + 60);
            }

            header("location: index.php");

            exit;
        }
    }
    $error = true;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/log.css">
    <script src="https://kit.fontawesome.com/65e267e018.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>

    <div class="container">

        <div class="judul">
            <h1>Halaman Login</h1>
        </div>

        <div class="container-input">
            <form action="" method="post">
                <ul>
                    <li>
                        <label class="label-person" for="gmail"><i class="fa-regular fa-user"></i></label>
                        <input type="text" id="gmail" name="gmail" placeholder="Masukkan Email anda..." required autocomplete="off">
                    </li>
                    <li>
                        <label class="label-key" for="password"><i class="fa-solid fa-key"></i></label>
                        <input type="password" id="password" name="password" placeholder="Masukkan password anda..." required>
                    </li>

                    <li class="remember">
                        <label for="remember">Remember me</label>
                        <div class="sp"></div>
                        <input type="checkbox" id="remember" name="remember" placeholder="">
                    </li>

                    <div class="error">
                        <?php if (isset($error)) : ?>
                            <p>Password/email salah!</p>
                        <?php endif; ?>
                    </div>

                    <div class="btn-login">
                        <button type="submit" name="login">Login</button>
                    </div>
                    
                    <div class="btn-regis">
                        <a href="registrasi.php"><button type="button">Daftar</button></a>
                    </div>
                </ul>
            </form>
        </div>
    </div>
</body>

</html>