<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
	<div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
		<a class="navbar-brand brand-logo" href="<?= base_url() ?>"><img src="<?= base_url('assets/regal/') ?>images/logo.svg"
				alt="logo" /></a>
		<a class="navbar-brand brand-logo-mini" href="<?= base_url() ?>"><img
				src="<?= base_url('assets/regal/') ?>images/logo-mini.svg" alt="logo" /></a>
	</div>
	<div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
		<button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
			<span class="icon-menu"></span>
		</button>
		<ul class="navbar-nav mr-lg-2">
			<li class="nav-item nav-search d-none d-lg-block">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text" id="search">
							<i class="icon-search"></i>
						</span>
					</div>
					<input type="search" class="form-control" placeholder="Cari.." id="genSearch">
				</div>
			</li>
		</ul>
		<ul class="navbar-nav navbar-nav-right">
			<li class="nav-item dropdown d-flex mr-4 ">
				<a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center"
					id="notificationDropdown" href="#" data-toggle="dropdown">
					<i class="icon-cog"></i>
				</a>
				<div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
					aria-labelledby="notificationDropdown">
					<p class="mb-0 font-weight-normal float-left dropdown-header">Settings</p>
					<a href="<?= base_url('home/profil') ?>" class="dropdown-item preview-item">
						<i class="icon-head"></i> Profile
					</a>
					<a href="<?= base_url('auth/logout') ?>" class="dropdown-item preview-item">
						<i class="icon-inbox"></i> Logout
					</a>
				</div>
			</li>
		</ul>
		<button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
			data-toggle="offcanvas">
			<span class="icon-menu"></span>
		</button>
	</div>
</nav>
