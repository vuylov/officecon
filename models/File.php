<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\VarDumper;
use yii\web\HttpException;
use yii\web\MethodNotAllowedHttpException;
use yii\widgets\ActiveForm;

/**
 * This is the model class for table "file".
 *
 * @property integer $id
 * @property integer $fid
 * @property string $type
 * @property string $name
 * @property string $path
 * @property string $thumbnail
 * @property string $extension
 * @property string $create_at
 */
class File extends \yii\db\ActiveRecord
{
    const FILE_NAME_SYMBOLS = 16;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'file';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fid', 'type', 'name', 'path'], 'required', 'message' => 'Должны быть заполнены'],
            [['fid'], 'integer', 'message' => 'Должно быть числом'],
            [['create_at', 'thumbnail'], 'safe'],
            [['type', 'name', 'path', 'extension'], 'string', 'max' => 255, 'message' => 'Превышает допустимый размер']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fid' => Yii::t('app', 'Внешний ID'),
            'type' => Yii::t('app', 'Вид модели'),
            'name' => Yii::t('app', 'Название'),
            'path' => Yii::t('app', 'Путь'),
            'thumbnail' => Yii::t('app', 'Аватар'),
            'extension' => Yii::t('app', 'Расширение'),
            'create_at' => Yii::t('app', 'Создано'),
        ];
    }

    public static function saveImage($type = null, array $files, ActiveRecord $model)
    {
        if(is_null($type))
            throw new MethodNotAllowedHttpException('SaveImage method not work well');

        foreach($files as $file)
        {

            $dbFile             = new File();
            $rName              = Yii::$app->security->generateRandomString(self::FILE_NAME_SYMBOLS);

            $dbFile->fid        = $model->id;
            $dbFile->type       = $type;
            $dbFile->name       = $file->baseName;
            $dbFile->path       = 'upload/'.$rName.'.'.$file->extension;
            $dbFile->extension  = $file->extension;

            if($dbFile->save()){
                $file->saveAs($dbFile->path);
            }
            else{
                VarDumper::dump($dbFile->errors, 10, true);
            }
        }
    }

    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert))
        {
            if($this->isNewRecord){
                $this->create_at = new Expression('NOW()');
            }
            return true;
        }
        return false;
    }
}
