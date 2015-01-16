<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "productItem".
 *
 * @property integer $id
 * @property integer $product_id
 * @property string $article
 * @property string $size
 * @property double $weight
 * @property double $volume
 * @property integer $amount
 * @property string $description
 *
 * @property CompositionItem[] $compositionItems
 * @property Product $product
 * @property ProductPrice[] $productPrices
 */
class ProductItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'productItem';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'article'], 'required'],
            [['product_id', 'amount'], 'integer'],
            [['weight', 'volume'], 'number'],
            [['description'], 'string'],
            [['article', 'size'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'article' => 'Article',
            'size' => 'Size',
            'weight' => 'Weight',
            'volume' => 'Volume',
            'amount' => 'Amount',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompositionItems()
    {
        return $this->hasMany(CompositionItem::className(), ['productItem_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductPrices()
    {
        return $this->hasMany(ProductPrice::className(), ['productItem_id' => 'id']);
    }
}
