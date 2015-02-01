<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "compositionItem".
 *
 * @property integer $id
 * @property integer $productItem_id
 * @property integer $composition_id
 * @property integer $amount
 *
 * @property Composition $composition
 * @property ProductItem $productItem
 */
class CompositionItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'compositionItem';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'composition_id'], 'required', 'message' => 'Необходимо заполнить'],
            [['product_id', 'composition_id', 'amount'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => Yii::t('app','Продукт'),
            'composition_id' => Yii::t('app','Композиция'),
            'amount' => Yii::t('app','Количество'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComposition()
    {
        return $this->hasOne(Composition::className(), ['id' => 'composition_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
