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
        [
            'message' => 'Uncaught SyntaxError: Unexpected end of input',
            'lineNo' => 1,
            'columnNo' => 10128,
        ],
//        [
//            'message' => 'Uncaught SyntaxError: Unexpected identifier',
//            'lineNo' => 1,
//            'columnNo' => 5,
//        ]
    ];
}