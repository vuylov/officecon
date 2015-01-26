<?php

namespace app\controllers;
use Yii;
use yii\web\Controller;
use yii\web\MethodNotAllowedHttpException;
use yii\helpers\StringHelper;
use app\models\File;

class FileController extends Controller
{
    public function actionDelete($id)
    {
        if(!$id && !Yii::$app->user->identity->id){
            throw new MethodNotAllowedHttpException("Not enough parameters or you not authorized");
        }
        $file       = File::findOne($id);
        if($file === null){
            $this->redirect(['site/index']);
        }

        $controller = $file->type;
        $modelId    = $file->fid;

        $fp = Yii::getAlias('@webroot').'/'.$file->path;
        if(file_exists($fp))
            unlink($fp);

        $file->delete();

        $this->redirect([$controller.'/view', 'id' => $modelId]);
    }
}
