<?php
use yii\helpers\Html;
use app\models\Goods;
use app\models\Cook;
use app\models\BookingConnect;
/* @var $this yii\web\View */

$this->title = 'Cook Panel';
?>

<h1 align="center">Cook</h1>

<br>
<table class="table table-striped table-bordered">
<thead>
<tr>
<th>#</th>
<th>Название</th>
<th>Статус</th>
<th>Повар</th>
<th>Действие</th>
</tr>
</thead>
<tbody>
<?php $i=1;
foreach ($goods as $key): 
?>

	    <tr>
            <th><?=$i++?></th>
            <th><p><?php $name = Goods::find()->where(['goods_id' => $key->goods_id])->one(); echo $name->goods_name;?></p> </th>
            <?php switch($key->booking_connect_status){
                    case '1' : $status = 'Не принято'; break;
                    case '2' : $status = 'Готовиться'; break;
                }
            ?>
            <th><p><?= $status?></p></th>
            <?php
                if($key->booking_connect_status==2): 
                    $cook = Cook::find()->innerJoin('pizza_booking_connect','pizza_cook.user_id = pizza_booking_connect.booking_connect_cook_id')->where(['booking_connect_id' => $key->booking_connect_id])->one();
            ?>
            <th><p><?= $cook->cook_name;?> <?= $cook->cook_surname;?></p></th>
        <?php else: ?>
            <th><p></p></th>
        <?php endif; ?>
            <th>
            <a href="/pizza/yii2/web/index.php?r=cook%2Faccept&amp;id=<?=$key->booking_connect_id?>">Принять</span></a>
            <a href="/pizza/yii2/web/index.php?r=cook%2Fready&amp;id=<?=$key->booking_connect_id?>">Готово</span></a>
            </th>
        </tr>
<?php
 endforeach;
 ?>
</tbody>
</table>