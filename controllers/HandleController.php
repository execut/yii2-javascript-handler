<?php
/**
 */

namespace execut\javascriptHandler\controllers;


use execut\javascriptHandler\Exception;
use execut\javascriptHandler\SkipChecker;
use yii\web\Controller;
use yii\web\Response;

class HandleController extends Controller
{
    public function actionIndex()
    {
        $postData = \yii::$app->request->post();
        if (!empty($postData['data']) && is_array($postData['data']) && !empty($postData['data']['message']) && is_string($postData['data']['message'])) {
            $data = $postData['data'];
            $userAgent = \yii::$app->request->getUserAgent();
            $data['userAgent'] = $userAgent;
            $checker = new SkipChecker($this->module->getIgnoredMessages());
            if ($checker->check($data)) {
                \yii::$app->response->format = Response::FORMAT_JSON;
                return true;
            }

            throw new Exception('Javascript error: ' . var_export($postData, true));
        }
    }
}
