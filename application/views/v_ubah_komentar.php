<!-- css dropdown checkbox -->
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/css-dropdown-checkbox.css'); ?>">
<!-- css v_ubah_komentar -->
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/css-views/css-v_ubah_komentar.css'); ?>">

<div class="container">
	<div id="wrap-content">

		<?php
	        //menampilkan massage jika massage sudah di set
	        $m = $this->session->flashdata('m');
	        if(isset($m)){
	            echo $m;
	        }
	    ?>

		<?= form_open_multipart('komentar/ubah_komentar'); ?>

		<!-- field input komentar berupa tanggal -->
		<input type="hidden" name="tanggal" value="<?= date('Y-m-d H:i:s'); ?>">

		<!-- field input komentar berupa id_informasi -->
		<input type="hidden" name="id_informasi" value="<?= $data_komentar->id_informasi; ?>">

		<!-- field input komentar berupa id_komentar -->
		<input type="hidden" name="id_komentar" value="<?= $data_komentar->id_komentar; ?>">

		<!-- field input komentar berupa teks -->
		<div class="form-group">
		  <label for="teks" class="text-capitalize">komentar teks:</label>
		  <textarea class="form-control" rows="5" id="teks" name="teks" maxlength="10000"><?= $data_komentar->teks; ?></textarea>
		</div>

		<!-- field input komentar berupa berkas -->
		<div class="form-group">
		  <label for="berkas" class="text-capitalize">komentar berkas (maksimal 5MB):</label>
		  <input type="file" class="form-control" id="berkas" name="berkas">
		</div>

		<!-- field input komentar berupa berkas lama -->
		<input type="hidden" name="berkas_lama" value="<?= $data_komentar->berkas; ?>">

		<!-- dropdown checkbox untuk menandai pengguna lain -->
		<div class="form-group">
		  <div class="btn-group">
				<button type="button" class="btn btn-default btn-xs dropdown-toggle text-capitalize" data-toggle="dropdown">tandai pengguna <span class="caret"></span></button>
				<ul class="dropdown-menu">

					<!-- mengambil data pengguna -->
					<?php foreach ($data_pengguna as $d): ?>
				   <li>
				       <label class="dropdown-menu-item checkbox">
				           <input type="checkbox" name="tandai[]" value="<?= $d->id_akun; ?>">
				           <span class="glyphicon glyphicon-unchecked"></span>
				           <?= $d->nama; ?>
				       </label>
				   </li>
				   <?php endforeach; ?>

				</ul>
			</div>
		</div>

		<!-- button ubah komentar -->
		<input type="submit" value="ubah komentar" class="btn btn-danger text-capitalize button" name="btn_ubah"></input>
		<?= form_close();?>
	</div>
</div>

<!-- js dropdown checkbox -->
<script type="text/javascript" src="<?= base_url('assets/js/js-dropdown-checkbox.js') ?>"></script>