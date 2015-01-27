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
 * @property integer $manufacturer_id
 *
 * @property Manufacturer $manufacturer
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
            [['name', 'manufacturer_id'], 'required'],
            [['price'], 'number'],
            [['manufacturer_id'], 'integer'],
            [['name', 'description'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Название'),
            'description' => Yii::t('app', 'Описание'),
            'price' => Yii::t('app', 'Цена'),
            'manufacturer_id' => Yii::t('app', 'Поставщик'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManufacturer()
    {
        return $this->hasOne(Manufacturer::className(), ['id' => 'manufacturer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompositionItems()
    {
        return $this->hasMany(CompositionItem::className(), ['composition_id' => 'id']);
    }

    public function getBaseFileType()
    {
        return self::FILE_TYPE;
    }
}
