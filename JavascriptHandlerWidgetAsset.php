<?php
/**
 */

namespace execut\javascriptHandler;


use execut\yii\web\AssetBundle;
use yii\jui\JuiAsset;

class JavascriptHandlerWidgetAsset extends AssetBundle
{
    public $depends = [
        JuiAsset::class,
    ];
}