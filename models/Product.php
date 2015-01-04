<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $manufacturer_id
 * @property string $name
 * @property string $description
 * @property integer $active
 * @property string $create_at
 * @property string $deactivate_at
 *
 * @property Manufacturer $manufacturer
 * @property User $user
 * @property ProductToCatalog[] $productToCatalogs
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'manufacturer_id', 'name'], 'required'],
            [['user_id', 'manufacturer_id', 'active'], 'integer'],
            [['description'], 'string'],
            [['create_at', 'deactivate_at'], 'safe'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'manufacturer_id' => Yii::t('app', 'Manufacturer ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'active' => Yii::t('app', 'Active'),
            'create_at' => Yii::t('app', 'Create At'),
            'deactivate_at' => Yii::t('app', 'Deactivate At'),
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductToCatalogs()
    {
        return $this->hasMany(ProductToCatalog::className(), ['product_id' => 'id']);
    }
}
