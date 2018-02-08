<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\MaskedInput;

$this->title = 'Contact - Santren Delik';
$this->params['breadcrumbs'][] = $this->title;

?>
<style>
	.detail .col-lg-3{
		height : 250px;
		border-bottom : 1px solid #cccccc;
		padding-top : 20px;
		background-color : white;
	}
	@media screen and (min-width:768px){
		.detail .col-lg-3{
			height : 300px;
			border-right : 1px solid #cccccc;
		}
		#col-one{
			border-left : 1px solid #cccccc;
		}
	}
	.container-fluid{
		padding : 0px;
	}
	.headerForm{
		border-bottom : 5px solid grey;
		width: 50%;
		padding-bottom : 20px;
	}
	.headerForm1{
		border-bottom : 5px solid green;
		width: 50%;
		padding-bottom : 20px;
	}
</style>
<div class="site-contact ">
		<div class="detail container-fluid">
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="col-one">
				<center>
					<span class="fa-stack fa-3x" id="one">
						<i class="fa fa-circle fa-stack-2x"></i>
						<i class="fa fa-phone fa-stack-1x fa-in"></i>
					</span>
				</center>
				<br>
				<p class="contactme"><b>Hubungi Kami</b></p>
				<p class="contactme">024 - 86457472</p>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
				<center>
					<span class="fa-stack fa-3x" id="two">
						<i class="fa fa-circle fa-stack-2x "></i>
						<i class="fa fa-envelope fa-stack-1x fa-in"></i>
					</span>
				</center>
				<p class="contactme"><b>Alamat Email</b></p>
				<p class="contactme">example@email.com</p>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
				<center>
					<span class="fa-stack fa-3x" id="three">
						<i class="fa fa-circle fa-stack-2x "></i>
						<i class="fa fa-map-marker fa-stack-1x fa-in"></i>
					</span>
				<center><br>
				<p class="contactme"><b>Lokasi Kami</b></p>
				<p class="contactme">Jl. Kalialang Lama IX no.44<br>Kel. Sukorejo Kec.Gunung Pati<br>Semarang Jawa Tengah</p>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
				<center>
					<span class="fa-stack fa-3x" id="four">
						<i class="fa fa-circle fa-stack-2x "></i>
						<i class="fa fa-clock-o fa-stack-1x fa-in"></i>
					</span>
					<center><br>
					<p class="contactme"><b>Jam Kerja?</b></p>
					<p class="contactme"><i>Tidak Tentu</i><br>Bisa hubungi terlebih dahulu<br><strong>Minggu Libur.</strong></p>
			</div>
		</div>
	<div class="container">
		<hr>
		<div class="row entry-form">
			<?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>
			<div class="alert alert-success" id="alert">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<center><strong>Thank you</strong> for contacting us. We will respond to you as soon as possible.</center>
			</div>
			<?php endif; ?>  
			 
			<center><h2 class="headerForm"><b>Berikan Kami Masukan</b></h2></center>
			<hr>
				<div>
					<?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
						<div class="col-lg-6">
							<?= $form->field($model, 'Nama')->textInput(['placeholder'=>'Your Name'])->label(false) ?>
						</div>
						<div class="col-lg-6">
							<?= $form->field($model, 'Email')->widget(MaskedInput::classname(), [ 
								'name' => 'email',
								'clientOptions' => [
									'alias' =>  'email'
									],
								])->label(false); 
							?>
						</div>
						<div class="col-lg-12">
							<?= $form->field($model, 'Subjek')->textInput(['placeholder'=>'subject'])->label(false) ?>
						</div>
						<div class="col-lg-12">
							<?= $form->field($model, 'Konten')->label(false)->textArea(['rows' => 6, 'placeholder'=>'Message']) ?>
						</div>
						<div class=" form-group col-lg-12">
							<?= Html::submitButton('Kirim Masukan', ['class' => 'btn btn-lg btn-success btn-submit', 'name' => 'contact-button']) ?>
						</div>
					<?php ActiveForm::end(); ?>
				</div>
			</div>
		<script src='https://maps.googleapis.com/maps/api/js?v=3.exp'></script>
	</div>
<!--Google maps-->
	<hr>
	<div style='overflow:hidden;height:500px; '>
		<center><h2 class="headerForm1"><b>Our Location</b></h2></center>
		<hr>
		<div id='gmap_canvas' style='height:500px;'></div>
		<div>
			<small>
				<a href="http://embedgooglemaps.com">embed google maps</a>
			</small>
		</div>
		<div>
			<small>
				<a href="https://disclaimergenerator.net">disclaimer generator</a>
			</small>
		</div>
		<style>#gmap_canvas img{max-width:none!important;background:none!important}</style>
	</div>
	<script type='text/javascript'>
		function init_map(){
			var myOptions = {
				zoom:10,center:new google.maps.LatLng(-7.031423611300674,110.37888776071327),mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);
			marker = new google.maps.Marker({
				map: map,position: new google.maps.LatLng(-7.031423611300674,110.37888776071327)
			});
			infowindow = new google.maps.InfoWindow({
				content:'<strong>SantrenDelik</strong><br>Jl. Kalialang Lama IX No.44, Sukorejo, Gn. Pati, Kota Semarang, Jawa Tengah<br>'
			});
			google.maps.event.addListener(marker, 'click', function(){infowindow.open(map,marker);});infowindow.open(map,marker);
		}
		google.maps.event.addDomListener(window, 'load', init_map);
	</script>
<!--kontak kontaknya-->
	<div class="container-fluid">
		<a href="https://www.facebook.com/santrendelik">
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 sosmed" id="fb">
				<center>
					<i class="fa fa-facebook-official"></i>
					<p class="con-text">Like Us on Facebook</p>
				</center>
			</div>
		</a>
		<a href="https://twitter.com/santrendelik">
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 sosmed" id="tw">
				<center>
					<i class="fa fa-twitter"></i>
					<p class="con-text">Follow Us on Twitter</p>
				</center>
			</div>
		</a>
		<a href="http://santrendelik.org">
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 sosmed" id="blog">
				<center>
					<i class="fa fa-globe"></i>
					<p>Ikuti Berita terbaru Kami di web</p>
				</center>
			</div>
		</a>
		<a href="https://plus.google.com/+santrendelik">
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 sosmed" id="gplus">
				<center>
					<i class="fa fa-google-plus"></i>
					<p>Add Us into Your Circle on Google+</p>
				</center>
			</div>
		</a>
		<a href="https://youtube.com/santrendelik">
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 sosmed" id="yb">
				<center>
					<i class="fa fa-youtube"></i>
					<p>Lihat hasil dokumentasi acara kami hanya di Youtube</p>
				</center>
			</div>
		</a>
		<a href="https://instagram.com/santrendelik">
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 sosmed" id="ig">
				<center>
					<i class="fa fa-instagram"></i>
					<p>Lebih dekat dengan aktivitas kami di instagram</p>
				</center>
			</div>
		</a>
	</div>
</div>