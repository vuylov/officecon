<?php

namespace app\models;

use Yii;
use yii\web\MethodNotAllowedHttpException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\db\Expression;
/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $name
 * @property integer $role
 * @property string $email
 * @property string $password
 * @property integer $active
 * @property string $create_at
 * @property string $deactivate_at
 *
 * @property Product[] $products
 */
class User extends ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'password'], 'required', 'message' => 'должны быть заполнены'],
            [['create_at', 'deactivate_at','role', 'active'], 'safe'],
            [['name', 'email', 'password'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Фамилия имя отчетство сотрудника'),
            'role' => Yii::t('app', 'Роль'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Пароль'),
            'active' => Yii::t('app', 'Активность'),
            'create_at' => Yii::t('app', 'Учетная запись создана'),
            'deactivate_at' => Yii::t('app', 'Учетная запись деактивирована'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['user_id' => 'id']);
    }

    /**
     * Finds an identity by the given ID
     *
     * @param string|integer $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @exception ErrorException
     */
    public function getAuthKey()
    {
        throw new MethodNotAllowedHttpException("Method not supported in User module");
    }

    /**
     * Finds an identity by the given token
     *
     * @throws MethodNotAllowedHttpException
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new MethodNotAllowedHttpException("Method not supported in User module");
    }

    /**
     * @throws MethodNotAllowedHttpException
     */
    public function validateAuthKey($authKey)
    {
        throw new MethodNotAllowedHttpException("Method not supported in User module");
    }

    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert)){
            if($this->isNewRecord){
                $this->password = Yii::$app->security->generatePasswordHash($this->password);
                $this->active   = 1;
                $this->role     = 100;
                $this->create_at = new Expression("NOW()");
            }
            else{
                $this->password = Yii::$app->security->generatePasswordHash($this->password);
            }
            return true;
        }
        return false;
    }

    /**
     * Find a user by email
     *
     * @param string $email email of user
     * @return User user object
     */
    public static function findUserByEmail($email)
    {
        return static::find()->where(['email' => $email])->one();
    }

    /**
     * Validate password
     *
     * @param string $password given by user
     * @return boolean response
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

}
