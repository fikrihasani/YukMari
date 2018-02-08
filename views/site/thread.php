<?php
use yii\helpers\Html;
use yii\helpers\Url;
// use yii\data\Pagination;
// use yii\widgets\LinkPager;
$this->title = 'Thread - YukMari';
$this->params['breadcrumbs'][] = $this->title;
?>
<style media="screen">

	.gallery {
	  /*background: #EEE;*/
		margin-bottom: 50px;
	}

	.gallery-cell {
	  width: 50%;
	  height: 300px;
	  margin-right: 10px;
		/*color: #b2dbfb;*/
	  /*background: #8C8;*/
	  background: #2196f3;
	  /*counter-increment: gallery-cell;*/
	}
	.gallery-cell-cus{
		width: 50%;
		height: 300px;
		margin-right: 10px;
		counter-increment: gallery-cell;
	}
	.thread-header{
		/*border-bottom : solid 2px #4d4d4d;*/
		padding : 2px 10px;
		background-color: #2196f3;
		margin-bottom : 20px;
	}
	.thread-header h4{
		color: #b2dbfb;
		left : 0px;
	}
	.thread-header .header-icon{
		float : right;
	}
	.flickity-page-dots {
	  bottom: -22px;
	}
	/* dots are lines */
	.flickity-page-dots .dot {
	  height: 4px;
	  width: 40px;
	  margin: 0;
	  border-radius: 0;
	}
	.container-custom{
		background-color: white;
		padding-left: 50px;
	}
	.flickity-prev-next-button {
	  width: 30px;
	  height: 30px;
	  border-radius: 5px;
	  background: #333;
		display: none;
	}
	.flickity-prev-next-button:hover {
	  background: #F90;
	}
	/* arrow color */
	.flickity-prev-next-button .arrow {
	  fill: white;
	}
	.flickity-prev-next-button.no-svg {
	  color: white;
	}
	/* position outside */
	/*.flickity-prev-next-button.previous {
	  left: -40px;
	}
	.flickity-prev-next-button.next {
	  right: -40px;
	}*/

}
</style>
<div class="site-thread">
	<!-- slide show event -->
	<div class="container-fluid">
		<div class="thread-header">
			<h4>Event Hari Ini
				<i class="fa fa-clock-o header-icon"></i>
			</h4>
		</div>
		<div class="gallery js-flickity"
			data-flickity-options='{ "autoPlay": true, "freeScroll": true, "wrapAround": true }'>
			<!-- <div class="gallery-cell" >
				<center>
					<h3 style="color : white">Event Untuk Hari Ini</h3>
					<h5 style="color : white">
						ada <?php echo count($thread) ?> event yang bisa kamu ikuti
					</h5>
				</center>
			</div> -->
			<?php
				$hitung = 0;
				foreach($thread as $threads){
					if ($hitung=='8') {
						break;
					}else{

			?>
			<div class="gallery-cell-cus" style="
				background :  linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url(../img/<?php echo $threads->gambar_event;?>);
				color : white;
				padding : 20px;
				"
			>
				<center>
					<h4 style="color : white"><?php echo $threads->nama_event ?></h4>
					<p>Lokasi : <?php echo $threads->lokasi ?></p>
					<p>Tanggal : <?php echo $threads->tanggal_event ?> </p>
					<hr>
					<table>
						<tr style="text-align : center">
							<td style="width : 50%">
								<a href="#"><button class="btn btn-default">Ingin Mendaftar?</button></a>
							</td>
							<td style="width : 50%;">
								<a href="<?php echo Url::to(['site/lihat_thread','id'=>$threads->id_event])?>"><button class="btn btn-default">Lihat</button></a>
						</tr>
					</table>
				</td>
					<hr>
					<div class="col-lg-4 col-md-4">
						<p onclick="location.href='<?php echo Url::to(['site/info_user','id'=>$threads->user_pembuat]) ?>'" style="cursor:pointer">
							<i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size : 14pt;"></i> Dibuat oleh :<?php echo $threads->user->nama_user; ?>
						</p>
					</div>
					<div class="col-lg-4 col-md-4">
						<p data-toggle="modal" data-target="#myModal" style="cursor:pointer">
							<i class="fa fa-users" aria-hidden="true" style="font-size : 14pt;" ></i>
							Jumlah Peserta : <?php echo count($threads->user); ?>
						</p>
					</div>
					<div class="col-lg-4 col-md-4">
						<p style="cursor:pointer">
							<i class="fa fa-comments"></i> Komentar : <?php echo count($threads->komentar) ?>
						</p>
					</div>
				</center>
			</div>
			<?php
					}
				$hitung++;
				}
			 ?>
			 <div class="gallery-cell" >
				 <center>
					 <h3 style="color : white">Lihat Semua Event</h3>
					 <button class="btn btn-default" onclick="location.href='all_thread'">Tampilkan</button>
				 </center>
			 </div>
		</div>
	</div>

	<!-- non slideshow -->
	<div class="container" style="padding-bottom : 20px">
		<div class="col-lg-8 col-md-8" style="padding-right : 50px">
			<div class="row" >
				<div class="thread-header">
					<h4 style="">Semua Event
						<!-- <button class="btn btn-info" style="float : right"> Semua  <i class="fa fa-plus"></i></button> -->
					</h4>
				</div>
				<div>
					<?php
						$hitung = 0;
						foreach($thread as $threads){
							if ($hitung=='10') {
								break;
							}else{
					?>
					<div class="">
						<div class="panel panel-default" >
							<div class="panel-heading">
								<img src="<?php echo Url::base()?>/img/user/<?php echo $threads->user->foto_profil ?>" alt="<?php echo $threads->user->foto_profil ?>"  class="img-circle" width="40px" height="40px" style="margin-left : 10px; margin-right: 10px"/>
								<a href="<?php echo Url::to(['site/info_user','id'=>$threads->user->id_user])?>" >
									<b style="font-size : 12pt; color : grey">
										<?php echo $threads->user->nama_user ?>
										<i class="fa fa-arrow-right" style="margin-left : 20px; margin-right : 20px"></i>
									</b>
								</a>
								<a href="#" style="font-size : 12pt;">
									<?php echo $threads->kategori->nama_kategori ?>
								</a>
							</div>
							<div class="panel-body">
								<h4><?php echo $threads->nama_event ?></h4>
								<?php
									$exist = FALSE;
									if (!(Yii::$app->user->isGuest)) {
										$user = Yii::$app->user->identity->id_user;
										foreach ($threads->peserta as $peserta) {
											if($peserta->User == $user){
												$exist = true;
											}
										}
									}

								?>
								<table class="">
									<tr>
										<td>kategori</td>
										<td>:</td>
										<td>
											<?php echo $threads->kategori->nama_kategori ?>
										</td>
									</tr>
									<tr>
										<td>Lokasi</td>
										<td>:</td>
										<td>
											<?php echo $threads->lokasi ?>
										</td>
									</tr>
									<tr>
										<td>Tanggal</td>
										<td>:</td>
										<td>
											<?php echo $threads->tanggal_event ?>
										</td>
									</tr>
								</table>
								<hr>
								<a href="<?php echo Url::to(['site/lihat_thread','id'=>$threads->id_event])?>" style="float : right">Lihat dulu</a>
											<?php
												if($exist){
													echo "<p style='color : orange'><b>Anda Sudah Terdaftar</b></p>";
												}else{
													if ($threads->tipe == 'privat') {
											?>
												<a href="#InputKey" data-toggle="modal"><p>Ingin Mendaftar?</p></a>
										<?php
											}else{
										?>
											<a href="daftar_peserta?id_event=<?php echo $threads->id_event ?>"><p>Ingin Mendaftar?</p></a>
										<?php	}
									}?>
									<p>
										<?php echo $threads->konten_event ?>
									</p>
									<img src="<?php echo Url::base()?>/img/<?php echo $threads->gambar_event?>" width = "100%" />
							</div>
							<div class="panel-footer">
								<table>
									<tr>
										<td>
												<a href="<?php echo Url::to(['site/info_user','id'=>$threads->user->id_user]) ?>"><i class="fa fa-pencil-square-o"></i>	Made By : <?php echo $threads->user->nama_user ?></a>
										</td>
										<td style="padding-left : 50px">
												<a href="<?php echo Url::to(['site/lihat_thread','id'=>$threads->id_event])?>"> <i class="fa fa-users"></i> Jumlah Peserta : <?php echo count($threads->peserta); ?></button>
										</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
					<?php
							}
						$hitung++;
						}
					 ?>

				</div>
			</div>
			<center>
				<button class="btn btn-default" onclick="location.href='all_thread'"><i class="fa fa-plus"></i> Tampilkan Semua Thread</button>
			</center>
		</div>
	<div class="col-lg-4 col-md-4">
		<div class="row">
			<div class="thread-header">
				<h4>Kategori
					<i class="fa fa-paperclip header-icon"></i>
				</h4>
			</div>
			<div class="">
				<?php foreach ($kategori as $category): ?>
					<a href="<?php echo Url::to(['site/filter_thread','id'=>$category->id_kategori]) ?>">
						<div class="panel panel-default">
							<div class="panel-body" style="
							background :  linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url(../img/kategori/<?php echo $category->image_kategori ?>);
							color : white;
							">
								<?php echo $category->nama_kategori ?>
							</div>
						</div>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
	</div>

	</div>
</div>

<!-- modal -->
<div class="modal fade" id="InputKey" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="">Masukkan Kunci Rahasia</h4>
      </div>
      <div class="modal-body">
				<div class="" id="peserta_thread">
					<form class="form-horizontal" action="cek_kunci" method="post">
						<input type="text" name="kunci" value="" class="form-control">
						<br>
						<button type="submit" name="button" class="btn btn-success">Submit</button>
					</form>
				</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
