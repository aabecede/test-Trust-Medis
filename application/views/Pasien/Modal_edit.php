<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active"><?php echo $icon;?></li>
			</ol>
	</div><!--/.row-->
	<div class="panel panel-default">
		<div class="panel-heading"><h5></h5></div>
		<div class="panel-body">
			<form action="<?php echo site_url('Pasien/update/'.$data->no_rm);?>" method="post" enctype="multipart/form-data">
								
				<div class="form-group">
					<label>No RM</label>
					<input type="text" name="no_rm" value="<?php echo $data->no_rm;?>" class="form-control" readonly>
				</div>

				<div class="form-group">
					<label>No ID</label>
					<select class="form-control" name="idjenis" required="">
													
						<?php

						$date = date('Y-m-d');

							echo "<option value_jenis='$data->idjenis'> $data->idjenis</option>";

							foreach ($jenisid as $key_jenis => $value_jenis) {

								if($data->idjenis != $value_jenis){
								
									echo "<option value='$value_jenis'> $value_jenis </option>";	

								}
								
							}
						?>

					</select>
				</div>

				<div class="form-group">
					<label>No Identitas</label>
					<input type="text" name="nik" value="<?php echo $data->nik;?>" title="Min Max 16 Karakter" class="form-control" pattern=".{16,16}" required="">
				</div>

				<div class="form-group">
					<label>Nama</label>
					<input type="text" name="nama_pasien" value="<?php echo $data->nama_pasien;?>" class="form-control" pattern=".{3,16}" title="min 3 Karakter" required="">
				</div>

				<div class="form-group">
					<label>Tanggal Lahir</label>
					<input type="date" name="tgl_lahir" value="<?php echo $data->tgl_lahir;?>" class="form-control" max="<?php echo $date;?>" required="">
				</div>

				<div class="form-group">
					<label>Tempat Lahir</label>
					<input type="text" name="tempat_lahir" value="<?php echo $data->tempat_lahir;?>" class="form-control" required="">
				</div>

				<div class="form-group">
					<label>Jenis Kelamin</label><br>
					<?php
						if($data->jenis_kelamin = 'Laki - laki'){

							echo '<input type="radio" name="jk1" value="Laki - laki" checked> Laki - Laki';
							echo '<input type="radio" name="jk2" value="Perempuan"> Perempuan';

						}else{

							echo '<input type="radio" name="jk1" value="Laki - laki"> Laki - Laki';
							echo '<input type="radio" name="jk2" value="Perempuan" checked> Perempuan';

						}
					?>
					
				</div>

				<div class="form-group">
					<label>Domisili</label>
					<input type="text" name="domisili" value="<?php echo $data->domisili;?>" class="form-control" required="">
				</div>

					<div class="form-group">
					<label>Alamat</label>
					<textarea name="alamat" class="form-control" rows="5" required=""><?php echo $data->alamat;?></textarea>
				</div>

				<div class="form-group">
					<input type="submit" class="btn btn-info" value="Edit Pasien">
				</div>

			</form>
		</div>
	</div>
</div>