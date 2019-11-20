# Pages
Yii2 pages module

## App configure module
```
'modules' => [
    'pages' => [
        'class' => Adx\PagesModule\Module::class,
        //'viewPath' => '@app/views/pages',
        //'controllerNamespace' => 'Adx\PagesModule\Admin',
    ],
],
```

## Migrations
config:
```
'controllerMap' => [
    'migrate' => [
        'class' => yii\console\controllers\MigrateController::class,
        'migrationNamespaces' => [],
        'migrationPath' => [
            '@vendor/alikdex/yii2-pages/src/Migration',
        ],
    ],
],
```
or composer:
```
"scripts": {
    "post-update-cmd": [
        "yes | php yii migrate --migrationPath=@vendor/alikdex/yii2-pages/src/Migration"
    ],
    "post-install-cmd": [
        "yes | php yii migrate --migrationPath=@vendor/alikdex/yii2-pages/src/Migration"
    ]
}
```
