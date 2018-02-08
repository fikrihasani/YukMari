<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\data\Pagination;

use yii\web\Controller;
use yii\web\UploadedFile;

use app\models\LoginForm;
use app\models\Member;
use app\models\Thread;
use app\models\Peserta;
use app\models\Komentar;
use app\models\Kategori;



class MemberController extends Controller
{
  // public $notification;

  public function behaviors()
  {
      return [
          'access' => [
              'class' => AccessControl::className(),
              'only' => ['logout'],
              'rules' => [
                  [
                      'actions' => ['logout'],
                      'allow' => true,
                      'roles' => ['@'],
                  ],
              ],
          ],
          'verbs' => [
              'class' => VerbFilter::className(),
              'actions' => [],
          ],
      ];
  }
    public function actionIndex()
    {
      $id=$_GET["id"];
      $data = Member::find()->where(['id_user' => $id])->one();
      // $warningEvent = Peserta::find()->with('thread')->where(['thread','batal'=>1])->all();
      // $warningEvent = (new \yii\db\Query())->select(['event.nama_event as nama','event.id_event as id_event','peserta.id_peserta as id_peserta','event.alasan_batal as alasan'])->from('peserta')->leftjoin('event','event.id_event = peserta.Thread')->where(['event.batal'=>1,'peserta.User'=>$id]);
      $warningEvent = Peserta::find()->joinWith('thread')->joinWith('member')->where(['event.batal'=>1,'peserta.User'=>$id])->all();
      // $command = $warningEvent->createCommand();
      // $data = $command->queryAll();
      // foreach ($warningEvent as $loop) {
      //   $data = $loop->event;
      //   echo $warning->nama_event;
      // }
      // exit;
      $thread = Thread::find()->where(['user_pembuat'=>$id])->all();
      $peserta = Peserta::find()->with('thread')->where(['User'=>$id])->all();
      return $this->render('user',
        [
            'data' => $data,
            'thread'=>$thread,
            'peserta'=>$peserta,
            'warningEvent'=>$warningEvent,
        ]);
    }

    //Register sebagai peserta
      public function actionDaftar_peserta($id_event){
        // $id_event = $_GET['']
        $peserta = new Peserta();

        if ($peserta->load(Yii::$app->request->post())) {
          $peserta->Thread = $id_event;
          $peserta->User = 0;
          $peserta->save();
          return $this->redirect(['site/lihat_thread','id'=>$id_event]);
        }else{
          $peserta->User = Yii::$app->user->identity->id_user;
          $peserta->nama_peserta = Yii::$app->user->identity->nama_user;
          $peserta->kontak_hp = Yii::$app->user->identity->hp_user;
          $peserta->Thread = $id_event;
          // echo "halo";
          // exit;
          // echo $peserta->User."<br>";
          // echo $peserta->Thread."<br>";
          $peserta->save();
          return $this->redirect(Yii::$app->request->referrer);
        }
      }

      // Daftar sebagai user baru
      public function actionRegister(){
      	$model = new Member();
      	if ($model->load(Yii::$app->request->post()) && $model->validate()) {
          $model->foto_profil = UploadedFile::getInstance($model, 'foto_profil');
          if ($model->foto_profil != null) {
            if($model->foto_profil->extension == 'jpg' || $model->foto_profil->extension == 'png'){
              $model->save();
              $model->foto_profil->saveAs('web/img/user/' . $model->foto_profil->baseName . '.' . $model->foto_profil->extension);
            }elseif ($model->foto_profil->extension =='') {
              $model->save();
            }
          }else{
            $model->save();
          }
          return $this->redirect(['/site/login']);
        }
      	return $this->render('register',['model' => $model,]);
      }

    // MENAMPILKAN INFORMASI USER JIKA DIAKSES OLEH USER SENDIRI
      public function actionUser()
        {
      		$id=$_GET["id"];
      		$data = Member::find()->where(['id_user' => $id])->one();
          $queryThread = Thread::find()->where(['user_pembuat'=>$id]);
          $queryPeserta = Peserta::find()->with('thread')->where(['User'=>$id]);
          $countQueryThread = clone $queryThread;
          $countQueryPeserta = clone $queryPeserta;
          $pagesThread = new Pagination(['totalCount' => $countQueryThread->count(), 'pageSize'=>5]);
          $pagesPeserta = new Pagination(['totalCount' => $countQueryPeserta->count(), 'pageSize'=>5]);

          $thread = $queryThread->offset($pagesThread->offset)
            ->limit($pagesThread->limit)
            ->all();

          $peserta = $queryPeserta->offset($pagesPeserta->offset)
            ->limit($pagesPeserta->limit)
            ->all();

          return $this->render('user',
            [
                'data' => $data,
                'thread'=>$thread,
                'peserta'=>$peserta,
                'pagesThread'=>$pagesThread,
                'pagesPeserta'=>$pagesPeserta,
            ]);
        }

    // MENAMPILKAN INFORMASI USER JIKA DIAKSES OLEH PIHAK LUAR/ GUEST
        public function actionInfo_user()
        {
          $id=$_GET["id"];
          $data = Member::find()->where(['id_user' => $id])->one();
          $thread = Thread::find()->where(['user_pembuat'=>$id])->all();
          $peserta = Peserta::find()->where(['User'=>$id])->all();
          return $this->render('info_user',
            [
                'data' => $data,
                'thread'=>$thread,
                'peserta'=>$peserta,
            ]);
        }

        public function actionUpdate_user($id){
          $model = Member::find()->where(['id_user'=>$id])->one();
          $foto_profil = $model->foto_profil;
          if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->foto_profil = UploadedFile::getInstance($model, 'foto_profil');
            if ($model->foto_profil != null) {
              if (UploadedFile::getInstance($model, 'foto_profil') == null) {
                $model->foto_profil = $foto_profil;
                $model->save();
                return $this->redirect(['user', 'id' => $model->id_user]);
              }elseif($model->foto_profil->extension == 'jpg' || $model->foto_profil->extension == 'png'){
                $model->save();
                $model->foto_profil->saveAs('web/img/user/' . $model->foto_profil->baseName . '.' . $model->foto_profil->extension);
                return $this->redirect(['user', 'id' => $model->id_user]);
              }
            }else{
              $model->foto_profil = $foto_profil;
              $model->save();
              return $this->redirect(['user', 'id' => $model->id_user]);
            }
          } else {
              return $this->render('update_user', [
                  'model' => $model,
              ]);
          }
        }

        public function actionBatalkan($id){
          $idPeserta = Yii::$app->user->identity->id_user;
          $peserta = Peserta::find()->where(['Thread'=>$id,'User'=>$idPeserta])->one();
          $peserta->delete();
          return $this->redirect(Yii::$app->request->referrer);
        }
}
