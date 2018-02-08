<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\MaskedInput;
// use yii\jui\DatePicker;
// use kartik\datetime\DateTimePicker;
use kartik\date\DatePicker;

$this->title = 'Registrasi';
$this->params['breadcrumbs'][] = $this->title;
?>
<style media="screen">
	.td-custom{
		padding-right: 50px;
		width: 100%;
	}
	.td-titik{
		padding-right: 20px;
	}
</style>
<div class="site-login container">
	<div class="panel panel-success">
		<div class="panel-heading">
			<h1 style="color : white"><?= Html::encode($this->title) ?></h1>
		</div>
		<div class="panel-body">
			<p>Harap mengisi form kosong berikut :</p>
			<hr>
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
			<div class="panel-footer">
				<?= Html::submitButton($model->isNewRecord ? 'Daftar' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
			</div>
			<!-- <?php
			// 	$form->field($model, 'Telepon')->widget(MaskedInput::classname(), [
			// 		'name' => 'input-1',
			// 		'mask' => '(999) 999-999-999'
			// ])->label('Nomor Telepon');
			?> -->
				<!-- <div class="form-group">
				<div class="col-lg-offset-1 col-lg-11">
				</div>
				</div> -->
				<?php ActiveForm::end(); ?>
		</div>
  </div>
</div>
