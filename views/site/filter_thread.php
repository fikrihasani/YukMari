<?php
  use yii\helpers\Url;
  use yii\helpers\Html;
  use yii\bootstrap\ActiveForm;
  use yii\widgets\Pjax;

  $this->title = 'Thread - '.$kategori->nama_kategori;
  $this->params['breadcrumbs'][] = ['label' => 'Thread', 'url' => ['index']];
  $this->params['breadcrumbs'][] = $this->title;
?>
<style media="screen">
  .filter-konten{
    margin-top: 50px;
  }
</style>
<div class="filter_thread-site">
  <div class="container">
    <div class="filter-header" style="
    background :  linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url(../web/img/kategori/<?php echo $kategori->image_kategori ?>);
    color : white;
    padding : 50px 5px ;
    height : 200px;
    text-align : center;
    font-size : 50px;">
      <?php echo $kategori->nama_kategori ?>
    </div>
    <div class="filter-konten">
      <?php if ($emptyMessage != '') {
      ?>
        <center>
          <h3><?php echo $emptyMessage ?><span style="color : orange; margin-left : 5px"><i class="fa fa-warning"></i></span></h3>
          <!-- <div class="col-lg-offset-2 col-md-offset-2 alert alert-warning"></div> -->
        </center>
      <?php
    } else{
  	  foreach ($data as $threads) {
		if($threads->batal == 0){
      ?>
      <div class="col-md-6 col-sm-12 col-xs-12 col-lg-6">
        <div class="panel panel-default" >
          <div class="panel-heading">
            <img src="<?php echo Url::base()?>/web/img/user/<?php echo $threads->member->foto_profil ?>" alt="<?php echo $threads->member->foto_profil ?>"  class="img-circle" width="40px" height="40px" style="margin-left : 10px; margin-right: 10px"/>
            <a href="<?php echo Url::to(['member/info_user','id'=>$threads->member->id_user])?>" >
              <b style="font-size : 12pt; color : grey">
                <?php echo $threads->member->nama_user ?>
            </a>
                <i class="fa fa-users" style="margin-left : 20px; margin-right : 5px"></i>
                <?php echo count($threads->peserta) ?>
              </b>
          </div>
          <div class="panel-body">
            <div class="col-lg-6 col-md-6">
              <h4><a href="<?php echo Url::to(['site/lihat_thread','id'=>$threads->id_event])?>"><?php echo $threads->nama_event ?></a></h4>
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
                      }else{
                  ?>
                    <a href="daftar_peserta?id_event=<?php echo $threads->id_event ?>"><p>Ingin Mendaftar?</p></a>
                  <?php
                }?>
                <p>
                  <?php if (strlen($threads->konten_event)>100){
                    echo substr(nl2br($threads->konten_event ),0,100)."....";
                  ?>
                  <br>
                  <a href="<?php echo Url::to(['site/lihat_thread','id'=>$threads->id_event])?>">Read More</a>
                  <?php
                  }else{
                    echo nl2br($threads->konten_event );
                  } ?>
                </p>
            </div>
            <div class="col-md-6 col-lg-6">
              <?php if ($threads->gambar_event == null): ?>
                <center>
                  <img src="<?php echo Url::base()?>/web/img/event/blank_event.png" width = "50%" />
                </center>
              <?php endif; ?>
              <?php if ($threads->gambar_event != null): ?>
                <center>
                  <img src="<?php echo Url::base()?>/web/img/event/<?php echo $threads->gambar_event?>" height= "50%" width = "50%" />
                </center>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
      <?php
      }
    }
    } ?>
    </div>
  </div>
</div>
