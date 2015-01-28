<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
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
class Composition extends ActiveRecord
{
    const FILE_TYPE = 'composition';
    public $file; //use for upload images
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
            [['file'], 'safe'],
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
            'file' => Yii::t('app', 'Изображение для загрузки'),
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

    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'composition_id'])->viaTable('compositionItem', ['composition_id' => 'id']);
    }

    public function getFiles()
    {
        return $this->hasMany(File::className(), ['fid' => 'id'])
            ->where(['type' => self::FILE_TYPE]);
    }

    public function getBaseFileType()
    {
        return self::FILE_TYPE;
    }

    /**
     * override beforeDelete
     */
    public function beforeDelete()
    {
        if(parent::beforeDelete())
        {
            File::deleteRelatedFiles($this);
            return true;
        }
        return false;
    }
}
