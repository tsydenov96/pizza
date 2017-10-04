<?php

namespace app\models;

use Yii;

class ModelInfo extends \yii\db\ActiveRecord
{
    public $name;
    public $surname;

    public function rules()
    {
        return [
            [['name', 'surname'], 'required'],
        ];
    }


}
