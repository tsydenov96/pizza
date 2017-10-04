<?php

/* @var $this yii\web\View */

$this->title = 'Управляющий';
?>

<div class="site-index">
    <div class="body-content">
    	<h1 align="center">Панель Управляющего</h1>
    	<br><br><br>
        <div class="row">
            <div class="col-lg-3 col-lg-offset-2 alert alert-success">
                <h3>Показать все товары</h3><br><br>
                <a href="index.php?r=admin/show-goods"><button class="bttn-jelly bttn-md bttn-success">Перейти</button></a>
            </div>
            <div class="col-lg-3 col-lg-offset-2 alert alert-success">
                <h3>Редактирование пользователей</h3><br>
                <a href="index.php?r=admin/show-user"><button class="bttn-jelly bttn-md bttn-success">Перейти</button></a>
            </div>
        </div>
    </div>
</div>