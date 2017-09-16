<?php

namespace app\controllers;

class BookingController extends \yii\web\Controller
{
    public function actionCreateOrder()
    {
        return $this->render('create-order');
    }

}
