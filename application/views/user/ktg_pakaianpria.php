<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800"><?= $title;?></h1>

	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="<?= base_url('assets/img/slider1.jpg');?>" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="<?= base_url('assets/img/slider2.jpg');?>" class="d-block w-100" alt="...">
    </div>
   
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<br>
	<div class="row text-center">

	<?php foreach ($pria as $p) : ?>

<div class="card" style="width: 16rem;">
  <img src="<?= base_url(). 'assets/img/'. $p['gambar'];?>" class="card-img-top" alt="...">
  <div class="card-body">

    <h5 class="card-title"><?= $p['nama'];?></h5>
    <small class="card-text"><?= $p['keterangan'];?></small><br>
    <span class="badge badge-pill badge-success mb-3">Rp.<?= number_format($p['harga'],0,',','.');?></span>
    <a href="<?= base_url('user/tambah_keranjang/').$p['id'];?>" class="btn btn-sm btn-primary">Tambah ke Keranjang</a>
    <a href="<?= base_url('user/detail_barang/').$p['id'];?>" class="btn btn-sm btn-success">Detail</a>
  </div>
</div>

	<?php endforeach; ?>

	</div>
</div>