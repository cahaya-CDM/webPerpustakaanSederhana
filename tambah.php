<?php

session_start();

if (!isset($_SESSION["login"])) {
    header('location: login.php');

    exit;
}

require "function.php";

if (isset($_POST["submit"])) {
    if (tambah($_POST) > 0) {
        echo "<script>
        
        alert('Data berhasil di tambahkan');
        document.location.href = 'index.php';
        </script>";
    } else {
        echo "Gagal";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/add.css">
</head>

<body>
    <div class="container">
    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="judul">Judul :</label>
                <input type="text" name="judul" id="judul" required>
            </li>
            <li>
                <label for="halaman">Halaman :</label>
                <input type="number" name="halaman" id="halaman" min="1" required>
            </li>
            <li>
                <label for="cover">Cover :</label>
                <input type="file" name="cover" id="cover" required>
            </li>
            <li><button type="submit" name="submit">APLY</button></li>
        </ul>
    </form>
    <ul>
        <li><a href="index.php"><button>Back</button></a></li>
    </ul>
    </div>
</body>

</html>