<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

?>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'goods_name')->textInput()->label('Наименование') ?>

    <?= $form->field($model, 'goods_price')->textInput()->label('Цена') ?>

    <?php
		echo $form->field($model, 'goods_status')->checkbox(['label' => 'Показывать на странице?']);
	?>

    <?= $form->field($model, 'goods_img')->fileInput()->label('Выберите Фото') ?>

    <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'bttn-fill bttn-md bttn-success' : 'bttn-fill bttn-md bttn-primary']) ?>

<?php ActiveForm::end() ?>