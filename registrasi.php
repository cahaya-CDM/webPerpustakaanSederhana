<?php
require 'function.php';



if (isset($_POST["registrasi"])) {

    if (registrasi($_POST) > 0) {
        echo "
        <script>
            alert('user baru ditambahkan');
            window.location.href = 'login.php';
        </script>
        ";
    }elseif(registrasi($_POST) < 0){
        $coba = true;
    } 
    else {
        // echo mysqli_error($conn);
        $error = true;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/regis.css">
    <script src="https://kit.fontawesome.com/65e267e018.js" crossorigin="anonymous"></script>
</head>

<body>

    <div class="container">

        <div class="judul">
            <div class="judul-2">
                <h1>Halaman Registrasi_</h1>
            </div>
        </div>

        <div class="container-input">
            <form action="" method="post">
                <ul>
                    <li>
                        <label class="label-user" for="gmail"><i class="fa-regular fa-user"></i></label>
                        <input type="text" id="gmail" name="gmail" placeholder="Masukkan Gmail Anda.." required autocomplete="off">
                    </li>
                    <li>
                        <label class="label-regis" for="password"><i class="fa-solid fa-key"></i></label>
                        <input type="password" id="password" name="password" placeholder="" required>
                    </li>
                    <li>
                        <label class="label-regis" for="password2"><i class="fa-solid fa-key"></i></label>
                        <input type="password" id="password2" name="password2" placeholder="" required>
                    </li>
                </ul>

                <div class="error">
                    <?php if(isset($error)) : ?>
                        <p>Password Verifikasi tidak sesuai</p>
                    <?php endif; ?>
                </div>
                
                <div class="error">
                    <?php if(isset($coba)) : ?>
                        <p>Data Yang anda input sudah ada di database</p>
                    <?php endif; ?>
                </div>
                

                <div class="btn">
                    <button type="submit" name="registrasi">REGISTRASI</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>