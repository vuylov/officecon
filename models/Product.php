<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use app\models\Item;
use app\models\Composition;
use yii\web\MethodNotAllowedHttpException;
use yii\helpers\VarDumper;

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
    const ACTIVE    = 1;
    const DEACTIVE  = 0;
    const FILE_TYPE = 'product';

    public $file; //image field for upload images

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
            [['manufacturer_id', 'name', 'catalog_id', 'keywords', 'description_seo'], 'required', 'message' => 'не может быть пустым'],
            [['manufacturer_id', 'catalog_id'], 'integer'],
            [['description'], 'string'],
            [['create_at', 'deactivate_at', 'active', 'parent_id','user_id', 'description', 'file', 'article', 'weight', 'volume', 'amount','price','type_id', 'size'], 'safe'],
            [['name', 'producer'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'                => Yii::t('app', 'ID'),
            'parent_id'         => Yii::t('app', 'Относится к'),
            'user_id'           => Yii::t('app', 'Автор'),
            'catalog_id'        => Yii::t('app', 'Каталог'),
            'manufacturer_id'   => Yii::t('app', 'Поставщик'),
            'name'              => Yii::t('app', 'Название'),
            'description'       => Yii::t('app', 'Описание'),
            'active'            => Yii::t('app', 'Активность'),
            'create_at'         => Yii::t('app', 'Создано'),
            'deactivate_at'     => Yii::t('app', 'Деактивировано'),
            'producer'          => Yii::t('app', 'Производство'),
            'file'              => Yii::t('app', 'Изображения для загрузки'),
            'keywords'          => Yii::t('app', 'Ключевые слова для SEO'),
            'description_seo'   => Yii::t('app', 'Описание для SEO'),
            'article'           => Yii::t('app', 'Артикул'),
            'size'              => Yii::t('app', 'Размеры'),
            'weight'            => Yii::t('app', 'Масса'),
            'volume'            => Yii::t('app', 'Объем'),
            'amount'            => Yii::t('app', 'Количество элементов в упаковке'),
            'price'             => Yii::t('app', 'Цена'),
            'type_id'           => Yii::t('app', 'Тип'),
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
    public function getCatalog()
    {
        return $this->hasOne(Catalog::className(), ['id' => 'catalog_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Product::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Type::className(), ['id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrices()
    {
        return $this->hasMany(Price::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(File::className(), ['fid' => 'id'])
            ->where(['type' => self::FILE_TYPE]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompositions()
    {
        return $this->hasMany(Composition::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompositionsItem()
    {
        return $this->hasMany(CompositionItem::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChilds()
    {
        return $this->hasMany(Product::className(), ['parent_id' => 'id'])->orderBy('type_id');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductColors()
    {
        return $this->hasMany(ProductColors::className(), ['product_id' => 'id']);
    }

     /**
     * override beforeSave()
     */
    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert))
        {

            if($this->isNewRecord){
                $this->user_id      = Yii::$app->user->id;
                $this->create_at    = new Expression('NOW()');
                $this->active       = Product::ACTIVE;
            }
            return true;
        }
        return false;
    }

    /**
     * override beforeDelete()
     */
    public function beforeDelete()
    {
        if(parent::beforeDelete()){
            if(count($this->childs) > 0){
                foreach($this->childs as $child){
                    $child->delete();
                }
            }
            File::deleteRelatedFiles($this);
            return true;
        }
        return false;
    }

    public function getBaseFileType()
    {
        return self::FILE_TYPE;
    }

    public function deleteColors()
    {
        ProductColors::deleteAll('product_id = :p', [':p' => $this->id]);
    }

    public function getProductFullName()
    {
        return $this->name.' ('.$this->article.')';
    }
}
