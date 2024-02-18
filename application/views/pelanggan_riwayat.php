<div class="modal fade" id="alertmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<?= $this->session->flashdata('alert'); ?>
	</div>
</div>
<div class="row">
	<div class="col-lg-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title mt-3">Informasi Pelanggan</h4>
			</div>
			<div class="card-body">
				<ul class="list-group list-group-flush">
					<li class="list-group-item">
						<div class="d-flex justify-content-between">
							<p>Nama</p>
							<p><?= $pelanggan->nama ?></p>
						</div>
					</li>
					<li class="list-group-item">
						<div class="d-flex justify-content-between">
							<p>Poin</p>
							<p><?= number_format($pelanggan->poin) ?></p>
						</div>
					</li>
					<li class="list-group-item">
						<div class="d-flex justify-content-between">
							<p>Teepon</p>
							<p><?= $pelanggan->telp ?></p>
						</div>
					</li>
					<li class="list-group-item">
						<div class="d-flex justify-content-between">
							<p>Alamat</p>
							<p><?= $pelanggan->alamat ?></p>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="col-lg-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Riwayat Transaksi Pelanggan</h4>
				<div class="table-responsive">
					<table class="table table-striped" id="tabel">
						<thead>
							<tr>
								<th>No</th>
								<th>Tanggal</th>
								<th>Kode Penjualan</th>
                                <th>Total Transaksi</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 1;
							foreach($transaksi as $pj){
							?>
							<tr>
								<td><?= $no++ ?></td>
								<td><?= $this->template->translate_bulan($pj->tanggal) ?></td>
								<td><?= $pj->kode_penjualan ?></td>
								<td><?= 'Rp '.number_format($pj->total_tagihan)  ?></td>
								<td>
									<a href="<?= base_url('penjualan/detail/').$pj->id_penjualan ?>" class="btn btn-primary">Detail</a>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>