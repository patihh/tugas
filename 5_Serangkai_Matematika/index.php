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
				<form method="POST" action=""><button type="submit" name="redirect" value="tambahdata">Tambah Data Mahasiswa</button></form>
			</div>
			<div class="card-header">
            <form method="POST" action="">
                <button type="submit" name="redirect" value="5serangkai">Statistik 5 Serangkai</button>
                <button type="submit" name="redirect" value="pencilan">Pencilan (Atas dan Bawah)</button>
                <button type="submit" name="redirect" value="stddev">Standar Deviasi</button>
            </form>
            <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['redirect'])) {
                    switch ($_POST['redirect']) {
                        case '5serangkai':
                            header('Location: 5serangkai.php');
                            break;
                    }
                    switch ($_POST['redirect']) {
                        case 'pencilan':
                            header('Location: pencilan.php');
                            break;
                    }
                    switch ($_POST['redirect']) {
                        case 'stddev':
                            header('Location: standardeviasi.php');
                            break;
                    }
					switch ($_POST['redirect']) {
                        case 'tambahdata':
                            header('Location: tambahdata.php');
                            break;
                    }
                    exit();
                };
            ?>
		  <!-- /.card-header -->
			<div class="card-body">
				<table id="example" class="table table-striped" style="width:100%">
					<thead>
						<tr>
							<th>NIM</th>
							<th>Nama Mahasiswa</th>
							<th>Alamat</th>
							<th>Program Studi</th>
							<th>UKT</th>	
						</tr>
					</thead>
					<tbody>
                        <?php foreach($datamhs as $row)
                        { ?>
						<tr>
							<td><?php echo $row['nim']; ?></td>
							<td><?php echo $row['nama']; ?></td>
							<td><?php echo $row['alamat']; ?></td>
							<td><?php echo $row['prodi']; ?></td>
							<td><?php echo number_format($row['ukt']); ?></td>
						</tr>
                        <?php 
                        };?>
					</tbody>
					<tfoot>
						<tr>
                            <th>NIM</th>
							<th>Nama Mahasiswa</th>
							<th>Alamat</th>
							<th>Program Studi</th>
							<th>UKT</th>	
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</section>