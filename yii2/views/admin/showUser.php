<?php
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'Пользователи';
?>

<h1 align="center">Пользователи</h1>

<br>
<p>	
	<a href="index.php?r=admin/add-user"> <button class="bttn-unite bttn-md bttn-danger">Добавить</button></a>        
    </p>
<table class="table table-striped table-bordered">
<thead>
<tr>
<th>#</th>
<th>Имя</th>
<th>Фамилия</th>
<th>Должность</th>
<th>Действие</th>
</tr>
</thead>
<tbody>
<?php $i=1;
foreach ($cooks as $cook): 
?>
	    <tr>
            <th><?=$i?></th>
            <th><p><?= Html::encode ("{$cook->cook_name}") ?></p> </th>
            <th><p><?= Html::encode ("{$cook->cook_surname}") ?></p> </th>
            <th><p>Повар</p> </th>
            <th>
            <a href="/yii2/web/index.php?r=admin%2Fupdate-user&amp;id_user=<?=$cook->user_id?>&amp;info_id=<?=$cook->cook_id?>" title="Update" aria-label="Update" data-pjax="0"><span class="glyphicon glyphicon-pencil"></span></a>
            <a href="/yii2/web/index.php?r=admin%2Fdelete-user&amp;id_user=<?=$cook->user_id?>&amp;info_id=<?=$cook->cook_id?>" title="Delete" aria-label="Delete" data-confirm="Are you sure you want to delete this item?" data-method="post" data-pjax="0"><span class="glyphicon glyphicon-trash"></span></a>
            </th>
        </tr>
<?php $i++;
 endforeach;
 ?>
<?php 
 foreach ($operators as $oper): 
?>
        <tr>
            <th><?=$i?></th>
            <th><p><?= Html::encode ("{$oper->operator_name}") ?></p> </th>
            <th><p><?= Html::encode ("{$oper->operator_surname}") ?></p> </th>
            <th><p>Оператор</p> </th>
            <th>
            <a href="/yii2/web/index.php?r=admin%2Fupdate-user&amp;id_user=<?=$oper->user_id?>&amp;info_id=<?=$oper->operator_id?>" title="Update" aria-label="Update" data-pjax="0"><span class="glyphicon glyphicon-pencil"></span></a>
            <a href="/yii2/web/index.php?r=admin%2Fdelete-user&amp;id_user=<?=$oper->user_id?>&amp;info_id=<?=$oper->operator_id?>" title="Delete" aria-label="Delete" data-confirm="Are you sure you want to delete this item?" data-method="post" data-pjax="0"><span class="glyphicon glyphicon-trash"></span></a>
            </th>
        </tr>
<?php $i++;
 endforeach;
 ?>
<?php 
 foreach ($carriers as $carr): 
?>
        <tr>
            <th><?=$i?></th>
            <th><p><?= Html::encode ("{$carr->carrier_name}") ?></p> </th>
            <th><p><?= Html::encode ("{$carr->carrier_surname}") ?></p> </th>
            <th><p>Курьер</p> </th>
            <th>
            <a href="/yii2/web/index.php?r=admin%2Fupdate-user&amp;id_user=<?=$carr->user_id?>&amp;info_id=<?=$carr->carrier_id?>" title="Update" aria-label="Update" data-pjax="0"><span class="glyphicon glyphicon-pencil"></span></a>
            <a href="/yii2/web/index.php?r=admin%2Fdelete-user&amp;id_user=<?=$carr->user_id?>&amp;info_id=<?=$carr->carrier_id?>" title="Delete" aria-label="Delete" data-confirm="Are you sure you want to delete this item?" data-method="post" data-pjax="0"><span class="glyphicon glyphicon-trash"></span></a>
            </th>
        </tr>
<?php $i++;
 endforeach;
 ?>
</tbody>
</table>