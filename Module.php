<?php
/**
 */

namespace execut\javascriptHandler;


use yii\helpers\ArrayHelper;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'execut\javascriptHandler\controllers';
    public $ignoredMessages = [];
    public $ignoredMessagesByDefault = [
        'Script error.',
        'Access is denied.',
        [
            'message' => 'Uncaught SyntaxError: Unexpected end of input',
            'lineNo' => 1,
            'columnNo' => 10128,
        ],
        [
            'message' => 'Uncaught SyntaxError: Unexpected identifier',
            'lineNo' => 1,
            'columnNo' => 5,
        ],
        [
            'message' => 'SyntaxError: illegal character',
            'lineNo' => 1,
            'columnNo' => 0,
        ]
    ];

    public function getIgnoredMessages() {
        return ArrayHelper::merge($this->ignoredMessages, $this->ignoredMessagesByDefault);
    }
}