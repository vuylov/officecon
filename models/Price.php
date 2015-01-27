<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "productPrice".
 *
 * @property integer $id
 * @property integer $productItem_id
 * @property integer $currency_id
 * @property double $value
 * @property string $cause
 *
 * @property Currency $currency
 * @property ProductItem $productItem
 */
class Price extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'productPrice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['productItem_id', 'currency_id'], 'required', 'message' => Yii::t('app', 'Поле обязательное для заполнения')],
            [['productItem_id', 'currency_id'], 'integer', 'message' => Yii::t('app', 'Значение должно быть числовым')],
            [['value'], 'number'],
            [['cause'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'productItem_id' => Yii::t('app', 'Артикул'),
            'currency_id' => Yii::t('app', 'Валюта'),
            'value' => Yii::t('app', 'Значение'),
            'cause' => Yii::t('app', 'Причина'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(Currency::className(), ['id' => 'currency_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::className(), ['id' => 'productItem_id']);
    }
}
