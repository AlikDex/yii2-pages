<?php
namespace Adx\PagesModule;

use Yii;
use yii\base\Module as BaseModule;
use yii\console\Application as ConsoleApplication;
use yii\i18n\PhpMessageSource;

/**
 * This is the main module class of the pages extension.
 */
class Module extends BaseModule
{
    /**
     * @var string Module cotrollers namespace.
     */
    public $controllerNamespace = 'Adx\PagesModule\Controller';

    /**
     * @var string Default route.
     */
    public $defaultRoute = 'main/index';

    /**
     * @inheritdoc
     */
    public function __construct($id, $parent = null, $config = [])
    {
        // default templates path
        $this->setViewPath(__DIR__ . '/Resources/views');

        parent::__construct($id, $parent, $config);
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (Yii::$app instanceof ConsoleApplication) {
            $this->controllerNamespace = 'Adx\PagesModule\Command';
            $this->defaultRoute = 'run/index';
        }

        //translations
        if (!isset(Yii::$app->get('i18n')->translations['pages'])) {
            Yii::$app->get('i18n')->translations['pages'] = [
                'class' => PhpMessageSource::class,
                'basePath' => __DIR__ . '/Resources/i18n',
                'sourceLanguage' => 'en-US',
            ];
        }
    }
}
