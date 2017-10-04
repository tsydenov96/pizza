<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\data\Pagination;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use app\models\Goods;
use app\models\User;
use app\models\Cook;
use app\models\Carrier;
use app\models\Operator;
use app\models\ModelInfo;

class AdminController extends Controller
{

public function behaviors() { 
        $session = Yii::$app->session;
        $session->open();
        return 
        [ 
        'access' => [ 'class' => AccessControl::className(), 
        'rules' => 
        [ 
        [   'actions' => ['index','createGoods','updateGoods','deleteGoods','add-user','show-goods','show-user'], 
        'allow' => true,
        'matchCallback' => function ($rule, $action) {
                            $status =isset($_SESSION['status']) ? $_SESSION['status'] : null;
                            if($status=='admin')
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
        return $this->render('index');
    }

    public function actionShowGoods()
    {
        $goods = Goods::find()->all();
        return $this->render('showGoods',['goods'=>$goods]);
    }

    public function actionShowUser()
    {
        $goods = User::find()->where(['!=','status','1'])->all();
        return $this->render('showUser',['goods'=>$goods]);
    }
    /***************

    Добавление пользователя

    **********************/
    public function actionAddUser(){
        $model_user = new User();
        $model_info1 = new ModelInfo();
        if (Yii::$app->request->isPost&&$model_user->load(Yii::$app->request->post())&&$model_info1->load(Yii::$app->request->post()))
            {
                switch ($model_user->status) {
                    case '2':
                        $model_info = new Operator();
                        $model_info->operator_name = $model_info1->name;
                        $model_info->operator_surname = $model_info1->surname;
                        break;
                    case '3': 
                        $model_info = new Carrier();
                        $model_info->carrier_name = $model_info1->name;
                        $model_info->carrier_surname = $model_info1->surname;
                        break;
                    case '4': 
                        $model_info = new Cook();
                        $model_info->cook_name = $model_info1->name;
                        $model_info->cook_surname = $model_info1->surname;
                        break;                    
                }
                $model_user->save();
                $model_info->user_id = $model_user->user_id;
                $model_info->save();
                print_r($model_info);
                exit();
                return $this->redirect(['index']);
            } 
        return $this->render('addUser', ['model_user' => $model_user,'model_info' => $model_info1]);
    }
    /***************

    Создание пиццы(товара)

    **********************/
    public function actionCreateGoods(){
        $model = new Goods();
        if (Yii::$app->request->isPost&&$model->load(Yii::$app->request->post()))
            {
                $model->goods_img = UploadedFile::getInstance($model, 'goods_img');
                if($model->create()){
                    $model->save();
                    return $this->redirect(['index']);
                }
            }
        return $this->render('create', ['model' => $model]);
    }

    public function actionUpdateGoods($id){
        $model = $this->findGoods($id);
        $link_old=$model->goods_img;
        if (Yii::$app->request->isPost&&$model->load(Yii::$app->request->post()))
            {
                $link = UploadedFile::getInstance($model, 'goods_img');
                if($link!=null)
                    $model->goods_img=$link;
                else
                    $model->goods_img=$link_old;
                if($model->updateGoods($link_old)){
                    $model->save();
                }
                return $this->redirect(['index']);
            }
        return $this->render('create', ['model' => $model]);
    }

    public function actionDeleteGoods($id){
        $model = $this->findGoods($id);
        if($model->goods_img!=='123')
            unlink($_SERVER['DOCUMENT_ROOT'].'/pizza/yii2/upload/'.$model->goods_img);
        $model->delete();
        return $this->redirect(['index']);
    }

    protected function findGoods($id)
    {
        if (($model = Goods::find()->where(['goods_id'=>$id])->one()) !== null) 
        {
            return $model;
        } 
        else 
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}