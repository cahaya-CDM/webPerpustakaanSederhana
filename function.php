<?php
// session_start();

// if(!isset($_SESSION["login"])){
//     header('location: login.php');

//     exit;
// }


$conn = mysqli_connect("Localhost", "root", "", "perpustakaan");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);

    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data)
{
    global $conn;
    $judul = htmlspecialchars($data["judul"]);
    $halaman = htmlspecialchars($data["halaman"]);

    // upload cover
    $cover = upload();
    if (!$cover) {
        return false;
    }

    $query = "INSERT INTO db_buku VALUES ('', '$judul', '$halaman', '$cover')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload()
{
    $namaFile = $_FILES['cover']['name'];
    $ukuranFile = $_FILES['cover']['size'];
    $error = $_FILES['cover']['error'];
    $tmpName = $_FILES['cover']['tmp_name'];

    // cek apakah gambar tidak ada yang di apload
    if ($error === 4) {
        echo "
            <script>
                alert('pilih gambar terlebih dahulu');
            </script>
        ";
        return false;
    }

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "
        <script>
            alert('yang anda apload bukan gambar!');
        </script>
    ";
        return false;
    }

    if ($ukuranFile > 1000000) {
        echo "
        <script>
            alert('Ukuran gambar terlalu besar!!');
        </script>
    ";
        return false;
    }
    // lolos pengecekan
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}

function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM db_buku WHERE id = $id");

    return mysqli_affected_rows($conn);
}

function ubah($data)
{
    global $conn;
    $id = $data["id"];
    $judul = htmlspecialchars($data["judul"]);
    $halaman = htmlspecialchars($data["halaman"]);
    $gambarLama = htmlspecialchars($data["coverLama"]);

    if ($_FILES['cover']['error'] === 4) {
        $cover = $gambarLama;
    } else {
        $cover = upload();
    }


    $query = "UPDATE db_buku SET judul = '$judul', halaman = '$halaman', cover = '$cover' WHERE id = $id";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function cari($keyword)
{
    $query = "SELECT * FROM db_buku WHERE judul LIKE '%$keyword%' OR halaman LIKE '%$keyword%' OR id LIKE '%$keyword%'";

    return query($query);
}

function registrasi($data)
{
    global $conn;

    $gmail = strtolower(stripcslashes($data["gmail"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);


    // pengecekan username 
    $result = mysqli_query($conn, "SELECT gmail FROM user WHERE gmail = '$gmail'");


    if (mysqli_fetch_assoc($result)) {

        return -1;
    }

    if ($password !== $password2) {
        // echo "
        // <script>
        //     alert('konfirmasi Password tidak sesuai')
        // </script>
        // ";

        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // menambahkan userbaru
    mysqli_query($conn, "INSERT INTO user VALUES('', '$gmail', '$password')");#

    return mysqli_affected_rows($conn);
}
