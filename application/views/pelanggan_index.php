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
					<h4 class="card-title">Daftar Pelanggan Marketstore</h4>
					<button class="btn btn-info" data-toggle="modal" data-target="#tambahmodal">Tambah +</button>
				</div>
				<div class="table-responsive">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama</th>
								<th>Poin</th>
								<th>Kode</th>
                                <th>No Telp</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 1;
							foreach($pelanggan as $p){
							?>
							<tr>
								<td><?= $no++ ?></td>
								<td><?= $p->nama ?></td>
								<td><?= number_format($p->poin) ?></td>
								<td><?= $p->alamat ?></td>
								<td><?= $p->telp ?></td>
								<td>
									<button class="btn btn-primary" data-toggle="modal" data-target="#editpelanggan" 
										data-nama="<?= $p->nama ?>" data-alamat="<?= $p->alamat ?>" 
										data-telp="<?= $p->telp ?>" data-id_pelanggan="<?= $p->id_pelanggan ?>">
										Edit
									</button>
									<a href="<?= base_url('pelanggan/riwayat/').$p->id_pelanggan ?>" class="btn btn-info">Riwayat</a>
									<a href="<?= base_url('pelanggan/delete/').$p->id_pelanggan ?>" onclick="return confirm('Yakin ingin menghapus pelanggan ini?')" class="btn btn-danger">Hapus</a>
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
<div class="modal fade" id="tambahmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambahkan Pelanggan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('pelanggan/add') ?>" method="post">
			<div class="modal-body">
				<div class="form-group mb-3">
					<label for="Nama">Nama</label>
					<input type="text" name="nama" class="form-control" placeholder="Nama" id="Nama">
				</div>
				<div class="form-group mb-3">
					<label for="Alamat">Alamat</label>
					<input type="text" name="alamat" class="form-control" placeholder="Alamat" id="Alamat">
				</div>
				<div class="form-group mb-3">
					<label for="Telepon">Telepon</label>
					<input type="number" name="telp" class="form-control" placeholder="Telepon" id="Telepon">
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
<div class="modal fade" id="editpelanggan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Pelanggan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('pelanggan/edit') ?>" method="post">
			<div class="modal-body">
				<div class="form-group mb-3">
					<label for="Nama">Nama</label>
					<input type="text" name="nama" class="form-control" placeholder="Nama" id="Nama">
				</div>
				<div class="form-group mb-3">
					<label for="Alamat">Alamat</label>
					<input type="text" name="alamat" class="form-control" placeholder="Alamat" id="Alamat">
					<input type="hidden" name="id_pelanggan" id="id_pelanggan">
				</div>
				
				<div class="form-group mb-3">
					<label for="Telepon">Telepon</label>
					<input type="number" name="telp" class="form-control" placeholder="Telepon" id="Telepon">
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