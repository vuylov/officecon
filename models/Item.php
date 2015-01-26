<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
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
class Item extends ActiveRecord
{
    const FILE_TYPE = 'item';

    public $file; //use for uploading files
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
            [['product_id', 'article'], 'required', 'message' => 'Необходимо заполнить'],
            [['product_id', 'amount'], 'integer'],
            [['weight', 'volume'], 'number'],
            [['description'], 'string'],
            [['file'], 'safe'],
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
            'product_id' => 'Продукт',
            'article' => 'Артикль',
            'size' => 'Размер',
            'weight' => 'Вес',
            'volume' => 'Объем',
            'amount' => 'Количество',
            'description' => 'Описание',
            'file'      => 'Изображения для загрузки'
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
    public function getPrices()
    {
        return $this->hasMany(Price::className(), ['productItem_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(File::className(), ['fid' => 'id'])->where(['type' => self::FILE_TYPE]);
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
