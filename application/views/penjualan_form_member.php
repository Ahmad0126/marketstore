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
                                    <button class="add_barang btn btn-small btn-info" data-nama="<?= $b->nama ?>" data-harga="<?= $b->harga_beli ?>" data-kode="<?= $b->kode_barang ?>">+</button>
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
                            <input type="hidden" required name="id_pelanggan" class="form-control" value="<?= $pelanggan->id_pelanggan ?>">
                        </div>
                    </div>
					<div class="col-6">
						<div class="form-group mb-3">
							<p>Pelanggan punya <?= number_format($pelanggan->poin) ?> poin</p>
							<div class="row">
								<label for="poin" class="col-sm-4 col-form-label">Gunakan Poin</label>
								<div class="col-sm-8">
									<input type="number" max="<?= $pelanggan->poin ?>" name="poin" class="form-control" placeholder="Berapa poin?" id="poin">
								</div>
							</div>
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
