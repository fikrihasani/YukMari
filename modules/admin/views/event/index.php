<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\EventSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Events';
$this->params['breadcrumbs'][] = $this->title;
$i = 0;
?>
<div class="event-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<!-- <?php Pjax::begin(); ?>
  <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id_event',
            'nama_event',
            'konten_event:ntext',
            [
                 'attribute' => 'tanggal_event',
                 'format' => ['date', 'php:Y-m-d']
             ],
            'lokasi',
            // 'kategori_event',
            // 'max_user',
            // 'min_user',
            // 'gambar_event',
            // 'user_pembuat',
            // 'jum_peserta',
            // 'tipe',
            // 'kunci_invitasi',

            [
              'class' => 'yii\grid\ActionColumn',
              'template'    => '{view}',
              'buttons' => [
                'view' => function ($url, $model){
                  $title = Yii::t('app', 'View Details');
                  $icon = '<span class="glyphicon glyphicon-eye-open"></span>';
                  $url = Url::to(['/admin/event/view','id' => $model->id_event]);
                  return Html::a('<span class="glyphicon glyphicon-eye-open" style="color : green"></span>', $url, ['title' => Yii::t('app', 'View Details'),]);
                },
              ],
            ],
            [
              'class' => 'yii\grid\ActionColumn',
              'template'    => '{delete}',
              'buttons' => [
                'delete' => function ($url, $model){
                  $title = Yii::t('app', 'Set Flag');
                  $icon = '<span class="glyphicons glyphicons-trash"></span>';
                  $url = Url::to(['/admin/default/delete_masukan','id' => $model->id_event]);
                  return Html::a('<span class="glyphicon glyphicon-trash" style="color : red"></span>', $url, [
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
<div class="alert alert-info">Tanda "<i class="fa fa-info-circle" style="color:blue"></i>" berarti acara tersebut <b>dibatalkan</b>, Tanda "<i class="fa fa-warning" style="color:orange"></i>" berarti acara tersebut <b>dilaporkan</b></div>
<table class="table table-bordered table-striped" id="event">
  <thead >
      <th>
        No
      </th>
      <th>
        Nama Event
      </th>
      <th>
        Tanggal Event
      </th>
      <th>
        Lokasi
      </th>
      <th>
        Pembuat
      </th>
      <th >

      </th>
  </thead>
  <tbody>
    <?php foreach ($model as $event) {
    ?>
    <tr>
      <td>
        <?php echo ++$i;?>
      </td>
      <td>
        <?php echo $event->nama_event ?>
      </td>
      <td>
        <?php echo $event->tanggal_event ?>
      </td>
      <td>
        <?php echo $event->lokasi ?>
      </td>
      <th>
        <a href="<?php echo Url::to(['/admin/member/view','id'=>$event->member->id_user])?>"><?php echo $event->member->nama_user ?></a>
      </th>
      <td style="padding-right : 0px;">
        <a href="<?php echo Url::to(['view','id'=>$event->id_event])?>"><i class="fa fa-eye" style="margin-right : 5px; color : green"></i></a>
        <?php if ($event->batal != 0): ?>
          <i class="fa fa-info-circle" style="margin-left : 5px; color : blue"></i>
        <?php endif; ?>
        <?php if ($event->laporan_event != 0): ?>
          <i class="fa fa-warning" style="margin-left : 5px; color : orange"></i>
        <?php endif; ?>
      </td>
    </tr>
    <?php
    } ?>
  </tbody>
</table>
</div>
