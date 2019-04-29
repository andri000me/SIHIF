<!-- css navbar -->
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/css-navbar.css'); ?>">

<nav class="navbar navbar-color navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#page-top">
        <span>
          <img src="<?= base_url('assets/img/favicon.png') ?>" class="img-rounded" alt="Logo SI harian TI" style="height:30px">
        </span>SISTEM INFORMASI HARIAN TI
      </a>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="<?= base_url('informasi'); ?>" data-toggle="tooltip" data-placement="bottom" title="Beranda"><span class="glyphicon glyphicon-home"></span></a></li>

      <li><a href="<?= base_url('pemberitahuan'); ?>" data-toggle="tooltip" data-placement="bottom" title="Pemberitahuan"><span class="glyphicon glyphicon-bell"></span></a></li>

      <li><a href="<?= base_url('akses/logout'); ?>" data-toggle="tooltip" data-placement="bottom" title="Logout"><span class="glyphicon glyphicon-log-out"></span></a></li>
    </ul>
  </div>
</nav>