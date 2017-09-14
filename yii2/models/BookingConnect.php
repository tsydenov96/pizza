<?php

namespace app\models;

use Yii;
use yii\base\Model;


class BookingConnect extends \yii\db\ActiveRecord
{

public function rules()
    {
        return [
            [['booking_id','goods_id','booking_connect_quantity','booking_connect_cook_id','booking_connect_status'], 'required'],
        ];
    }
}

?>