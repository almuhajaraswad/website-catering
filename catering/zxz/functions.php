<?php 
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "catering");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    };
    return $rows;
};

function upload_foto() {
    $namaFile = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpName = $_FILES['foto']['tmp_name'];


    $ekstensifoto = explode('.', $namaFile);
    $ekstensifoto = strtolower(end($ekstensifoto));

    // generate nama foto baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensifoto;
    move_uploaded_file($tmpName, '../foto/' . $namaFileBaru);

    return $namaFileBaru;
}

function upload_foto2() {
    $namaFile = $_FILES['foto2']['name'];
    $ukuranFile = $_FILES['foto2']['size'];
    $error = $_FILES['foto2']['error'];
    $tmpName = $_FILES['foto2']['tmp_name'];


    $ekstensifoto = explode('.', $namaFile);
    $ekstensifoto = strtolower(end($ekstensifoto));

    // generate nama foto baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensifoto;
    move_uploaded_file($tmpName, '../foto/' . $namaFileBaru);

    return $namaFileBaru;
}

function upload_foto3() {
    $namaFile = $_FILES['foto3']['name'];
    $ukuranFile = $_FILES['foto3']['size'];
    $error = $_FILES['foto3']['error'];
    $tmpName = $_FILES['foto3']['tmp_name'];


    $ekstensifoto = explode('.', $namaFile);
    $ekstensifoto = strtolower(end($ekstensifoto));

    // generate nama foto baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensifoto;
    move_uploaded_file($tmpName, '../foto/' . $namaFileBaru);

    return $namaFileBaru;
}
