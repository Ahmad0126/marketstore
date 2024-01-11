<div class="row">
	<div class="col-lg-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<div class="d-flex justify-content-between">
					<h4 class="card-title">Daftar User Marketstore</h4>
					<button class="btn btn-info" data-toggle="modal" data-target="#tambahmodal">Tambah +</button>
				</div>
				<div class="table-responsive">
					<table class="table table-striped">
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
							<tr>
								<td>1</td>
								<td>Herman Beck</td>
								<td>HermanBeck</td>
								<td class="py-1">
									<a href="">
										<img src="<?= base_url('assets/regal/') ?>images/faces/face1.jpg" alt="image" />
									</a>
								</td>
								<td>User</td>
								<td>
									<button class="btn btn-primary">urygfse</button>
									<button class="btn btn-danger">urygfse</button>
								</td>
							</tr>
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
<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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