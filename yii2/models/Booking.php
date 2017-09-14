<?php

namespace app\models;

use Yii;
use yii\base\Model;


class Booking extends \yii\db\ActiveRecord
{

public function rules()
    {
        return [
            [['user_surname','user_name','user_patronymic','user_address','user_phone','operator_id','carrier_id','booking_status','booking_date'], 'required'],
        ];
    }
}

?>