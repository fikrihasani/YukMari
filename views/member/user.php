<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\data\Pagination;
use yii\widgets\Pjax;
$i=0;

$this->title = 'Member - '.$data->username;
 ?>
 <style media="screen">
 #user-header{
   background: linear-gradient(white,grey);
 }
 </style>
<div class="site-user">
  <div class="container">
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
      <div class="panel panel-default" id="user-header">
        <div class="panel-body">
          <?php if (($data->foto_profil == '') || ($data->foto_profil == null)){
              if ($data->jenKel == 'p') { ?>
                <center>
                  <img src="<?= Url::base();?>/web/img/user/user_woman.jpg" alt="action.jpg" width="400px" height="400px" style="padding: 20px" class="img-circle">
                </center>
          <?php }else{ ?>
            <center>
              <img src="<?= Url::base();?>/web/img/user/user_man.jpg" alt="action.jpg" width="400px" height="400px" style="padding: 20px" class="img-circle">
            </center>
          <?php  }
        }else{ ?>
          <center>
            <img src="<?= Url::base();?>/web/img/user/<?php echo $data->foto_profil ?>" alt="action.jpg" width="400px" height="400px" style="padding: 20px" class="img-circle">
          </center>
        <?php } ?>
        </div>
      </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <!-- <?php
      // if (count($warningEvent)!=0): ?>
        <div class="alert alert-warning">
          <h5>Perhatian! Bebarapa acara yang anda ikuti telah dibatalkan. <a href="#event_batal" data-toggle="modal" data-target="#event_batal">Info lebih lanjut</a></h5>
        </div>
      <?php
    // endif; ?> -->
    </div>
    <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
        <div class="panel panel-info">
          <div class="panel-heading">
            <h3 class="panel-title">Informasi</h3>
          </div>
          <div class="panel-body">
              <table style="" class="table">
                <tr>
                  <td>Nama</td>
                  <td>:</td>
                  <td><?php echo $data->nama_user ?></td>
                </tr>
                <tr>
                  <td>Tanggal Lahir</td>
                  <td>:</td>
                  <td><?php echo $data->tanggal_lahir ?></td>
                </tr>
                <tr>
                  <td>Alamat</td>
                  <td>:</td>
                  <td><?php echo $data->alamat_user ?></td>
                </tr>
                <tr>
                  <td>email</td>
                  <td>:</td>
                  <td><?php echo $data->email_user ?></td>
                </tr>
                <tr>
                  <td>Jenis Kelamin</td>
                  <td>:</td>
                  <td><?php if ($data->jenKel=="p") {
                    echo "Pria";
                  }else {
                    echo "Wanita";
                  }?></td>
                </tr>
                <tr>
                  <td>No Handphone</td>
                  <td>:</td>
                  <td><?php echo $data->hp_user ?></td>
                </tr>
              </table>
          </div>
          <div class="panel-footer">
            <a href="<?php echo Url::to(['/member/update_user','id'=>$data->id_user])?> ?>">Perbarui profile? <i class="fa fa-pencil-square-o fa-2x"></i></a></h3>
          </div>
        </div>
    </div>
    <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12">
      <div class="panel panel-info" id="dafThread">
        <div class="">

        </div>

        <div class="panel-heading">

          <h3 class="panel-title">Acara yang dimiliki</h3>
        </div>
        <div class="panel-body">
          <table class="table table-striped table-bordered display" id='punya'>
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Lokasi</th>
                <th>Tanggal</th>
                <th></th>
                <th></th>
              </tr>
            </thead>
          <?php foreach ($thread as $threads) {
            $waktu = date('Y-m-d H:i:s');
            $i++;?>
            <tr>
              <td>
                <?php echo $i; ?>
              </td>
              <td>
                <?php echo $threads->nama_event; ?>
              </td>
              <td>
                <?php echo $threads->lokasi; ?>
              </td>
              <td>
                <?php echo $threads->tanggal_event; ?>
              </td>
              <td style="text-align : center">
                <a href="<?php echo Url::to(['site/lihat_thread','id'=>$threads->id_event])?>"><i class="fa fa-eye" aria-hidden="true" style="color : green; font-size : 14pt;"></i></a>
                <?php if (($threads->batal == 1)||($waktu >= $threads->tanggal_event)): ?>
                  <a href="#warning-modal-hapus" style="color : red" class="hapus" data-toggle="modal" id="<?php echo $threads->id_event?>" data-target="#warning-modal-hapus"><i class="fa fa-trash-o" aria-hidden="true" style="color : red; font-size : 14pt;"></i></a>
                  <!-- <a href="<?php echo Url::to(['site/delete_thread','id'=>$threads->id_event])?>"> -->
                <?php endif; ?>
                <a href="<?php echo Url::to(['site/update_thread','id'=>$threads->id_event])?>"><i class="fa fa-pencil" style="color : orange; font-size: 14pt"></i></a>
              </td>
              <td>
                <?php
                  if ($waktu >= $threads->tanggal_event) {
                    echo "acara selesai";
                } ?>
              </td>
            </tr>
          <?php } ?>
            </table>
        </div>
      </div>
      <div class="panel panel-primary" id="dafPeserta">
        <div class="panel-heading">
          <h3 class="panel-title">Acara yang diikuti</h3>
        </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped display" id='ikut'>
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Lokasi</th>
                <th>Tanggal</th>
                <th>Acara dibatalkan</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php
                $i=0;
                foreach ($peserta as $partisipan) {
                  $i++;
                  foreach ($partisipan->thread as $ngikut) {
                  ?>
                  <tr>
                    <td>
                      <?php echo $i; ?>
                    </td>
                    <td>
                      <?php echo $ngikut->nama_event ?>
                    </td>
                    <td>
                      <?php echo $ngikut->lokasi ?>
                    </td>
                    <td>
                      <?php echo $ngikut->tanggal_event ?>
                    </td>
                    <td>
                      <?php if ($ngikut->batal != 0) {
                      ?>
                        <a href="#event_batal" data-toggle="modal" data-target="#event_batal" style="color : orange">Ya</a>
                    <?php  }else { ?>
                        Tidak
                    <?php  } ?>
                    </td>
                    <td>
                      <a href="#warning-modal-batal" style="color : red"  data-toggle="modal" id="<?php echo $ngikut->id_event?>" data-target="#warning-modal-batal" data-judul="<?php echo $ngikut->nama_event?>"><i class="fa fa-trash-o fa-2x"></i></a>
                      <a href="<?php echo Url::to(['site/lihat_thread','id'=>$ngikut->id_event])?>" style="color : green; margin-left : 5px"><i class="fa fa-eye fa-2x"></i></a>
                    </td>
                  </tr>
                  <?php
                  }
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="warning-modal-batal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
				<div class="modal-content">
						<div class="modal-header" style=" background-color : orange">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" id="myModalLabel" style="color : white;">Anda akan batal ikut pada acara ini</h4>
						</div>
						<div class="modal-body edit-content">
								<center>Apakah anda yakin?</center>
						</div>
						<div class="modal-footer">
              <button type="button" class="btn btn-primary" id="redirect">Saya yakin</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
				</div>
		</div>
</div>
<div id="warning-modal-hapus" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
				<div class="modal-content">
						<div class="modal-header" style=" background-color : red">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" id="myModalLabel" style="color : white;">Anda akan menghapus acara ini</h4>
						</div>
						<div class="modal-body edit-content">
								<center>Apakah anda yakin?</center>
						</div>
						<div class="modal-footer">
              <button type="button" class="btn btn-primary" id="delete">Saya yakin</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
				</div>
		</div>
</div>
<div class="modal fade" id="event_batal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background-color : blue">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <center><h4 class="modal-title" style="color:white">Acara yang batal</h4></center>
      </div>
      <div class="modal-body">
        <table class="table table-striped table-bordered display ">
          <thead>
            <tr>
              <th>Nama Acara</th>
              <th>Alasan Batal</th>
              <th>Pembuat acara</th>
              <th>Kontak</th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach ($peserta as $partisipan) {
                foreach ($partisipan->thread as $loop) {
                  if ($loop->batal != 0) {
            ?>
            <tr>
              <td><?php echo $loop->nama_event;?></td>
              <td><?php echo $loop->alasan_batal;?></td>
              <td><?php echo $loop->member->nama_user;?></td>
              <td><?php echo $loop->member->hp_user; ?></td>
            </tr>
            <?php
            }
                }
              } ?>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
		$('#warning-modal-batal').on('show.bs.modal', function(e) {
				var $modal = $(this),
				esseyId = e.relatedTarget.id;
        // judul = $(this).data('judul');
        // alert(esseyId);
				$("#redirect").click(function(){
					// url : "filter_thread?id="+esseyId;
					$(location).attr("href", "member/batalkan?id="+esseyId);
				});
		});
    $('#warning-modal-hapus').on('show.bs.modal', function(e) {
        var $modal = $(this),
        esseyId = e.relatedTarget.id;
        // judul = $(this).data('judul');
        // alert(esseyId);
        $("#delete").click(function(){
          // url : "filter_thread?id="+esseyId;
          $(location).attr("href", "site/delete_thread?id="+esseyId);
        });
    });
  });
</script>
