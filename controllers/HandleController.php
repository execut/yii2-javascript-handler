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
        $postData = \yii::$app->request->post();
        if (!empty($postData['data']) && is_array($postData['data']) && !empty($postData['data']['message']) && is_string($postData['data']['message'])) {
            if (in_array($postData['data']['message'], $this->module->ignoredMessages)) {
                \yii::$app->response->format = Response::FORMAT_JSON;
                return true;
            }
        }

        throw new Exception('Javascript error: ' . var_export($postData, true));
    }
}
