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
					<h4 class="card-title">Daftar Voucher Marketstore</h4>
					<button class="btn btn-info" data-toggle="modal" data-target="#tambahmodal">Tambah +</button>
				</div>
				<div class="table-responsive">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>No</th>
								<th>Kode Voucher</th>
								<th>Potongan Harga</th>
								<th>Berlaku Sampai</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$no = 1;
							foreach($voucher as $k): 
							?>
							<tr>
								<td><?= $no++ ?></td>
								<td><?= $k->kode_voucher ?></td>
								<td><?= 'Rp '.number_format($k->potongan) ?></td>
								<td><?= $k->expired ?></td>
								<td>
									<a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editvch" data-id="<?= $k->id_voucher ?>" data-kode="<?= $k->kode_voucher ?>" data-potongan="<?= $k->potongan ?>" data-expired="<?= $k->expired ?>">Edit <i class="fa fa-edit"></i></a>
									<a class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus voucher ini?')" href="<?= base_url('voucher/delete/').$k->id_voucher ?>"><i class="fa fa-trash"></i> Hapus</a>
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
				<h5 class="modal-title" id="exampleModalLabel">Tambahkan Voucher</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('voucher/add') ?>" method="post">
			<div class="modal-body">
				<div class="form-group mb-3">
					<label for="floatingPasswordt">Kode Voucher</label>
					<input type="text" name="kode" class="form-control" placeholder="Kode Voucher" id="floatingPasswordt">
				</div>
				<div class="form-group mb-3">
					<label for="Potongant">Potongan Harga</label>
					<input type="number" name="potongan" class="form-control" id="Potongant">
				</div>
				<div class="form-group mb-3">
					<label for="expiredt">Berlaku Sampai</label>
					<input type="date" name="expired" class="form-control" id="expiredt">
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
<div class="modal fade" id="editvch" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Voucher</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('voucher/edit') ?>" id="form" method="post">
			<div class="modal-body">
				<div class="form-group mb-3">
					<label for="Kode">Kode Voucher</label>
					<input type="text" name="kode" class="form-control" placeholder="Kode Voucher" id="Kode" readonly>
					<input type="hidden" name="id_voucher" id="id_voucher">
				</div>
				<div class="form-group mb-3">
					<label for="Potongan">Potongan Harga</label>
					<input type="number" name="potongan" class="form-control" id="Potongan">
				</div>
				<div class="form-group mb-3">
					<label for="expired">Berlaku Sampai</label>
					<input type="date" name="expired" class="form-control" id="expired">
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