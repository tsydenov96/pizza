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
        [   'actions' => ['index','create-goods','update-goods','delete-goods','add-user','show-goods','show-user', 'update-user', 'delete-user'], 
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
        $cooks = Cook::find()->all();
        $operators = Operator::find()->all();
        $carriers = Carrier::find()->all();
        return $this->render('showUser',['cooks'=>$cooks, 'operators' => $operators, 'carriers' => $carriers]);
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
    /*************************************
    
    Редактирование пользователя

    *************************************/
    public function actionUpdateUser($id_user,$info_id){
        $model_user = $this->findUser($id_user);
        $model_info = $this->findUserInfo($info_id,$model_user->status);
        $model_info1 = new ModelInfo();
        if (Yii::$app->request->isPost&&$model_user->load(Yii::$app->request->post())&&$model_info1->load(Yii::$app->request->post()))
            {
                switch ($model_user->status) {
                    case '2':
                        $model_info->operator_name = $model_info1->name;
                        $model_info->operator_surname = $model_info1->surname;
                        break;
                    case '3': 
                        $model_info->carrier_name = $model_info1->name;
                        $model_info->carrier_surname = $model_info1->surname;
                        break;
                    case '4': 
                        $model_info->cook_name = $model_info1->name;
                        $model_info->cook_surname = $model_info1->surname;
                        break;                    
                }
                $model_user->save();
                $model_info->user_id = $model_user->user_id;
                $model_info->save();
                return $this->redirect(['index']);
            } 
        return $this->render('addUser', ['model_user' => $model_user,'model_info' => $model_info1]);
    }

    public function actionDeleteUser($id_user,$info_id){
        $model_user = $this->findUser($id_user);
        $model_info = $this->findUserInfo($info_id,$model_user->status);
        $model_user->delete();
        $model_info->delete();
        return $this->redirect(['index']);
    }

    public function actionDeleteGoods($id){
        $model = $this->findGoods($id);
        if($model->goods_img!=='123')
            unlink($_SERVER['DOCUMENT_ROOT'].'/yii2/upload/'.$model->goods_img);
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

    protected function findUser($id)
    {
        if (($model = User::find()->where(['user_id'=>$id])->one()) !== null) 
        {
            return $model;
        } 
        else 
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findUserInfo($id,$status)
    {
        switch ($status) {
            case '2':
                $model = Operator::find()->where(['operator_id'=>$id])->one();
                break;
            case '3':
                $model = Carrier::find()->where(['carrier_id'=>$id])->one();
                break;
            case '4':
                $model = Cook::find()->where(['cook_id'=>$id])->one();
                break;
        }
        if ($model !== null) 
        {
            return $model;
        } 
        else 
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}