<?php

use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\widgets\MaskedInput;
use yii\bootstrap\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\Country */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Update Member: ' . ' ' . $model->nama_user;
$this->params['breadcrumbs'][] = ['label' => 'YukMari', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama_user, 'url' => ['user', 'id' => $model->id_user]];
$this->params['breadcrumbs'][] = 'Update';
?>
<style media="screen">
	.td-custom{
		padding-right: 50px;
		width: 100%;
	}
	.td-titik{
		padding-right: 20px;
		padding-left: 20px;
	}
</style>
<div class="admin-default-update container" style="padding : 50px">

  <?php $form = ActiveForm::begin([
  'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
        ],
  ]); ?>

    <table>
      <tr>
        <td>
          Username
        </td>
        <td class="td-titik">
          :
        </td>
        <td class="td-custom">
            <?= $form->field($model, 'username')->textInput(['maxlength' => true])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td>
          Nama
        </td>
        <td class="td-titik">
          :
        </td>
        <td class="td-custom">
            <?= $form->field($model, 'nama_user')->textInput(['maxlength' => true])->label(false); ?>
        </td>
      </tr>
			<tr>
				<td>
					No yang bisa dihubungi
				</td>
				<td class="td-titik">
					:
				</td>
				<td class="td-custom">
						<?= $form->field($model, 'hp_user')->widget(MaskedInput::classname(), [
							'name' => 'input-1',
							'mask' => '(999) 999-999-999'
					])->label(false); ?>
				</td>
			</tr>
      <tr>
        <td>
          Email
        </td>
        <td class="td-titik">
          :
        </td>
        <td class="td-custom">
          <?= $form->field($model, 'email_user')->widget(MaskedInput::classname(), [
            'name' => 'input-36',
            'clientOptions' => [
              'alias' =>  'email'
              ],
            ])->label(false);
          ?>
        </td>
      </tr>
      <tr>
        <td>
          Password
        </td>
        <td class="td-titik">
          :
        </td>
        <td class="td-custom">
          <?= $form->field($model, 'password_user')->passwordInput(['maxlength' => true])->label(false); ?>
        </td>
      </tr>
			<tr>
				<td>
						Foto Profile
				</td>
				<td>
					:
				</td>
				<td>
						<?= $form->field($model, 'foto_profil')->fileInput()->label(false) ?>
				</td>
			</tr>
      <tr>
        <td>Tanggal lahir</td>
        <td>:</td>
        <td class="td-custom">
          <?=
            $form->field($model, 'tanggal_lahir')->widget(DatePicker::classname(), [
            'name' => 'dp_3',
            'type' => DatePicker::TYPE_COMPONENT_APPEND,
            'value' => '23-Feb-1982',
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'dd-MM-yyyy'
            ]
          ])->label(false);
          ?>
        </td>
      </tr>
      <tr>
        <td>
          Jenis Kelamin
        </td>
        <td class="td-titik">
          :
        </td>
        <td>
          <?= $form->field($model, 'jenKel')->inline()->radioList(array('p'=>'Pria','w'=>'Wanita'))->label(false); ?>
        </td>
      </tr>
      <tr>
        <td>
          Alamat
        </td>
        <td class="td-titik">
          :
        </td>
        <td class="td-custom">
          <?= $form->field($model, 'alamat_user')->textArea(['rows' => '6'])->label(false) ?>
        </td>
      </tr>
    </table>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
