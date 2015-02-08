<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $type
 */
class Project extends \yii\db\ActiveRecord
{
    const DESIGN = 1;
    const PORTFOLIO = 100;
    const FILE_TYPE = 'project';
    public $file; //for file upload
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['type'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['file'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => Yii::t('app', 'Название'),
            'description' => Yii::t('app', 'Описание'),
            'type' => Yii::t('app', 'Тип'),
            'file'  => Yii::t('app', 'Изображения для загрузки'),
        ];
    }

    public function getBaseFileType()
    {
        return self::FILE_TYPE;
    }

    public function getFiles()
    {
        return $this->hasMany(File::className(), ['fid' => 'id'])
            ->where(['type' => self::FILE_TYPE]);
    }

    public function beforeDelete()
    {
        if(parent::beforeDelete()){
            if(count($this->files) > 0){
                File::deleteRelatedFiles($this);
            }
            return true;
        }
        return false;
    }
}
