<?php
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'Pizza store';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Пиццерия!</h1>
    </div>

    <div class="body-content">

        <div class="row">
            <?php
                foreach ($goods as $goods):
            ?>
            
                <div class="col-md-4">
                    <img src="<?='/pizza/yii2/upload/'.$goods->goods_img?>" width="300" height="250" class="img-rounded" alt="<?= $goods->goods_name?>">
                    <br>
                    <h4><?= Html::encode ("{$goods->goods_name}") ?></h4>
                    <h4><?= Html::encode ("{$goods->goods_price}") ?></h4>
                    <form action="index.php?r=site/choose-goods" method="POST">
                        <input type="hidden" name="goods_id" value="<?=$goods->goods_id;?>">
                        <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                        <button type="submit">В корзину</button>
                    </form>
                </div>

            <?php
                endforeach;
            ?>
        </div>
    </div>
</div>
