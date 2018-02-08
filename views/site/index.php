<?php
use yii\helpers\Html;
use yii\helpers\Url;
// use yii\data\Pagination;
// use yii\widgets\LinkPager;
// $halaman = Url::current();
$this->title = 'YukMari';
// echo $halaman;
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
	  /*width: 30px;
	  height: 30px;
	  border-radius: 5px;*/
	  background: #333;
		/*display: none;*/
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
	.flickity-prev-next-button.previous {
	  left: -50px;
	}
	.flickity-prev-next-button.next {
	  right: -50px;
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
<div class="container">
		<!-- <div class="thread-header">
			<h4>Event Hari Ini
				<i class="fa fa-clock-o header-icon"></i>
			</h4>
		</div> -->
		<div class="gallery js-flickity"
			data-flickity-options='{ "autoPlay": true, "freeScroll": true, "wrapAround": true }'>
			<?php
				$hitung = 0;
				foreach($thread as $threads){
					if ($hitung=='8') {
						break;
					}else{
						if ($threads->batal == 0) {
			?>
			<div class="gallery-cell-cus" style="
				background :  linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url(web/img/event/<?php echo $threads->gambar_event;?>);
				background-size: 100%;
				color : white;
				padding : 20px;
				"
			>
				<center>
					<h4 style="color : white"><?php echo $threads->nama_event ?></h4>
					<p>Lokasi : <?php echo $threads->lokasi ?></p>
					<p>Tanggal : <?php echo $threads->tanggal_event ?> </p>
					<hr>
						<a href="<?php echo Url::to(['site/lihat_thread','id'=>$threads->id_event])?>"><button class="btn btn-default">Lihat</button></a>
					<hr>
					<div class="col-lg-4 col-md-4">
						<p onclick="location.href='<?php
								if(!(Yii::$app->user->isGuest) && (Yii::$app->user->identity->id_user == $threads->member->id_user)){
									echo Url::to(['/member','id'=>$threads->user_pembuat]);
								}else{
									echo Url::to(['/member/info_user','id'=>$threads->user_pembuat]);
								} ?>'" style="cursor:pointer">
							<i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size : 14pt;"></i> <?php echo $threads->member->username; ?>
						</p>
					</div>
					<div class="col-lg-4 col-md-4">
						<p>
							<i class="fa fa-users" aria-hidden="true" style="font-size : 14pt;" ></i>
							Jumlah Peserta : <?php echo count($threads->peserta); ?>
						</p>
					</div>
					<div class="col-lg-4 col-md-4">
						<p>
							<i class="fa fa-comments"></i> Komentar : <?php echo count($threads->komentar) ?>
						</p>
					</div>
				</center>
			</div>
			<?php
						}
					}
				$hitung++;
				}
			 ?>
			 <div class="gallery-cell" >
				 <center>
					 <h3 style="color : white">Lihat Semua Event</h3>
					 <button class="btn btn-default" onclick="location.href='<?php echo Url::to(['site/all_thread'])?>'">Tampilkan</button>
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
							if ($hitung >='5') {
								break;
							}else{
								if ($threads->batal == 0) {
									$hitung++;
							?>
							<div class="">
								<div class="panel panel-default" >
									<div class="panel-heading">
										<img src="web/img/user/<?php echo $threads->member->foto_profil ?>" alt="<?php echo $threads->member->foto_profil ?>"  class="img-circle" width="40px" height="40px" style="margin-left : 10px; margin-right: 10px"/>
										<a href="<?php
										if(!(Yii::$app->user->isGuest) && (Yii::$app->user->identity->id_user == $threads->member->id_user)){
											echo Url::to(['/member','id'=>$threads->user_pembuat]);
										}else{
												echo Url::to(['member/info_user','id'=>$threads->member->id_user]);
										} ?>
									" >
											<b style="font-size : 12pt; color : grey">
												<?php echo $threads->member->nama_user ?>
												<i class="fa fa-arrow-right" style="margin-left : 20px; margin-right : 20px"></i>
											</b>
										</a>
										<a href="#" style="font-size : 12pt;">
											<?php echo $threads->kategori->nama_kategori ?>
										</a>
									</div>
									<div class="panel-body">
										<h4><a href="<?php echo Url::to(['lihat_thread','id'=>$threads->id_event])?>" style="text-decoration:none;"><?php echo $threads->nama_event ?></a></h4>
										<?php if ($threads->batal != 0){ ?>
											<hr>
											<center>
												<h4 style="color : orange">Acara ini telah dibatalkan dengan alasan : </h4>
												<h5><?php echo nl2br($threads->alasan_batal );?></h5>
											</center>
										<?php }else{
										?>
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
													<?php
														if($exist){
															echo "<p style='color : orange'><b>Anda Sudah Terdaftar</b></p>";
														}
												?>
											<p>
												<?php echo nl2br($threads->konten_event); ?>
											</p>
											<?php if ($threads->gambar_event == '') {
											?>
											<center>
												<img src="web/img/event/blank_event.png" width = "50%" />
											</center>
										<?php	}else{ ?>
											<center><img src="web/img/event/<?php echo $threads->gambar_event?>" width = "50%" heigth="50%" /></center>
										<?php } ?>
										<?php
										} ?>
									</div>
									<?php if ($threads->batal == 0): ?>
										<div class="panel-footer">
											<table>
												<tr>
													<td>
															<a href="<?php echo Url::to(['member/info_user','id'=>$threads->member->id_user]) ?>"><i class="fa fa-pencil-square-o"></i>	Made By : <?php echo $threads->member->nama_user ?></a>
													</td>
													<td style="padding-left : 50px">
															<a href="<?php echo Url::to(['site/lihat_thread','id'=>$threads->id_event])?>"> <i class="fa fa-users"></i> Jumlah Peserta : <?php echo count($threads->peserta); ?></button>
													</td>
												</tr>
											</table>
										</div>
									<?php endif; ?>
								</div>
							</div>
					<?php
								}
							}
						}
					 ?>
				</div>
			</div>
			<center>
				<button class="btn btn-default" onclick="location.href='<?php echo Url::to(['site/all_thread'])?>'"><i class="fa fa-plus"></i> Tampilkan Semua Acara</button>
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
						<div class="panel panel-default panel-kategori">
							<div class="panel-body" style="
							background :  linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url(web/img/kategori/<?php echo $category->image_kategori ?>);
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
<!-- <div class="modal fade" id="InputKey" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
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
</div> -->
