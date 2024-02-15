<div class="row">
	<div class="col-lg-3 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title mb-3">Tambahkan Barang</h4>
				<input type="search" class="typeahead mb-3" placeholder="Nama Barang" id="cari">
				<div class="form-group mb-3">
					<label class="card-title" for="Jumlah">Jumlah</label>
					<input type="number" class="form-control" placeholder="Jumlah" id="Jumlah">
				</div>
				<button class="btn btn-info form-control" id="add_barang" data-beli="true">Tambah +</button>
			</div>
		</div>
	</div>
	<div class="col-lg-9 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<form action="<?= base_url('pembelian/simpan') ?>" method="post">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">Detail Transaksi</h4>
                    <button type="submit" class="btn btn-info">Beli</button>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group mb-3">
                            <label for="Supplier">Supplier Barang</label>
							<select name="kode_supplier" id="Supplier" class="form-control">
								<?php foreach($suppliers as $s){ ?>
								<option value="<?= $s->kode_supplier ?>"><?= $s->nama ?></option>
								<?php } ?>
							</select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group mb-3">
                            <label for="Tanggal">Tanggal Transaksi</label>
                            <input type="date" required name="tanggal" class="form-control" id="Tanggal">
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
								<th></th>
							</tr>
						</thead>
						<tbody>
						</tbody>
						<thead>
							<tr>
								<th colspan="4">Total Transaksi</th>
								<th id="total"></th>
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
								<td class="d-md-table-cell d-none"><?= 'Rp '.number_format($b->harga_beli) ?></td>
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
