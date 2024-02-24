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
					<h4 class="card-title">Daftar Barang Marketstore</h4>
					<button class="btn btn-info" data-toggle="modal" data-target="<?= $kategori == null? '#alertBarang' : '#tambahmodal' ?>">Tambah +</button>
				</div>
				<div class="table-responsive">
					<table class="table table-striped" id="tabel">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama barang</th>
								<th>Kode barang</th>
                                <th>Kategori</th>
                                <th>Stok</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
								<th>Aksi</th>
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
								<td><?= $b->kode_barang ?></td>
								<td><?= $b->kategori ?></td>
								<td><?= $b->stok ?></td>
								<td><?= 'Rp '.number_format($b->harga_beli)  ?></td>
								<td><?= 'Rp '.number_format($b->harga_jual) ?></td>
								<td>
									<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editbarang" 
										data-nama="<?= $b->nama ?>" data-kode="<?= $b->kode_barang ?>" 
										data-harga_jual="<?= $b->harga_jual ?>" data-harga_beli="<?= $b->harga_beli ?>"
										data-id_kategori="<?= $b->id_kategori ?>" data-id_barang="<?= $b->id_barang ?>">
										Edit
									</button>
									<a href="<?= base_url('barang/delete/').$b->id_barang ?>" onclick="return confirm('Yakin ingin menghapus barang ini?')" class="btn btn-sm btn-danger">Hapus</a>
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
<?php if($kategori == null){ ?>
<div class="modal fade" id="alertBarang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="alert alert-danger alert-dismissible fade show notifikasi" role="alert">
			<span class="alert-icon"><i class="fa fa-exclamation"></i></span>
            <span class="alert-text">Tambahkan kategori barang terlebih dahulu</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
		</div>
	</div>
</div>
<?php }else{ ?>
<div class="modal fade" id="tambahmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambahkan Barang</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('barang/add') ?>" method="post">
			<div class="modal-body">
				<div class="form-group mb-3">
					<label for="Nama">Nama</label>
					<input type="text" name="nama" class="form-control" placeholder="Nama" id="Nama">
				</div>
				<div class="form-group mb-3">
					<label for="Kode">Kode</label>
					<input type="text" name="kode" class="form-control" placeholder="*Opsional" id="Kode">
				</div>
				<div class="form-group mb-3">
					<label for="kategori">Kategori</label>
					<select name="kategori" id="kategori" class="form-control">
						<?php foreach($kategori as $k){ ?>
							<option value="<?= $k->id_kategori ?>"><?= $k->kategori ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group mb-3">
					<label for="Beli">Harga Beli</label>
					<input type="number" name="harga_beli" class="form-control" placeholder="Harga Beli" id="Beli">
				</div>
				<div class="form-group mb-3">
					<label for="Jual">Harga Jual</label>
					<input type="number" name="harga_jual" class="form-control" placeholder="Harga Jual" id="Jual">
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
				<button type="submit" class="btn btn-primary m-2">Simpan</button>
			</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="editbarang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit barang</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('barang/edit') ?>" method="post">
			<div class="modal-body">
				<div class="form-group mb-3">
					<label for="Nama">Nama</label>
					<input type="text" name="nama" class="form-control" placeholder="Nama" id="Nama">
				</div>
				<div class="form-group mb-3">
					<label for="Kode">Kode</label>
					<input type="text" name="kode" class="form-control" placeholder="*Opsional" id="Kode">
					<input type="hidden" name="id_barang" id="id_barang">
				</div>
				<div class="form-group mb-3">
					<label for="kategori">Kategori</label>
					<select name="kategori" id="kategori" class="form-control">
						<?php foreach($kategori as $k){ ?>
							<option value="<?= $k->id_kategori ?>"><?= $k->kategori ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group mb-3">
					<label for="Beli">Harga Beli</label>
					<input type="number" name="harga_beli" class="form-control" placeholder="Harga Beli" id="Beli">
				</div>
				<div class="form-group mb-3">
					<label for="Jual">Harga Jual</label>
					<input type="number" name="harga_jual" class="form-control" placeholder="Harga Jual" id="Jual">
				</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
				<button type="submit" class="btn btn-primary m-2">Simpan</button>
			</div>
			</form>
		</div>
	</div>
</div>
<?php } ?>