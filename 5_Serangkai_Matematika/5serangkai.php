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

    $minimum = min($ukt_data);
    $maksimum = max($ukt_data);
    $Q1 = get_quartile($ukt_data, 0.25);
    $median = get_quartile($ukt_data, 0.5); 
    $Q3 = get_quartile($ukt_data, 0.75);
?>
<section class="content">
	<div class="container-fluid">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Statistik 5 Serangkai</h3>
			</div>
			<div class="card-header">
            <form method="POST" action="">
                <button type="submit" name="redirect" value="index">Data Semua Mahasiswa</button>
                <button type="submit" name="redirect" value="pencilan">Pencilan (Atas dan Bawah)</button>
                <button type="submit" name="redirect" value="stddev">Standar Deviasi</button>
            </form>
            <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['redirect'])) {
                    switch ($_POST['redirect']) {
                        case 'index':
                            header('Location: index.php');
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
                    exit();
                };
            ?>
		  <!-- /.card-header -->
			<div class="card-body">
				<table id="example" class="table table-striped" style="width:100%">
					<thead>
						<tr>
							<th>UKT Minimum</th>
							<th>Kuartal 1 UKT</th>
							<th>Median UKT</th>
							<th>Kuartal 3 UKT</th>
							<th>UKT Maksimum</th>	
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo number_format($minimum); ?></td>
							<td><?php echo number_format($Q1); ?></td>
							<td><?php echo number_format($median); ?></td>
							<td><?php echo number_format($Q3); ?></td>
							<td><?php echo number_format($maksimum); ?></td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
                            <th>UKT Minimum</th>
							<th>Kuartal 1 UKT</th>
							<th>Median UKT</th>
							<th>Kuartal 3 UKT</th>
							<th>UKT Maksimum</th>	
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</section>