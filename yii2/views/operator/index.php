<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Bookink;
/* @var $this yii\web\View */
//$url='view';
$this->title = Yii::t('app', 'Operator');
?>

<div class="booking-index">

    <h1><?= Html::encode($this->title) ?></h1>

<?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'layout'=>"{sorter}\n{pager}\n{summary}\n{items}",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'booking_id',
            'user_name',
            'user_address',
            'user_phone',
            'carrier_id',
            'booking_status',
            'booking_date',
            'operator_id',
            [
                'class' => 'yii\grid\ActionColumn',
                'controller' => 'operator',
                'header'=>'Действия', 
                'template' => '{view}',
                'buttons' => [
                //     'update' => function ($url,$model) {
                //     return Html::a(
                //     '<span class="glyphicon glyphicon-screenshot"></span>', 
                //     $url);
                // },
                'view' => function ($url,$model) {
                    return Html::a('To accept', $url);
                },
                ],
            ],
        ],
    ]); 
    ?>