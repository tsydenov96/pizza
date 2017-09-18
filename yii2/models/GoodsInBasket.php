<?php

namespace app\models;

use Yii;


class GoodsInBasket
{
	public $id;
	public $count;
	function __construct($id){
		$this->id = $id;
		$this->count = 1;
	}
}
?>