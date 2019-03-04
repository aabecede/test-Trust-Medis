<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $title;?></title>

<link href="<?php echo base_url('assets/');?>css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url('assets/');?>css/datepicker3.css" rel="stylesheet">
<link href="<?php echo base_url('assets/');?>css/styles.css" rel="stylesheet">

<!--Icons-->
<script src="<?php echo base_url('assets/');?>js/lumino.glyphs.js"></script>

	<script src="<?php echo base_url('assets/');?>js/jquery-1.11.1.min.js"></script>
	<script src="<?php echo base_url('assets/');?>js/bootstrap.min.js"></script>
	<script src="<?php echo base_url('assets/');?>js/chart.min.js"></script>

	<script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>

	<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
	<script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>
	<link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><span>Trust Medis</span><?php echo $user->status;?></a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> <?php echo $user->nama;?> <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="<?php echo site_url('Login/logout');?>"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
							
		</div><!-- /.container-fluid -->
	</nav>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<ul class="nav menu">
			<li class="active"><a href="<?php echo site_url('Dashboard/');?>"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>
			<?php

				if($user->status == 'loket'){

					echo '<li><a href="'.site_url('rawatjalan').'"><svg class="glyph stroked app window with content"><use xlink:href="#stroked-app-window-with-content"/></svg> Rawat Jalan </a></li>';
				}

			?>
			<!-- <li><a href="<?php echo site_url('admin2/datalogin');?>"><svg class="glyph stroked male user "><use xlink:href="#stroked-male-user"/></svg> Data Login</a></li>
			<li><a href="<?php echo site_url('admin2/PDF');?>"><svg class="glyph stroked notepad "><use xlink:href="#stroked-notepad"/></svg> Data PDF</a></li>
			<li><a href="<?php echo site_url('admin2/daftarkata');?>"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg> Kata Stop Word</a></li> -->
		</ul>

	</div><!--/.sidebar-->