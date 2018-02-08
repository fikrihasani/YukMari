<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Countries */
/* @var $form yii\widgets\ActiveForm */
?>

<?php

$this->registerJs(
   '$("document").ready(function(){
        $("#new_comment").on("pjax:end", function() {
            $.pjax.reload({panel-body:"#komentar"});
        });
    });'
);
?>

<div class="commens-form">
  <div class="row row-custom">
    <?php yii\widgets\Pjax::begin(['id' => 'new_comment']) ?>
    <?php
       $form = ActiveForm::begin([
        'options' => ['class' => 'form-horiz ontal'],
       //  'layout' => 'inline',
         'fieldConfig' => [
           // 	'template' => "<div class=\"col-lg-8\">{input}</div>\n<div class=\"col-lg-3\">{error}</div>",
             // 'labelOptions' => ['class' => 'col-lg-1 control-label'],
         ],
       ]);
    ?>
    <div class="col-lg-10 col-md-10">
     <?= $form->field($model, 'isi_komentar')->textArea(['maxlength' => true,'placeholder'=>'Isi Komentar Anda '])->label(false)  ?>
    </div>
    <div class="col-lg-2 col-md-2">
     <?= Html::submitButton('Kirim', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end() ?>
    <?php yii\widgets\Pjax::end() ?>
  </div>
</div>
