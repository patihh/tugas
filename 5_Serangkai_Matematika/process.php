<?php
    include 'koneksi.php';

    if(isset($_POST['condition'])) {
        $condition = $_POST['condition'];

        switch ($condition) {
            case "tambah":
                $nim = $_POST['nim'];
                $nama = $_POST['nama'];
                $alamat = $_POST['alamat'];
                $prodi = $_POST['prodi'];
                $ukt = $_POST['ukt'];
                $table = "datamhs";
                $sql = "INSERT INTO $table (nim, nama, alamat, prodi, ukt) VALUES ('$nim', '$nama', '$alamat', '$prodi', '$ukt')";
                if (mysqli_query($conn, $sql)) {
                    echo '<script language="javascript">';
                    echo 'alert("Data berhasil ditambahkan.")';
                    echo '</script>';
                    header('Location: index.php');
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                    die;
                }
                break;
        }
    } else {
        header("location: tambahdata.php");
    }
?>