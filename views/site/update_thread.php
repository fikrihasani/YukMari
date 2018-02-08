<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;
use kartik\datetime\DateTimePicker;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\Country */

$this->title = 'Update Event';
$this->params['breadcrumbs'][] = $this->title;
?>
<style media="screen">
	table tr td{
		padding-bottom: : 100px;
		margin-bottom : 1000px;
	}
	.panel-body-custom{
		padding : 0px 50px;
	}
	.td-titik{
		padding-right: 20px;
	}
</style>
<div class="container">
	<div class="col-lg-9 col-md-9">
		<div class="panel panel-default">
			<div class="panel-heading" style="background-color : rgb(0, 230, 153)">
				<h1 style="color : white">Perbaharui Event <small style="color : rgb(217, 217, 217)"><?php echo $model->nama_event ?></small></h1>
			</div>
			<div class="panel-body panel-body-custom">
				<br><br>
				<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
				<table>
					<tr>
						<td>Nama Event</td>
						<td class="td-titik">:</td>
						<td>
							<?= $form->field($model, 'nama_event')->textInput(['maxlength' => true,'placeholder'=>'Nama event yang diinginkan'])->label(false) ?>
						</td>
					</tr>
					<tr>
						<td>Tanggal</td>
						<td class="td-titik">:</td>
						<td>
							<?=
								$form->field($model, 'tanggal_event')->widget(DateTimePicker::classname(), [
									'name' => 'datetime_10',
									'options' => ['placeholder' => 'Pilih Tanggal Acara'],
									'convertFormat' => true,
									'pluginOptions' => [
										'format' => 'yyyy-MM-dd hh:mm A',
										'startDate' => '01-Mar-2014 12:00 AM',
										'todayHighlight' => true
									]
							])->label(false);
							?>
						</td>
					</tr>
					<tr>
						<td>
							Kategori
						</td>
						<td class="td-titik">:</td>
						<td>
							<?= $form->field($model, 'kategori_event')
     										->dropDownList(
            								ArrayHelper::map($kategori, 'id_kategori', 'nama_kategori')
														)->label(false);
						?>
						</td>
					</tr>
					<tr>
						<td>Lokasi</td>
						<td class="td-titik">:</td>
						<td>
							<?= $form->field($model, 'lokasi')->textInput(['maxlength'=>true,'placeholder'=>'Lokasi terselenggara event'])->label(false)?>
						</td>
					</tr>
					<tr>
						<td>Konten Event</td>
						<td class="td-titik">:</td>
						<td>
							<?= $form->field($model, 'konten_event')->textArea(['rows' => 6, 'placeholder'=>'konten event'])->label(false) ?>
						</td>
					</tr>
					<tr>
						<td>Maksimal Jumlah Peserta</td>
						<td class="td-titik">:</td>
						<td>
							<?= $form->field($model, 'max_user')->textInput(['type'=>'number'])->label(false)?>
						</td>
					</tr>
					<tr>
						<td>Minimum Jumlah Peserta</td>
						<td class="td-titik">:</td>
						<td>
							<?= $form->field($model, 'min_user')->textInput(['type'=>'number'])->label(false)?>
						</td>
					</tr>
					<tr>
						<td>
							Gambar/ Poster Event (jika ada)
						</td>
						<td class="td-titik">:</td>
						<td>
							<?= $form->field($model, 'gambar_event')->fileInput()->label(false) ?>
						</td>
					</tr>
				</table>
			</div>
			<div class="panel-footer">
				<div class="form-group">
					<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
				</div>
			</div>
			<?php ActiveForm::end(); ?>
		</div>
	</div>
	<div class="col-lg-3 col-md-3">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 style="color: white;">Halo <?php echo Yii::$app->user->identity->nama_user ?></h3>
			</div>
			<div class="panel-body">
				<p>
					Thread yang anda miliki sekarang : <br>
					<?php echo $sum ?> Jumlah  <i class="fa fa-arrow-circle-down" aria-hidden="true" data-toggle="collapse" data-target="#threadInfo" style="cursor : pointer;font-size:14pt;color : green; padding-left : 20px;"></i>
					<div id="threadInfo" class="collapse">
						<hr>
						<table>
							<?php
								$i= 0;
								foreach ($thread as $threads) {
									$i++;
							?>
								<tr>
										<td>
											<?php echo	$i."."?>
										</td>
										<td>
											<?php echo $threads->nama_event ?>
										</td>
										<td style="padding-left : 5px;">
											<a href="lihat_thread?id=<?php echo $threads->id_event?>"><i class="fa fa-eye" aria-hidden="true" style="color : green"></i></a>
										</td>
								</tr>
							<?php
								}
							?>
						</table>
					</div>
				</p>
			</div>
			<div class="panel-footer">
				<a href="<?php echo Url::to(['member/user','id'=>Yii::$app->user->identity->id_user])?>">Lihat Informasi anda <i class="fa fa-user" aria-hidden="true" style="padding-left : 20px"></i></a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('#black').click(function(){
		$('input:radio').click(function(){
			value = $(this).val();
		});
		if (value=='publik') {
			$('#key_invite').css('display','none');
		}else{
				$('#key_invite').css('display','block');
		}
	});
</script>
