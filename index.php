<?php
session_start();

if (!isset($_SESSION["login"])) {
    header('location: login.php');

    exit;
}


require 'function.php';
// $id = $_GET['id'];

$perHalaman = 5;
$jumlahData = count(query("SELECT * FROM db_buku"));
$jumlahHalaman = ceil($jumlahData / $perHalaman);
$halamanAktif = (isset($_GET['halaman'])) ? $_GET['halaman'] : 1;
$awalData = ($perHalaman * $halamanAktif) - $perHalaman;



$perpustakaan = query("SELECT * FROM db_buku LIMIT $awalData, $perHalaman");

// Kondisi Search

if (isset($_POST["cari"])) {
    $perpustakaan = cari($_POST["keyword"]);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/main.css">
    <script src="https://kit.fontawesome.com/65e267e018.js" crossorigin="anonymous"></script>
</head>

<body>


    <nav>
        <div class="judul">
            <h1>Halaman Utama</h1>
        </div>
        <ul>
            <li>
                <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                    <a href="?halaman=<?= $i ?>"><?= $i ?></a>
                <?php endfor ?>
            </li>
            <li>
                <button class="btn-log" type="button"><a href="logout.php">LOG OUT</a></button>
            </li>
            <li>
                <form action="tambah.php">
                    <button type="submit" name="submit">ADD</button>
                </form>
            </li>
            <li>
                <form action="" method="post" class="cari">
                    <input type="text" size="40" name="keyword" autocomplete="off" autofocus id="keyword">
                    <button type="submit" name="cari" id="cari"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </li>
        </ul>
    </nav>

    <?php $no = 1 ?>

    <div id="container">
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>judul</th>
                <th>halaman</th>
                <th>cover</th>
                <th>Perintah</th>
            </tr>
            <?php foreach ($perpustakaan as $buku) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $buku["id"] ?></td>
                    <td><?= $buku["judul"] ?></td>
                    <td><?= $buku["halaman"] ?></td>
                    <td><img src="img/<?= $buku["cover"] ?>" alt="cover"></td>
                    <td>
                        <a href="ubah.php?id=<?= $buku["id"] ?>"><button>ubah</button></a>
                        <a href="hapus.php?id=<?= $buku["id"] ?>"><button>hapus</button></a>
                    </td>
                </tr>
                <!-- <?php $i++ ?> -->
            <?php endforeach; ?>
        </table>
    </div>

    <script src="js/script.js"></script>
</body>

</html>