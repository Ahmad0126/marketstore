<?php $menu = $this->uri->segment(1); ?>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
	<div class="user-profile">
		<div class="user-image">
			<img src="<?= $this->session->userdata('profil') == null ? base_url('assets/upload/profil/unknown.png') : base_url('assets/upload/profil/').$this->session->userdata('profil') ?>">
		</div>
		<div class="user-name">
			<?= $this->session->userdata('nama') ?>
		</div>
		<div class="user-designation">
			<?= $this->session->userdata('level') ?>
		</div>
	</div>
	<ul class="nav">
		<li class="nav-item <?= $menu == null || $menu == 'home' ? 'active' : '' ?>">
			<a class="nav-link" href="<?= base_url() ?>">
				<i class="icon-box menu-icon"></i>
				<span class="menu-title">Dashboard</span>
			</a>
		</li>
		<?php if($this->session->userdata('level') == 'Admin'){ ?>
		<li class="nav-item <?= $menu == 'user' || $menu == 'supplier' || $menu == 'pelanggan' || $menu == 'voucher' ? 'active' : '' ?>">
			<a class="nav-link" data-toggle="collapse" href="#admin" aria-expanded="false" aria-controls="ui-basic">
				<i class="icon-head menu-icon"></i>
				<span class="menu-title">Administrasi</span>
				<i class="menu-arrow"></i>
			</a>
			<div class="collapse <?= $menu == 'user' || $menu == 'supplier' || $menu == 'pelanggan' || $menu == 'voucher' ? 'show' : '' ?>" id="admin">
				<ul class="nav flex-column sub-menu">
					<li class="nav-item <?= $menu == 'supplier' ? 'active' : '' ?>">
						<a class="nav-link" href="<?= base_url('supplier') ?>">
							<span class="menu-title">Supplier</span>
						</a>
					</li>
					<li class="nav-item <?= $menu == 'pelanggan' ? 'active' : '' ?>">
						<a class="nav-link" href="<?= base_url('pelanggan') ?>">
							<span class="menu-title">Pelanggan</span>
						</a>
					</li>
					<li class="nav-item <?= $menu == 'user' ? 'active' : '' ?>">
						<a class="nav-link" href="<?= base_url('user') ?>">
							<span class="menu-title">User</span>
						</a>
					</li>
					<li class="nav-item <?= $menu == 'voucher' ? 'active' : '' ?>">
						<a class="nav-link" href="<?= base_url('voucher') ?>">
							<span class="menu-title">Voucher</span>
						</a>
					</li>
				</ul>
			</div>
		</li>
		<li class="nav-item <?= $menu == 'pembelian' || $menu == 'penjualan' ? 'active' : '' ?>">
			<a class="nav-link" data-toggle="collapse" href="#ui-trans" aria-expanded="false" aria-controls="ui-basic">
				<i class="icon-clipboard menu-icon"></i>
				<span class="menu-title">Transaksi</span>
				<i class="menu-arrow"></i>
			</a>
			<div class="collapse <?= $menu == 'pembelian' || $menu == 'penjualan' ? 'show' : '' ?>" id="ui-trans">
				<ul class="nav flex-column sub-menu">
					<li class="nav-item">
						<a class="nav-link <?= $menu == 'penjualan' ? 'active' : '' ?>" href="<?= base_url('penjualan') ?>">
							<span class="menu-title">Penjualan</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?= $menu == 'pembelian' ? 'active' : '' ?>" href="<?= base_url('pembelian') ?>">
							<span class="menu-title">Pembelian</span>
						</a>
					</li>
				</ul>
			</div>
		</li>
		<li class="nav-item <?= $menu == 'barang' || $menu == 'kategori' ? 'active' : '' ?>">
			<a class="nav-link" data-toggle="collapse" href="#gudang" aria-expanded="false" aria-controls="ui-basic">
				<i class="icon-box menu-icon"></i>
				<span class="menu-title">Gudang</span>
				<i class="menu-arrow"></i>
			</a>
			<div class="collapse <?= $menu == 'barang' || $menu == 'kategori' ? 'show' : '' ?>" id="gudang">
				<ul class="nav flex-column sub-menu">
					<li class="nav-item">
						<a class="nav-link <?= $menu == 'barang' ? 'active' : '' ?>" href="<?= base_url('barang') ?>">
							<span class="menu-title">Barang</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?= $menu == 'kategori' ? 'active' : '' ?>" href="<?= base_url('kategori') ?>">
							<span class="menu-title">Kategori Barang</span>
						</a>
					</li>
				</ul>
			</div>
		</li>
		<?php }else{ ?>
		<li class="nav-item">
			<a class="nav-link <?= $menu == 'penjualan' ? 'active' : '' ?>" href="<?= base_url('penjualan') ?>">
				<i class="icon-clipboard menu-icon"></i>
				<span class="menu-title">Penjualan</span>
			</a>
		</li>
		<?php } ?>
	</ul>
</nav>
