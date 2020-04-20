<div class="container-fluid">
	<h1 class="h3 mb-4 text-gray-800"> <?= $title; ?></h1>
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="btn btn-sm btn-primary">
				<?php 
					$grand_total = 0;
					if($keranjang = $this->cart->contents()){
						foreach ($keranjang as $item) {
							$grand_total = $grand_total + $item['subtotal'];
						}
						
					
					echo "<h4>Total Belanja Anda: Rp.".number_format($grand_total,0,',','.');
				 ?>
		</div><br><br>
		<h3 class="h5 mb-4 text-gray-800">Input Alamat Pengiriman dan Pembayaran</h3>
		<form action="<?= base_url('User/proses_pemesanan');?>" method="post">
			
			<div class="form-group">
				<label>Nama</label>
				<input type="text" name="nama" placeholder="Nama Lengkap Anda" 
				class="form-control">
				</div>

			<div class="form-group">
				<label>Alamat</label>
				<input type="text" name="alamat" placeholder="Alamat Lengkap Anda" 
				class="form-control">
				</div>

			<div class="form-group">
				<label>Telepon</label>
				<input type="text" name="telepon" placeholder="Nomer Telepon Anda" 
				class="form-control">
				</div>

			<div class="form-group">
				<label>Jasa Pengiriman</label>
				<select class="form-control" name="jaskir">
					<option>JNE</option>
					<option>TKI</option>
					<option>POS Indonesia</option>


				</select>
				</div>

			<div class="form-group">
				<label>Pilih Bank</label>
				<select class="form-control" name="bank">
					<option>BCA - XXXXXXX</option>
					<option>BRI - XXXXXXX</option>
					<option>MANDIRI - XXXXXXX</option>
					

				</select>
				</div>
			<button type="submit" class="btn btn-sm btn-success">Pesan</button>
		</form>
		
		<?php
			}else{
				echo "<h3>Keranjang Anda Masih Kosong</h3>";
			}?>


		<div class="col-md-2"></div>
	</div>
</div>