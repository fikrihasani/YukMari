<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Event */

$this->title = $model->nama_event." - admin";
$this->params['breadcrumbs'][] = ['label' => 'Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-view">
    <h1><?= Html::encode($model->nama_event) ?></h1>
    <?php if ($model->laporan_event != 0) {
    ?>
    <div class="alert alert-warning">
        <h4><strong><i class="fa fa-warning"></i> Acara ini telah dilaporkan sebanyak <?php echo $model->laporan_event?> kali</strong><h4>
        <?php if ($model->laporan_event >= 5): ?>
          Anda sebaiknya menghapus event ini
        <?php endif; ?>
    </div>
    <?php if ($model->batal == 1){ ?>
      <div class="panel panel-info">
        <div class="panel-heading">
          <h4 class="panel-title"><i class="fa fa-info-circle"></i> Acara ini telah dibatalkan oleh pemiliknya</h4>
        </div>
        <div class="panel-body">
          <h4><b>Alasan Pembatalan</b></h4>
          <hr>
          <p><?php echo $model->alasan_batal ?></p>
        </div>
        <div class="panel-footer">
          <?php echo $model->member->nama_user." : ". $model->member->hp_user ?>
        </div>
      </div>
    <?php } ?>
    <?php
    // echo "<span style='color : red'><b>YA, terlapor sebanyak : ".$model->laporan_event."</b></span>";
    } ?>
    <a href="index"><b>back to home</b></a>
    <hr>
    <p>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_event], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="col-md-6 col-lg-6 col-lg-offset-3 col-md-offset-3 colsm-12 col-xs-12" style="padding-bottom : 50px">
      <?php if ($model->gambar_event != '') {
      ?>
        <img src="<?php echo Url::base()?>/web/img/event/<?php echo $model->gambar_event ?>" alt="<?php echo $model->gambar_event?>" width="100%">
      <?php }else{
      ?>
        <img src="<?php echo Url::base()?>/web/img/event/blank_image.jpg" width="100%">
      <?php
      } ?>

    </div>
    <div class="" style="padding-top : 100px">
      <table class="table table-striped table-bordered" style="">
        <tr>
          <td>
            Nama Event
          </td>
          <td>
            <?php echo $model->nama_event ?>
          </td>
        </tr>
        <tr>
          <td>
            Konten Event
          </td>
          <td>
            <?php echo nl2br($model->konten_event) ?>
          </td>
        </tr>
        <tr>
          <td>
            Tanggal Acara
          </td>
          <td>
            <?php echo $model->tanggal_event ?>
          </td>
        </tr>
        <tr>
          <td>
            Lokasi Acara
          </td>
          <td>
            <?php echo $model->lokasi ?>
          </td>
        </tr>
        <tr>
          <td>
            Kategori
          </td>
          <td>
            <?php echo $model->kategori->nama_kategori ?>
          </td>
        </tr>
        <tr>
          <td>
            Maksimum Jumlah Peserta
          </td>
          <td>
            <?php echo $model->max_user ?>
          </td>
        </tr>
        <tr>
          <td>
            Minimum Jumlah Peserta
          </td>
          <td>
            <?php echo $model->min_user ?>
          </td>
        </tr>
        <tr>
          <td>
            User Pembuat
          </td>
          <td>
            <a href="<?php echo Url::to(['/admin/member/view','id'=>$model->member->id_user])?>"><?php echo $model->member->username ?></a>
          </td>
        </tr>
        <!-- <tr>
          <td>
            Terlapor?
          </td>
          <td>

          </td>
        </tr> -->

      </table>
      <hr>
      <center><h3>Peserta</h3></center>
      <?php $i = 0; if(count($peserta) == 0){
        echo "<h4 style ='text-align : center; color : orange'>Belum ada peserta untuk acara ini</h4>";
      }else {
        ?>
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <td>
                No
              </td>
              <td>
                Username
              </td>
              <td>
                Email
              </td>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($peserta as $partisipan): ?>
              <?php foreach ($partisipan->member as $user): ?>
                <tr>
                  <td>
                    <?php echo ++$i ?>
                  </td>
                  <td>
                    <a href="<?php echo Url::to(['/admin/member/view','id'=>$user->id_user]) ?>"><?php echo $user->username ?></a>
                  </td>
                  <td>
                    <?php echo $user->email_user ?>
                  </td>
                  <!-- <td>
                    <a href="<?php echo Url::to(['/admin/member/view','id'=>$user->id_user]) ?>"><i class="fa fa-eye" style="color : green"></i></a>
                  </td> -->
                </tr>
              <?php endforeach; ?>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php
      } ?>
    </div>

</div>
