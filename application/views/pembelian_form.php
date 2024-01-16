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
							<?php $no=1; foreach($barang as $b){ ?>
							<tr>
								<td><label for="inp<?= $no ?>"><?= $b->nama ?></label></td>
								<td>
                                    <input type="checkbox" id="inp<?= $no++ ?>" value="<?= $b->kode_barang ?>" class="form-control add">
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
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">Detail Transaksi</h4>
                    <button type="submit" class="btn btn-info">Beli</button>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group mb-3">
                            <label for="Supplier">Supplier Barang</label>
                            <input type="text" name="nama" class="form-control" placeholder="Supplier barang" id="Supplier">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group mb-3">
                            <label for="Tanggal">Tanggal Transaksi</label>
                            <input type="date" name="nama" class="form-control" id="Tanggal">
                        </div>
                    </div>
                </div>
                
				<div class="table-responsive">
					<table class="table table-hover table-striped">
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
							<tr>
								<td>Jacob</td>
								<td>Photoshop</td>
								<td class="text-success"> 28.76% <i class="mdi mdi-arrow-up"></i></td>
								<td><label class="badge badge-danger">Pending</label></td>
                                <td><label class="badge badge-warning">In progress</label></td>
							</tr>
                            <tr>
                                <th colspan="4">Total Transaksi</th>
                                <th>Rp Angka</th>
                            </tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
