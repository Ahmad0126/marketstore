<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Nota <?= $pembelian['kode_pembelian'] ?></title>
	<?php require_once 'layout/_css.php'; ?>
</head>

<body>
	
	<div style="width: 325px;">
		<h1 class="text-center mb-3">Toko</h1>
		<div class="row">
			<div class="col-8">
				<p>Supplier: <?= $pembelian['nama'] ?></p>
			</div>
			<div class="col-4">
				<p style="text-align: right;"><?= $pembelian['telp'] ?></p>
			</div>
			<div class="col-6">
				<p>No: <?= $pembelian['kode_pembelian'] ?></p>
			</div>
			<div class="col-6">
				<p style="text-align: right;"><?= $this->template->translate_bulan($pembelian['tanggal']) ?></p>
			</div>
		</div>
		<hr>
		<hr>
		<?php foreach($detail as $b){ ?>
		<div class="row">
			<div class="col">
				<p><?= $b->nama ?></p>
			</div>
		</div>
		<div class="row">
			<div class="col-4">
				<p><?= $b->harga_beli ?></p>
			</div>
			<div class="col-2">
				<p class="text-center">x<?= $b->jumlah ?></p>
			</div>
			<div class="col-1">
				<p class="text-center">=</p>
			</div>
			<div class="col-5">
				<p style="text-align: right;"><?= $b->harga_beli * $b->jumlah ?></p>
			</div>
		</div>
		<?php } ?>
		<hr>
		<hr>
		<div class="row">
			<div class="col-5">
				<p>Total</p>
			</div>
			<div class="col-1">
				<p>=</p>
			</div>
			<div class="col-6">
				<p style="text-align: right;"><?= $pembelian['total_tagihan'] ?></p>
			</div>
		</div>
	</div>
	<script>
		window.print();
	</script>
	
</body>

</html>

