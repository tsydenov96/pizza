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
        [   'actions' => ['index','create','update','delete'], 
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
        $goods = Goods::find()->all();
        return $this->render('index',['goods'=>$goods]);
    }
    /***************

    Создание пиццы(товара)

    **********************/
    public function actionCreate(){
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

    public function actionUpdate($id){
        $model = $this->findModel($id);
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

    public function actionDelete($id){
        $model = $this->findModel($id);
        if($model->goods_img!=='123')
            unlink($_SERVER['DOCUMENT_ROOT'].'/pizza/yii2/upload/'.$model->goods_img);
        $model->delete();
        return $this->redirect(['index']);
    }

    protected function findModel($id)
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