<?php
  use yii\helpers\Url;
  $this->title = 'Semua Thread - YukMari';
  $this->params['breadcrumbs'][] = $this->title;
 ?>
 <div class="site-all_thread">
   <div class="container">
     <div class=" col-lg-8 col-md-8">
       <h4 style="text-align:center">Semua Event</h4>
       <div>
         <?php
           $hitung = 0;
           foreach($thread as $threads){
             if ($threads->batal == 0) {
         ?>
         <div class="">
           <div class="panel panel-default" >
             <div class="panel-heading">
               <table>
                 <tr>
                   <td>
                     <img src="<?php echo Url::base()?>/web/img/user/<?php echo $threads->member->foto_profil ?>" alt=""  class="img-circle" width="40px" height="40px" style="margin-left : 10px; margin-right: 10px"/>
                     <a href="<?php
                    if(!(Yii::$app->user->isGuest)&&(Yii::$app->user->identity->id_user)){
                      echo Url::to(['/member','id'=>$threads->member->id_user]);
                    }else{
                       echo Url::to(['/member/info_user','id'=>$threads->member->id_user]);
                    }
                    ?>" >
                       <b style="font-size : 12pt; color : grey">
                         <?php echo $threads->member->nama_user ?>
                         <i class="fa fa-arrow-right" style="margin-left : 20px; margin-right : 20px"></i>
                       </b>
                     </a>
                     <a href="<?php echo Url::to(['site/filter_thread','id'=>$threads->kategori->id_kategori]);?>" style="font-size : 12pt;">
                       <?php echo $threads->kategori->nama_kategori ?>
                     </a>
                   </td>
                   <td style="padding-left : 50px; font-size : 12pt">
                     <i class="fa fa-users fa-md"></i> <?php echo count($threads->peserta) ?></span>
                   </td>
                 </tr>
               </table>


             </div>
             <div class="panel-body">
               <h4><a href="<?php echo Url::to(['site/lihat_thread','id'=>$threads->id_event])?>"><?php echo $threads->nama_event ?></a></h4>
               <?php
                 $exist = FALSE;
                 if (!(Yii::$app->user->isGuest)) {
                   $user = Yii::$app->user->identity->id_user;
                   foreach ($threads->peserta as $peserta) {
                     if($peserta->User == $user){
                       $exist = true;
                     }
                   }
                 }

               ?>
               <table class="">
                 <tr>
                   <td>kategori</td>
                   <td>:</td>
                   <td>
                     <?php echo $threads->kategori->nama_kategori ?>
                   </td>
                 </tr>
                 <tr>
                   <td>Lokasi</td>
                   <td>:</td>
                   <td>
                     <?php echo $threads->lokasi ?>
                   </td>
                 </tr>
                 <tr>
                   <td>Tanggal</td>
                   <td>:</td>
                   <td>
                     <?php echo $threads->tanggal_event ?>
                   </td>
                 </tr>
               </table>
               <hr>
               <?php
                  if($exist){
                    echo "<p style='color : orange'><b>Anda Sudah Terdaftar</b></p>";
                  }?>
                 <p>
                   <?php
                      if (strlen($threads->konten_event)>500){
                        echo substr(nl2br($threads->konten_event),0,500);
                        echo "...";
                      }else{
                        echo nl2br($threads->konten_event);
                      }
                    ?>
                 </p>
                 <?php if ($threads->gambar_event == '') {
                  ?>
                   <center><img src="<?php echo Url::base()?>/web/img/event/blank_event.png" width = "50%" /></center>
                  <?php
                }else{ ?>
                 <center><img src="<?php echo Url::base()?>/web/img/event/<?php echo $threads->gambar_event?>" width = "60%" height="60%" /></center>
                <?php } ?>
             </div>
           </div>
         </div>
         <?php
           }
         }
          ?>
       </div>
     </div>
     <div class="col-lg-4 col-md-4">
   		<div class="row">
   			<div class="thread-header">
   			<center><h4>Kategori</h4></center>
   			</div>
   			<div class="">
   				<?php foreach ($kategori as $category): ?>
   					<a href="<?php echo Url::to(['site/filter_thread','id'=>$category->id_kategori]) ?>">
   						<div class="panel panel-default panel-kategori">
   							<div class="panel-body" style="
   							background :  linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url(../web/img/kategori/<?php echo $category->image_kategori ?>);
   							color : white;
   							">
   								<?php echo $category->nama_kategori ?>
   							</div>
   						</div>
   					</a>
   				<?php endforeach; ?>
   			</div>
   		</div>
   	</div>

   </div>
 </div>
