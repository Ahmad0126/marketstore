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
					<h4 class="card-title">Kategori Barang Marketstore</h4>
					<button class="btn btn-info" data-toggle="modal" data-target="#tambahmodal">Tambah +</button>
				</div>
				<div class="table-responsive">
					<table class="table table-striped" id="tabel">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Kategori</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$no = 1;
							foreach($kategori as $k): 
							?>
							<tr>
								<td><?= $no++ ?></td>
								<td><?= $k->kategori ?></td>
								<td>
									<a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editkate" data-id="<?= $k->id_kategori ?>" data-nama="<?= $k->kategori ?>">Edit</a>
									<a class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus kategori ini?')" href="<?= base_url('kategori/delete/').$k->id_kategori ?>">Hapus</a>
								</td>
							</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="tambahmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambahkan Kategori</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('kategori/add') ?>" method="post">
			<div class="modal-body">
				<div class="form-group mb-3">
					<label for="floatingPassword">Nama Kategori</label>
					<input type="text" name="kategori" class="form-control" placeholder="Nama Kategori" id="floatingPassword">
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
<div class="modal fade" id="editkate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Kategori</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('kategori/edit') ?>" id="form" method="post">
			<div class="modal-body">
				<div class="form-group mb-3">
					<label for="nama">Nama Kategori</label>
					<input type="text" name="kategori" class="form-control" placeholder="Nama Kategori" id="kategori">
					<input type="hidden" name="id_kategori" id="id_kategori">
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