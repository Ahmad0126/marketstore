<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Login Marketstore</title>
	<!-- base:css -->
	<link rel="stylesheet" href="<?= base_url('assets/regal/') ?>vendors/mdi/css/materialdesignicons.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/regal/') ?>vendors/feather/feather.css">
	<link rel="stylesheet" href="<?= base_url('assets/regal/') ?>vendors/base/vendor.bundle.base.css">
	<!-- endinject -->
	<!-- plugin css for this page -->
	<!-- End plugin css for this page -->
	<!-- inject:css -->
	<link rel="stylesheet" href="<?= base_url('assets/regal/') ?>css/style.css">
	<!-- endinject -->
	<link rel="shortcut icon" href="<?= base_url('assets/regal/') ?>images/favicon.png" />
</head>

<body>
	<div class="container-scroller">
		<div class="container-fluid page-body-wrapper full-page-wrapper">
			<div class="content-wrapper d-flex align-items-center auth px-0">
				<div class="row w-100 mx-0">
					<div class="col-lg-4 mx-auto">
						<div class="auth-form-light text-left py-5 px-4 px-sm-5">
							<div class="brand-logo">
								<img src="<?= base_url('assets/regal/') ?>images/logo-dark.svg" alt="logo">
							</div>
							<h4>Hello! let's get started</h4>
							<h6 class="font-weight-light">Sign in to continue.</h6>
							<form action="<?= base_url('auth/login') ?>" method="post" class="pt-3">
								<div class="form-group">
									<input type="text" name="username" class="form-control form-control-lg <?= $this->session->flashdata('username')? 'is-invalid' : '' ?>" id="exampleInputEmail1" placeholder="Username" value="<?= $this->session->flashdata('username_val'); ?>">
									<?php if($this->session->flashdata('username')){ ?><div class="invalid-feedback"><?= $this->session->flashdata('username') ?></div><?php } ?>
								</div>
								<div class="form-group">
									<input type="password" name="password" class="form-control form-control-lg <?= $this->session->flashdata('password')? 'is-invalid' : '' ?>" id="exampleInputPassword1" placeholder="Password">
									<?php if($this->session->flashdata('password')){ ?><div class="invalid-feedback"><?= $this->session->flashdata('password') ?></div><?php } ?>
								</div>
								<div class="mt-3">
									<button type="submit" class="btn btn-block btn-info btn-lg font-weight-medium auth-form-btn">LOGIN</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- content-wrapper ends -->
		</div>
		<!-- page-body-wrapper ends -->
	</div>
	<!-- container-scroller -->
	<!-- base:js -->
	<script src="<?= base_url('assets/regal/') ?>vendors/base/vendor.bundle.base.js"></script>
	<!-- endinject -->
	<!-- inject:js -->
	<script src="<?= base_url('assets/regal/') ?>js/off-canvas.js"></script>
	<script src="<?= base_url('assets/regal/') ?>js/hoverable-collapse.js"></script>
	<script src="<?= base_url('assets/regal/') ?>js/template.js"></script>
	<!-- endinject -->
</body>

</html>
