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
            [['productItem_id', 'currency_id'], 'required'],
            [['productItem_id', 'currency_id'], 'integer'],
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
            'productItem_id' => Yii::t('app', 'Product Item ID'),
            'currency_id' => Yii::t('app', 'Currency ID'),
            'value' => Yii::t('app', 'Value'),
            'cause' => Yii::t('app', 'Cause'),
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
    public function getProductItem()
    {
        return $this->hasOne(Item::className(), ['id' => 'productItem_id']);
    }
}
