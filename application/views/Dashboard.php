<div class="modal fade" id="modalPasien" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-xl" role="document">
    	<div class="modal-content">
        	<div class="modal-header">
            	<h5 class="modal-title" id="largeModalLabel">Edit Pasien</h5>
	            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	            	<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
            	<div class="fetched-data"></div>
			</div>
            <div class="modal-footer">
            	<button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
        	</div>
        </div>
	</div>
</div>


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

				<div class="panel-heading"><button class="btn btn-info btn-tambah-pasien" title="Tambah Pasien"><svg class="glyph stroked plus sign"><use xlink:href="#stroked-plus-sign"/></svg></button></div>
				<div class="panel-body">
					<div class="row" id='frm-tambah-pasien'>
						<div class="col-lg-6">
							
							<form action="<?php echo site_url('Pasien/insert');?>" method="post" enctype="multipart/form-data">
								
								<div class="form-group">
									<label>No RM</label>
									<input type="text" name="no_rm" value="<?php echo $norm;?>" class="form-control" readonly>
								</div>

								<div class="form-group">
									<label>No ID</label>
									<select class="form-control" name="idjenis" required="">
										
										<?php
											foreach ($jenisid as $key_jenis => $value_jenis) {
												echo "<option value='$value_jenis'> $value_jenis </option>";
											}
										?>

									</select>
								</div>

								<div class="form-group">
									<label>No Identitas</label>
									<input type="text" name="nik" value="" title="Min Max 16 Karakter" class="form-control" pattern=".{16,16}" required="">
								</div>

								<div class="form-group">
									<label>Nama</label>
									<input type="text" name="nama_pasien" value="" class="form-control" pattern=".{3,16}" title="min 3 Karakter" required="">
								</div>

								<div class="form-group">
									<label>Tanggal Lahir</label>
									<input type="date" name="tgl_lahir" value="" class="form-control" max="<?php echo $date;?>" required="">
								</div>

								<div class="form-group">
									<label>Tempat Lahir</label>
									<input type="text" name="tempat_lahir" value="" class="form-control" required="">
								</div>

								<div class="form-group">
									<label>Jenis Kelamin</label><br>
									<input type="radio" name="jk1" value="Laki - laki" checked> Laki - Laki
									<input type="radio" name="jk2" value="Perempuan"> Perempuan
								</div>

								<div class="form-group">
									<label>Domisili</label>
									<input type="text" name="domisili" value="" class="form-control" required="">
								</div>

									<div class="form-group">
									<label>Alamat</label>
									<textarea name="alamat" class="form-control" rows="5" required=""></textarea>
								</div>

								<div class="form-group">
									<input type="submit" class="btn btn-info" value="Tambah Pasien">
								</div>

							</form>

						</div>
					</div>

					<div class="col-md-12">
						<table id="table" class="display table-striped table-bordered" cellspacing="0" width="100%">
							<thead>
								<th>No</th>
								<th>No RM</th>
								<th>Jenis Identitas</th>
								<th>NIk</th>
								<th>Nama</th>
								<th>Tanggal Lahir</th>
								<th>Tanggal Masuk</th>
								<th>Tempat Lahir</th>
								<th>Jenis Kelamin</th>
								<th>Domisili</th>
								<th>Alamat</th>
								<th>Aksi</th>
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