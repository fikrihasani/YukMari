<?php
  use yii\helpers\Url;
  use yii\widgets\LinkPager;
  use yii\data\Pagination;
  use yii\widgets\Pjax;
  $i = 0;
  $j = 0;
?>
<style media="screen">
  .header-laporan-komentar, .header-laporan-event{
    background-color: orange;
    color : white;
    padding : 10px;
    font-size: 20px;
    margin-bottom : 20px;
  }
  .laporan-event{
    margin-top : 50px;
  }
</style>
<div class="admin-laporan">
    <div class="container">
      <div class="">
        <center>
            <h2>Laporan</h2>
            <p>
              Laporan disini adalah laporan dari user dimana komentar atau event dianggap tidak layak untuk ditampilkan.
            </p>
        </center>
      </div>
      <div class="laporan-komentar">
        <?php Pjax::begin(); ?>
        <?php echo LinkPager::widget([
            'pagination' => $pagesKomen,
          ]);
        ?>
        <div class="header-laporan-komentar">
          <span>Komentar yang dilaporkan</span>
        </div>
        <?php if (count($komentar)!=0) {
        ?>
        <p>
          Jumlah Komentar yang dilaporkan : <?php echo count($komentar) ?>
        </p>
        <table class="table table-striped">
          <thead>
            <tr>
              <td><b>No</b></td>
              <td><b>Konten Komentar</b></td>
              <td><b>User Terkait</b></td>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($komentar as $comments) {
          ?>
            <tr>
              <td>
                <?php echo ++$i ?>
              </td>
              <td>
                <?php echo $comments->isi_komentar ?>
              </td>
              <td>
                <a href="<?php echo Url::to (['/admin/member/view','id'=>$comments->member->id_user])?>"><?php echo $comments->member->username ?>
              </td>
            </tr>
          <?php
          } ?>
          </tbody>
        </table>
        <?php
      }else{
        echo "<center></h2>Belum ada laporan dari pengguna</h2></center>";
      }?>
      <?php Pjax::end(); ?>
      </div>
      <div class="" id="">
        <?php Pjax::begin(); ?>
        <?php echo LinkPager::widget([
            'pagination' => $pagesEvent,
          ]);
        ?>
        <div class="header-laporan-komentar">
          <span>Event yang dilaporkan</span>
        </div>
        <?php if (count($event)!=0) {
        ?>
        <p>
          Jumlah Komentar yang dilaporkan : <?php echo count($event) ?>
        </p>
        <table class="table table-striped">
          <thead>
            <tr>
              <td><b>No</b></td>
              <td><b>Judul Event</b></td>
              <td><b>Konten event</b></td>
              <td><b>User Terkait</b></td>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($event as $thread) {
          ?>
            <tr>
              <td>
                <?php echo ++$j ?>
              </td>
              <td>
                <a href="<?php echo Url::to(['/admin/event/view','id'=>$thread->id_event])?>"><?php echo $thread->nama_event ?></a> 
              </td>
              <td>
                <?php echo $thread->konten_event ?>
              </td>
              <td>
                <a href="<?php echo Url::to (['/admin/member/view','id'=>$thread->member->id_user])?>"><?php echo $thread->member->username ?>
              </td>
            </tr>
          <?php
          } ?>
          </tbody>
        </table>
        <?php
      }else{
        echo "<center></h2>Belum ada laporan dari pengguna</h2></center>";
      }?>
        <?php Pjax::end(); ?>
      </div>
    </div>
</div>
