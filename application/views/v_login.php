<!-- css v_login -->
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/css-views/css-v_login.css'); ?>">

<div class="container">
	<?php
		//menampilkan massage jika massage sudah di set
		$m = $this->session->flashdata('m');
		if(isset($m)){
			echo $m;
		}
	?>
	<div class="wrapper"> <!-- pembungkus konten -->
		<div class="row">
			<!-- konten sebelah kiri -->
			<div class="col-md-6 text-uppercase text-center part-left">
				<center><img src="<?= base_url('assets/img/favicon.png'); ?>" class="img-responsive"></center>
				<h1>sistem informasi harian ti</h1>
				<p>UNIVERSITAS SRIWIJAYA</p>
			</div>

			<!-- konten sebelah kanan -->
			<div class="col-md-6 part-right">
				<h2 class="text-capitalize"><span class="glyphicon glyphicon-log-in"></span> login</h2>
				<hr>

				<?= form_open('akses'); ?>
				<!-- field input email -->
				<div class="input-group login-field">
				    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
				    <input type="email" class="form-control" name="email" placeholder="Email..." required>
				</div>

				<!-- field input password -->
				<div class="input-group login-field">
				    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
				    <input type="password" class="form-control" name="password" placeholder="Password..." required>
				</div>

				<!-- button login -->
				<input type="submit" value="login" class="btn btn-danger btn-block text-capitalize login-button" name="btn_login"></input>
				<?= form_close();?>
			</div>
		</div>
	</div>
</div>