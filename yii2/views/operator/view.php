<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
/* @var $this yii\web\View */

$this->title = 'Заказ';
?>

<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
					<div class="col-md-12">
                		<u>Контактная информация</u>
                	</div>
                	<br><br>
                	<?php $form = ActiveForm::begin() ?>
                	<div class="col-md-6">
                		<?= $form->field($model, 'user_name')->textInput()->label('Имя') ?>
                	</div>
                	<div class="col-md-6">
                		<?= $form->field($model, 'user_surname')->textInput()->label('Фамилия') ?>
                	</div>
                	<div class="col-md-6">
                		<?= $form->field($model, 'user_patronymic')->textInput()->label('Отчество') ?>
                	</div>
                	<div class="col-md-6">
                		<?= $form->field($model, 'user_phone')->textInput()->label('Телефон') ?>
                	</div>
                	<div class="col-md-6">
                		<?= $form->field($model, 'user_street')->textInput()->label('Улица') ?>
                	</div>
                	<div class="col-md-6">
                		<?= $form->field($model, 'user_house_number')->textInput()->label('Номер дома') ?>
                	</div>
                	<div class="col-md-6">
                		<?= $form->field($model, 'user_apartment_number')->textInput()->label('Номер квартиры') ?>
                	</div>
                	<div class="col-md-6">
                		<?= $form->field($model, 'user_entrance_number')->textInput()->label('Номер подъезда') ?>
                	</div>
                	<div class="col-md-6">
                		<?= $form->field($model, 'user_floor_number')->textInput()->label('Этаж') ?>
                	</div>
                	<div class="col-md-6">
                		<?= $form->field($model, 'user_intercom')->radioList([
						        '0' => 'Не работает',
						        '1' => 'Работает',
					    	])->label('Домофон'); 
					    ?>
                	</div>
                </div>
                <div class="row">
                	<div class="col-md-6">
                		<button type="submit" class="btn btn-large btn-success">Принять заказ</button>
                	</div>
                </div>
                <?php $form = ActiveForm::end() ?>
            </div>
            <div class="col-md-4">
            	<div class="row">
	            	<div class="col-md-12">
	                	<u>Счет</u>
	                </div>
	                <br><br>
	                <div class="col-md-12">
	                	Заказ №<?= $model->booking_id?>
	                </div>
	                <br><br>
	                <div class="col-md-12">
	                	<table class="table table-striped">
							<thead>
								<tr>
									<th>Наименование</th>
									<th>Кол-во</th>
									<th>Сумма</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$price = 0;
									foreach ($account as $ac): 
								?>
								<tr>
						            <th><p><?= Html::encode ("{$ac['goods_name']}") ?> </p> </th>
						            <th><p><?= Html::encode ("{$ac['count']}") ?> </p> </th>
						            <?php $goods_price = $ac['goods_price']*$ac['count'];?>
						            <th><p><?= Html::encode ("{$goods_price}") ?> </p> </th>
					        	</tr>
								<?php
									$price+=$ac['goods_price']*$ac['count'];
									endforeach;
								?>
							</tbody>
						</table>
	                </div>
	                <div class="col-md-12">
	                	<b>Итого</b>: <?= $price?> рублей
	                </div>
	            </div>
            </div>
        </div>
    </div>
</div>