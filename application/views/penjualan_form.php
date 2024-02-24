<div class="row">
	<div class="col-lg-3 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title mb-3">Tambahkan Barang</h4>
				<input type="search" class="typeahead mb-3" id="cari" placeholder="Nama Barang">
				<div class="form-group mb-3">
					<label class="card-title" for="Jumlah">Jumlah</label>
					<input type="number" class="form-control" id="Jumlah" placeholder="Jumlah">
				</div>
				<button class="btn btn-info form-control addBarang">Tambah +</button>
			</div>
		</div>
	</div>
	<div class="col-lg-9 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<form action="<?= base_url('penjualan/simpan') ?>" method="post">
					<div class="d-flex justify-content-between">
						<h4 class="card-title">Detail Transaksi</h4>
						<button type="submit" class="btn btn-primary">Bayar</button>
					</div>
					<div class="row">
						<div class="col-sm-6 col-12">
							<div class="form-group mb-3">
								<label for="Tanggal">Tanggal Transaksi</label>
								<input type="date" required value="<?= date('Y-m-d') ?>" name="tanggal" class="form-control" id="Tanggal">
							</div>
						</div>
						<div class="col-sm-6 col-12">
							<a data-toggle="modal" data-target="#vouchermodal" id="use_vch" class="mt-4 btn btn-info form-control">Pakai Voucher</a>
							<input type="hidden" name="id_voucher" id="id_vch">
							<input type="hidden" name="voucher" id="nomi_vch">
						</div>
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
									<th></th>
								</tr>
							</thead>
							<tbody>
							</tbody>
							<thead>
								<tr>
									<td class="font-weight-bold" colspan="4">Total Transaksi</td>
									<td class="font-weight-bold" id="total"></td>
								</tr>
								<tr>
									<td class="font-weight-bold" colspan="4">Diskon</td>
									<td class="font-weight-bold" id="diskon"></td>
								</tr>
								<tr>
									<td class="font-weight-bold" colspan="4">Total Bayar</td>
									<td class="font-weight-bold" id="total_bayar"></td>
								</tr>
							</thead>
						</table>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title mb-3">Daftar Barang</h4>
				<div class="table-responsive">
					<input type="search" class="form-control form-control-sm" placeholder="Cari..." id="carian">
					<table class="table table-striped" id="barang">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama barang</th>
								<th class="d-md-table-cell d-none">Kode barang</th>
								<th class="d-md-table-cell d-none">Stok</th>
								<th class="d-md-table-cell d-none">Harga</th>
								<th>Tambah</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 1;
							foreach($barang as $b){
							?>
							<tr>
								<td><?= $no++ ?></td>
								<td><?= $b->nama ?></td>
								<td class="d-md-table-cell d-none"><?= $b->kode_barang ?></td>
								<td class="d-md-table-cell d-none"><?= $b->stok ?></td>
								<td class="d-md-table-cell d-none"><?= 'Rp '.number_format($b->harga_jual) ?></td>
								<td>
									<button class="add_barang btn btn-small btn-info" data-nama="<?= $b->nama ?>">+</button>
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
<div class="modal fade" id="vouchermodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Masukkan Kode Voucher</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group mb-3">
					<input type="text" name="kode" id="kode_voucher" class="form-control">
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
				<button id="vchbtn" class="btn btn-primary m-2">Terapkan</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Jumlah Barang</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<input type="hidden" class="cari">
				<div class="form-group mb-3">
					<label class="card-title">Jumlah</label>
					<input type="number" name="shfgasdg" id="toJumlah" class="form-control">
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
				<button class="btn btn-info addBarang">Tambah +</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="alertmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="alert alert-dismissible fade show notifikasi" id="color" role="alert">
			<span class="alert-icon"><i class="fa fa-exclamation"></i></span>
			<span class="alert-text" id="pesan"></span>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div>
	</div>
</div>
