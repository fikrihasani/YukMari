<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\MemberSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Members';
$this->params['breadcrumbs'][] = $this->title;
$i=0;
?>
<div class="member-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<!--
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id_user',
            'username',
            'nama_user',
            'tanggal_lahir',
            'alamat_user:ntext',
            // 'email_user:email',
            // 'password_user',
            // 'jenKel',
            // 'foto_profil',

            [
              'class' => 'yii\grid\ActionColumn',
              'template'    => '{view}&nbsp;&nbsp;{delete}',
              'buttons' => [
                'view' => function ($url, $model){
                  $title = Yii::t('app', 'View Details');
                  $icon = '<span class="glyphicon glyphicon-eye-open"></span>';
                  $url = Url::to(['/admin/member/view','id' => $model->id_user]);
                  return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, ['title' => Yii::t('app', 'View Details'),]);
                },
                'delete' => function ($url, $model){
                  $title = Yii::t('app', 'Set Flag');
                  $icon = '<span class="glyphicons glyphicons-trash"></span>';
                  $url = Url::to(['/admin/default/delete_masukan','id' => $model->id_user]);
                  return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                    'title' => Yii::t('app', 'delete'),
                    'data-confirm' => Yii::t('yii', 'Apakah anda ingin menghapus event ini?'),
                                  'data-method' => 'post',
                    ]);
                }
              ],
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?> -->

<table class="table table-bordered table-striped" id="member" >
  <thead >
      <th>
        No
      </th>
      <th>
        Username
      </th>
      <th>
        Nama
      </th>
      <th>
        Tanggal Lahir
      </th>
      <th>
        Alamat
      </th>
      <th>
        Jumlah Acara
      </th>
      <th>
        Acara yang dilaporkan
      </th>
      <th>
        Komentar yang dilaporkan
      </th>
      <th>
        Acara yang batal
      </th>
      <th style="padding-right : 0px;">

      </th>
  </thead>
  <tbody>
    <?php foreach ($member as $anggota) {
      $laporAcara = 0;
      $laporKomen = 0;
      $batalAcara = 0;
      foreach ($anggota->thread as $thread) {
        if ($thread->batal != 0) {
          $batalAcara++;
        }
        if ($thread->laporan_event != 0) {
          $laporAcara++;
        }
      }
      foreach ($anggota->komentar as $komentar){
        if ($komentar->laporan_komentar != 0) {
          $laporKomen++;
        }
      }
    ?>
    <tr>
      <td>
        <?php echo ++$i;?>
      </td>
      <td>
        <?php echo $anggota->username ?>
      </td>
      <td>
        <?php echo $anggota->nama_user ?>
      </td>
      <td>
        <?php echo $anggota->tanggal_lahir ?>
      </td>
      <td>
        <?php echo $anggota->alamat_user ?>
      </td>
      <td><?php echo count($anggota->thread) ?></td>
      <td>
        <?php if ($laporAcara != 0) {
        ?>
        <b style="color:red"><?php echo $laporAcara ?></b>
      <?php
        }else{
          echo $laporAcara;
        }
      ?>
      </td>
      <td>
        <?php if ($laporKomen != 0) {
        ?>
        <b style="color:red"><?php echo $laporKomen ?></b>
      <?php
        }else{
          echo $laporKomen;
        }
      ?>
      </td>
      <td>
        <?php if ($batalAcara != 0) {
        ?>
        <b style="color:orange"><?php echo $batalAcara ?></b>
      <?php
        }else{
          echo $batalAcara;
        }
      ?>
      </td>
      <td style="padding-right : 0px;">
        <a href="<?php echo Url::to(['view','id'=>$anggota->id_user])?>"><i class="fa fa-eye" style="margin-right : 5px; color : green"></i></a>
      </td>
    </tr>
    <?php
    } ?>
  </tbody>
</table>
</div>
