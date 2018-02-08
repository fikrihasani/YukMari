<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);

$c = Yii::$app->controller->action->id;
$session = Yii::$app->session;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
  <meta charset="<?= Yii::$app->charset ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"> -->
	<!-- <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css"> -->
  <!-- <script   src="https://code.jquery.com/jquery-3.0.0.min.js" integrity="sha256-JmvOoLtYsmqlsWxa7mDSLMwa6dZ9rrIdtrrVYRnDRH0="   crossorigin="anonymous"></script> -->
  <?= Html::csrfMetaTags() ?>
  <title><?= Html::encode($this->title) ?></title>
  <?php $this->head() ?>
<style>

	.footer {
		height: 60px;
		background-color: black;
		border-top: 1px solid #ddd;
		padding-top: 20px;
	}
	.dropdown:hover .dropdown-menu {
		display: block;
	}
	a.back-to-top{
		display: none;
		width: 80px;
		height: 80px;
		/*text-indent: -9999px;*/
		position: fixed;
		z-index: 999;
		right: 20px;
		bottom: 100px;
		background: #27AE61 /*url("../img/up-arrow.png")*/ no-repeat center 43%;
		-webkit-border-radius: 50px;
		-moz-border-radius: 50px;
		border-radius : 50px;
    padding-top : 10px;
		color : white;
		text-align : center;

		box-shadow : 2px 2px 10px black;
	}
  a.back-to-top i{
    font-size : 20pt;
  }
	a:hover.back-to-top {
		background-color: #000;
	}
	.aboutProject{
		display : none;
	}
	</style>
  <!-- <link rel="stylesheet" href="https://npmcdn.com/flickity@1.2/dist/flickity.css">
  <script src="https://npmcdn.com/flickity@1.2/dist/flickity.pkgd.js"></script> -->

</head>
<body style="background-color : #EEEBE9;">
<?php $this->beginBody() ?>
	<div class="wrap">
		<nav class="navbar-inverse navbar"> <!--role="navigation" data-spy="affix" data-offset-top="3"-->
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#w1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="<?php echo Url::to(['/site/index']);?>">
						<span style="color : Orange">Yuk</span><span style="color : white">Mari</span>
					</a>
				</div>
				<div class="collapse navbar-collapse" id="w1">
					<ul  class="navbar-nav nav navbar-right">
						<li <?= ($c=='index') ? 'class="active"' : '' ?>><a href="<?php echo Url::base();?>">Home</a></li>
						<!-- <li <?= ($c=='thread') ? 'class="active"' : '' ?>><a href="<?php echo Url::to(['site/thread']);?>" style="color : Yellow">Yuk! Threads</a></li> -->
						<li <?= ($c=='about') ? 'class="active"' : '' ?>><a href="<?php echo Url::to(['site/about']);?>">Tentang Kami</a></li>
            <?php
            if (Yii::$app->user->isGuest) {
            ?>
              <li <?= ($c=='login') ? 'class="active"' : '' ?>><a href="<?php echo Url::to(['site/logout']);?>">Login</a></li>
            <?php } else { ?>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  <?php
                    $jumBatal = 0;
                      foreach (Yii::$app->user->identity->peserta as $x) {
                        foreach ($x->thread as $acara) {
                          if ($acara->batal) {
                            $jumBatal++;
                          }
                        }
                      }
                    ?>
                    Acara yang batal
                    <?php if ($jumBatal > 0): ?>
                      <span class="badge" style="background-color : orange"><?php echo $jumBatal; ?></span>
                    <?php endif; ?>
                  </a>
                  <ul class="dropdown-menu">
                    <?php
                    if ($jumBatal > 0 ) {
                      foreach (Yii::$app->user->identity->peserta as $x) {
                        foreach ($x->thread as $acara) {
                          if ($acara->batal) {
                    ?>
                    <li><a href="<?php echo Url::to(['member/info_user','id'=>$acara->member->id_user])?>"><b><?php echo $acara->member->nama_user ?></b> membatalkan</a><a href="<?php echo Url::to(['site/lihat_thread','id'=>$acara->id_event]) ?>"><b><?php echo $acara->nama_event ?></b></a></li>
                    <hr>
                    <?php
                          }
                        }
                      }
                    }else{ ?>
                    <li style="padding-left : 5px">Tidak ada acara yang dibatalkan</li>
                    <hr>
                    <li><a href="<?php echo Url::to(['site/all_thread'])?>"><b>Lihat semua acara</b></a></li>
                  <?php  }
                    ?>
                  </ul>
                </li>
             
              <li><a href="<?php echo Url::to(['/member/user','id'=>Yii::$app->user->identity->id_user]);?>">Profil Anda</a></li>
               <li><a href="<?php echo Url::to(['/site/logout']);?>">LogOut</a></li>
            <?php } ?>
					</ul>
				</div>
			</div>
		</nav>
		<div>
			<div class="container">
        <?= Breadcrumbs::widget([
				'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
			]) ?>
			</div>
			<?= $content ?>
		</div>
	</div>
	<footer id="footer" class="top-space">
		<div class="footer1">
			<div class="container">
				<div class="row">
					<div class="col-md-3 widget">
						<h3 class="widget-title">Contact</h3>
						<div class="widget-body">
							<p>024 - 86457472 <br>
								<a href="mailto:#">emailnyasantrendelik@domain.com</a><br>
								<br>
								Jl. Kalialang Lama IX no.44<br>
								Kel. Sukorejo Kec.Gunung Pati<br>
								Semarang Jawa Tengah
							</p>
						</div>
					</div>
					<div class="col-md-3 widget">
						<h3 class="widget-title">Follow me</h3>
						<div class="widget-body">
							<p class="follow-me-icons">
								<a href=""><i class="fa fa-twitter fa-2"></i></a>
								<a href=""><i class="fa fa-dribbble fa-2"></i></a>
								<a href=""><i class="fa fa-github fa-2"></i></a>
								<a href=""><i class="fa fa-facebook fa-2"></i></a>
							</p>
						</div>
					</div>

					<div class="col-md-6 widget">
						<h3 class="widget-title">Text widget</h3>
						<div class="widget-body">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi, dolores, quibusdam architecto voluptatem amet fugiat nesciunt placeat provident cumque accusamus itaque voluptate modi quidem dolore optio velit hic iusto vero praesentium repellat commodi ad id expedita cupiditate repellendus possimus unde?</p>
							<p>Eius consequatur nihil quibusdam! Laborum, rerum, quis, inventore ipsa autem repellat provident assumenda labore soluta minima alias temporibus facere distinctio quas adipisci nam sunt explicabo officia tenetur at ea quos doloribus dolorum voluptate reprehenderit architecto sint libero illo et hic.</p>
						</div>
					</div>
				</div> <!-- /row of widgets -->
			</div>
		</div>
		<div class="footer2">
			<div class="container">
				<div class="row">
					<div class="col-md-6 widget">
						<div class="widget-body">
							<p class="simplenav">
								<a href="<?php echo Url::to(['/site/index']);?>">Home</a> |
								<a href="<?php echo Url::to(['/site/page']);?>">Events</a> |
								<a href="<?php echo Url::to(['/site/about']);?>">About</a> |
								<a href="<?php echo Url::to(['/site/contact']);?>">Contact</a> |
								<b><a href="<?php echo Url::to(['/site/register']);?>">Daftar</a></b>
							</p>
						</div>
					</div>
					<div class="col-md-6 widget">
						<div class="widget-body">
							<p class="text-right">
								Copyright &copy; 2016, SantrenDelik.
							</p>
						</div>
					</div>
				</div> <!-- /row of widgets -->
			</div>
		</div>
	</footer>

  <!-- back-to-top -->
	<a href="#" class="back-to-top"><b><i class="fa fa-arrow-up" aria-hidden="true"></i></b><p>Ke atas</p></a>

  <!-- floating button -->
  <div class="" id="myFunction" style="<?php if(($c != 'user') && ($c != 'index') && ($c != 'all_thread') && ($c != 'lihat_thread')) { echo 'display : none;';} ?>">
    <div class="" id="tombol"  data-toggle="collapse" data-target="#demo" style="<?php
          if(Yii::$app->user->isGuest){
              echo 'display :none;';
          }
          ?>
          cursor:pointer">
      <i class="fa fa-plus-circle" aria-hidden="true" style="font-size : 20pt"></i>
    </div>
    <?php if(!(Yii::$app->user->isGUest)){?>
    <div class="collapse" id="demo">
      <div class="btn-group btn-group-thread">
        <button class="btn btn-primary" ><i class="fa fa-calendar" aria-hidden="true" style="font-size : 14pt" ></i></button>
        <button class="btn btn-primary" onclick="location.href='<?php echo Url::to(['site/create_thread','id'=>Yii::$app->user->identity->id_user]) ?>'">Buat Event</button>
      </div>
      <br>
      <div class="btn-group btn-group-thread">
        <button class="btn btn-info"><i class="fa fa-info" aria-hidden="true" style="font-size : 14pt"></i></button>
        <button class="btn btn-info" onclick="location.href='<?php echo Url::to(['member/user','id'=>Yii::$app->user->identity->id_user]) ?>'">Lihat Event Anda</button>
      </div>
    </div>
    <?php }?>
  </div>

  <!-- modal buat menampilkan Peserta -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="">Peserta Thread</h4>
        </div>
        <div class="modal-body">
  				<div class="" id="peserta_thread">
  				</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
	<?php $this->endBody() ?>
</body>
</html>
<script>
  $(document).ready(function(){
     $('table.display').dataTable();
  });

</script>
<?php $this->endPage() ?>
