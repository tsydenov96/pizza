<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "booking_connect".
 *
 * @property integer $booking_id
 * @property integer $goods_id
 * @property integer $booking_connect_quantity
 * @property integer $booking_connect_cook_id
 * @property integer $booking_connect_status
 *
 * @property Goods $goods
 * @property Booking $booking
 */
class BookingConnect extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'booking_connect';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['booking_id', 'goods_id', 'booking_connect_quantity', 'booking_connect_cook_id', 'booking_connect_status'], 'required'],
            [['booking_id', 'goods_id', 'booking_connect_quantity', 'booking_connect_cook_id', 'booking_connect_status'], 'integer'],
            [['goods_id'], 'exist', 'skipOnError' => true, 'targetClass' => Goods::className(), 'targetAttribute' => ['goods_id' => 'goods_id']],
            [['booking_id'], 'exist', 'skipOnError' => true, 'targetClass' => Booking::className(), 'targetAttribute' => ['booking_id' => 'booking_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'booking_id' => 'Booking ID',
            'goods_id' => 'Goods ID',
            'booking_connect_quantity' => 'Booking Connect Quantity',
            'booking_connect_cook_id' => 'Booking Connect Cook ID',
            'booking_connect_status' => 'Booking Connect Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoods()
    {
        return $this->hasOne(Goods::className(), ['goods_id' => 'goods_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooking()
    {
        return $this->hasOne(Booking::className(), ['booking_id' => 'booking_id']);
    }
}
