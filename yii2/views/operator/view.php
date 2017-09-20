<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use app\models\BookingConnect;
use app\models\Booking;

/* @var $this yii\web\View */
//$url='view';
$this->title = Yii::t('app', 'Operator');

$dataProvider = new ActiveDataProvider([
	'query' => Post::find(),
	'pagination' => [
		'pageSize' => 20,
	],
]);
echo ListView::widget([
	'dataProvider' => $dataProvider,
	'itemView' => '_post',
]);

?>
