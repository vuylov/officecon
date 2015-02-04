<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "productColor".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $color_id
 *
 * @property Color $color
 * @property Product $product
 */
class ProductColors extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'productColor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'color_id'], 'required', 'message' => 'Обязателен для заполнения'],
            [['product_id', 'color_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Продукт',
            'color_id' => 'Цвета',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseColor()
    {
        return $this->hasOne(Color::className(), ['id' => 'color_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
