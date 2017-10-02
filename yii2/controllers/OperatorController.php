<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\data\Pagination;
use yii\filters\VerbFilter;
use app\models\Booking;
use app\models\BookingSearch;


class OperatorController extends Controller
{

public function behaviors() { 
        $session = Yii::$app->session;
        $session->open();
        return 
        [ 
        'access' => [ 'class' => AccessControl::className(), 
        'rules' => 
        [ 
        [   'actions' => ['index','accept','remove'], 
        'allow' => true,
        'matchCallback' => function ($rule, $action) {
                            $status =isset($_SESSION['status']) ? $_SESSION['status'] : null;
                            if($status=='operator')
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
        $model->operator_id = $_SESSION['__id'];
        $model->booking_status = 2; // 2 - принят
        $model->save();
        return $this->redirect(['index']);
    }  

    public function actionRemove($id)
    {
        $session = Yii::$app->session;
        $session->open();
        $model = $this->findModel($id);
        $model->operator_id = $_SESSION['__id'];
        $model->booking_status = 3; // 3 - не принят
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