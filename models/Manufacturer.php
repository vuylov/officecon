<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\models\Product;
use app\models\Color;

/**
 * This is the model class for table "manufacturer".
 *
 * @property integer $id
 * @property string $name
 * @property string $image
 * @property string $url
 * @property string $country
 *
 * @property Product[] $products
 */
class Manufacturer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'manufacturer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['image'], 'safe'],
            [['name', 'url', 'country'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'image' => 'Изображение',
            'url' => 'Адрес сайта',
            'country' => 'Страна',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['manufacturer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColors()
    {
        return $this->hasMany(Color::className(), ['manufacturer_id' => 'id']);
    }
}
