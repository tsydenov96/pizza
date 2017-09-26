<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Booking;


class BookingSearch extends Operator{

        public function search($params)
    {
        $query = Booking::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'booking_id' => $this->booking_id,
            'user_surname' => $this->user_surname,
            'user_name' => $this->user_name,
            'user_patronymic' => $this->user_patronymic,
            'user_address' => $this->user_address,
            'user_phone' => $this->user_phone,
            'operator_id' => $this->operator_id,
            'carrier_id' => $this->carrier_id,
            'booking_status' => $this->booking_status,
            'booking_date' => $this->booking_date,
        ]);

        // $query->andFilterWhere(['like', 'img_name', $this->img_name])
        //     ->andFilterWhere(['like', 'advert_mess_text', $this->advert_mess_text])
        //     ->andFilterWhere(['like', 'addit_inf', $this->addit_inf])
        //     ->andFilterWhere(['like', 'stand_form', $this->stand_form])
        //     ->andFilterWhere(['like', 'size', $this->size])
        //     ->andFilterWhere(['like', 'domin_colors', $this->domin_colors]);

        return $dataProvider;
    }

    public static function tableName()
    {
        return '{{%booking}}';
    }

}

