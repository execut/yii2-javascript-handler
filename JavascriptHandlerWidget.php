<?php
/**
 */

namespace execut\javascriptHandler;


class JavascriptHandlerWidget extends \execut\yii\jui\Widget
{
    public function run()
    {
        $this->registerWidget();
        return $this->_renderContainer();
    }
}