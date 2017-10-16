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
                	<?php $form = ActiveForm::begin(['enableClientValidation' => true, 'enableAjaxValidation' => false]) ?>
                	<div class="row">
	                	<div class="col-md-6">
	                		<?= $form->field($model, 'user_name')->textInput()->label('Имя') ?>
	                	</div>
	                	<div class="col-md-6">
	                		<?= $form->field($model, 'user_surname')->textInput()->label('Фамилия') ?>
	                	</div>
                	</div>
                	<div class="row">
	                	<div class="col-md-6">
	                		<?= $form->field($model, 'user_patronymic')->textInput()->label('Отчество') ?>
	                	</div>
	                	<div class="col-md-6">
	                		<?= $form->field($model, 'user_phone')->textInput()->label('Телефон') ?>
	                	</div>
	                </div>
                	<div class="row">
	                	<div class="col-md-6">
	                		<?= $form->field($model, 'user_street')->textInput()->label('Улица') ?>
	                	</div>
	                	<div class="col-md-6">
	                		<?= $form->field($model, 'user_house_number')->textInput()->label('Номер дома') ?>
	                	</div>
	                </div>
	                <div class="row">
	                	<div class="col-md-6">
	                		<?= $form->field($model, 'user_apartment_number')->textInput()->label('Номер квартиры') ?>
	                	</div>
	                	<div class="col-md-6">
	                		<?= $form->field($model, 'user_entrance_number')->textInput()->label('Номер подъезда') ?>
	                	</div>
	                </div>
	                <div class="row">
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
                <!-- Конец 1 формы -->
                	<div class="row">
	                	<div class="col-md-12">
	                		<button type="submit" class="btn btn-large btn-success" id="first-next">Далее</button>
	                	</div>
	                </div>
                </div>
                <?php $form = ActiveForm::end() ?>
                <div class="form-2" style="display: none;">
                	<div class="col-md-12">
                		<ul class="nav nav-tabs">
						  <li class="active"><a href="#pizza" data-toggle="tab">Пицца</a></li>
						  <li><a href="#dessert" data-toggle="tab">Десерты</a></li>
						  <li><a href="#beverages" data-toggle="tab">Напитки</a></li>
						</ul>
                	</div>
                	<div class="clearfix"></div>
                	<hr>	
                  	<div class="tab-content">
                		<div class="tab-pane active" id="pizza">
	                		<?php
	                			foreach ($goods as $goods):
					        ?>
					        <div class="col-md-4">
					            <img src="<?='/pizza/yii2/upload/'.$goods->goods_img?>" width="100" height="100" class="img-rounded" alt="<?= $goods->goods_name?>">
					            <br>
					            <p class="name"><?= Html::encode ("{$goods->goods_name}") ?></p>
					            <p class="price"><?= Html::encode ("{$goods->goods_price}") ?></p>
					            <button type="button" class="btn btn-info btn-add" data-id="<?=$goods->goods_id?>">В корзину</button>
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
                	<div class="clearfix"></div>
                	<hr>
                	<div class="row">
		                <div class="col-md-6">
		                	<button type="button" class="btn btn-large btn-primary" id="first-back">Назад</button>
		                </div>
		                <div class="col-md-6">
		                	<button type="button" class="btn btn-large btn-success" id="second-next">Далее</button>
		                </div>
		            </div>
                </div>
                <div class="form-3" style="display: none;">
                	<h1>Оплата</h1>
                	<div class="clearfix"></div>
                	<hr>
                	<div class="row">
	                	<div class="col-md-6">
	                		<button type="button" class="btn btn-large btn-default">Наличные</button>
	                	</div>	
	                	<div class="col-md-6">
	                		<button type="button" class="btn btn-large btn-default">Карта</button>
	                	</div>	
	                </div>
	                <h1>Купюры к оплате</h1>
	                <hr>
	               	<div class="row">
	               		<button type="button" class="btn btn-large btn-default">100</button>
	               		<button type="button" class="btn btn-large btn-default">500</button>
	               		<button type="button" class="btn btn-large btn-default">1000</button>
	               		<button type="button" class="btn btn-large btn-default">5000</button>
	               	</div>
                	<div class="clearfix"></div>
                	<hr>
                	<div class="row">
		                <div class="col-md-6">
		                	<button type="button" class="btn btn-large btn-primary" id="second-back">Назад</button>
		                </div>
		                <div class="col-md-6">
		                	<button type="button" class="btn btn-large btn-success" id="accept">Готово</button>
		                </div>
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
	                	<table class="table table-striped table-goods">
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
	                <div class="col-md-12 total-price">
	                </div>
	            </div>
            </div>
        </div>
    </div>
</div>
<?php
$ar = array();
 	  $i=0;
     foreach ($account as $val) :
	     $ar[$i]['goods_id']=$val->goods_id;
	     $ar[$i]['goods_name']=$val->goods_name;
	     $ar[$i]['goods_price']=$val->goods_price;
	     $ar[$i]['count']=$val->count;
	      $i++;
     endforeach;
 ?>
<script type="text/javascript">
	window.date = <?php
     echo json_encode(['goods' => $ar]);
  ?>;
</script>
<script src="js/createBooking.js" defer></script> 