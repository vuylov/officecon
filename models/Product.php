<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use app\models\Item;
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
            [['manufacturer_id', 'name'], 'required', 'message' => 'не может быть пустым'],
            [['manufacturer_id'], 'integer'],
            [['description'], 'string'],
            [['create_at', 'deactivate_at', 'active', 'parent_id','user_id', 'description', 'file'], 'safe'],
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
            'manufacturer_id'   => Yii::t('app', 'Поставщик'),
            'name'              => Yii::t('app', 'Название'),
            'description'       => Yii::t('app', 'Описание'),
            'active'            => Yii::t('app', 'Активность'),
            'create_at'         => Yii::t('app', 'Создано'),
            'deactivate_at'     => Yii::t('app', 'Деактивировано'),
            'producer'          => Yii::t('app', 'Производство'),
            'file'              => Yii::t('app', 'Изображения для загрузки')
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogs()
    {
        return $this->hasMany(Catalog::className(), ['id' => 'catalog_id'])->viaTable('productToCatalog', ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::className(), ['product_id' => 'id']);
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
        return $this->hasMany(Composition::className(), ['id' => 'product_id'])->viaTable('compositionItem', ['product_id' => 'id']);
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
            File::deleteRelatedFiles($this);
            return true;
        }
        return false;
    }

    /**
     * Save relations in junction table productToCatalog
     * @param Product $product product model
     * @param Catalog $catalogs many catalog
     * @throws  MethodNotAllowedHttpException
     * @return  mixed
     */
    public function insertProductToCatalog(array $catalogs)
    {
        $db     = Yii::$app->db;
        $data   = $this->prepareData($catalogs);

        $result = $db->createCommand()->batchInsert('productToCatalog', ['product_id', 'catalog_id'], $data)->execute();
        if(!$result)
            throw new MethodNotAllowedHttpException('Not insert rows in productToCatalog table');
    }

    /**
     * Delete relations in junction table productToCatalog
     */
    public function deleteProductToCatalog()
    {
        $db     = Yii::$app->db;
        $db->createCommand()->delete('productToCatalog', ['product_id' => $this->id])->execute();
    }

    /**
     * Prepare data for insertProductToCatalog mathod
     */
    private function prepareData(array $catalogs)
    {
        $ar = [];
        foreach($catalogs as $catalogId)
        {
            $ar[] = [$this->id, (int)$catalogId];
        }
        return $ar;
    }

    /**
     * Deactivate product in system. Hide product from front site
     */
    private function Deactivate()
    {
        $this->active = 0;
        $this->deactivate_at = new Expression('NOW()');
        $this->save();
    }

    public function getBaseFileType()
    {
        return self::FILE_TYPE;
    }
}
