<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "currency".
 *
 * @property integer $id
 * @property string $name
 *
 * @property ProductPrice[] $productPrices
 */
class Currency extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'currency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Валюта',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductPrices()
    {
        return $this->hasMany(ProductPrice::className(), ['currency_id' => 'id']);
    }
}
