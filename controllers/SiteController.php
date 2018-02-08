<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use	yii\helpers\VarDumper ;
use yii\data\Pagination;

use yii\web\Controller;
use yii\web\UploadedFile;

use app\models\LoginForm;
use app\models\Member;
use app\models\Thread;
use app\models\Peserta;
use app\models\Komentar;
use app\models\Kategori;

// MULAI CLASS SITECONTROLLER
class SiteController extends Controller
{

  // public $notif;

  // $this->$notif = 0;

// BEHAVIOR ATAU PERILAKU UNTUK CLASS SITECONTROLLER
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

// DEFAULT FUNGSI UNTUK ACTION
  public function actions()
  {
    return [
      'error' => [
        'class' => 'yii\web\ErrorAction',
      ],
      'captcha' => [
        'class' => 'yii\captcha\CaptchaAction',
        'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
      ],
    ];
  }

// MENAMPILKAN INDEX
  public function actionIndex()
  {
    // $thread = Thread::find()->all();
    $thread = Thread::find()->with('member')->orderBy(['id_event'=>SORT_DESC])->all();
	foreach($thread as $acara){
		// echo $acara->member->foto_profil;
		// echo $acara->user_pembuat;
	}
	// exit;
    $peserta = Peserta::find()->with('thread')->all();
    $kategori = Kategori::find()->all();
    return $this->render('index',[
		'thread' => $thread,
      'peserta'=>$peserta,
      'kategori'=>$kategori,
			// 'pages' => $pages,
		]);
    // return $this->render('index');
  }

  public function actionAbout(){
    return $this->render('about');
  }
  
// MENAMPILKAN SEMUA THREAD
  public function actionAll_thread()
    {
  		// $thread = Thread::find()->all();
      $thread = Thread::find()->with('member','peserta','komentar','kategori')->where(['batal'=>0])->orderBy(['id_event'=>SORT_DESC])->all();
      $kategori = Kategori::find()->all();
      return $this->render('all_thread',[
  			'thread' => $thread,
        'kategori' =>$kategori,
  			// 'pages' => $pages,
  		]);
      }

// Melihat event atau thread berdasarkan kategori
  public function actionFilter_thread(){
    $id = $_GET['id'];
    $emptyMessage = '';
    $data = Thread::find()->where(['kategori_event'=>$id])->orderBy(['id_event'=>SORT_DESC])->all();
 	$kategori = Kategori::find()->where(['id_kategori'=>$id])->one();

    if(count($data) == 0){
      $emptyMessage = 'Belum ada event untuk kategori ini';
    }
    return $this->render('filter_thread',[
      'emptyMessage' => $emptyMessage,
      'data'=>$data,
      'kategori'=>$kategori,
    ]);
  }

  public function validateDate($dateThread, $dateNow){
    $dayNow = date("d",strtotime($dateNow));
    $monthNow = date("m",strtotime($dateNow));
    $yearNow = date("Y",strtotime($dateNow));
    $dayThread = date("d",strtotime($dateThread));
    $monthThread = date("m",strtotime($dateThread));
    $yearThread = date("Y",strtotime($dateThread));
    if ($yearNow > $yearThread) {
      return false;
    }elseif (($monthNow > $monthThread) && ($yearNow >= $yearThread)) {
      return false;
    }elseif (($dayNow >= $dayThread) && ($monthNow >=$monthThread) && ($yearNow >= $yearThread)) {
      return false;
    }else{
      return true;
    }
  }

  public function actionLihat_thread(){
    $id=$_GET["id"];
    $thread = Thread::find()->with('member')->where(['id_event'=>$id])->one();
    $peserta = Peserta::find()->with('member')->where(['Thread'=>$id])->all();
    $cekjum = 0;
    $exist = false;
    $validDate = true;
    $tanggalNow = date('Y-m-d');
    $validDate = $this->validateDate($thread->tanggal_event, $tanggalNow);

    if (!(Yii::$app->user->isGuest)) {
      $queryCek = Peserta::find()->where(['User'=>Yii::$app->user->identity->id_user,'Thread'=>$id])->one();
      $cekjum = count($queryCek);
    }
    if ($cekjum != 0) {
      $exist = true;
    }

    $data_peserta = new Peserta();
    $model = new Komentar();
    $batalkan_acara = new Thread();

    $komentar = $model->find()->with('member')->where(['id_thread'=>$id])->orderBy('id_komentar DESC')->all();

    $day = date("d",strtotime($thread->tanggal_event));
    $month = date("m",strtotime($thread->tanggal_event));
    $year = date("Y",strtotime($thread->tanggal_event));
    $month = $this->convertMonth($month);
    $time = date("H:i:s",strtotime($thread->tanggal_event));

    // membatalkan acara
    $batalkan = Thread::find()->where(['id_event'=>$id])->one();
    if ($batalkan->load(Yii::$app->request->post())) {
      // echo $batalkan->nama_event;
      $batalkan->batal = 1;
      // echo $batalkan->alasan_batal;
      // exit;
      $batalkan->update();
      return $this->redirect(['site/lihat_thread','id'=>$id]);
    }

    if ($model->load(Yii::$app->request->post())) {
      // masukin data
      $model->id_user = Yii::$app->user->identity->id_user;
      $model->id_thread = $id;
      $waktu = date('Y-m-d H:i:s');
      $model->tanggal_komentar = $this->convertDate($waktu);
      $model->save();
      // reset data
      $model = new Komentar();
      $komentar = $model->find()->with('user')->where(['id_thread'=>$id])->orderBy('id_komentar DESC')->all();
    }

    return $this->render('lihat_thread',[
      'thread'=>$thread,
      'hari'=>$day,
      'bulan'=>$month,
      'tahun'=>$year,
      'jam'=>$time,
      'peserta'=>$peserta,
      'model'=>$model,
      'data_peserta'=>$data_peserta,
      'komentar'=>$komentar,
      'exist'=>$exist,
      'validDate'=>$validDate,
      'batalkan'=>$batalkan,      // 'pagesPeserta'=>$pages
    ]);
  }

  public function actionDelete_thread($id){
    $event = Thread::find()->where(['id_event'=>$id])->one();
    $komentar = Komentar::find()->where(['id_thread'=>$id])->all();
    $peserta = Peserta::find()->where(['Thread'=>$id])->all();
    if (($event->gambar_event != '') || ($event->gambar_event != null)) {
      $path = getcwd().'/web/img/event/'.$event->gambar_event;
      if (file_exists($path)) {
        if(unlink($path)){
          echo "ada";
        }else{
          echo "gagal";
        }
      }else{
        $event->delete();
        // hapus komentar
        foreach ($komentar as $comments) {
          $comments->delete();
        }
        // hapus peserta
        foreach ($peserta as $pesertaEvent) {
          echo $pesertaEvent->delete();
        }
      }
    }else{
      // hapus event
      $event->delete();
      // hapus komentar
      foreach ($komentar as $comments) {
        $comments->delete();
      }
      // hapus peserta
      foreach ($peserta as $pesertaEvent) {
        echo $pesertaEvent->delete();
      }
    }
    return $this->redirect(['member/user','id'=>Yii::$app->user->identity->id_user]);
  }

  // buat event
    public function actionCreate_thread(){
      if (Yii::$app->user->isGuest) {
        return $this->goBack();
      }
      // exit;
      $model = new Thread();
      $kategori = Kategori::find()->all();
      if ($model->load(Yii::$app->request->post())) {
		if ($model->validate()){
			$model->user_pembuat = Yii::$app->user->identity->id_user;
			$model->gambar_event = UploadedFile::getInstance($model, 'gambar_event');
			if ($model->gambar_event != null) {
			  if($model->gambar_event->extension == 'jpg' || $model->gambar_event->extension == 'png'){
				if($model->max_user < $model->min_user){
					$model->addError('min_user','Minimum peserta harus kurang dari max peserta');
				}
				if(count($model->getErrors())==0){
					$model->save();
					$model->gambar_event->saveAs('web/img/event/' . $model->gambar_event->baseName . '.' . $model->gambar_event->extension);
					return $this->redirect(['lihat_thread','id'=>$model->id_event]);
				}else{
					return $this->render('create_thread',[
						'model' => $model,
						'sum'=>$sum_thread,
						'thread'=>$thread,
						'kategori'=>$kategori,
					]);
				}
			}
        }else{
			if($model->max_user < $model->min_user){
				$model->addError('min_user','Minimum peserta harus kurang dari max peserta');
			}
			if(count($model->getErrors())==0){
				$model->save();
				return $this->redirect(['lihat_thread','id'=>$model->id_event]);
			}else{
				$id = Yii::$app->user->identity->id_user;
				$sum_thread = $model->getNumThreadOf($id);
				$thread = $model->getThreadOf($id);
				return $this->render('create_thread',[
					'model' => $model,
					'sum'=>$sum_thread,
					'thread'=>$thread,
					'kategori'=>$kategori,
				]);
			}
          $model->save();
          return $this->redirect(['lihat_thread','id'=>$model->id_event]);
        }
        // echo $model->gambar_event->baseName . '.' . $model->gambar_event->extension;
      }else{
			print_r($model->errors);
		}
	  }else{
				$id = Yii::$app->user->identity->id_user;
				$sum_thread = $model->getNumThreadOf($id);
				$thread = $model->getThreadOf($id);
			
				return $this->render('create_thread',[
					'model' => $model,
					'sum'=>$sum_thread,
					'thread'=>$thread,
					'kategori'=>$kategori,
				]);
		}
	}

    public function actionUpdate_thread($id){
      $model = Thread::find()->where(['id_event'=>$id])->one();
      if (Yii::$app->user->isGuest) {
        return $this->goBack();
      }
      $kategori = Kategori::find()->all();
      if ($model->load(Yii::$app->request->post())) {
        $model->user_pembuat = Yii::$app->user->identity->id_user;
        $temp = UploadedFile::getInstance($model, 'gambar_event');
        if($temp != null){
          $model->gambar_event = $temp;
          if($model->gambar_event->extension == 'jpg' || $model->gambar_event->extension == 'png'){
			if($model->max_user < $model->min_user){
				$model->addError('min_user','Minimum peserta harus kurang dari max peserta');
			}
			if(count($model->getErrors()) == 0){
				$model->save();
				$model->gambar_event->saveAs('web/img/event/' . $model->gambar_event->baseName . '.' . $model->gambar_event->extension);
				return $this->redirect(['lihat_thread','id'=>$model->id_event]);
			}else{
				if (Yii::$app->user->isGuest == false) {
				$id = Yii::$app->user->identity->id_user;
				$sum_thread = $model->getNumThreadOf($id);
				$thread = $model->getThreadOf($id);
				}else{
					$id = null;
				}
				return $this->render('update_thread',[
					'model' => $model,
					'sum'=>$sum_thread,
					'thread'=>$thread,
					'kategori'=>$kategori,
				]);
			}
          }
        }else{
			if($model->max_user < $model->min_user){
				$model->addError('min_user','Minimum peserta harus kurang dari max peserta');
			}
			if(count($model->getErrors()) == 0){
				$model->save();
				return $this->redirect(['lihat_thread','id'=>$model->id_event]);
			}else{
				if (Yii::$app->user->isGuest == false) {
					$id = Yii::$app->user->identity->id_user;
					$sum_thread = $model->getNumThreadOf($id);
					$thread = $model->getThreadOf($id);
				}else{
					$id = null;
				}
				return $this->render('update_thread',[
					'model' => $model,
					'sum'=>$sum_thread,
					'thread'=>$thread,
					'kategori'=>$kategori,
				]);
			}
        }
      }else{
        if (Yii::$app->user->isGuest == false) {
          $id = Yii::$app->user->identity->id_user;
          $sum_thread = $model->getNumThreadOf($id);
          $thread = $model->getThreadOf($id);
        }else{
          $id = null;
        }
        return $this->render('update_thread',[
          'model' => $model,
          'sum'=>$sum_thread,
          'thread'=>$thread,
          'kategori'=>$kategori,
        ]);
      }
    }

    public function actionLapor_komentar($id){
      // $connection = Yii::$app->getDb();
      // $command = $connection->createCommand("
      // UPDATE komentar SET laporan_komentar = 1 WHERE id_komentar = $id");
      // $result = $command->execute();
      // //
      $model= Komentar::find()->where(['id_komentar'=>$id])->one();
      echo $model->laporan_komentar;
      $model->laporan_komentar += 1;
      $model->save();
      $cek = clone $model;
      echo $cek->laporan_komentar;
      // debug
      $this->redirect(Yii::$app->request->referrer);
    }

    public function actionLapor_event($id){
      // cek laporan
      $connection = Yii::$app->getDb();
      $model= Thread::find()->where(['id_event'=>$id])->one();
      $count = $model->laporan_event + 1;
      $command = $connection->createCommand("
      UPDATE event SET laporan_event = $count WHERE id_event = $id");
      $result = $command->execute();
      $this->redirect(Yii::$app->request->referrer);
    }

    public function convertDateTime($datetime){
      $day = date("d",strtotime($datetime));
    	$month = date("m",strtotime($datetime));
    	$year = date("Y",strtotime($datetime));
    	$month = $this->convertMonth($month);
    	$time = date("H:i:s",strtotime($datetime));
      $arr = array('Tanggal',$day,$month,$year,', Jam',$time);
      $hasil = join(" ",$arr);
      return $hasil;
    }

    public function convertDate($datetime){
      $day = date("d",strtotime($datetime));
      $month = date("m",strtotime($datetime));
      $year = date("Y",strtotime($datetime));
      $month = $this->convertMonth($month);
      $time = date("H:i:s",strtotime($datetime));
      $arr = array('Tanggal',$day,$month,$year);
      $hasil = join(" ",$arr);
      return $hasil;
    }

    public function actionDelete_comment($id,$id_thread){
      // echo Yii::$app->request->referrer;
      // $halaman = Yii::$app->request->referrer;
      echo $id;
      $model = new Komentar();
      $komentar = $model->find()->where(['id_komentar'=>$id])->one();
      // echo $komentar->id_komentar;
      // echo $komentar->isi_komentar;
      // exit;
      $komentar->delete();
      // $this->findModel($id)->delete();
      return $this->redirect(Yii::$app->request->referrer);
    }
// RUBAH NAMA BULAN
	public function convertMonth($month){
		$bul='';
		switch($month){
			case '01' :
				$bul=' Januari ';
				break;
			case '02' :
				$bul=' Februari ';
				break;
			case '03' :
				$bul=' Maret ';
				break;
			case '04' :
				$bul=' April ';
				break;
			case '05' :
				$bul=' Mei ';
				break;
			case '06' :
				$bul=' Juni ';
				break;
			case '07' :
				$bul=' Juli ';
				break;
			case '08' :
				$bul=' Agustus ';
				break;
			case '09' :
				$bul=' September ';
				break;
			case '10' :
				$bul=' Oktober ';
				break;
			case '11':
				$bul=' November ';
				break;
			case '12' :
				$bul=' Desember ';
				break;
		}
		return $bul;
	}

// login
  public function actionLogin()
  {

    // echo Yii::$app->request->referrer;
    $model = new LoginForm();
    if ($model->load(Yii::$app->request->post()) && $model->login()) {
			if($model->getUser()->nama_user == 'admin'){
				return $this->redirect(['/admin']);
		  }
      else{
          // return $this->redirect(Yii::$app->request->referrer);
          // $halaman = Yii::$app->request->referrer;
          return $this->goHome();
        }
      }
    else{
      return $this->render('login', [
        'model' => $model,
      ]);
    }
  }

  // logout
  public function actionLogout()
  {
    Yii::$app->user->logout();
    // return $this->redirect(['/site/index']);
    return $this->goHome();
  }

	public function actionEntry()
    {
        $model = new EntryForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // valid data received in $model
            // do something meaningful here about $model ...

            return $this->render('entry-confirm', ['model' => $model]);
        } else {
            // either the page is initially displayed or there is some validation error
            return $this->render('entry', ['model' => $model]);
        }
    }

}
