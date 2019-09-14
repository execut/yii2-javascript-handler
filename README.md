# yii2-javascript-handler
Javascript error handler for Yii2

### Install

Either run

```
$ php composer.phar require execut/yii2-javascript-handler "dev-master"
```

or add

```
"execut/yii2-javascript-handler": "dev-master"
```

to the ```require``` section of your `composer.json` file.

### Configuration

Add module inside web application config:
```php
return [
    'modules' => [
        'javascriptHandler' => [
            'class' => Module::class,
        ]
    ],
];
```

Render widget inside your application layout:
```php
echo \execut\javascriptHandler\JavascriptHandlerWidget::widget();
```

As a result, all javascript exceptions will throw php exceptions, that will be handled via yii2 error handler