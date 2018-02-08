<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\data\Pagination;
use yii\widgets\LinkPager;
$this->title = 'Page - Santren Delik';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
	.img1{
		width : 100%;
	}
	p{
		font-size : 14px;
	}
	// .list-event{
		// float : left;
	// }
	// .float-sort{
		// float : right;
	// }
	// .panel-heading a:after {
		// font-family:'Glyphicons Halflings';
		// content:"\e114";
		// float: right;
		// color: white;
	// }
	// .panel-heading a.collapsed:after {
		// content:"\e080";
	// }
	#menuNav {
		display: none;
	}
	@media (max-width: 960px) {
		.panel-group{ display: none; }
		#menuNav { display: inline-block; }
		.float-sort, .list-event{
			float : center;
		}
	}
	.site-page .breadcrumb{
		color : red;
	}
	
</style>
<script>
	
</script>
<div class="site-page">
	<div class="container-fluid">
		<center><h1>Acara SantrenDelik</h1></center>
		<hr>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<center>
				<?php
					echo LinkPager::widget([
						'pagination' => $pages,
					]);
				?>
			</center>
		</div>
		<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 float-sort">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
				<div class="input-group form-group">
					<input type="text" class="form-control" placeholder="Cari Event">
					<span class="input-group-btn"><button class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></button></span>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="panel-group">
					<div class="panel panel-default">
						<div class="panel-heading w3-teal">
							<h4 class="panel-title"><a>Tampil Berdasarkan Bulan : </a></h4>
						</div>
						<ul class="list-group">
							<li class="list-group-item"><a class="linkBulan" href="#">Januari</a></li>
							<li class="list-group-item"><a class="linkBulan" href="#">Februari</a></li>
							<li class="list-group-item"><a class="linkBulan" href="#">Maret</a></li>
							<li class="list-group-item"><a class="linkBulan" href="#">April</a></li>
							<li class="list-group-item"><a class="linkBulan" href="#">Mei</a></li>
							<li class="list-group-item"><a class="linkBulan" href="#">Juni</a></li>
							<li class="list-group-item"><a class="linkBulan" href="#">Juli</a></li>
							<li class="list-group-item"><a class="linkBulan" href="#">Agustus</a></li>
							<li class="list-group-item"><a class="linkBulan" href="#">September</a></li>
							<li class="list-group-item"><a class="linkBulan" href="#">Oktober</a></li>
							<li class="list-group-item"><a class="linkBulan" href="#">November</a></li>
							<li class="list-group-item"><a class="linkBulan" href="#">Desember</a></li>
						</ul>
					</div>
				</div>
			
				<!--Dropdown menu buat kalau layarnya kecil-->
				<center>
					<div class="panel-group" id="menuNav" style="width : 100%">
						<div class="panel panel-default">
							<div class="panel-heading w3-teal">
								<a data-toggle="collapse" href="#subMenu">
									<button class="btn  w3-teal">
										<i class="fa fa-bars" aria-hidden="true"></i> 
									</button>
								</a>
							</div>
							<div class="panel-collapse collapse" id="subMenu">
								<ul class="list-group">
									<li class="list-group-item"><a class="linkBulan" href="#">Januari</a></li>
									<li class="list-group-item"><a class="linkBulan" href="#">Februari</a></li>
									<li class="list-group-item"><a class="linkBulan" href="#">Maret</a></li>
									<li class="list-group-item"><a class="linkBulan" href="#">April</a></li>
									<li class="list-group-item"><a class="linkBulan" href="#">Mei</a></li>
									<li class="list-group-item"><a class="linkBulan" href="#">Juni</a></li>
									<li class="list-group-item"><a class="linkBulan" href="#">Juli</a></li>
									<li class="list-group-item"><a class="linkBulan" href="#">Agustus</a></li>
									<li class="list-group-item"><a class="linkBulan" href="#">September</a></li>
									<li class="list-group-item"><a class="linkBulan" href="#">Oktober</a></li>
									<li class="list-group-item"><a class="linkBulan" href="#">November</a></li>
									<li class="list-group-item"><a class="linkBulan" href="#">Desember</a></li>
								</ul>
							</div>
							<div class="panel-footer w3-blue">Klik tombol " <i class="fa fa-bars" aria-hidden="true"></i> " diatas untuk menampilkan menu</div>
						</div>
					</div>
				</center>
			</div>
		</div>
		<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
		<?php 
			foreach($events as $event){
				?>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="panel panel-default w3-card-12">
						<div class="panel-heading w3-teal">
							<h3><?php echo $event->Judul; ?></h3>
						</div>
						<div class="panel-body">
							<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
							<p>
								<?php
									echo substr($event->Kontent_event,0,500);
								?>
								....<br> <br>
								
							</p>
							</div>
							<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
								<img src="<?= Url::base();?>/img/<?php echo $event->Nama_gambar;?>" alt="<?php echo $event->Nama_gambar;?>" style="" class="img1">
							</div>
						</div>
						<div class="panel-footer">
							<footer class="w3-container">
							<a href="<?php echo Url::to(['/site/view','ID'=>$event->ID_event]);?>"><button class="w3-btn w3-ripple w3-yellow" id="myBtn" style=""><h4>Read More</h4></button></a>
							</footer>
						</div>
						
					</div>
				</div>
				<?php
			}
		?>
		</div>
	</div>
</div>
