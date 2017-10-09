<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Bookink;
/* @var $this yii\web\View */

$this->title = Yii::t('app', 'Operator');
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