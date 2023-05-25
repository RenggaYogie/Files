<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data Buku</title>
</head>
<body>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["kode_buku"])) {
            // Mendapatkan kode buku dari parameter URL
            $kode_buku = trim($_GET["kode_buku"]);

            // Memeriksa apakah kode buku ada dalam file buku.txt
            $file_name = "buku.txt";
            $read = file($file_name);
            $found = false;
            $selected_buku = [];

            foreach ($read as $buku) {
                $data_buku = explode("-", $buku);

                if ($data_buku[0] == $kode_buku) {
                    $found = true;
                    $selected_buku = $data_buku;
                    break;
                }
            }

            if ($found) {
                // Form edit buku
                // Ambil nilai kode_buku dari URL jika tersedia
                $kode_buku = $_GET['kode_buku'] ?? '';?>
                    <h3>Update Data Buku</h3>
                    <form action="Edit.php" method="post" enctype="multipart/form-data">
                        <table>
                            <tr>
                                <td>Kode buku</td>
                                <td><input type="text" name="kode_buku" value="<?php echo "$kode_buku";?>"></td>
                            </tr>
                            <tr>
                                <td>Judul buku</td>
                                <td><input type="text" name="judul" value="<?php echo "$selected_buku[1]";?>" required><br></td>
                            </tr>
                            <tr>
                                <td>Pengarang</td>
                                <td><input type="text" name="pengarang" value="<?php echo "$selected_buku[2]";?>" required><br></td>
                            </tr>
                            <tr>
                                <td>Penerbit</td>
                                <td><input type="text" name="penerbit" value="<?php echo "$selected_buku[3]";?>" required><br></td>
                            </tr>
                            <tr>
                                <td>Tahun Terbit</td>
                                <td><input type="text" name="tahun_terbit" value="<?php echo isset($selected_buku[4]) ? $selected_buku[4] : ''; ?>" required><br></td>
                            </tr>
                            <tr>
                                <td>Jumlah Halaman</td>
                                <td><input type="text" name="jmlh_halaman" value="<?php echo isset($selected_buku[5]) ? $selected_buku[5] : ''; ?>" required><br></td>
                            </tr>
                            <tr>
                                <td>Kategori</td>
                                <td><input type="text" name="kategori" value="<?php echo isset($selected_buku[6]) ? $selected_buku[6] : ''; ?>" required><br></td>
                            </tr>
                            <tr>
                                <td>Cover</td>
                                <td><input type="file" name="file" accept="image/*"><br></td>
                            </tr>
                            <?php
                                echo "<tr><td><input type='submit' name='update' value='Perbarui'></td></td></tr>";
                            ?>
                        </table>
                    </form>
            <?php
            } else {
                echo "Buku tidak ditemukan";
            }
        } else {
            echo "Permintaan tidak valid";
        }
    ?>
</body>
</html>