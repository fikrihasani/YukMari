<?php
use yii\helpers\Url;
$i=0;
 ?>
<style media="screen">
  #info-header{
    background: linear-gradient(white,grey);
  }
</style>
<div class="site-user">
  <div class="container">
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
      <div class="panel panel-default" id="info-header">
        <div class="panel-body">
          <?php if (($data->foto_profil == '') || ($data->foto_profil == null)){
              if ($data->jenKel == 'p') { ?>
                <center>
                  <img src="<?= Url::base();?>/web/img/user/user_woman.jpg" alt="action.jpg" width="400px" height="400px" style="padding: 20px" class="img-circle">
                </center>
          <?php }else{ ?>
            <center>
              <img src="<?= Url::base();?>/web/img/user/user_man.jpg" alt="action.jpg" width="400px" height="400px" style="padding: 20px" class="img-circle">
            </center>
          <?php  }
        }else{ ?>
          <center>
            <img src="<?= Url::base();?>/web/img/user/<?php echo $data->foto_profil ?>" alt="action.jpg" width="400px" height="400px" style="padding: 20px" class="img-circle">
          </center>
        <?php } ?>
        </div>
      </div>
    </div>
    <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title">Informasi User</h3>
        </div>
        <div class="panel-body">
            <table style="" class="table">
              <tr>
                <td>Nama</td>
                <td>:</td>
                <td><?php echo $data->nama_user ?></td>
              </tr>
              <tr>
                <td>Tanggal Lahir</td>
                <td>:</td>
                <td><?php echo $data->tanggal_lahir ?></td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><?php echo $data->alamat_user ?></td>
              </tr>
              <tr>
                <td>email</td>
                <td>:</td>
                <td><?php echo $data->email_user ?></td>
              </tr>
              <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td><?php if ($data->jenKel=="p") {
                  echo "Pria";
                }else {
                  echo "Wanita";
                }?></td>
              </tr>
              <tr>
                <td>No Handphone</td>
                <td>:</td>
                <td><?php echo $data->hp_user ?></td>
              </tr>
            </table>
        </div>
        <div class="panel-footer">

        </div>
      </div>
    </div>
    <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12">
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title">Thread yang dimiliki</h3>
        </div>
        <div class="panel-body">
          <table class="table table-striped table-bordered display" id="">
            <thead>
              <tr>
                <td>No</td>
                <td>Nama</td>
                <td>Lokasi</td>
                <td>Tanggal</td>
                <td></td>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($thread as $threads) {
                $i++;?>
                <tr>
                  <td>
                    <?php echo $i; ?>
                  </td>
                  <td>
                    <?php echo $threads->nama_event; ?>
                  </td>
                  <td>
                    <?php echo $threads->lokasi; ?>
                  </td>
                  <td>
                    <?php echo $threads->tanggal_event; ?>
                  </td>
                  <td>
                    <a href="<?php echo Url::to(['site/lihat_thread','id'=>$threads->id_event])?>"><i class="fa fa-question fa-2x"></i></a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
            </table>
        </div>
      </div>
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Thread yang diikuti</h3>
        </div>
        <div class="panel-body">
          <table class="table table-striped table-bordered display" id="">
            <thead>
              <tr>
                <td>No</td>
                <td>Nama</td>
                <td>Lokasi</td>
                <td>Tanggal</td>
                <td></td>
              </tr>
            </thead>
            <tbody>
              <?php
                $i=0;
                foreach ($peserta as $partisipan) {
                  $i++;
                  foreach ($partisipan->thread as $ngikut) {
                  ?>
                  <tr>
                    <td>
                      <?php echo $i; ?>
                    </td>
                    <td>
                      <?php echo $ngikut->nama_event ?>
                    </td>
                    <td>
                      <?php echo $ngikut->lokasi ?>
                    </td>
                    <td>
                      <?php echo $ngikut->tanggal_event ?>
                    </td>
                    <td>
                      <a href="<?php echo Url::to(['site/lihat_thread','id'=>$ngikut->id_event])?>"><i class="fa fa-question fa-2x"></i></a>
                    </td>
                  </tr>
                  <?php
                  }
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
</div>
