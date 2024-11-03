<?php

session_start();

if (!isset($_SESSION["login"])) {
    header('location: login.php');

    exit;
}

require "function.php";

$id = $_GET["id"];

$perpus = query("SELECT * FROM db_buku WHERE id = $id")[0];

if (isset($_POST["submit"])) {
    if (ubah($_POST) > 0) {
        echo "<script>
        
        alert('Data berhasil di ubah');
        document.location.href = 'index.php';
        </script>";
    } else {
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
    <link rel="stylesheet" href="css/edit.css">
</head>

<body>

    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="coverLama" value="<?= $perpus["cover"] ?>">
            <input type="hidden" name="id" value="<?= $perpus["id"] ?>">
            <ul>
                <li>
                    <label for="judul">Judul :</label>
                    <input type="text" name="judul" id="judul" required value="<?= $perpus["judul"] ?>">
                </li>
                <li>
                    <label for="halaman">Halaman :</label>
                    <input type="number" name="halaman" id="halaman" min="1" required value="<?= $perpus["halaman"] ?>">
                </li>
                <li>
                    <label for="cover">Cover :</label>
                    <img src="img/<?= $perpus["cover"] ?>" alt="cover">
                    <input type="file" name="cover" id="cover">
                </li>
                <?php if (isset($error)) : ?>
                    <p class="error">Gagal</p>
                <?php endif; ?>
                <li><button type="submit" name="submit">APLY</button></li>
            </ul>
        </form>
        <ul>
            <li><a href="index.php"><button type="button" class="btn-sub">Back</button></a></li>
        </ul>
    </div>
</body>

</html>