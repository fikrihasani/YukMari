<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\MemberSearch;
use app\models\Member;
use app\models\Thread;
use app\models\Komentar;
use app\models\Peserta;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MemberController implements the CRUD actions for Member model.
 */
class MemberController extends Controller
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
     * Lists all Member models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MemberSearch();
        $username = 'admin';
        $member = Member::find()->with('thread','komentar')->where(['!=','username','admin'])->all();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'member' => $member,
        ]);
    }

    /**
     * Displays a single Member model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
      $event = Thread::find()->where(['user_pembuat'=>$id])->all();
      $peserta = Peserta::find()->with(['thread'])->where(['User'=>$id])->all();
      $reportedEvent = Thread::find()->where(['user_pembuat'=>$id])->andFilterWhere(['!=','laporan_event',0])->all();
      $reportedComment = Komentar::find()->where(['id_user'=>$id])->andFilterWhere(['!=','laporan_komentar',0])->all();
      $eventBatal = Thread::find()->where(['user_pembuat'=>$id])->andFilterWhere(['!=','batal',0])->all();
      // $reportedComment =
        return $this->render('view', [
            'model' => $this->findModel($id),
            'event' => $event,
            'peserta' => $peserta,
            'eventTerlapor' =>$reportedEvent,
            'komentarTerlapor' =>$reportedComment,
            'eventBatal'=>$eventBatal,
        ]);
    }

    /**
     * Creates a new Member model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /**
     * Updates an existing Member model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    // public function actionUpdate($id)
    // {
    //     $model = $this->findModel($id);
    //
    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'id' => $model->id_user]);
    //     } else {
    //         return $this->render('update', [
    //             'model' => $model,
    //         ]);
    //     }
    // }

    /**
     * Deletes an existing Member model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
		$event = Thread::find()->where(['user_pembuat'=>$id])->all();
		$komentar = Komentar::find()->all(); 
		$komenUser = Komentar::find()->where(['id_user'=>$id])->all();
		$peserta = Peserta::find()->all();
		$pesUser = Peserta::find()->where(['User'=>$id])->all();
		$user = Member::find()->where(['id_user'=>$id])->one();
		if (($user->foto_profil != '') || ($user->foto_profil != null)) {
			$path = getcwd().'/web/img/user/'.$user->foto_profil;
			if (file_exists($path)) {
				if(unlink($path)){
					echo "ada";
				}else{
					echo "gagal";
				}
			}else{
				$user->delete();
				// hapus event
				foreach($event as $acara){
					if (($acara->gambar_event != '') || ($acara->gambar_event != null)) {
						$pathEvent = getcwd().'/web/img/event/'.$acara->gambar_event;
						if (file_exists($pathEvent)) {
							if(unlink($pathEvent)){
								echo "ada";
							}else{
								echo "gagal";
							}
						}
					}else{
						  // hapus komentar
						foreach ($komentar as $comments) {
							if(($comments->id_user == $id) && ($comments->id_thread == $acara->id_event)){
								$comments->delete();
							}
						}
					  // hapus peserta
						foreach ($peserta as $pesertaEvent) {
							if(($pesertaEvent->User == $id) && ($pesertaEvent->Thread == $acara->id_event)){
								$pesertaEvent->delete();
							}
						 }
					}
					$acara->delete();
				}
				// hapus komentar
				foreach ($komentarUser as $komen) {
					$komen->delete();
				}
				// hapus peserta
				foreach ($pesUser as $pesertaEvent) {
					echo $pesertaEvent->delete();
				}
			}
		}else{
			  // hapus event
			$user->delete();
			foreach($event as $acara){
				if (($acara->gambar_event != '') || ($acara->gambar_event != null)) {
					$pathEvent = getcwd().'/web/img/event/'.$acara->gambar_event;
					if (file_exists($pathEvent)) {
						if(unlink($pathEvent)){
							echo "ada";
						}else{
							echo "gagal";
						}
					}
				}else{
					// hapus komentar
					foreach ($komentar as $comments) {
						if(($comments->id_user == $id) && ($comments->id_thread == $acara->id_event)){
							$comments->delete();
						}
					}
					// hapus peserta
					foreach ($peserta as $pesertaEvent) {
						if(($pesertaEvent->User == $id) && ($pesertaEvent->Thread == $acara->id_event)){
							$pesertaEvent->delete();
						}
					}
				}
				$acara->delete();
			}
			  // hapus komentar
			  foreach ($komenUser as $comments) {
				$comments->delete();
			 }
		  // hapus peserta
			  foreach ($pesUser as $pesertaEvent) {
				echo $pesertaEvent->delete();
			 }
		}
        // $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Member model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Member the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Member::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
