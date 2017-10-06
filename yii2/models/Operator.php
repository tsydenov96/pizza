<?php

namespace app\models;

use Yii;

class Operator extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['operator_name', 'operator_surname','user_id'], 'required'],
            [['user_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'operator_name' => 'Имя',
            'operator_surname' => 'Фамилия',
        ];
    }
    public function getBooking()
    {
        return $this->hasMany(Booking::className(), ['operator_id' => 'user_id']);
    }  

}
