<?php
  use yii\helpers\Url;
  use yii\helpers\Html;
  use yii\bootstrap\ActiveForm;
  use yii\widgets\Pjax;
  use yii\widgets\LinkPager;
  use yii\data\Pagination;
  use yii\widgets\MaskedInput;

  $this->title = $thread->nama_event.' - YukMari';
  $this->params['breadcrumbs'][] = ['label' => 'Thread', 'url' => ['all_thread']];
  $this->params['breadcrumbs'][] = $this->title;
?>
<style media="screen">
  /*.panel-custom{
    box-shadow : 2px 2px 10px grey
  }*/
  .td-titik{
    padding-left : 5px;
    padding-right : 10px;
  }
  .row-custom{
    padding : 0px 20px;
    background-color:
  }
  .comment-empty{
    background-color: #adad85;
    color : white;
  }
</style>
 <div class="site-lihat_thread">
   <div class="container">
     <?php
      if ($thread->batal == 0) {
        if (!(Yii::$app->user->isGuest)) {
          if ((Yii::$app->user->identity->id_user == $thread->user_pembuat)&&($validDate)) {
       ?>
       <button type="button" name="button" class="btn btn-warning" data-toggle="modal" data-target="#alasan" style="margin-bottom : 20px">Batalkan Acara</button>
       <?php
          }
        } ?>
        <div class="panel panel-default panel-custom">
          <div class="panel-heading">
            <h5>Detail Event</h5>
          </div>
          <div class="panel-body">
            <table class="">
              <tbody>
                <tr>
                  <td>Lokasi</td>
                  <td class="td-titik">:</td>
                  <td>
                    <?php echo $thread->lokasi ?>
                  </td>
                </tr>
                <tr>
                  <td>Tanggal/ Waktu</td>
                  <td class="td-titik">:</td>
                  <td>
                    <?php echo $hari." ".$bulan." ".$tahun  ?>, Jam <?php echo $jam ?>
                  </td>
                </tr>
                <tr>
                  <td>Kategori</td>
                  <td class="td-titik">:</td>
                  <td>
                   <a href="<?php echo Url::to(['site/filter_thread','id'=>$thread->kategori->id_kategori])?>"><?php echo $thread->kategori->nama_kategori ?></a>
                  </td>
                </tr>
                <tr>
                  <td>Pemilik Acara</td>
                  <td class="td-titik">:</td>
                  <td>
                   <?php if (!(Yii::$app->user->isGuest)) {
                     if($thread->member->id_user == Yii::$app->user->identity->id_user) {
                     ?>
                     <a href="<?php echo Url::to(['member','id'=>$thread->member->id_user])?>"><?php echo $thread->member->nama_user ?></a>
                   <?php }else { ?>
                     <a href="<?php echo Url::to(['member/info_user','id'=>$thread->member->id_user])?>"><?php echo $thread->member->nama_user ?></a>
                   <?php
                   }
                 }else{ ?>
                     <a href="<?php echo Url::to(['member/info_user','id'=>$thread->member->id_user])?>"><?php echo $thread->member->nama_user ?></a>
                <?php  } ?>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="panel-footer">
            <?php if ($thread->laporan_event != 0) {
              echo "<span style='color : red'>Acara ini telah dilaporkan karena mengandung SARA, Pornografi, konten berbau seksual, atau Hal-hal yang melanggar norma</span>";
            } ?>
          </div>
        </div>
        <div class="panel panel-default panel-custom">
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-6 col-md-6">
                <p>
                  <?php echo nl2br($thread->konten_event );?>
                </p>
              </div>
              <div class="col-lg-6 col-md-6">
                <?php if ($thread->gambar_event != null) {?>
                 <img src="../web/img/event/<?php echo $thread->gambar_event?>" alt="<?php echo $thread->nama_event?>" width="90%"/>
                <?php }else{ ?>
                 <img src="../web/img/event/blank_event.png" alt="<?php echo $thread->nama_event?>" width="90%"/>
                <?php } ?>
              </div>
            </div>
          </div>
          <div class="panel-footer">
            <?php if (Yii::$app->user->isGuest == false){
              if ($thread->user_pembuat != Yii::$app->user->identity->id_user){ ?>
                <a href="<?php echo Url::to(['lapor_event','id'=>$thread->id_event])?>"><button class="btn btn-warning">Laporkan event ini jika dianggap tidak patut</button></a>
             <?php }
           }else{ ?>
             <a href="<?php echo Url::to(['lapor_event','id'=>$thread->id_event])?>"><button class="btn btn-warning">Laporkan event ini jika dianggap tidak patut</button></a>
           <?php } ?>
            </div>
        </div>
        <?php if($validDate){
         ?>
         <div class="panel panel-default panel-custom">
           <div class="panel-heading">
             <h5>Peserta</h5>
           </div>
           <div class="panel-body">
             <p>
               Jumlah Peserta : <?php echo count($thread->peserta) ?>
               <?php if (!(Yii::$app->user->isGuest)){
                  if (count($thread->peserta) < $thread->max_user){
                    if (($thread->member->id_user != Yii::$app->user->identity->id_user) && !($exist)) { ?>
                      <a href="<?php
                       if(Yii::$app->user->isGuest){
                         echo Url::to(['site/login']);
                       }else{
                         echo Url::to(['member/daftar_peserta','id_event'=>$thread->id_event]);
                       }?>" style="float : right;"> Daftar? <i class="fa fa-plus-square-o"></i>
                     </a>
                    <?php } } }elseif (count($thread->peserta) < $thread->max_user) { ?>
                 <a href="#modal-daftar-umum" data-toggle="modal" data-target="#modal-daftar-umum" style="float : right;">Daftar? <i class="fa fa-plus-square-o"></i></a>
               <?php } ?>
             </p>
             <?php if (count($thread->peserta) < $thread->max_user): ?>
               <div class="alert alert-info">
                 Event ini masih memerlukan peserta. Ayo segera daftarkan diri anda!
               </div>
             <?php endif; ?>
             <div >
               <table class="table table-striped table-bordered display" id='peserta'>
                 <thead>
                   <tr>
                     <th> No </th>
                     <th> Nama Peserta </th>
                     <th> Kontak </th>
                   </tr>
                 </thead>
                 <tbody>
                   <?php
                    $i = 0;
                    foreach ($peserta as $partisipan) {
                      $i++;
                    ?>
                    <tr>
                      <td><?php echo $i?></td>
                      <td>
                          <?php
                            if ((Yii::$app->user->isGuest == false) && ($partisipan->User == Yii::$app->user->identity->id_user)){
                              if ($partisipan->User != 0) { ?>
                                <a href="<?php echo Url::to(['/member','id'=>$partisipan->User]) ?>"><?php echo $partisipan->nama_peserta ?></a>
                              <?php }else{
                                echo $partisipan->nama_peserta;
                              }
                            }elseif($partisipan->User != 0){ ?>
                          <a href="<?php echo Url::to(['member/info_user','id'=>$partisipan->User]) ?>"><?php echo $partisipan->nama_peserta ?></a>
                          <?php
                        }else{
                          echo $partisipan->nama_peserta;
                        }  ?>
                      </td>
                      <td>
                        <?php echo $partisipan->kontak_hp ?>
                      </td>
                    </tr>
                    <?php
                    } ?>
                 </tbody>
               </table>
             </div>
            </div>
         </div>
         <div class="panel panel-default">
           <?php Pjax::begin(); ?>
           <div class="panel-heading">
             <h3 class="panel-title">Komentar : <?php echo count($komentar) ?></h3>
           </div>
           <div class="panel-body">
             <?php if (Yii::$app->user->isGuest) {
               ?>
               <div class=" alert alert-warning">
                 <h4>
                  Anda Harus login terlebih dahulu untuk memberikan komentar
                  <i class="fa fa-warning" style="float : right"></i>
                </h4>
               </div>
               <?php
             }else{ ?>
               <div class="row row-custom">
                 <?php
                    $form = ActiveForm::begin([
                     'options' => ['class' => 'form-horizontal','data-pjax' => 'true'],
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
                  <?= Html::submitButton('Kirim', ['class' => 'btn btn-primary','name'=>'button1']) ?>
                 </div>
                 <?php ActiveForm::end() ?>
               </div>
            <?php } ?>
             <?php foreach ($komentar as $comments){
                 ?>
                 <div class="panel panel-info comment">
                   <div class="panel-body">
                     <table>
                       <tr>
                         <td class="col-lg-3 col-md-3">
                           <span><?php echo $comments->member->nama_user ?></span>
                         </td>
                         <td class="col-lg-9 col-md-9">
                           <?php echo nl2br($comments->isi_komentar); ?>
                         </td>
                       </tr>
                     </table>
                   </div>
                   <div class="panel-footer">
                     <a href="<?php echo Url::to(['member/info_user','id'=>$comments->member->id_user])?>"> <?php echo $comments->member->nama_user ?> <i class="fa fa-user"></i></a>
                     <?php
                      if(!(Yii::$app->user->isGuest)){
                        if($comments->member->id_user == Yii::$app->user->identity->id_user){
                      ?>
                      <a href="#warning-modal-delete" data-event="<?php echo $thread->id_event?>" class="hapus" data-toggle="modal" id="<?php echo $comments->id_komentar?>" data-target="#warning-modal-delete" style="color : red; padding-left:10px">Hapus Komentar <i class="fa fa-trash-o"></i></a>
                     <?php }else{
                       ?>
                       <a href="#warning-modal-lapor" style="color : orange"  data-toggle="modal" id="<?php echo $comments->id_komentar?>" data-target="#warning-modal-lapor" style="color : orange; padding-left:10px; float : right"><i class="fa fa-warning"></i> Laporkan</a>
                       <?php
                     }
                   }else{ ?>
                     <a href="#warning-modal-lapor" style="color : orange"  data-toggle="modal" id="<?php echo $comments->id_komentar?>" data-target="#warning-modal-lapor" style="color : orange; padding-left:10px; float : right"><i class="fa fa-warning"></i> Laporkan</a>
                   <?php } ?>
                     <p style="float : right">
                       <?php echo $comments->tanggal_komentar ?>
                     </p>
                   </div>
                 </div>
                 <?php
             }
             ?>
             <?php Pjax::end(); ?>
           </div>
         </div>
        <?php }else{ ?>
         <div class="alert alert-info">
           <center>
               <h4 style="color : white">Anda tidak dapat mendaftar dikarenakan acara tengah/ telah berlangsung <i class="fa fa-info-circle"></i></h4>
           </center>
         </div>
         <?php if (!(Yii::$app->user->isGuest)) {
           if (Yii::$app->user->identity->id_user == $thread->user_pembuat) {
          ?>
          <div class="panel panel-default panel-custom">
            <div class="panel-heading">
              <h5>Peserta</h5>
            </div>
            <div class="panel-body">
              <div >
                <table class="table table-striped table-bordered display" id='peserta'>
                  <thead>
                    <tr>
                      <th> No </th>
                      <th> Nama Peserta </th>
                      <th> Kontak </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                     $i = 0;
                     foreach ($peserta as $partisipan) {
                       $i++;
                     ?>
                     <tr>
                       <td><?php echo $i?></td>
                       <td>
                           <?php
                             if ((Yii::$app->user->isGuest == false) && ($partisipan->User == Yii::$app->user->identity->id_user)){
                               if ($partisipan->User != 0) { ?>
                                 <a href="<?php echo Url::to(['/member','id'=>$partisipan->User]) ?>"><?php echo $partisipan->nama_peserta ?></a>
                               <?php }else{
                                 echo $partisipan->nama_peserta;
                               }
                             }elseif($partisipan->User != 0){ ?>
                           <a href="<?php echo Url::to(['member/info_user','id'=>$partisipan->User]) ?>"><?php echo $partisipan->nama_peserta ?></a>
                           <?php
                         }else{
                           echo $partisipan->nama_peserta;
                         }  ?>
                       </td>
                       <td>
                         <?php echo $partisipan->kontak_hp ?>
                       </td>
                     </tr>
                     <?php
                     } ?>
                  </tbody>
                </table>
              </div>
             </div>
          </div>
        <?php
           }
         } ?>
        <?php } ?>
    <?php
  }else{ ?>
    <center>
      <h2 style="color : orange">Acara ini telah dibatalkan oleh pemilik acara dengan alasan : </h2>
      <h3><i class="fa fa-quote-left"></i><?php echo $thread->alasan_batal ?><i class="fa fa-quote-right"></i></h3>
      <h5>untuk kontak dapat menghubungi pembuat acara atas nama : <hr>
        <?php echo $thread->member->nama_user. " : ". $thread->member->hp_user  ?>
      </h5>
    </center>
  <?php } ?>
     </div>
   </div>
 </div>
 <div id="warning-modal-lapor" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 		<div class="modal-dialog">
 				<div class="modal-content">
 						<div class="modal-header" style=" background-color : orange">
 								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
 								<h4 class="modal-title" id="myModalLabel" style="color : white;">Anda akan melaporkan komentar ini</h4>
 						</div>
 						<div class="modal-body edit-content">
 								<center>Apakah anda yakin jika komentar yang anda laporkan memang layak untuk dilaporkan?</center>
                <center style="color : blue">Komentar yang dilaporkan hanya diketahui oleh admin</center>
 						</div>
 						<div class="modal-footer">
               <button type="button" class="btn btn-primary" id="redirectLapor">Saya yakin</button>
 								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
 						</div>
 				</div>
 		</div>
 </div>
 <div class="modal fade" id="modal-daftar-umum" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
         <h4 class="modal-title" id="">ISI DATA PRIBADI ANDA</h4>
       </div>
       <div class="modal-body">
         <?php
            $form_daftar = ActiveForm::begin(
                [
                  'action' =>['member/daftar_peserta?id_event='.$thread->id_event.''],
                  'id' => 'daftar_peserta',
                  'method' => 'post',
              ]);
         ?>
          <?= $form_daftar->field($data_peserta, 'nama_peserta')->textArea(['maxlength' => true,'placeholder'=>'Isi Nama Lengkap Anda '])->label(false)  ?>
          <?= $form_daftar->field($data_peserta, 'kontak_hp')->widget(MaskedInput::classname(), [
                'name' => 'inputKontak',
                'mask' => '(999) 999-999-999'
              ])->label(false);
            // $form_daftar->field($data_peserta, 'kontak_hp')->textArea(['maxlength' => true,'placeholder'=>'Isi Kontak HP anda'])->label(false)
            ?>

       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         <?= Html::submitButton('Kirim', ['class' => 'btn btn-primary','name'=>'Submit']) ?>
       </div>
        <?php ActiveForm::end() ?>
     </div>
   </div>
 </div>
 <div id="warning-modal-delete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header" style=" background-color : red">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title" id="myModalLabel" style="color : white;">Anda akan menghapus komentar ini</h4>
             </div>
             <div class="modal-body edit-content">
                 <center>Apakah anda yakin untuk menghapus komentar ini?</center>
             </div>
             <div class="modal-footer">
               <button type="button" class="btn btn-primary" id="redirectDelete">Saya yakin</button>
                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
             </div>
         </div>
     </div>
 </div>
 <div class="modal fade" id="alasan" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header" style="background-color : red">
         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
         <h4 class="modal-title" id="">Batalkan Acara</h4>
       </div>
       <div class="modal-body">
         <?php
            $form_alasan = ActiveForm::begin(
                [
                  // 'action' =>['site/batal_thread?id='.$thread->id_event.''],
                  // 'id' => 'alasan_batal',
                  // 'method' => 'post',
              ]);
         ?>
            <?= $form_alasan->field($batalkan, 'alasan_batal')->textArea(['maxlength' => true,'placeholder'=>'Alasan dibatalkannya acara'])  ?>
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         <?= Html::submitButton('Kirim', ['class' => 'btn btn-primary','name'=>'kirim']) ?>
       </div>
         <?php ActiveForm::end() ?>
     </div>
   </div>
 </div>

 <script>
   $(document).ready(function(){
     $('#warning-modal-lapor').on('show.bs.modal', function(e) {
           var $modal = $(this),
           esseyId = e.relatedTarget.id;
           $("#redirectLapor").click(function(){
             $(location).attr("href", "lapor_komentar?id="+esseyId);
           });
       });
      $('.hapus').click(function(){
        id_event = $(this).data('event');
        $('#warning-modal-delete').on('show.bs.modal', function(e) {
            var $modal = $(this),
            esseyId = e.relatedTarget.id;
            $("#redirectDelete").click(function(){
              $(location).attr("href", "delete_comment?id="+esseyId+"&id_thread="+id_event);
            });
        });
      });
   });

    // $('.panel-body').pjax('#pjax-container', { timeout: 5000 });
 </script>
