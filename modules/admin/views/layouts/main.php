<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $content string */
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\modules\admin\assets\AdminAsset;
use yii\helpers\Url;

$assets = AdminAsset::register($this);
// $imagePath = $assets->baseUrl.'/img';
// echo $imagePath;
$c = Yii::$app->controller->action->id;
$d = Yii::$app->controller->id;
$pageArr = array($d,"/",$c);
$page =  join($pageArr);
$session = Yii::$app->session;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8"/>
		<?= Html::csrfMetaTags() ?>
		<title><?= Html::encode($this->title) ?></title>
		<?php $this->head() ?>
		<style media="screen">
		</style>
	</head>
	<body class="hold-transition skin-blue sidebar-mini">
	<?php $this->beginBody() ?>
		<div id="wrapper">
			<nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
					<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
							</button>
							<a  class="navbar-brand" href="#">Admin YukMari</a>
					</div>
					<div class="notifications-wrapper">
						<ul class="nav">
							<li class="dropdown">
	            	<a class="dropdown-toggle" data-toggle="dropdown" href="#">
	              	<i class="fa fa-user-plus"></i>  <i class="fa fa-caret-down"></i>
	              </a>
	              <ul class="dropdown-menu dropdown-user">
	              	<!-- <li><a href="#"><i class="fa fa-user-plus"></i> My Profile</a></li> -->
	                <!-- <li class="divider"></li> -->
	                <li><a href="<?php echo Url::to(['/admin/default/logout'])?>"><i class="fa fa-sign-out"></i> Logout</a></li>
	              </ul>
	            </li>
	          </ul>
	        </div>
	      </nav>
				<nav  class="navbar-default navbar-side" role="navigation">
	          <div class="sidebar-collapse">
	            <ul class="nav" id="main-menu">
	              <li>
	                <div class="user-img-div">
	                  <img src="<?php echo $assets->baseUrl ?>/img/default-avatar.png" class="img-circle" />
	                </div>
	              </li>
	              <li><a  href="#"> <strong> ADMIN</strong></a></li>
	              <li><a  <?= ($page=='default/index') ? 'class="active-menu"' : '' ?>  href="<?php echo Url::to(['/admin/default'])?>"><i class="fa fa-dashboard "></i>Dashboard</a></li>
								<li><a <?= ($page=='event/index') ? 'class="active-menu"' : '' ?>  href="<?php echo Url::to(['/admin/event'])?>"><i class="fa fa-calendar "></i>Data Event</a></li>
  							<li><a <?= ($page=='member/index') ? 'class="active-menu"' : '' ?> href="<?php echo Url::to(['/admin/member'])?>"><i class="fa fa-users "></i>Data User</a></li>
		            <li><a href="<?php echo Url::to(['/admin/default/view_laporan'])?>"><i class="fa fa-warning "></i>Semua Laporan</a></li>
	            </ul>
	          </div>
	        </nav>
				<div id="page-wrapper" class="page-wrapper-cls">
					<div id="page-inner">
						<?= $content?>
					</div>
				</div>
			</div>
			<footer >
				&copy; 2016 YukMari
			</footer>
    </div>
    <!-- Main Content -->

	<?php $this->endBody() ?>
	</body>
</html>
<script type="text/javascript">
$(document).ready(function(){
  $('#member').dataTable();
  $('#event').dataTable();
});
</script>
<?php $this->endPage() ?>
