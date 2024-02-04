<div class="row">
	<div class="col-sm-12 mb-4 mb-xl-0">
		<h4 class="font-weight-bold text-dark">Hi, welcome back!</h4>
		<p class="font-weight-normal mb-2 text-muted">APRIL 1, 2019</p>
	</div>
</div>
<div class="row">
	<div class="col-md-6 col-xl-3 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Penjualan Hari Ini</h4>
				<h4 class="text-dark font-weight-bold mb-2">
					Rp <?= $pj_hari == null ? '0' : number_format($pj_hari) ?>
				</h4>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-xl-3 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Pembelian Hari Ini</h4>
				<h4 class="text-dark font-weight-bold mb-2">
					Rp <?= $pb_hari == null ? '0' : number_format($pb_hari) ?>
				</h4>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-xl-3 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Penjualan Bulan Ini</h4>
				<h4 class="text-dark font-weight-bold mb-2">
					Rp <?= $pj_bulan == null ? '0' : number_format($pj_bulan) ?>
				</h4>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-xl-3 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Pembelian Bulan Ini</h4>
				<h4 class="text-dark font-weight-bold mb-2">
					Rp <?= $pb_bulan == null ? '0' : number_format($pb_bulan) ?>
				</h4>
			</div>
		</div>
	</div>
</div>
<div class="row mt-3">
	<div class="col-xl-3 flex-column d-flex grid-margin stretch-card">
		<div class="row flex-grow">
			<div class="col-sm-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Jumlah Pelanggan</h4>
						<h4 class="text-dark font-weight-bold mb-2"><?= $pelanggan == null ? '0' : number_format($pelanggan) ?></h4>
					</div>
				</div>
			</div>
			<div class="col-sm-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Jumlah Barang</h4>
						<h4 class="text-dark font-weight-bold mb-2"><?= $barang == null ? '0' : number_format($barang) ?></h4>
					</div>
				</div>
			</div>
			<div class="col-sm-12 stretch-card">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Jumlah Supplier</h4>
						<h4 class="text-dark font-weight-bold mb-2"><?= $supplier == null ? '0' : number_format($supplier) ?></h4>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-9 d-flex grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Transaksi Marketstore Tahun <?= date('Y') ?></h4>
				<div class="row">
					<div class="col-lg-5">
						<p>Total penghasilan transaksi tiap bulan. Total penghasilan sampai saat ini ada di samping:</p>
					</div>
					<div class="col-lg-7">
						<div class="chart-legends d-lg-block d-none" id="chart-legends"></div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<canvas id="web-transaksi-metrics-satacked" class="mt-3"></canvas>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xl-4 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<div class="d-flex justify-content-between mb-3">
					<h4 class="card-title">Jumlah Transaksi</h4>
					<div class="dropdown">
						<button class="btn btn-sm dropdown-toggle text-dark pt-0 pr-0" type="button"
							id="dropdownMenuSizeButton3" data-toggle="dropdown" aria-haspopup="true"
							aria-expanded="false">
							This week
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton3">
							<h6 class="dropdown-header">This week</h6>
							<h6 class="dropdown-header">This month</h6>
						</div>
					</div>
				</div>
				<div id="jumlah-transaksi-chart-legends" class="chart-legends mt-1">
				</div>
				<div class="row mt-2 mb-2">
					<div class="col-6">
						<div class="text-small"><span class="text-success">18.2%</span> higher
						</div>
					</div>
					<div class="col-6">
						<div class="text-small"><span class="text-danger">0.7%</span> higher </div>
					</div>
				</div>
				<div class="marketTrends mt-4">
					<canvas id="web-transaksi-jumlah-satacked"></canvas>
				</div>

			</div>
		</div>
	</div>
	<div class="col-xl-4 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Barang Terlaris</h4>
				<div class="row">
					<div class="col-sm-12">
						<div class="d-flex justify-content-between mt-2 text-dark mb-2">
							<div><span class="font-weight-bold"><?= $terjual == null ? '0' : number_format($terjual) ?></span> Terjual</div>
							<div>Stok: <?= $terbeli == null ? '0' : number_format($terbeli) ?></div>
						</div>
						<div class="progress progress-md grouped mb-2">
							<?php
							$color = ['bg-danger', 'bg-info', 'bg-primary', 'bg-warning', 'bg-success'];
							$all = $terbeli;
							$b_lain = 0;
							$no = 0;
							foreach($barang_terlaris as $b){
								$pres = $b['jumlah'] * 100 / $terbeli;
								$all -= intval($b['jumlah']);
								if($no < 5){
							?>
							<div class="progress-bar <?= $color[$no++] ?>" style="width: <?= round($pres) ?>%"></div>
							<?php 
								}else if($no >= 5){
									$b_lain -= $b['jumlah'];
								}
							}
							$sisa = $all * 100 / $terbeli;
							$b_lain_p = $b_lain * 100 / $terbeli;
							?>
							<div class="progress-bar bg-dark" style="width: <?= round($b_lain_p) ?>%"></div>
							<div class="progress-bar bg-light" style="width: <?= round($sisa) ?>%"></div>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="traffic-source-legend">
							<div class="d-flex justify-content-between mb-1 mt-2">
								<div class="font-weight-bold">SOURCE</div>
								<div class="font-weight-bold">TOTAL</div>
							</div>
							<?php
							$color = ['bg-danger', 'bg-info', 'bg-primary', 'bg-warning', 'bg-success'];
							$all = $terbeli;
							$b_lain = 0;
							$no = 0;
							foreach($barang_terlaris as $b){
								$pres = $b['jumlah'] * 100 / $terbeli;
								$all -= intval($b['jumlah']);
								if($no < 5){
							?>
							<div class="d-flex justify-content-between legend-label">
								<div><span class="<?= $color[$no++] ?>"></span><?= $b['nama'] ?></div>
								<div><?= round($pres) ?>%</div>
							</div>
							<?php 
								}else if($no >= 5){
									$b_lain -= $b['jumlah'];
								}
							}
							$sisa = $all * 100 / $terbeli;
							$b_lain_p = $b_lain * 100 / $terbeli;
							?>
							<div class="d-flex justify-content-between legend-label">
								<div><span class="bg-dark"></span>Barang lain</div>
								<div><?= round($b_lain_p) ?>%</div>
							</div>
							<div class="d-flex justify-content-between legend-label">
								<div><span class="bg-light"></span>Belum Terjual</div>
								<div><?= round($sisa) ?>%</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-4 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<div class="d-flex justify-content-between mb-1">
					<h4 class="card-title">Transaksi Hari ini</h4>
					<div class="dropdown">
						<button class="btn btn-sm dropdown-toggle text-dark pt-0 pr-0" type="button"
							id="activeDropdownTransaksi" data-toggle="dropdown" aria-haspopup="true"
							aria-expanded="false">
							Penjualan
						</button>
						<div class="dropdown-menu" aria-labelledby="activeDropdownTransaksi">
							<a type="button" data-kategori="penjualan" data-active="Penjualan" class="kategoriMenu text-decoration-none">
								<h6 class="dropdown-header">Penjualan</h6>
							</a>
							<a type="button" data-kategori="pembelian" data-active="Pembelian" class="kategoriMenu text-decoration-none">
								<h6 class="dropdown-header">Pembelian</h6>
							</a>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-sm-12">
						<div id="daftar" class="text-dark">
							<?php foreach($pj_recent as $pj){ ?>
							<div class="d-flex pb-3 border-bottom justify-content-between mt-3">
								<div class="mr-2"><i class="mdi mdi-signal-cellular-outline icon-md"></i></div>
								<div class="font-weight-bold mr-sm-2">
									<div>Transaksi penjualan sebesar</div>
									<div class="text-muted font-weight-normal mt-1"><?= $pj->id_pelanggan == null ? 'Non member' : 'Member' ?></div>
								</div>
								<div>
									<a href="<?= base_url('penjualan/detail/').$pj->id_penjualan ?>">
										<h6 class="font-weight-bold text-info ml-sm-2">Rp <?= number_format($pj->total_tagihan)?></h6>
									</a>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>