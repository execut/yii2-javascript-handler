<?php
/**
 */

namespace execut\javascriptHandler\controllers;


use execut\javascriptHandler\Exception;
use yii\web\Controller;

class HandleController extends Controller
{
    public function actionIndex() {
        $postData = var_export(\yii::$app->request->post(), true);
        throw new Exception('Javascript error: ' . $postData);
    }
}