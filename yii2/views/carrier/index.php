<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Bookink;
/* @var $this yii\web\View */
//$url='view';
$this->title = Yii::t('app', 'Carrier');
?>

<div class="booking-index">

    <h1><?= Html::encode($this->title) ?></h1>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'formatter' => [
        'class' => 'yii\i18n\Formatter',
        'nullDisplay' => '',
    ],
        //'layout'=>"{sorter}\n{pager}\n{summary}\n{items}",
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
            //'booking_id',
        'user_name',
        'user_address',
        'user_phone',
        'carrier.username',
        'booking_status',
        'booking_date',
        'operator.username',
        [
            'class' => 'yii\grid\ActionColumn',
            'controller' => 'carrier',
            'header'=>'Действия', 
            'template' => '{accept} {delivery}',
            'buttons' => [
                //     'update' => function ($url,$model) {
                //     return Html::a(
                //     '<span class="glyphicon glyphicon-screenshot"></span>', 
                //     $url);
                // },
                'accept' => function ($url,$model) {
                    return Html::a('<span class="glyphicon glyphicon-plus"></span>', $url);
                },
                'delivery' => function ($url,$model) {
                    return Html::a('<span class="glyphicon glyphicon-ok"></span>', $url);
                },
            ],
        ],
    ],
]); 
?>