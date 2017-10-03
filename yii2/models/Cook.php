<?php

namespace app\models;

use Yii;

class Cook extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cook_id', 'cook_name', 'cook_surname','user_id'], 'required'],
            [['cook_id', 'user_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cook_name' => 'Имя',
            'cook_surname' => 'Фамилия',
        ];
    }
}
