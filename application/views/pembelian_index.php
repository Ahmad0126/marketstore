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
					<h4 class="card-title">Riwayat Transaksi Pembelian Marketstore</h4>
					<?php if($barang == null){ ?>
					<a href="#" data-target="#alertBarang" data-toggle="modal" class="btn btn-info">Beli +</a>
					<?php }else if($barang != null && $supplier == null){ ?>
					<a href="#" data-target="#alertSupplier" data-toggle="modal" class="btn btn-info">Beli +</a>
					<?php }else{ ?>
					<a href="<?= base_url('pembelian/add') ?>" class="btn btn-info">Beli +</a>
					<?php } ?>
				</div>
				<div class="table-responsive">
					<table class="table table-striped" id="tabel">
						<thead>
							<tr>
								<th>No</th>
								<th>Tanggal</th>
								<th>Kode Pembelian</th>
                                <th>Supplier barang</th>
                                <th>Total Transaksi</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 1;
							foreach($pembelian as $pb){
							?>
							<tr>
								<td><?= $no++ ?></td>
								<td><?= $this->template->translate_bulan($pb->tanggal) ?></td>
								<td><?= $pb->kode_pembelian ?></td>
								<td><?= $pb->nama ?></td>
								<td><?= 'Rp '.number_format($pb->total_tagihan)  ?></td>
								<td>
									<a href="<?= base_url('pembelian/detail/').$pb->id_pembelian ?>" class="btn btn-sm btn-primary">Detail</a>
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
<?php if($barang == null){ ?>
<div class="modal fade" id="alertBarang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="alert alert-danger alert-dismissible fade show notifikasi" role="alert">
			<span class="alert-icon"><i class="fa fa-exclamation"></i></span>
            <span class="alert-text">Tambahkan barang terlebih dahulu</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
		</div>
	</div>
</div>
<?php }else if($supplier == null){ ?>
<div class="modal fade" id="alertSupplier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="alert alert-danger alert-dismissible fade show notifikasi" role="alert">
			<span class="alert-icon"><i class="fa fa-exclamation"></i></span>
            <span class="alert-text">Tambahkan supplier terlebih dahulu</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
		</div>
	</div>
</div>
<?php } ?>