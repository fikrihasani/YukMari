<?php
	$this->title = 'admin - YukMari';
	use yii\helpers\Url;
?>
<style>
  .showbox {
    -webkit-transition: 1s;
    -moz-transition: 1s ;
    -o-transition: 1s ;
    transition: 1s ;
  }
  .showbox.slideright:hover {
    -webkit-transform: translate(0,-3em);
    -moz-transform: translate(0, -3em);
    -o-transform: translate(0, -3em);
    -ms-transform: translate(0, -3em);
    transform: translate(0,-3em);
  }
	.fa-admin-info{
		font-size: 50pt;
		top : auto;
	}
	.panel-admin{
		color : white;
	}
	.panel-admin-blue{
		background-color: blue;
	}
	.panel-admin-yellow{
		background-color: yellow;
	}
	.panel-admin-green{
		background-color: green;
	}
	.panel-admin-warning{
		background-color: red;
	}
</style>
<div class="admin-default-index">
    <center>
		<h1>YukMari - Halaman Admin</h1>
		<p>Selamat Datang Admin web YukMari</p>
	<center>
	<hr>
	<div class="row">
		<div class="col-lg-4 col-md-4 col-xs-4">
			<!-- small box -->
			<div class="panel panel-info panel-admin">
				<div class="panel-body panel-admin-blue">
					<div class="col-md-6 col-lg-6">
						<h3><?php echo count($event);?> Event</h3>
					</div>
					<div class="col-md-6 col-lg-6 panel-admin-footer">
						<i class="fa fa-calendar-o fa-admin-info "></i>
					</div>
				</div>
				<div class="panel-footer">
					<a href="<?php echo Url::to(['/admin/event'])?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
		</div>
		<div class="col-lg-4 col-md-4 col-xs-4">
			<!-- small box -->
			<div class="panel-panel-info panel-admin">
				<div class="panel-body panel-admin-green">
					<div class="col-lg-6 col-md-6">
						<h3><?php echo count($member);?> User</h3>
					</div>
					<div class="co-lg-6 col-md-6">
						<i class="fa fa-users fa-admin-info"></i>
					</div>
				</div>
				<div class="panel-footer">
					<a href="<?php echo Url::to(['/admin/member'])?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
		</div><!-- ./col -->
		<div class="col-lg-4 col-md-4 col-xs-4">
			<!-- small box -->
			<div class="panel panel-info panel-admin">
				<div class="panel-body panel-admin-warning">
					<div class="col-lg-6 col-md-6">
						<h3><?php echo $laporan;?> Laporan</h3>
					</div>
					<div class="co-lg-6 col-md-6">
						<i class="fa fa-warning fa-admin-info"></i>
					</div>
				</div>
				<div class="panel-footer">
					<a href="<?php echo Url::to(['/admin/default/view_laporan'])?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
		</div>
		<div class="col-lg-4 col-md-4 col-xs-4">
			<!-- small box -->
			<div class="panel panel-info panel-admin">
				<div class="panel-body panel-admin-warning">
					<div class="col-md-6 col-lg-6">
						<h3><?php echo count($batal);?> Acara Batal</h3>
					</div>
					<div class="col-md-6 col-lg-6 panel-admin-footer">
						<i class="fa fa-close fa-admin-info "></i>
					</div>
				</div>
				<div class="panel-footer">
					<a href="<?php echo Url::to(['/admin/event'])?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
		</div>
	</div>
</div>
