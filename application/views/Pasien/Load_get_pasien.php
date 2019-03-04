<div class="panel panel-default">
	<div class="panel-body">
		<table class="table table-responsive">
			<tr>
				<td>No RM</td>
				<td><?php echo $data->no_rm;?></td>
			</tr>
			<tr>
				<td>NIK</td>
				<td><?php echo $data->nik;?></td>
			</tr>
			<tr>
				<td>Nama Pasien</d>
				<td><?php echo $data->nama_pasien;?></td>
			</tr>
		</table>
	</div>
</div>

<input type="hidden" name="no_rm" value="<?php echo $data->no_rm;?>" id="frm-no-rm">