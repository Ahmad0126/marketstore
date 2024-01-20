<div class="modal fade" id="alertmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<?= $this->session->flashdata('alert'); ?>
	</div>
</div>
<div class="row">
	<div class="col-lg-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Detail Transaksi <?= $pembelian['kode_pembelian'] ?></h4>
                <div class="table-responsive">
					<table id="detail" class="table table-hover table-striped">
						<thead>
							<tr>
								<th colspan="2">Supplier Barang</th>
								<th colspan="2">Tanggal Transaksi</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td colspan="2"><?= $pembelian['nama'].' ('.$pembelian['kode_supplier'].')' ?></td>
								<td colspan="2"><?= $this->template->translate_bulan($pembelian['tanggal']) ?></td>
							</tr>
						</tbody>
					</table>
                </div>
				<div class="table-responsive">
					<table id="detail" class="table table-hover table-striped">
						<thead>
							<tr>
								<th>Barang</th>
								<th>Kode</th>
								<th>Harga Satuan</th>
								<th>Jumlah</th>
								<th>Harga Total</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($detail as $b){ ?>
							<tr>
								<td><?= $b->nama ?></td>
								<td><?= $b->kode_barang ?></td>
								<td>Rp <?= number_format($b->harga_beli) ?></td>
								<td><?= $b->jumlah ?></td>
								<td>Rp <?= number_format($b->harga_beli * $b->jumlah) ?></td>
							</tr>
							<?php } ?>
						</tbody>
						<thead>
							<tr>
								<th colspan="4">Total Transaksi</th>
								<th id="total">Rp <?= number_format($pembelian['total_tagihan']) ?></th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>