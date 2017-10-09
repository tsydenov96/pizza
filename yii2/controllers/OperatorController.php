<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\data\Pagination;
use yii\filters\VerbFilter;
use app\models\Booking;
use app\models\BookingConnect;
use app\models\Goods;
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
        [   'actions' => ['index','accept','remove','view'], 
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

    public function actionView($id){
        $model = $this->findModel($id);
        $account = (new \yii\db\Query())
            ->select(['goods_name', 'COUNT(goods_name) AS count','goods_price'])
            ->from('pizza_goods AS a')
            ->join('INNER JOIN','pizza_booking_connect AS b','a.goods_id = b.goods_id')
            ->where(['b.booking_id' => $model->booking_id])
            ->groupBy(['goods_name'])
            ->all();
        return $this->render('view',['model' => $model,'account' => $account]);
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