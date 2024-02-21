<div class="modal fade" id="alertmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<?= $this->session->flashdata('alert'); ?>
	</div>
</div>
<div class="row">
	<div class="col-lg-12 grid-margin stretch-card">
		<div class="card">
			<form action="<?= base_url('pemilu/add') ?>" method="post">
			<div class="card-header">
				<div class="d-flex justify-content-between align-items-center">
					<h4 class="card-title">Masukkan Suara</h4>
					<button type="submit" class="btn btn-primary m-2">Simpan</button>
				</div>
			</div>
			<div class="card-body">
				<div class="form-group mb-3">
					<label for="NamaTPS">Nama TPS</label>
					<input type="text" name="nama_tps" class="form-control" placeholder="Masukkan Nama TPS" id="NamaTPS">
				</div>
				<div class="row">
					<div class="col-12 col-md-6">
						<div class="form-group mb-3">
							<label for="Suara01">Suara 01</label>
							<input type="number" name="suara1" class="form-control" placeholder="Masukkan Suara 01" id="Suara01">
						</div>
						<div class="form-group mb-3">
							<label for="Suara02">Suara 02</label>
							<input type="number" name="suara2" class="form-control" placeholder="Masukkan Suara 02" id="Suara02">
						</div>
						<div class="form-group mb-3">
							<label for="Suara03">Suara 03</label>
							<input type="number" name="suara3" class="form-control" placeholder="Masukkan Suara 03" id="Suara03">
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group mb-3">
							<label for="TotalSuaraSah">Total Suara Sah</label>
							<input type="number" name="sah" class="form-control" placeholder="Masukkan Suara yang Sah" id="TotalSuaraSah">
						</div>
						<div class="form-group mb-3">
							<label for="TotalSuaraTidakSah">Total Suara Tidak Sah</label>
							<input type="number" name="tidak_sah" class="form-control" placeholder="Masukkan Suara yang Tidak Sah" id="TotalSuaraTidakSah">
						</div>
						<div class="form-group mb-3">
							<label for="TotalSuara">Total Suara</label>
							<input type="number" name="total" class="form-control" placeholder="Masukkan Total Semua Suara" id="TotalSuara">
						</div>
					</div>
				</div>
			</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="tambahmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Masukkan Suara</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('pemilu/add') ?>" method="post">
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