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
        [   'actions' => ['index','accept','remove','view','create'], 
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
            ->select(['a.goods_id','goods_name', 'COUNT(goods_name) AS count','goods_price'])
            ->from('pizza_goods AS a')
            ->join('INNER JOIN','pizza_booking_connect AS b','a.goods_id = b.goods_id')
            ->where(['b.booking_id' => $model->booking_id])
            ->groupBy(['goods_name'])
            ->all();
        $goods = Goods::find()->where(['goods_status' => 1])->all();
        return $this->render('create',['model' => $model,'account' => $account, 'goods' => $goods]);
    }

    public function actionCreate(){
        $model = new Booking();
        $goods = Goods::find()->where(['goods_status' => 1])->all();
        if (Yii::$app->request->isAjax&&$model->load(Yii::$app->request->post('model')))
        {
            if(isset($_SESSION['status'])){
                switch ($_SESSION['status']) {
                    case 'operator':
                    $model->operator_id=$_SESSION['__id'];
                    $model->booking_status = 2;
                    break;
                }
            }
            if($model->booking_status != 2)
                $model->booking_status = 1;
            $model->booking_date = date('Y-m-d H:i:s');
            $model->save();
            $bc = Yii::$app->request->post('cart');
            foreach($bc as $key)
                for($i = 0; $i < $key['count']; $i++){   
                    $bookingCon = new BookingConnect();
                    $bookingCon->booking_id = $model->booking_id;   
                    $bookingCon->goods_id = $key['id'];
                    $bookingCon->booking_connect_status = 1;
                    $bookingCon->save();
            }
            return "Зашел";
        }
        return $this->render('create',['model' => $model, 'goods' => $goods, 'account' => []]);
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