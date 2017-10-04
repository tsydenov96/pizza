<?php

namespace app\models;

use Yii;

class Carrier extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['carrier_id', 'carrier_name', 'carrier_surname','user_id'], 'required'],
            [['carrier_id', 'carrier_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'carrier_name' => 'Имя',
            'carrier_surname' => 'Фамилия',
        ];
    }
}
