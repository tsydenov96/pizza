<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

?>
<?php $form = ActiveForm::begin() ?>

	<?= $form->field($model_info, 'name')->textInput()->label('Имя') ?>

    <?= $form->field($model_info, 'surname')->textInput()->label('Фамилия') ?>

    <?= $form->field($model_user, 'username')->textInput()->label('Логин') ?>

    <?= $form->field($model_user, 'password')->textInput()->label('Пароль') ?>

    <?= $form->field($model_user, 'status')->radioList([
	        '4' => 'Повар',
	        '2' => 'Оператор',
	        '3' => 'Курьер'
    	]); 
    ?>

    <?= Html::submitButton($model_user->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model_user->isNewRecord ? 'bttn-fill bttn-md bttn-success' : 'bttn-fill bttn-md bttn-primary']) ?>

<?php ActiveForm::end() ?>