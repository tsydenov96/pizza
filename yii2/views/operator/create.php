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
                <div class="form-1">
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
                <!-- Конец 1 формы -->
                	<div class="col-md-12">
                		<button type="button" class="btn btn-large btn-success" id="first-next">Далее</button>
                	</div>
                </div>
                <div class="form-2" style="display: none;">
                	<div class="col-md-12">
                		<ul class="nav nav-tabs">
						  <li class="active"><a href="#pizza" data-toggle="tab">Пицца</a></li>
						  <li><a href="#dessert" data-toggle="tab">Десерты</a></li>
						  <li><a href="#beverages" data-toggle="tab">Напитки</a></li>
						</ul>
                	</div>
                  	<div class="tab-content">
                		<div class="tab-pane active" id="pizza">
	                		<?php
	                			foreach ($goods as $goods):
					        ?>
					        <div class="col-md-4">
					            <img src="<?='/pizza/yii2/upload/'.$goods->goods_img?>" width="100" height="100" class="img-rounded" alt="<?= $goods->goods_name?>">
					            <br>
					            <p><?= Html::encode ("{$goods->goods_name}") ?></p>
					            <p><?= Html::encode ("{$goods->goods_price}") ?></p>
					            <button type="button" class="btn btn-info">В корзину</button>
					        </div>
					        <?php
					            endforeach;
					        ?>
					    </div>
					    <div class="tab-pane" id="dessert">
					    	dessert
					    </div>
					    <div class="tab-pane" id="beverages">
					    	beverages
					    </div>
                	</div> 	
                	<br><br><br>
	                <div class="col-md-6">
	                	<button type="button" class="btn btn-large btn-success" id="first-back">Назад</button>
	                </div>
	                <div class="col-md-6">
	                	<button type="button" class="btn btn-large btn-success" id="second-next">Далее</button>
	                </div>
                </div>
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
							</tbody>
						</table>
	                </div>
	                <div class="col-md-12">
	                	<b>Итого</b>: рублей
	                </div>
	            </div>
            </div>
			<?php $form = ActiveForm::end() ?>
        </div>
    </div>
</div>
<script src="js/createBooking.js" defer></script> 