<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "booking".
 *
 * @property integer $booking_id
 * @property string $user_surname
 * @property string $user_name
 * @property string $user_patronymic
 * @property string $user_address
 * @property integer $user_phone
 * @property integer $operator_id
 * @property integer $carrier_id
 * @property integer $booking_status
 * @property string $booking_date
 *
 * @property BookingConnect[] $bookingConnects
 * @property Goods[] $goods
 */
class Booking extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
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
            [['user_surname', 'user_name', 'user_patronymic', 'user_address', 'user_phone', 'booking_status', 'booking_date'], 'required'],
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
            'user_surname' => 'Фамилия',
            'user_name' => 'Имя',
            'user_patronymic' => 'Отчество',
            'user_address' => 'Адрес',
            'user_phone' => 'Телефон',
            'operator_id' => 'Operator ID',
            'carrier_id' => 'Carrier ID',
            'booking_status' => 'Статус',
            'booking_date' => 'Время',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookingConnects()
    {
        return $this->hasMany(BookingConnect::className(), ['booking_id' => 'booking_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoods()
    {
        return $this->hasMany(Goods::className(), ['goods_id' => 'goods_id'])->viaTable('booking_connect', ['booking_id' => 'booking_id']);
    }
}
