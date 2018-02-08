<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = 'YukMari';
?>
	<style>
		.container-fluid{
			padding : 0px;
		}
		#fitur .panel-default{
			/*box-shadow: 5px 5px 5px grey;*/
		}
	</style>
<div class="site-index">
		<div class="container">
			<div id="headTop" class="col-lg-12 col-sm-12 col-xs-12 col-md-12" style="padding : 0px 50px;">
				<div style="color : white; border-bottom : 5px solid white; padding-bottom : 20px; margin-bottom : 20px;">
					<h2><span style="color : orange">Yuk</span><span style="color : white">Mari</span> <small style="font-size : 20pt">Apa itu?</small></h2>
				</div>
				<p style="color : white; font-size : 15pt; margin-top : 50px;">
					YukMari merupakan sebuah web yang bertujuan untuk mendekatkan : <br>
					Para pihak event organizer, baik itu dalam bentuk liburan, pentas seni, holiday travel, ataupun hanya mengajak kerabat dekat
					dengan Khalayak ramai, pihak-pihak yang ingin mengikuti acara, ataupun siapa saja yang ingin mencari kegiatan terbuka.
				</p>
			</div>
		</div>
		<div id="coba"></div>
    <div class="body-content container-fluid">
		<div id="fitur">
			<div class="container">
				<div class="col-lg-4">
					<div class="panel panel-default">
						<div class="panel-body">
							<center>
								<span class="fa-stack fa-3x">
									<i class="fa fa-circle fa-stack-2x" style="color : green"></i>
									<i class="fa fa-calendar fa-stack-1x fa-in"></i>
								</span>
							</center>
							<br>
							<h3 class="contactme"><b>Buat Event yang kamu mau!</b></h3>
							<p class="contactme">Kamu bisa membuat event, mengajak orang, menentukan tanggal, dan sebagainya</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="panel panel-default">
						<div class="panel-body">
							<center>
								<span class="fa-stack fa-3x">
									<i class="fa fa-circle fa-stack-2x" style="color : #ff9933"></i>
									<i class="fa fa-comments-o fa-stack-1x fa-in"></i>
								</span>
							</center>
							<br>
							<h3 class="contactme"><b>Jadi Peserta Acara </b></h3>
							<p class="contactme">Daftar, berikan komentar disetiap thread, ataupun berita, ikuti diskusi terkait event tersebut</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="panel panel-default">
						<div class="panel-body">
							<center>
								<span class="fa-stack fa-3x">
									<i class="fa fa-circle fa-stack-2x" style="color : #6666ff"></i>
									<i class="fa fa-users fa-stack-1x fa-in"></i>
								</span>
							</center>
							<br>
							<h3 class="contactme"><b>Masuk kedalam komunitas terunik!</b></h3>
							<p class="contactme">Buat, kembangkan, dan kelola komunitasmu!</p>
						</div>
						</div>
				</div>
			</div>
		</div>
<!-- 		<div class="container">
			<div class="col-lg-12 col-md-12">
				<div class="panel panel-default">
						<div class="panel-body">
							<div class="col-lg-8 col-md-8 col-md-offset-2 ">
								<center><button type="button" name="button" class="btn btn-primary btn-lg" style="width : 100%" onclick="location.href='<?php echo Url::to(['/site/index']);?>'">Masuk!</button></center>
							</div>
						</div>
				</div>
			</div>
		</div> -->
	</div>
</div>

<!-- bikin tombol back to top -->
