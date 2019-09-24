<?php
/**
 */

namespace execut\javascriptHandler\controllers;


use execut\javascriptHandler\Exception;
use yii\web\Controller;
use yii\web\Response;

class HandleController extends Controller
{
    public function actionIndex() {
        $postData = var_export(\yii::$app->request->post(), true);
        if (!empty($postData['message'])) {
            if (in_array($postData['message'], $this->module->ignoredMessages)) {
                \yii::$app->response->format = Response::FORMAT_JSON;
                return true;
            }
        }

        throw new Exception('Javascript error: ' . $postData);
    }
}