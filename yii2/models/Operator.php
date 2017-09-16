<?php

namespace app\models;

use Yii;
use yii\base\Model;


class Operator extends \yii\db\ActiveRecord
{


    public static function tableName()
    {
        return 'booking';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_surname', 'user_name', 'user_patronymic', 'user_address', 'user_phone', 'carrier_id', 'booking_status', 'booking_date'], 'required'],
            [['user_phone', 'operator_id', 'carrier_id', 'booking_status'], 'integer'],
            [['booking_date'], 'safe'],
            [['user_surname', 'user_name', 'user_patronymic', 'user_address'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'booking_id' => 'Booking ID',
            'user_surname' => 'User Surname',
            'user_name' => 'User Name',
            'user_patronymic' => 'User Patronymic',
            'user_address' => 'User Address',
            'user_phone' => 'User Phone',
            'operator_id' => 'Operator ID',
            'carrier_id' => 'Carrier ID',
            'booking_status' => 'Booking Status',
            'booking_date' => 'Booking Date',
        ];
    }


}

?>