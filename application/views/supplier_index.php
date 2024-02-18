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
					<h4 class="card-title">Daftar Supplier Marketstore</h4>
					<button class="btn btn-info" data-toggle="modal" data-target="#tambahmodal">Tambah +</button>
				</div>
				<div class="table-responsive">
					<table class="table table-striped" id="tabel">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama</th>
								<th>Kode</th>
                                <th>No Telp</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 1;
							foreach($suppliers as $s){
							?>
							<tr>
								<td><?= $no++ ?></td>
								<td><?= $s->nama ?></td>
								<td><?= $s->kode_supplier ?></td>
								<td><?= $s->telp ?></td>
								<td>
									<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editsupplier" 
										data-nama="<?= $s->nama ?>" data-kode="<?= $s->kode_supplier ?>" 
										data-telp="<?= $s->telp ?>" data-id_supplier="<?= $s->id_supplier ?>">
										Edit
									</button>
									<a href="<?= base_url('supplier/delete/').$s->id_supplier ?>" onclick="return confirm('Yakin ingin menghapus supplier ini?')" class="btn btn-sm btn-danger">Hapus</a>
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
				<h5 class="modal-title" id="exampleModalLabel">Tambahkan Supplier</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('supplier/add') ?>" method="post">
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
<div class="modal fade" id="editsupplier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Supplier</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('supplier/edit') ?>" method="post">
			<div class="modal-body">
				<div class="form-group mb-3">
					<label for="Nama">Nama</label>
					<input type="text" name="nama" class="form-control" placeholder="Nama" id="Nama">
				</div>
				<div class="form-group mb-3">
					<label for="Kode">Kode</label>
					<input type="text" name="kode" class="form-control" placeholder="Kode" id="Kode" readonly>
					<input type="hidden" name="id_supplier" id="id_supplier">
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