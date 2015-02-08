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
            'name' => Yii::t('app', 'Название'),
            'description' => Yii::t('app', 'Описание'),
            'type' => Yii::t('app', 'Тип'),
        ];
    }

    public function getBaseFileType()
    {
        return self::FILE_TYPE;
    }
}
