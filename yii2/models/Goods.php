<?php

namespace app\models;

use Yii;
use yii\base\Model;


class Goods extends \yii\db\ActiveRecord
{

    public function rules()
    {
        return [
            [['goods_name','goods_price','goods_status'], 'required'],
            [['goods_img'],'default','value'=>""],
            [['goods_img'], 'file', 'extensions' => ['png', 'jpg', 'gif','jpeg']],
        ];
    }

    public function create()
    {
        if ($this->validate()) {
            if(is_string($this->goods_img))
            {
                $this->goods_img = "123";
                return true;
            }
            else
            {
                $this->goods_img->saveAs($_SERVER['DOCUMENT_ROOT'].'/yii2/upload/' .time()."_". $this->goods_img->baseName . '.' . $this->goods_img->extension);
                $this->goods_img=time()."_".$this->goods_img->baseName . '.' . $this->goods_img->extension;
                return true;
            } 
        }   
        else {
            return false;
        }
        
    }

    public function updateGoods($link_old)
    {
        if ($this->validate()) {
            if(is_string($this->goods_img))
            {
                return true;
            }
            else
            {
                if($link_old!='123')
                    unlink($_SERVER['DOCUMENT_ROOT'].'/yii2/upload/'.$link_old);
                $this->goods_img->saveAs($_SERVER['DOCUMENT_ROOT'].'/yii2/upload/' .time()."_". $this->goods_img->baseName . '.' . $this->goods_img->extension);
                $this->goods_img=time()."_".$this->goods_img->baseName . '.' . $this->goods_img->extension;
                return true;
            } 
        }   
        else {
            return false;
        }
        
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookingConnect()
    {
        return $this->hasMany(BookingConnect::className(), ['goods_id' => 'goods_id']);
    }
     /**
     * @return \yii\db\ActiveQuery
     */
     public function getGoods()
     {
        return $this->hasMany(Booking::className(), ['booking_id' => 'booking_id'])->viaTable('booking_connect', ['goods_id' => 'goods_id']);
    }

}
?>