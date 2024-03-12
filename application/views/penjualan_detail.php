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
					<h4 class="card-title">Detail Transaksi <?= $penjualan['kode_penjualan'] ?></h4>
					<a href="<?= base_url('penjualan/cetak/'.$penjualan['id_penjualan']) ?>" class="btn btn-primary">Cetak</a>
				</div>
                <div class="table-responsive">
					<table id="detail" class="table table-hover table-striped">
						<thead>
							<tr>
								<th colspan="2">Tanggal Transaksi</th>
								<?php if($pelanggan != null){ ?>
								<th>Nama Pelanggan</th>
								<th>Alamat</th>
								<th>Contact</th>
								<?php } ?>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td colspan="2"><?= $this->template->translate_bulan($penjualan['tanggal']) ?></td>
								<?php if($pelanggan != null){ ?>
								<td><?= $pelanggan->nama ?></td>
								<td><?= $pelanggan->alamat ?></td>
								<td><?= $pelanggan->telp ?></td>
								<?php } ?>
							</tr>
						</tbody>
					</table>
                </div>
				<div class="table-responsive mt-4">
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
								<td>Rp <?= number_format($b->harga_jual) ?></td>
								<td><?= $b->jumlah ?></td>
								<td>Rp <?= number_format($b->harga_jual * $b->jumlah) ?></td>
							</tr>
							<?php } ?>
						</tbody>
						<thead>
							<tr>
								<th colspan="4">Total Transaksi</th>
								<th id="total">Rp <?= number_format($penjualan['total_tagihan']) ?></th>
							</tr>
							<?php if($penjualan['diskon'] != 0 && $penjualan['diskon'] != null){ ?>
							<tr>
								<th colspan="4">Diskon</th>
								<th id="total">Rp <?= number_format($penjualan['diskon']) ?></th>
							</tr>
							<tr>
								<th colspan="4">Total Bayar</th>
								<th id="total">Rp <?= number_format($penjualan['total_tagihan'] - $penjualan['diskon']) ?></th>
							</tr>
							<?php } ?>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>