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
            foreach ($this->module->ignoredMessages as $ignoredMessage) {
            if (strpos($postData['data']['message'], $ignoredMessage) !== false) {
                \yii::$app->response->format = Response::FORMAT_JSON;
                return true;
            }
        }

        throw new Exception('Javascript error: ' . var_export($postData, true));
    }
}
