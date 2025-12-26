<?php
    include 'style.php';
    include 'koneksi.php';

    $datamhs = mysqli_query($conn, "SELECT * FROM datamhs");
?>
<section class="content">
	<div class="container-fluid">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Data Mahasiswa</h3>
			</div>
			<div class="card-header">
            <form method="POST" action="">
                <button type="submit" name="redirect" value="index">Kembali ke Halaman Utama</button>
            </form>
            <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['redirect'])) {
                    switch ($_POST['redirect']) {
                        case 'index':
                            header('Location: index.php');
                            break;
                    }
                };
            ?>
        <body>
            <div class="card" justify-content="center">
                <h1 class="welcome">Tambah Data Mahasiswa</h1>
                <form method="post" action="process.php">
                    <label for="form">NIM:</label>
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" name="nim" required>
                        </br>
                        </br>
                    </div>
                    <label for="form">Nama Mahasiswa:</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="nama" required>
                        </br>
                        </br>
                    </div>
                    <label for="form">Alamat:</label>
                    <div class="input-group mb-3">
                        <textarea rows="3" class="form-control" name="alamat" required></textarea>
                        </br>
                        </br>
                    </div>
                    <label for="form">Program Studi:</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="prodi" required>
                        </br>
                        </br>
                    </div>
                    <label for="form">UKT (Uang Kuliah Tunggal):</label>
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" name="ukt" required>
                        </br>
                        </br>
                    </div>
                    <div class="input-group mb-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        </br>
                    </div>
                    <div class="input-group">
                    <input type="hidden" name="condition" value="tambah">
                </form>
            </div>
        </body>
</html>