<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active"><?php echo $icon;?></li>
			</ol>
	</div><!--/.row-->
		
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">


				<?php

					$date = date('Y-m-d');
					echo $this->session->flashdata('msg');

					if($user->status == 'loket'){
				?>

				<div class="panel-heading"><button class="btn btn-info btn-tambah-rawat-jalan" title="Tambah Pasien"><svg class="glyph stroked plus sign"><use xlink:href="#stroked-plus-sign"/></svg></button></div>
				<div class="panel-body">
					<div class="row" id='frm-tambah-rawat-jalan'>
						<form action="<?php echo site_url('RawatJalan/insert');?>" method="post" enctype="multipart/form-data">
							<div class="col-lg-6">

								<input type="text" value="" class="" id="search-norm" class="form-control">
								<input type="submit" class="btn btn-info" value="Cari" id="btn-cari-norm">
								<input type="hidden" name="no_dftr" value="<?php echo time();?>">

								<div id="show-pasien"></div>

							</div>
							<div class="col-lg-6">
								
								<form action="<?php echo site_url('Pasien/insert');?>" method="post" enctype="multipart/form-data">
									
									<div class="form-group">
										<label>Pembayaran</label>
										<select class="form-control" name="id_jenis_bayar" required="">
											<?php
												foreach ($pembayaran as $key_pembayan => $value_pembayaran) {
													echo "<option value='$value_pembayaran'>$value_pembayaran</opton>";
												}
											?>
										</select>
									</div>
									<div class="form-group">
										<label>Asuransi</label>
										<input type="text" name="no_asuransi" pattern=".{8,}" title="Min 8 Karakter" required="" class="form-control">
									</div>
									<div class="form-group">
										<label>Penanggung</label>
										<select class="form-control" name="id_penanggung" required="">
											<?php
												foreach ($penanggung as $key_penanggung => $value_penanggung) {
													echo "<option value='$value_penanggung'>$value_penanggung</opton>";
												}
											?>
										</select>
									</div>
									<div class="form-group">
										<label>Poli</label>
										<select class="form-control" name="id_poli" required="">
											<?php
												foreach ($poli as $key_poli => $value_poli) {
													echo "<option value='$value_poli->id'>$value_poli->poli</opton>";
												}
											?>
										</select>
									</div>
									<div class="form-group">
										<label>Kelas</label>
										<select class="form-control" name="id_kelas" required="">
											<?php
												foreach ($kelas as $key_kelas => $value_kelas) {
													echo "<option value='$value_kelas->id'>$value_kelas->kelas</opton>";
												}
											?>
										</select>
									</div>
									<div class="form-group">
										<label>Dokter</label>
										<select class="form-control" name="id_dokter" required="">
											<?php
												foreach ($dokter as $key_dokter => $value_dokter) {
													echo "<option value='$value_dokter->id'>$value_dokter->dokternama</opton>";
												}
											?>
										</select>
									</div>
									<div class="form-group">
										<input type="submit" class="btn btn-info" value="Rawat Jalan" id="btn-rawat-jalan">
									</div>

								</form>

							</div>
						</form>
					</div>

					<div class="col-md-12">
						<table id="table-rawat" class="display table-striped table-bordered" cellspacing="0" width="100%">
							<thead>
								<th>No</th>
								<th>No Daftar</th>
								<th>No RM</th>
								<th>Jenis Bayar</th>
								<th>Asuransi</th>
								<th>Penanggung</th>
								<th>Kelas</th>
								<th>Poli</th>
								<th>Dokter</th>
							</thead>
						</table>
					</div>
				</div>

				<?php
					}
				?>

			</div>
		</div>
	</div><!--/.row-->
</div>