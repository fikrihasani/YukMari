<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Thread;
use app\modules\admin\models\EventSearch;
use app\models\Peserta;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EventController implements the CRUD actions for Event model.
 */
class EventController extends Controller
{
    /**
     * @inheritdoc
     */
    public $layout = 'main';
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Event models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = Thread::find()->all();
        $searchModel = new EventSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=>$model,
        ]);
    }

    /**
     * Displays a single Event model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $peserta = Peserta::find()->where(['Thread'=>$id])->all();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'peserta' => $peserta,
        ]);
    }

    /**
     * Creates a new Event model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Thread();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_event]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Event model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_event]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Event model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */

    public function actionDelete($id)
    {
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
        return $this->redirect(['index']);
    }

    /**
     * Finds the Event model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Event the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Thread::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
