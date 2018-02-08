<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Event */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama_event')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'konten_event')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tanggal_event')->textInput() ?>

    <?= $form->field($model, 'lokasi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kategori_event')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'max_user')->textInput() ?>

    <?= $form->field($model, 'min_user')->textInput() ?>

    <?= $form->field($model, 'gambar_event')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_pembuat')->textInput() ?>

    <?= $form->field($model, 'jum_peserta')->textInput() ?>

    <?= $form->field($model, 'tipe')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kunci_invitasi')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
