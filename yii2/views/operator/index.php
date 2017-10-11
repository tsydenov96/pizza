<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Bookink;
/* @var $this yii\web\View */

$this->title = Yii::t('app', 'Оператор');
?>

<div class="booking-index">

    <h1 align="center"><?= $this->title?></h1>

    <p> 
    <a href="index.php?r=operator/create"> <button class="bttn-unite bttn-md bttn-danger">Создать заказ</button></a>        
    </p>

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
        'user_phone',
        'user_street',
        'user_house_number',
        'user_apartment_number',
        'user_entrance_number',
        'user_floor_number',
        'user_intercom',
        //'carrier.username',
        'booking_status',
        'booking_date',
        [
            'attribute' => 'operator.operator_name',
            'value' => function($model) {
                return $model->getOperatorName() . ' ' . $model->getOperatorSurname();
            },
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'controller' => 'operator',
            'header'=>'Действия', 
            'template' => '{accept} {remove} {view}',
            'buttons' => [
                //     'update' => function ($url,$model) {
                //     return Html::a(
                //     '<span class="glyphicon glyphicon-screenshot"></span>', 
                //     $url);
                // },
                'accept' => function ($url,$model) {
                    return Html::a('<span class="glyphicon glyphicon-ok"></span>', $url);
                },
                'remove' => function ($url,$model) {
                    return Html::a('<span class="glyphicon glyphicon-remove"></span>', $url);
                },
                'view' => function ($url,$model) {
                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url);
                },
            ],
        ],
    ],
]); 
    ?>
</div>