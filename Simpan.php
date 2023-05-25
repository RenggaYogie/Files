<?php

if ($_POST) {
    //variable penampung
    $BUKU = $_POST['kode_buku'] . "-" .
    $_POST['judul'] . "-" .
    $_POST['pengarang'] . "-" .
    $_POST['penerbit'] . "-" .
    $_POST['tahun_terbit'] . "-" .
    $_POST['jmlh_halaman'] . "-" .
    $_POST['kategori'] . "-" .
    $_FILES['file']['name'] ."\n";
    
    $file_name = "buku.txt";
    //Memindahkan file yg diunggah ke lokasi yang diinginkan
    $target_dir = "upload/";
    $target_file = $target_dir . basename($_FILES['file']['name']);
    move_uploaded_file($_FILES['file']['tmp_name'], $target_file);
    
    //simpan ke file
    
    if (file_put_contents($file_name, $BUKU, FILE_APPEND) > 0) {
        echo "data berhasil disimpan";
    } else {
        echo "data gagal disimpan";
    }

    echo '<br><br><a href="Inputan.php">Kembali ke Form</a>';
    echo '<br><br><a href="Display.php">Lihat Data</a>';
}

?>