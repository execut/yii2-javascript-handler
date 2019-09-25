<?php
/**
 */

namespace execut\javascriptHandler;


class Module extends \yii\base\Module
{
    public $controllerNamespace = 'execut\javascriptHandler\controllers';
    public $ignoredMessages = [
        'Script error.',
        'Access is denied.',
    ];
}