<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "composition".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property double $price
 *
 * @property CompositionItem[] $compositionItems
 */
class Composition extends \yii\db\ActiveRecord
{
    const FILE_TYPE = 'composition';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'composition';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['price'], 'number'],
            [['name', 'description'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'price' => 'Price',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompositionItems()
    {
        return $this->hasMany(CompositionItem::className(), ['composition_id' => 'id']);
    }
}
