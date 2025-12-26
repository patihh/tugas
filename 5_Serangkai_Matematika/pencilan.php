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

	$Q1 = get_quartile($ukt_data, 0.25);
	$Q3 = get_quartile($ukt_data, 0.75);
	$IQR = $Q3 - $Q1;
	$BatasBawah = $Q1 - (1.5 * $IQR);
	$BatasAtas = $Q3 + (1.5 * $IQR);
	$DataBawah = mysqli_query($conn, "SELECT * FROM datamhs WHERE ukt < $BatasBawah");
	$DataAtas = mysqli_query($conn, "SELECT * FROM datamhs WHERE ukt > $BatasAtas");
	if (mysqli_num_rows($DataBawah) > 0) {
		$PencBawah = mysqli_fetch_assoc($DataBawah);
		$PenBawah = $PencBawah['ukt'];
	} else {
		$PenBawah = "Tidak ada";
	}
	if (mysqli_num_rows($DataAtas) > 0) {
		$PencAtas = mysqli_fetch_assoc($DataAtas);
		$PenAtas = $PencAtas['ukt'];
	} else {
		$PenAtas = "Tidak ada";
	}
?>
<section class="content">
	<div class="container-fluid">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Pencilan Atas dan Bawah</h3>
			</div>
			<div class="card-header">
            <form method="POST" action="">
                <button type="submit" name="redirect" value="index">Data Semua Mahasiswa</button>
                <button type="submit" name="redirect" value="5serangkai">Statistik 5 Serangkai</button>
                <button type="submit" name="redirect" value="stddev">Standar Deviasi</button>
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
                        case 'stddev':
                            header('Location: standardeviasi.php');
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
							<th>Pencilan Bawah</th>
							<th>Pencilan Atas</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo $PenBawah; ?></td>
							<td><?php echo $PenAtas; ?></td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<th>Pencilan Bawah</th>
							<th>Pencilan Atas</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</section>