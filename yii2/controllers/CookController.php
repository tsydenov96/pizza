<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\data\Pagination;
use yii\filters\VerbFilter;
use app\models\BookingConnect;

class CookController extends Controller
{

public function behaviors() { 
        $session = Yii::$app->session;
        $session->open();
        return 
        [ 
        'access' => [ 'class' => AccessControl::className(), 
        'rules' => 
        [ 
        [   'actions' => ['index','accept','ready'], 
        'allow' => true,
        'matchCallback' => function ($rule, $action) {
                            $status =isset($_SESSION['status']) ? $_SESSION['status'] : null;
                            if($status=='cook')
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
        $goods = BookingConnect::find()->where(['!=','booking_connect_status', 3 ])->orderBy('goods_id')->all();
        return $this->render('index',['goods'=>$goods]);
    }

    public function actionAccept($id){
        $session = Yii::$app->session;
        $session->open();
        $model = $this->findModel($id);
        $model->booking_connect_cook_id = $_SESSION['__id'];
        $model->booking_connect_status = 2; // 2 - принят
        $model->save();
        return $this->redirect(['index']);
    }

    public function actionReady($id){
        $session = Yii::$app->session;
        $session->open();
        $model = $this->findModel($id);
        $model->booking_connect_cook_id = $_SESSION['__id'];
        $model->booking_connect_status = 3; // 2 - готово
        $model->save();
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = BookingConnect::find()->where(['booking_connect_id' => $id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}