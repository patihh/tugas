<?php
    include 'style.php';
    include 'koneksi.php';
    include 'model.php';

    $query = "SELECT ukt FROM datamhs ORDER BY ukt ASC";
    $result = $conn->query($query);

    $ukt_data = [];
    while ($row = $result->fetch_assoc()) {
        $ukt_data[] = $row['ukt'];
    }

	$stddevsampel = standarDeviasiSampel($ukt_data);
	$stddevpopulasi = standarDeviasiPopulasi($ukt_data);
?>
<section class="content">
	<div class="container-fluid">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Standar Deviasi</h3>
			</div>
			<div class="card-header">
            <form method="POST" action="">
                <button type="submit" name="redirect" value="index">Data Semua Mahasiswa</button>
                <button type="submit" name="redirect" value="5serangkai">Statistik 5 Serangkai</button>
                <button type="submit" name="redirect" value="pencilan">Pencilan (Atas dan Bawah)</button>
            </form>
            <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['redirect'])) {
                    switch ($_POST['redirect']) {
                        case 'index':
                            header('Location: 5serangkai.php');
                            break;
                    }
                    switch ($_POST['redirect']) {
                        case '5serangkai':
                            header('Location: index.php');
                            break;
                    }
                    switch ($_POST['redirect']) {
                        case 'pencilan':
                            header('Location: pencilan.php');
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
							<th>Standar Deviasi Populasi</th>
							<th>Standar Deviasi Sampel</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo $stddevpopulasi; ?></td>
							<td><?php echo $stddevsampel; ?></td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<th>Standar Deviasi Populasi</th>
							<th>Standar Deviasi Sampel</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</section>