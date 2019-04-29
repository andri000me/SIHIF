<?php 
    //set display by value
    function set_display($data)
    {
        if ($data == null) {
            return "display: none;";
        }
        else{
            return "display: block;";
        }
    }

    //convert string to date
    function StringToDate($string)
    {
        return date('l, j F Y H:i:s', strtotime($string));
    }

    //set display by id_akun
    function set_display_ByIdAkun($id_akun, $id_pembuat)
    {
        if ($id_akun != $id_pembuat) {
            return "display: none;";
        }
        else{
            return "display: block;";
        }
    }

    //set display by role
    function set_display_ByRole($role)
    {
        if ($role != 'admin') {
            return "display: none;";
        }
        else{
            return "display: block;";
        }
    }
 ?>
<!-- css v_tampil_informasi -->
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/css-views/css-v_tampil_informasi.css'); ?>">
<!-- css dropdown checkbox -->
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/css-dropdown-checkbox.css'); ?>">

<div id="wrap-content"> <!-- pembungkus konten -->

<div class="container">
    <div class="pull-left">
        <h3 style="color: #fff;" class="text-uppercase"><?= $nama; ?></h3>
    </div>
    <div class="pull-right">
        <input class="form-control" id="filter-input" type="text" placeholder="Cari Informasi...">
    </div>
</div>

<div style="<?= set_display_ByRole($role); ?>">
    <!-- button tambah informasi -->
    <div class="container-fluid btn-fixed">
        <a href="<?= base_url('informasi/tambah_informasi'); ?>" data-toggle="tooltip" data-placement="bottom" title="Tambah Informasi" class="btn btn-danger btn-md"><span class="glyphicon glyphicon-plus"></span></a>
    </div> 
</div>

<div class="container">
    <?php
        //menampilkan massage jika massage sudah di set
        $m = $this->session->flashdata('m');
        if(isset($m)){
            echo $m;
        }
    ?>
    <div id="filter-output">
    <?php foreach ($data_informasi as $d_i): ?>
    <div id="card-content"> <!-- kartu konten -->
        <section id="wrap-informasi"> <!-- bagian informasi -->

            <div id="header-informasi"> <!-- header informasi -->
            	<div class="row"> 
            		<div class="col-md-11"> <!-- metadata pembuat informasi -->
            			<h4><?= $d_i->nama; ?></h4>
                        <p class="text-capitalize"><?= $d_i->role; ?></p>
            			<p class="text-capitalize"><?= StringToDate($d_i->tanggal); ?></p>
            		</div>
            		<div class="col-md-1"> <!-- aksi terhadap informasi -->
                        <div style="<?= set_display_ByIdAkun($id_akun, $d_i->id_pembuat); ?>">
                			<!-- button ubah informasi -->
                			<a href="<?= base_url('informasi/ubah_informasi/?id='.base64_encode($d_i->id_informasi)); ?>" data-toggle="tooltip" data-placement="bottom" title="Ubah Informasi" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>

                			<!-- button hapus informasi -->
                			<a href="<?= base_url('informasi/hapus_informasi/?id='.base64_encode($d_i->id_informasi)); ?>" data-toggle="tooltip" data-placement="bottom" title="Hapus Informasi" class="btn btn-danger btn-xs" onclick="javascript: return confirm('Anda yakin ingin menghapus ?')"><span class="glyphicon glyphicon-trash"></span></a>
                        </div>
            		</div>
            	</div>
            </div> <!-- end header informasi -->

        	<hr>

            <div id="core-informasi"> <!-- core informasi -->
            	<div class="row">

            		<div class="col-md-3"> <!-- menampilkan data file untuk informasi -->
                        <div style="<?= set_display($d_i->berkas); ?>">
                            <center>
                                <img style="height: 50px;" src="<?= base_url('assets/img/file-icon.svg'); ?>" class="img-responsive">
                                <p><?= $d_i->berkas; ?></p>
                            </center>

                            <!-- button download file -->
                            <a href="<?= base_url('informasi/undah_berkas/?id='.base64_encode($d_i->berkas)); ?>" data-toggle="tooltip" data-placement="bottom" title="Undah Berkas" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-download-alt"></span></a>
                        </div>
            		</div>
            		<div class="col-md-9"> <!-- menampilkan data teks untuk informasi -->
            			<p>
        					<?= $d_i->teks; ?>
        				</p>
            		</div> 

            	</div>
            </div> <!-- end core informasi -->

        	<hr>
            </section> <!-- end bagian informasi -->

            <section id="wrap-komentar"> <!-- bagian komentar -->
            <!-- button tambah komentar -->
            <a data-toggle="collapse" href="#tambah-komentar" class="btn text-capitalize">tambah komentar</a>

            <div id="tambah-komentar" class="panel-collapse collapse">
                <?= form_open_multipart('komentar/tambah_komentar'); ?>

                <!-- field input komentar berupa tanggal -->
                <input type="hidden" name="tanggal" value="<?= date('Y-m-d H:i:s'); ?>">

                <!-- field input komentar berupa id_informasi -->
                <input type="hidden" name="id_informasi" value="<?= $d_i->id_informasi; ?>">

                <!-- field input komentar berupa teks -->
                <div class="form-group">
                  <label for="teks" class="text-capitalize">komentar teks:</label>
                  <textarea class="form-control" rows="5" id="teks" name="teks" maxlength="10000" placeholder="Ketikkan sesuatu..."></textarea>
                </div>

                <!-- field input komentar berupa berkas -->
                <div class="form-group">
                  <label for="berkas" class="text-capitalize">komentar berkas (maksimal 5MB):</label>
                  <input type="file" class="form-control" id="berkas" name="berkas">
                </div>

                <!-- dropdown checkbox untuk menandai pengguna -->
                <div class="form-group">
                  <div class="btn-group">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle text-capitalize" data-toggle="dropdown">tandai pengguna <span class="caret"></span></button>
                        <ul class="dropdown-menu">

                            <!-- mengambil data pengguna -->
                            <?php foreach ($data_pengguna as $d_p): ?>
                           <li>
                               <label class="dropdown-menu-item checkbox">
                                   <input type="checkbox" name="tandai[]" value="<?= $d_p->id_akun; ?>">
                                   <span class="glyphicon glyphicon-unchecked"></span>
                                   <?= $d_p->nama; ?>
                               </label>
                           </li>
                           <?php endforeach; ?>

                        </ul>
                    </div>
                </div>

                <!-- button tambah komentar -->
                <input type="submit" value="tambah komentar" class="btn btn-danger text-capitalize button" name="btn_tambah"></input>
                <?= form_close();?>
            </div>
            <hr>
            <!-- button lihat semua komentar -->
            <a data-toggle="collapse" href="#lihat-komentar" class="btn text-capitalize">lihat semua komentar</a>
<!-- ====================================================================================================== -->
            <div id="lihat-komentar" class="panel-collapse collapse">
                <ul class="list-group">
                <?php foreach ($data_komentar as $d_k): ?>
                    <?php if ($d_k->id_informasi == $d_i->id_informasi): ?>
                    <li class="list-group-item">

                        <div id="header-komentar"> <!-- header komentar -->
                            <div class="row">
                                <div class="col-md-11"> <!-- metadata pembuat komentar -->
                                    <h4><?= $d_k->nama; ?></h4>
                                    <p class="text-capitalize"><?= $d_k->role; ?></p>
                                    <p><?= StringToDate($d_k->tanggal); ?></p>
                                </div>
                                <div class="col-md-1"> <!-- aksi terhadap komentar -->
                                    <div style="<?= set_display_ByIdAkun($id_akun, $d_k->id_pembuat); ?>">
                                        <!-- button ubah komentar -->
                                        <a href="<?= base_url('komentar/ubah_komentar/?id='.base64_encode($d_k->id_komentar)); ?>" data-toggle="tooltip" data-placement="bottom" title="Ubah Komentar" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>

                                        <!-- button hapus komentar -->
                                        <a href="<?= base_url('komentar/hapus_komentar/?id='.base64_encode($d_k->id_komentar)); ?>" data-toggle="tooltip" data-placement="bottom" title="Hapus Komentar" class="btn btn-danger btn-xs" onclick="javascript: return confirm('Anda yakin ingin menghapus ?')"><span class="glyphicon glyphicon-trash"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end header komentar -->

                        <hr>

                        <div id="core-komentar"> <!-- core-komentar -->
                            <div class="row">
                                <div class="col-md-2"> <!-- menampilkan data file untuk komentar -->
                                    <div style="<?= set_display($d_k->berkas); ?>">
                                        <center>
                                            <img style="height: 30px;" src="<?= base_url('assets/img/file-icon.svg'); ?>" class="img-responsive">
                                            <p><?= $d_k->berkas; ?></p>
                                        </center>

                                        <!-- button download file -->
                                        <a href="<?= base_url('informasi/undah_berkas/?id='.base64_encode($d_k->berkas)); ?>" data-toggle="tooltip" data-placement="bottom" title="Undah Berkas" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-download-alt"></span></a>
                                    </div>
                                </div>
                                <div class="col-md-10"> <!-- menampilkan data teks untuk komentar -->
                                    <p>
                                        <?= $d_k->teks; ?>
                                    </p>
                                </div>
                            </div>
                        </div> <!-- end core-komentar -->

                    </li>
                    <?php endif; ?>
                <?php endforeach; ?>
                </ul>
            </div>
        </section> <!-- end bagian komentar -->
    </div> <!-- end kartu konten -->
    <?php endforeach; ?>
    </div>
</div>
</div> <!-- end pembungkus konten -->

<!-- js bootstrap filters -->
<script type="text/javascript" src="<?= base_url('assets/js/js-bootstrap-filters.js') ?>"></script>
<!-- js dropdown checkbox -->
<script type="text/javascript" src="<?= base_url('assets/js/js-dropdown-checkbox.js') ?>"></script>