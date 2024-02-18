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
					<h4 class="card-title">Daftar User Marketstore</h4>
					<button class="btn btn-info" data-toggle="modal" data-target="#tambahmodal">Tambah +</button>
				</div>
				<div class="table-responsive">
					<table class="table table-striped" id="tabel">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama</th>
								<th>Username</th>
                                <th>Profil</th>
								<th>Level</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 1;
							foreach($users as $u){
							?>
							<tr>
								<td><?= $no++ ?></td>
								<td><?= $u->nama ?></td>
								<td><?= $u->username ?></td>
								<td class="py-1">
									<a data-toggle="modal" data-target="#profilModl" data-url="<?= base_url('assets/upload/profil/').$u->profil ?>" href="#">
										<img src="<?= $u->profil == null ? base_url('assets/upload/profil/unknown.png') : base_url('assets/upload/profil/').$u->profil ?>" alt="image" />
									</a>
								</td>
								<td><?= $u->level ?></td>
								<td>
									<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#edituser" 
										data-nama="<?= $u->nama ?>" data-username="<?= $u->username ?>" 
										data-level="<?= $u->level ?>" data-id_user="<?= $u->id_user ?>">
										Edit
									</button>
									<button class="btn btn-sm btn-warning"  data-toggle="modal" data-target="#resetuser"  data-id_user="<?= $u->id_user ?>">Reset Password</button>
									<a href="<?= base_url('user/delete/').$u->id_user ?>" onclick="return confirm('Yakin ingin menghapus user ini?')" class="btn btn-sm btn-danger">Hapus</a>
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
				<h5 class="modal-title" id="exampleModalLabel">Tambahkan User</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('user/add') ?>" method="post">
			<div class="modal-body">
				<div class="form-group mb-3">
					<label for="Username">Username</label>
					<input type="text" name="username" class="form-control" placeholder="Username" id="Username">
				</div>
				<div class="form-group mb-3">
					<label for="Password">Password</label>
					<input type="password" name="password" class="form-control" placeholder="Password" id="Password">
				</div>
				<div class="form-group mb-3">
					<label for="Nama">Nama</label>
					<input type="text" name="nama" class="form-control" placeholder="Nama" id="Nama">
				</div>
				<div class="form-group mb-3">
					<label for="level">Level</label>
					<select class="form-control" name="level" id="level">
						<option value="Admin">Admin</option>
						<option value="Kasir">Kasir</option>
					</select>
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
<div class="modal fade" id="edituser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('user/edit') ?>" method="post">
			<div class="modal-body">
				<div class="form-group mb-3">
					<label for="Username">Username</label>
					<input type="text" name="username" class="form-control" placeholder="Username" id="Username" readonly>
					<input type="hidden" name="id_user" id="id_user">
				</div>
				<div class="form-group mb-3">
					<label for="Nama">Nama</label>
					<input type="text" name="nama" class="form-control" placeholder="Nama" id="Nama">
				</div>
				<div class="form-group mb-3">
					<label for="level">Level</label>
					<select class="form-control" name="level" id="level">
						<option value="Admin">Admin</option>
						<option value="Kasir">Kasir</option>
					</select>
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
<div class="modal fade" id="resetuser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('user/reset') ?>" method="post">
			<div class="modal-body">
				<div class="form-group mb-3">
					<label for="konf_pass">Konfirmasi Password Anda</label>
					<input type="password" name="password" class="form-control" placeholder="Konfirmasi Password" id="konf_pass">
					<input type="hidden" name="id_user" id="id_user">
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
				<button type="submit" class="btn btn-primary m-2" onclick="return confirm('Yakin ingin mereset password user ini?')">Reset</button>
			</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="profilModl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" id="fotopp" role="document">
	</div>
</div>