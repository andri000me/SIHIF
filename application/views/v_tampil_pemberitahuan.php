<!-- css v_tampil_pemberitahuan -->
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/css-views/css-v_tampil_pemberitahuan.css'); ?>">
<div class="wrap-content">
	<div class="container">
		<?php foreach ($data_pemberitahuan as $d_p): ?>
		<div id="content">
			<div class="row">
				<div class="col-md-11">
					<p class="text-capitalize">anda ditandai oleh <b><?= $d_p->nama; ?></b></p>
				</div>
				<div class="col-md-1">
					<a href="<?= base_url('informasi/tampil_informasi/?id='.base64_encode($d_p->id_informasi)); ?>" data-toggle="tooltip" data-placement="bottom" title="Lihat Informasi" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-eye-open"></span></a>
				</div>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</div>