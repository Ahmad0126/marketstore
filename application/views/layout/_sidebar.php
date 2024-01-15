<nav class="sidebar sidebar-offcanvas" id="sidebar">
	<div class="user-profile">
		<div class="user-image">
			<img src="<?= base_url('assets/regal/') ?>images/faces/face28.png">
		</div>
		<div class="user-name">
			Edward Spencer
		</div>
		<div class="user-designation">
			Developer
		</div>
	</div>
	<ul class="nav">
		<li class="nav-item">
			<a class="nav-link" href="<?= base_url() ?>">
				<i class="icon-box menu-icon"></i>
				<span class="menu-title">Dashboard</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="<?= base_url('user') ?>" aria-expanded="false" aria-controls="auth">
				<i class="icon-head menu-icon"></i>
				<span class="menu-title">User</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="<?= base_url('supplier') ?>" aria-expanded="false" aria-controls="auth">
				<i class="icon-head menu-icon"></i>
				<span class="menu-title">Supplier</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" data-toggle="collapse" href="#gudang" aria-expanded="false" aria-controls="ui-basic">
				<i class="icon-box menu-icon"></i>
				<span class="menu-title">Gudang</span>
				<i class="menu-arrow"></i>
			</a>
			<div class="collapse" id="gudang">
				<ul class="nav flex-column sub-menu">
					<li class="nav-item">
						<a class="nav-link" href="<?= base_url('NA') ?>">
							<span class="menu-title">Barang</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?= base_url('kategori') ?>">
							<span class="menu-title">Kategori Barang</span>
						</a>
					</li>
				</ul>
			</div>
		</li>
		<li class="nav-item">
			<a class="nav-link" data-toggle="collapse" href="#ui-trans" aria-expanded="false" aria-controls="ui-basic">
				<i class="icon-box menu-icon"></i>
				<span class="menu-title">Transaksi</span>
				<i class="menu-arrow"></i>
			</a>
			<div class="collapse" id="ui-trans">
				<ul class="nav flex-column sub-menu">
					<li class="nav-item">
						<a class="nav-link" href="<?= base_url('NA') ?>">
							<span class="menu-title">Penjualan</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?= base_url('NA') ?>">
							<span class="menu-title">Pembelian</span>
						</a>
					</li>
				</ul>
			</div>
		</li>
	</ul>
</nav>
