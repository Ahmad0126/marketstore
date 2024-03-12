<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Nota <?= $penjualan['kode_penjualan'] ?></title>
	<?php require_once 'layout/_css.php'; ?>
</head>

<body>
	
	<div style="width: 325px;">
		<h1 class="text-center mb-3">Toko</h1>
		<div class="row">
			<?php if($pelanggan != null){ ?>
			<div class="col-6">
				<p>Pelanggan: <?= $pelanggan->nama ?></p>
			</div>
			<div class="col-6">
				<p style="text-align: right;"><?= $pelanggan->telp ?></p>
			</div>
			<div class="col-12">
				<p style="text-align: center;"><?= $pelanggan->alamat ?></p>
			</div>
			<?php } ?>
			<div class="col-6">
				<p>No: <?= $penjualan['kode_penjualan'] ?></p>
			</div>
			<div class="col-6">
				<p style="text-align: right;"><?= $this->template->translate_bulan($penjualan['tanggal']) ?></p>
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
				<p><?= $b->harga_jual ?></p>
			</div>
			<div class="col-2">
				<p class="text-center">x<?= $b->jumlah ?></p>
			</div>
			<div class="col-1">
				<p class="text-center">=</p>
			</div>
			<div class="col-5">
				<p style="text-align: right;"><?= $b->harga_jual * $b->jumlah ?></p>
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
				<p style="text-align: right;"><?= $penjualan['total_tagihan'] ?></p>
			</div>
		</div>
		<?php if($penjualan['diskon'] != 0 && $penjualan['diskon'] != null){ ?>
		<div class="row">
			<div class="col-5">
				<p>Diskon</p>
			</div>
			<div class="col-1">
				<p>=</p>
			</div>
			<div class="col-6">
				<p style="text-align: right;"><?= $penjualan['diskon'] ?></p>
			</div>
		</div>
		<div class="row">
			<div class="col-5">
				<p>Bayar</p>
			</div>
			<div class="col-1">
				<p>=</p>
			</div>
			<div class="col-6">
				<p style="text-align: right;"><?= $penjualan['total_tagihan'] - $penjualan['diskon'] ?></p>
			</div>
		</div>
		<?php } ?>
	</div>
	<script>
		window.print();
	</script>
	
</body>

</html>

