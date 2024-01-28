<div class="row">
	<div class="col-lg-3 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Tambahkan Barang</h4>
				<div class="table-responsive">
                    <input type="search" class="form-control form-control-sm" placeholder="Cari..." id="carian">
					<table class="table" id="barang">
						<thead>
							<tr>
								<th>Barang</th>
								<th>Tambah</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($barang as $b){ ?>
							<tr>
								<td><?= $b->nama ?><span class="invisible"><?= $b->kode_barang ?></span></td>
								<td>
                                    <button class="add_barang btn btn-small btn-info" data-nama="<?= $b->nama ?>" data-stok="<?= $b->stok ?>" data-harga="<?= $b->harga_jual ?>" data-kode="<?= $b->kode_barang ?>">+</button>
                                </td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-9 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<form action="<?= base_url('penjualan/simpan') ?>" method="post">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">Detail Transaksi</h4>
                    <button type="submit" class="btn btn-info">Simpan</button>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group mb-3">
                            <label for="Tanggal">Tanggal Transaksi</label>
                            <input type="date" required name="tanggal" class="form-control" id="Tanggal">
                        </div>
                    </div>
                    <div class="col-6 ">
						<div class="form-group mb-3">
							<input type="hidden" name="id_voucher" id="id_vch">
							<input type="hidden" name="voucher" id="nomi_vch">
							<a data-toggle="modal" data-target="#vouchermodal" id="use_vch" class="mt-4 btn btn-info form-control">Pakai Voucher</a>
						</div>
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
							</tr>
						</thead>
						<tbody>
						</tbody>
						<thead>
							<tr>
								<th colspan="4">Total Transaksi</th>
								<th id="total"></th>
							</tr>
							<tr>
								<th colspan="4">Diskon</th>
								<th id="diskon"></th>
							</tr>
							<tr>
								<th colspan="4">Total Bayar</th>
								<th id="total_bayar"></th>
							</tr>
						</thead>
					</table>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="vouchermodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
<div class="modal fade" id="alertmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
