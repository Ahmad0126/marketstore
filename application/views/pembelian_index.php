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
					<h4 class="card-title">Riwayat Transaksi Pembelian Marketstore</h4>
					<a href="<?= base_url('pembelian/add') ?>" class="btn btn-info">Beli +</a>
				</div>
				<div class="table-responsive">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>No</th>
								<th>Tanggal</th>
								<th>Kode Pembelian</th>
                                <th>Supplier barang</th>
                                <th>Total Transaksi</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 1;
							foreach($pembelian as $pb){
							?>
							<tr>
								<td><?= $no++ ?></td>
								<td><?= $this->template->translate_bulan($pb->tanggal) ?></td>
								<td><?= $pb->kode_pembelian ?></td>
								<td><?= $pb->nama ?></td>
								<td><?= 'Rp '.number_format($pb->total_tagihan)  ?></td>
								<td>
									<a href="<?= base_url('pembelian/detail/').$pb->id_pembelian ?>" class="btn btn-primary">Detail</a>
									<a href="<?= base_url('pembelian/delete/').$pb->kode_pembelian ?>" onclick="return confirm('Yakin ingin menghapus pembelian ini?')" class="btn btn-danger">Hapus</a>
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