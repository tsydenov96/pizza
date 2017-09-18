<?php
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'Корзина';
?>

<h1 align="center">Корзина</h1>

<table class="table table-striped">
<thead>
<tr>
<th>Название</th>
<th>Цена</th>
<th>Количество</th>
</tr>
</thead>
<tbody>
<?php
$price = 0;
foreach ($goods as $key): 
?>
	    <tr>
            <th><p><?= Html::encode ("{$key[0]->goods_name}") ?></p> </th>
            <th><p><?= Html::encode ("{$key[0]->goods_price} руб.") ?></p> </th>
            <th><a href="/pizza/yii2/web/index.php?r=site%2Fcount-goods&amp;do=1&amp;id=<?=$key[0]->goods_id?>"><span class="glyphicon glyphicon-minus"></span></a>
            	<?= Html::encode ("{$key[1]}") ?>
            <a href="/pizza/yii2/web/index.php?r=site%2Fcount-goods&amp;do=2&amp;id=<?=$key[0]->goods_id?>"><span class="glyphicon glyphicon-plus"></span></a> </th>
            <th>
            <a href="/pizza/yii2/web/index.php?r=site%2Fdelete-goods&amp;id=<?=$key[0]->goods_id?>" title="Delete" aria-label="Delete" data-confirm="Are you sure you want to delete this item?" data-method="post" data-pjax="0"><span class="glyphicon glyphicon-remove"></span></a>
            </th>
        </tr>
<?php
 $price+=$key[0]->goods_price*$key[1];
 endforeach;
?>
</tbody>
</table>

<h2>Итого: <?= $price;?> руб. </h2> 
<a href="/pizza/yii2/web/index.php?r=site%2Fbooking-create"><button>Заказать</button></a>