<?php
/**
 */

namespace execut\javascriptHandler\controllers;


use execut\javascriptHandler\Exception;
use yii\web\Controller;
use yii\web\Response;

class HandleController extends Controller
{
    public function actionIndex()
    {
        $postData = \yii::$app->request->post();
        if (!empty($postData['data']) && is_array($postData['data']) && !empty($postData['data']['message']) && is_string($postData['data']['message'])) {
            foreach ($this->module->ignoredMessages as $ignoredMessage) {
                if (is_string($ignoredMessage)) {
                    $ignoredMessage = [
                        'message' => $ignoredMessage,
                    ];
                }

                if (strpos($postData['data']['message'], $ignoredMessage['message']) !== false) {
                    $isIgnore = true;
                    if (array_key_exists('lineNo', $ignoredMessage) && $ignoredMessage['lineNo'] !== (int) $postData['data']['lineNo']) {
                        $isIgnore = false;
                    }

                    if (array_key_exists('columnNo', $ignoredMessage) && $ignoredMessage['columnNo'] !== (int) $postData['data']['columnNo']) {
                        $isIgnore = false;
                    }

                    if ($isIgnore) {
                        \yii::$app->response->format = Response::FORMAT_JSON;
                        return true;
                    }
                }
            }

            throw new Exception('Javascript error: ' . var_export($postData, true));
        }
    }
}
