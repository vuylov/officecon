<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "color".
 *
 * @property integer $id
 * @property integer $manufacturer_id
 * @property string $name
 *
 * @property Manufacturer $manufacturer
 * @property ProductColor[] $productColors
 */
class Color extends ActiveRecord
{
    public $file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'color';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['manufacturer_id', 'name'], 'required', 'message' => 'Обязательно для заполнения'],
            [['manufacturer_id'], 'integer'],
            [['path', 'file'], 'safe'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'manufacturer_id' => 'Поставщик',
            'name' => 'Название',
            'path'  => 'Путь к изображению',
            'file' => 'Изображение цвета'
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
    public function getProductColors()
    {
        return $this->hasMany(ProductColor::className(), ['color_id' => 'id']);
    }

    /**
     * override beforeDelete
     */
    public function beforeDelete()
    {
        if(parent::beforeDelete()){

            $this->deleteUploadedFile();
            return true;
        }
        return false;
    }

    public function deleteUploadedFile()
    {
        $file = Yii::getAlias('@webroot').'/'.$this->path;
        if(file_exists($file)){
            unlink($file);
        }else{
            Yii::warning('Удаляемого файла не существует. Модель #: '.$this->id.'. Файл: '.$this->path);
        }
    }
}
