<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use app\models\User;
use app\models\Goods;
use app\models\GoodsInBasket;
use app\models\Booking;
use app\models\BookingConnect;
use yii\base\Model;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $goods = Goods::find()->all();
        return $this->render('index',['goods' => $goods]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    //авторизация
    public function actionLogin()
    {
        $session = Yii::$app->session;
        $session->open();
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new User();
        if ($model->load(Yii::$app->request->post())) {

            $user = User::find()->where(['username' => $model->username,'password' => $model->password])->one();
            if($user)
            {                    
                Yii::$app->user->login($user);
                switch ($user->status) {
                    case '1':
                        $_SESSION['status']='admin';
                        break;
                    case '2':
                        $_SESSION['status']='operator';
                        break;
                    case '3':
                        $_SESSION['status']='carrier';
                        break;
                    case '4':
                        $_SESSION['status']='cook';
                        break;    
                }
                return $this->goBack();
            }
            else
            {
                $model->addError($attribute='password', 'Incorrect username or password.');
            }
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    public function actionShoppingCart()
    {        
        if(isset($_SESSION['id'])){
            if(count($_SESSION['id'])){
                $allGoods = array();
                foreach($_SESSION['id'] as $id){
                    $goods = Goods::find()->where(['goods_id' => $id->id])->one();
                    $allGoods[] = [$goods , $id->count];
                }
                return $this->render('shoppingCart',['goods' => $allGoods]);
            }
            else{
                return $this->goBack();
            }
        }
        else{
            return $this->goBack();
        }
    }

    public function actionDeleteGoods($id){
        $key = array_search($id, $_SESSION['id']);
        unset($_SESSION['id'][$key]);
        return $this->redirect(['shopping-cart']);
    }

    public function actionCountGoods($do,$id){
        for($i = 0;$i<count($_SESSION['id']);$i++){
            if($_SESSION['id'][$i]->id == $id)
                break;
        }
        if($do==1){
            if($_SESSION['id'][$i]->count!=1)
                $_SESSION['id'][$i]->count--;
        }
        else{
            $_SESSION['id'][$i]->count++;
        }
        return $this->redirect(['shopping-cart']);
    }

    public function actionChooseGoods(){
            $id = Yii::$app->request->post('goods_id');
            if(isset($_SESSION['id'])){
                if(count($_SESSION['id'])!=0){
                    $i=0;
                    while($i<count($_SESSION['id'])&&$_SESSION['id'][$i]->id!=$id){
                        $i++;
                    }
                    if($i==count($_SESSION['id']))
                        $_SESSION['id'][] = new GoodsInBasket($id);
                }
                else{
                    $_SESSION['id'][]=new GoodsInBasket($id);
                }
            }
            else{
                $_SESSION['id'][]=new GoodsInBasket($id);
            }
                       
            return $this->goBack();
    }

    public function clear(){
        unset($_SESSION['id']);
        return $this->redirect(['index']);
    }

    public function actionBookingCreate(){
        $model = new Booking();
        if (Yii::$app->request->isPost&&$model->load(Yii::$app->request->post()))
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
            $model->booking_date = date('Y-m-d H:i');
            $model->save();
            for($i = 0;$i<count($_SESSION['id']);$i++){
                $bookingCon = new BookingConnect();
                $bookingCon->booking_id = $model->booking_id;   
                $bookingCon->goods_id = $_SESSION['id'][$i]->id;
                $bookingCon->booking_connect_quantity = $_SESSION['id'][$i]->count;
                $bookingCon->booking_connect_status = 1;
                $bookingCon->save();
            }
            $this->clear();
        }
        return $this->render('create', ['model' => $model]);
    }
}
