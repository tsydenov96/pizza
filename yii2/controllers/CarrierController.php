<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\data\Pagination;
use yii\filters\VerbFilter;
use app\models\Booking;
use app\models\BookingSearch;

class CarrierController extends Controller
{

    public function behaviors() { 
        $session = Yii::$app->session;
        $session->open();
        return 
        [ 
            'access' => [ 'class' => AccessControl::className(), 
            'rules' => 
            [ 
                [   'actions' => ['index','accept','delivery'], 
                'allow' => true,
                'matchCallback' => function ($rule, $action) {
                    $status =isset($_SESSION['status']) ? $_SESSION['status'] : null;
                    if($status=='carrier')
                        return true;    
                    else{
                        return false;
                    }
                }
            ],
        ], 
    ], 
]; 
}



public function actionIndex()
{
    $searchModel = new BookingSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    return $this->render('index', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
    ]);
}
public function actionAccept($id)
{
    $session = Yii::$app->session;
    $session->open();
    $model = $this->findModel($id);
    $model->carrier_id = $_SESSION['__id'];
        $model->booking_status = 5; // 5 - принят
        $model->save();
        return $this->redirect(['index']);
    }  

    public function actionDelivery($id)
    {
        $session = Yii::$app->session;
        $session->open();
        $model = $this->findModel($id);
        $model->carrier_id = $_SESSION['__id'];
        $model->booking_status = 6; // 6 - доставлен
        $model->save();
        return $this->redirect(['index']);
    }   

    protected function findModel($id)
    {
        if (($model = Booking::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }






}
