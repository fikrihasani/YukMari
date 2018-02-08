<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\EventSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_event') ?>

    <?= $form->field($model, 'nama_event') ?>

    <?= $form->field($model, 'konten_event') ?>

    <?= $form->field($model, 'tanggal_event') ?>

    <?= $form->field($model, 'lokasi') ?>

    <?php // echo $form->field($model, 'kategori_event') ?>

    <?php // echo $form->field($model, 'max_user') ?>

    <?php // echo $form->field($model, 'min_user') ?>

    <?php // echo $form->field($model, 'gambar_event') ?>

    <?php // echo $form->field($model, 'user_pembuat') ?>

    <?php // echo $form->field($model, 'jum_peserta') ?>

    <?php // echo $form->field($model, 'tipe') ?>

    <?php // echo $form->field($model, 'kunci_invitasi') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
