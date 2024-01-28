<div class="modal fade" id="alertmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<?= $this->session->flashdata('alert'); ?>
	</div>
</div>
<div class="row">
	<div class="col-lg-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<div class="d-flex justify-content-between">
					<h4 class="card-title">Riwayat Transaksi Penjualan Marketstore</h4>
					<div class="row">
						<button data-toggle="modal" data-target="#membermodal" class="btn btn-primary mr-2">Member +</button>
						<a href="<?= base_url('penjualan/add') ?>" class="btn btn-info">Non Member +</a>
					</div>
				</div>
				<div class="table-responsive">
					<table class="table table-striped">
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
							foreach($penjualan as $pj){
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
<div class="modal fade" id="membermodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Pilih Pelanggan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group mb-3">
					<select name="pelanggan" id="pelanggan" class="form-control">
						<?php foreach($pelanggan as $k){ ?>
							<option value="<?= $k->id_pelanggan ?>"><?= $k->nama ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
				<a href="" id="memberbtn" class="btn btn-primary m-2">Pilih</a>
			</div>
		</div>
	</div>
</div>