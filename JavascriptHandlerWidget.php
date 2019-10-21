<?php
/**
 */

namespace execut\javascriptHandler;


use yii\helpers\Json;
use yii\web\View;

class JavascriptHandlerWidget extends \execut\yii\jui\Widget
{
    public function run()
    {
        $this->registerWidget();
    }



    /**
     * Registers a specific jQuery UI widget options
     * @param string $name the name of the jQuery UI widget
     * @param string $id the ID of the widget
     */
    protected function registerClientOptions($name, $id)
    {
        if ($this->clientOptions !== false) {
            $options = empty($this->clientOptions) ? '' : Json::htmlEncode($this->clientOptions);
            $js = "jQuery('body').$name($options);";
            $this->getView()->registerJs($js);
        }
    }
}