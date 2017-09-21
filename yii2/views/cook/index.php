<?php
use yii\helpers\Html;
use app\models\Goods;
/* @var $this yii\web\View */

$this->title = 'Cook Panel';
?>

<h1 align="center">Admin</h1>

<br>
<p>	
	<a href="index.php?r=admin/create"> <button class="bttn-unite bttn-md bttn-danger">Создать</button></a>        
    </p>
<table class="table table-striped table-bordered">
<thead>
<tr>
<th>#</th>
<th>Название</th>
<th>Статус</th>
<th>Действие</th>
</tr>
</thead>
<tbody>
<?php $i=1;
foreach ($goods as $key): 
for($j=0;$j<$key->booking_connect_quantity;$j++):
?>

	    <tr>
            <th><?=++$i?></th>
            <th><p><?php $name = Goods::find()->where(['goods_id' => $key->goods_id])->one(); echo $name->goods_name;?></p> </th>
            <?php switch($key->booking_connect_status){
                    case '1' : $status = 'Не принято'; break;
                    case '2' : $status = 'Готовиться'; break;
                }
            ?>
            <th><p><?= $status?></p></th>
            <th>
            <a href="/pizza/yii2/web/index.php?r=cook%2Faccept&amp;id_booking=<?=$key->booking_id?>&amp;id_goods=<?=$key->goods_id?>">Принять</span></a>
            <a href="#">Готово</span></a>
            </th>
        </tr>
<?php
endfor;
 endforeach;
 ?>
</tbody>
</table>