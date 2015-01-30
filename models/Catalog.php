<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catalog".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property integer $level
 *
 * @property Catalog $parent
 * @property Catalog[] $catalogs
 * @property ProductToCatalog[] $productToCatalogs
 */
class Catalog extends \yii\db\ActiveRecord
{
    const VISIBLE   = 1;
    const INVISIBLE = 0;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'catalog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'level', 'keywords', 'description'], 'required', 'message' => Yii::t('app', 'Поле обязательно для заполнения')],
            [['level', 'visible', 'sort'], 'integer', 'message' => Yii::t('app', 'Значение должно быть числовым')],
            [['parent_id'], 'safe'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'        => Yii::t('app', 'Каталог'),
            'parent_id' => Yii::t('app', 'Иерархия'),
            'name'      => Yii::t('app', 'Название'),
            'level'     => Yii::t('app', 'Уровень'),
            'visible'   => Yii::t('app', 'Показывать в каталоге'),
            'sort'      => Yii::t('app', 'Сортировка'),
            'keywords'  => Yii::t('app', 'Ключевые слова'),
            'description'   => Yii::t('app','Описание'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Catalog::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChilds()
    {
        return $this->hasMany(Catalog::className(), ['parent_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['catalog_id' => 'id']);
    }
}
