<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Member */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$i = 0;
?>
<div class="member-view">
  <div class="header row" style="">
    <div class="col-lg-9 col-md-9">
      <table>
        <tr>
          <td>
            <h1><?= Html::encode($this->title) ?></h1>
          </td>
          <td style="padding-left : 20px;">
            <?php if ((count($eventTerlapor) != 0) || (count($komentarTerlapor)!= 0)) {
              ?>
              <button class="btn btn-warning" data-toggle="collapse" data-target="#demo"><i class="fa fa-warning"></i> Member ini memiliki masalah</button>
            <?php } ?>
          </td>
        </tr>
      </table>
      <!-- <b><a href="index">Back to Home</a></b> -->
      <div id="demo" class="collapse">
          <?php if ((count($eventTerlapor) != 0)): ?>
        <div class="alert alert-warning" style ="cursor : pointer" data-toggle="modal" data-target="#ListProblem">
            <strong>Warning!</strong> <?php echo count($eventTerlapor) ?> Event bermasalah
        </div>
          <?php endif ?>
        <div class="alert alert-warning" style ="cursor : pointer" data-toggle="modal" data-target="#ListKomen">
          <?php if ((count($komentarTerlapor)!= 0)): ?>
            <strong>Warning!</strong> <?php echo count($komentarTerlapor) ?> Komentar bermasalah
        </div>
          <?php endif ?>
      </div>
      <hr>
      <p>
          <?= Html::a('Delete', ['delete', 'id' => $model->id_user], [
              'class' => 'btn btn-danger',
              'data' => [
                  'confirm' => 'Are you sure you want to delete this item?',
                  'method' => 'post',
              ],
          ]) ?>
      </p>
      <!-- <?php if (count($eventTerlapor) != 0) {
        ?>
        <p style="color : red; cursor:pointer" data-toggle="modal" data-target="#ListProblem">
          <i class="fa fa-warning"></i> Member ini memiliki masalah
        </p>
      <?php } ?> -->
    </div>
    <div class="col-lg-3 col-md-3">
      <img src="<?php echo Url::base()?>/web/img/user/<?php echo $model->foto_profil?>" alt="<?php echo $model->foto_profil?>" class="img-circle" style="right: 0px" height="300px" width="300px"/>
    </div>
  </div>
  <div class="konten" style="padding-top : 100px;">
    <div class="info-user">
      <table class="table table-striped table-bordered">
        <tr>
          <td>
            Username
          </td>
          <td>
            <?php echo $model->username ?>
          </td>
        </tr>
        <tr>
          <td>
            Nama
          </td>
          <td>
            <?php echo $model->nama_user ?>
          </td>
        </tr>
        <tr>
          <td>
            Tanggal Lahir
          </td>
          <td>
            <?php echo $model->tanggal_lahir ?>
          </td>
        </tr>
        <tr>
          <td>
            Alamat
          </td>
          <td>
            <?php echo $model->alamat_user ?>
          </td>
        </tr>
        <tr>
          <td>
            Email
          </td>
          <td>
            <?php echo $model->email_user ?>
          </td>
        </tr>
        <tr>
          <td>
            Jenis Kelamin
          </td>
          <td>
            <?php
                if ($model->jenKel == 'p') {
                  echo "Pria";
                }else {
                  echo "Wanita";
                }
            ?>
          </td>
        </tr>
        <tr>
          <td>No Kontak</td>
          <td><?php echo $model->hp_user ?></td>
        </tr>
      </table>
    </div>
    <div class="info-event">

      <hr>
      <!--  Acara yang dibatalkan dari user-->
      <h2>Acara yang dibatalkan</h2>
      <?php if (count($eventBatal) == 0) {
      ?>
        <div class="alert alert-success">Tidak ada acara yang dibatalkan</div>
      <?php }else{
        $x = 0
      ?>
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <td>
              No
            </td>
            <td>
              Nama Acara
            </td>
            <td>
              Alasan Dibatalkan
            </td>
            <td>
              Jumlah Peserta
            </td>
            <td>
              Aksi
            </td>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($eventBatal as $batals): ?>
          <tr>
            <td>
              <?php echo ++$x ?>
            </td>
            <td>
              <?php echo $batals->nama_event ?>
            </td>
            <td>
              <?php echo nl2br($batals->alasan_batal); ?>
            </td>
            <td>
              <?php echo count($batals->peserta); ?>
            </td>
            <td>
              <a href="<?php echo Url::to(['/admin/event/view','id'=>$batals->id_event])?>"><i class="fa fa-eye"></i></a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <?php } ?>

      <hr> <!------------------------------------------------>

      <!-- event yang dimiliki -->
      <h2>Acara yang dimiliki</h2>
      <?php if (count($event) == 0) {
      ?>
      <div class="alert alert-info">
        User ini belum membuat acara
      </div>
        <!-- echo "<h4 style='color : orange'></h4>"; -->
      <?php }else {
      ?>

      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <td>
              No
            </td>
            <td>
              Nama Event
            </td>
            <td>
              Konten Event
            </td>
            <td>
              Jumlah Peserta
            </td>
            <td>
              Aksi
            </td>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($event as $events): ?>
            <tr>
              <td>
                <?php echo ++$i ?>
              </td>
              <td>
                <?php echo $events->nama_event ?>
              </td>
              <td>
                <?php echo nl2br($events->konten_event); ?>
              </td>
              <td>
                <?php echo count($events->peserta); ?>
              </td>
              <td>
                <a href="<?php echo Url::to(['/admin/event/view','id'=>$events->id_event])?>"><i class="fa fa-eye"></i></a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <?php } ?>

      <hr> <!------------------------------------------------>

      <!-- event yang diikuti -->
      <h2>Acara yang diikuti </h2>
      <?php
      $i = 0 ;
      if (count($peserta) == 0) {
      ?>
      <div class="alert alert-info">User ini belum mengikuti event/ thread</div>
        <!-- echo "<h4></h4>"; -->
      <?php }else {
      ?>
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <td>
              No
            </td>
            <td>
              Nama Event
            </td>
            <td>
              Konten Event
            </td>
            <td>
              Jumlah Peserta
            </td>
            <td>
              Aksi
            </td>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($peserta as $partisipan) {
            foreach ($partisipan->thread as $ngikut) {
          ?>
          <tr>
            <td>
              <?php echo ++$i ?>
            </td>
            <td>
              <?php echo $ngikut->nama_event ?>
            </td>
            <td>
              <?php echo nl2br($ngikut->konten_event ) ?>
            </td>
            <td>
              <?php echo count($ngikut->peserta) ?>
            </td>
            <td>
              <a href="<?php echo Url::to(['/admin/event/view','id'=>$partisipan->Thread])?>">lihat</a>
            </td>
          </tr>
          <?php
          }
        } ?>
        </tbody>
      </table>
      <?php } ?>
    </div>
  </div>
  <div class="modal fade" id="ListProblem" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header" style="background-color : orange">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="" style="color : white">Event yang dilaporkan</h4>
        </div>
        <div class="modal-body">
          <table class="table table-bordered table-striped">
            <thead>
              <td>
                Nama Event
              </td>
              <td>
                Lokasi Event
              </td>
              <td>
                Konten Event
              </td>
              <td>

              </td>
            </thead>
            <tbody>
              <?php foreach ($eventTerlapor as $reportedEvent) { ?>
              <tr>
                <td>
                  <?php echo $reportedEvent->nama_event ?>
                </td>
                <td>
                  <?php echo $reportedEvent->lokasi ?>
                </td>
                <td>
                  <?php echo $reportedEvent->konten_event ?>
                </td>
                <td>
                  <a href="<?php echo Url::to(['/admin/event/view','id'=>$reportedEvent->id_event]) ?>"><i class="fa fa-eye" style="color : green"></i></a>
                </td>
              </tr>
                <?php  } ?>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="ListKomen" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header" style="background-color : orange">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="" style="color : white">Komentar yang dilaporkan</h4>
        </div>
        <div class="modal-body">
          <table class="table table-bordered table-striped">
            <thead>
              <td>
                Nama Event
              </td>
              <td>
                Konten Komentar
              </td>
              <td>
                Tanggal Komentar
              </td>
            </thead>
            <tbody>
              <?php foreach ($komentarTerlapor as $repKomen) { ?>
              <tr>
                <td>
                  <?php echo $repKomen->thread->nama_event ?>
                </td>
                <td>
                  <?php echo $repKomen->isi_komentar ?>
                </td>
                <td>
                  <?php echo $repKomen->tanggal_komentar ?>
                </td>
              </tr>
                <?php  } ?>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

</div>
