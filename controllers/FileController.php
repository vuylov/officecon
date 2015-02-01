<?php

namespace app\controllers;
use Yii;
use yii\web\Controller;
use yii\web\MethodNotAllowedHttpException;
use app\models\File;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class FileController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access'    => [
                'class' => AccessControl::className(),
                'only'  => ['delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ],
        ];
    }
    public function actionDelete($id)
    {
        if(Yii::$app->request->isAjax){
            if(!$id && !Yii::$app->user->identity->id){
                throw new MethodNotAllowedHttpException("Not enough parameters or you not authorized");
            }
            $file       = File::findOne($id);
            if($file === null){
                $this->redirect(['site/index']);
            }

            $fp = Yii::getAlias('@webroot').'/'.$file->path;

            if(file_exists($fp))
                unlink($fp);

            if($file->delete()){
                echo 'Изображение удалено!';
            }else{
                echo $file->errors;
            }
        }else{
            $this->redirect(['site/index']);
        }
    }
}
