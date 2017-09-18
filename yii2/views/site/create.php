<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

?>

<?php $form = ActiveForm::begin() ?>

    <?= $form->field($model, 'user_surname')->textInput()->label('Фамилия') ?>

    <?= $form->field($model, 'user_name')->textInput()->label('Имя') ?>

    <?= $form->field($model, 'user_patronymic')->textInput()->label('Отчество') ?>

     <?= $form->field($model, 'user_address')->textInput()->label('Адрес') ?>

      <?= $form->field($model, 'user_phone')->textInput()->label('Телефон') ?>

    <button type="submit">Заказать</button>

<?php ActiveForm::end() ?>