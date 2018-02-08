<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\data\Pagination;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use app\modules\admin\models\LoginForm;
use app\modules\admin\models\User;
use app\models\Member;
use app\models\Thread;
use app\models\Komentar;
use app\models\Peserta;

use app\modules\admin\models\EventSearch;
use app\modules\admin\models\MemberSearch;
// use app\models\UploadForm;

use yii\helpers\Url;


class DefaultController extends Controller
{
		public $layout = "main";
		// public $event_terlapor = Event::find()->where(['laporan'=>1])->all();
		// public $komentar_terlapor = Komentar::find()->where(['laporan'=>1])->all();


	public function behaviors()
    {
        return [
		    'access' => [
                'class' => AccessControl::className(),
                // 'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => [
								'logout','add_event','view_event','update_event','detail_event','detail_member','delete_event',
								'index','view_members','add_member','update_member','delete_member','upload',
								'view_laporan','view_laporan_event','view_laporan_komentar', 'detail_masukan', 'delete_masukan','set_favorit','export',
							],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
				// return $this->redirect(['/site/index']);
        return $this->goHome();
    }

		public function actionIndex()
		{
			$events = Thread::find()->all();
			$members = Member::find()->all();
			$event_terlapor = Thread::find()->where(['!=','laporan_event',0])->all();
			$komentar_terlapor = Komentar::find()->where(['!=','laporan_komentar',0])->all();
			$batal = Thread::find()->where(['!=','batal',0])->all();
			$laporan = count($event_terlapor) + count($komentar_terlapor);
			return $this->render('index',[
					'event' => $events ,
					'member' => $members,
					'laporan'=>$laporan,
					'batal'=>$batal
				]);
		}

		public function actionView_laporan(){
			$queryKomentar  = Komentar::find()->where(['!=','laporan_komentar',0]);
			// ->where(['laporan'=>1]);
			$queryEvent = Thread::find()->where(['!=','laporan_event',0]);
			// ->where(['laporan'=>1]);

			$countQueryKomentar = clone $queryKomentar;
			$countQueryEvent = clone $queryEvent;

			$pages1 = new Pagination(['totalCount' => $countQueryKomentar->count(), 'pageSize'=>10]);
			$pages2 = new Pagination(['totalCount' => $countQueryEvent->count(), 'pageSize'=>10]);

			$komentar = $queryKomentar->offset($pages1->offset)
				->limit($pages1->limit)
				->all();

			$event = $queryEvent->offset($pages2->offset)
				->limit($pages2->limit)
				->all();

			return $this->render('view_laporan',[
					'komentar'=>$komentar,
					'event'=>$event,
					'pagesKomen'=>$pages1,
					'pagesEvent'=>$pages2,
				]);
		}


	/** For EVENT**/
	public function actionAdd_event()
    {
		$model = new Thread();

		if ($model->load(Yii::$app->request->post())) {
			$model->Nama_gambar = UploadedFile::getInstance($model, 'Nama_gambar');
			echo $model->Nama_gambar->baseName . '.' . $model->Nama_gambar->extension;
			if($model->Nama_gambar->extension == 'jpg' || $model->Nama_gambar->extension == 'png'){
				echo $model->ID_event.'<br>';
				echo $model->Judul.'<br>';
				echo $model->Tanggal.'<br>';
				echo $model->Tempat.'<br>';
				echo $model->Kontent_event.'<br>';
				echo $model->Nama_gambar.'<br>';
				$model->save();
				$model->Nama_gambar->saveAs('img/' . $model->Nama_gambar->baseName . '.' . $model->Nama_gambar->extension);
				return $this->redirect(['detail_event', 'id' => $model->ID_event]);
			}
        } else{
			return $this->render('add_event', ['model' => $model]);
		}
    }

	public function actionUpdate_event($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
			$model->Nama_gambar = UploadedFile::getInstance($model, 'Nama_gambar');
			echo $model->Nama_gambar->baseName . '.' . $model->Nama_gambar->extension;
			if($model->Nama_gambar->extension == 'jpg' || $model->Nama_gambar->extension == 'png'){
				echo $model->ID_event.'<br>';
				echo $model->Judul.'<br>';
				echo $model->Tanggal.'<br>';
				echo $model->Tempat.'<br>';
				echo $model->Kontent_event.'<br>';
				echo $model->Nama_gambar.'<br>';
				$model->save();
				$model->Nama_gambar->saveAs('img/' . $model->Nama_gambar->baseName . '.' . $model->Nama_gambar->extension);
				return $this->redirect(['detail_event', 'id' => $model->ID_event]);
			}
        } else {
			unlink('img/'.$model->Nama_gambar);
            return $this->render('update_event', [
                'model' => $model,
            ]);
        }
    }
}
