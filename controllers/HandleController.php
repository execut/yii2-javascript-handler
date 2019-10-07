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
            foreach ($this->module->getIgnoredMessages() as $ignoredError) {
                if (is_string($ignoredError)) {
                    $ignoredError = [
                        'message' => $ignoredError,
                    ];
                }

                $ignoredMessages = $ignoredError['message'];
                if (!is_array($ignoredMessages)) {
                    $ignoredMessages = [$ignoredMessages];
                }

                foreach ($ignoredMessages as $ignoredMessage) {
                    if (strpos($postData['data']['message'], $ignoredMessage) !== false) {
                        $isIgnore = true;
                        if ((array_key_exists('lineNo', $ignoredError) && $ignoredError['lineNo'] !== (int)$postData['data']['lineNo']) ||
                            (array_key_exists('columnNo', $ignoredError) && $ignoredError['columnNo'] !== (int)$postData['data']['columnNo']) ||
                            (array_key_exists('errorUrl', $ignoredError) && strpos($postData['data']['errorUrl'], $ignoredError['errorUrl']) === false)) {
                            $isIgnore = false;
                        }

                        if ($isIgnore) {
                            \yii::$app->response->format = Response::FORMAT_JSON;
                            return true;
                        }
                    }
                }
            }

            throw new Exception('Javascript error: ' . var_export($postData, true));
        }
    }
}
