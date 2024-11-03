<?php
require "../function.php";
$keyword = $_GET['keyword'];
$query = "SELECT * FROM db_buku WHERE judul LIKE '%$keyword%' OR halaman LIKE '%$keyword%' OR id LIKE '%$keyword%'";

$perpustakaan = query($query);
?>
<?php $no = 1; ?>
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