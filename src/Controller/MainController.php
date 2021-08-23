<?php

namespace Adx\PagesModule\Controller;

use Adx\PagesModule\Model\Page;
use App\Cache\PageCache;
use RS\Component\Core\Filter\QueryParamsFilter;
use RS\Component\Core\Settings\SettingsInterface;
use Yii;
use yii\base\InvalidConfigException;
use yii\base\ViewContextInterface;
use yii\di\NotInstantiableException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Request;
use yii\web\Response;

/**
 * MainController
 */
class MainController extends Controller implements ViewContextInterface
{

    /**
     * @inheritdoc
     */
    public function behaviors(): array
    {
        return [
            'queryParams' => [
                'class' => QueryParamsFilter::class,
                'actions' => [
                    'index' => ['id', 'slug'],
                ],
            ],
            'pageCache' => [
                'class' => PageCache::class,
                'enabled' => (bool) $this->get(SettingsInterface::class)->get('enable_page_cache', false),
                'duration' => 600,
                'variations' => [
                    Yii::$app->language,
                    $this->action->id,
                    \implode(':', \array_values($this->get(Request::class)->get())),
                    $this->isMobile(),
                ],
            ],
        ];
    }

    /**
     * Переопределяет дефолтный путь шаблонов модуля.
     * Путь задается в конфиге модуля, в компонентах приложения.
     *
     * @return string
     */
    public function getViewPath(): string
    {
        return $this->module->getViewPath();
    }

    /**
     * View one custom page.
     *
     * @param int $id
     * @param string $slug
     * @return string
     * @throws InvalidConfigException
     * @throws NotFoundHttpException
     * @throws NotInstantiableException
     */
    public function actionIndex(int $id = 0, string $slug = ''): string
    {
        $identify = (0 !== (int) $id) ? (int) $id : $slug;
        $page = $this->findByIdOrSlug($identify);

        $template = empty($page['template']) ? 'index' : $page['template'];

        $this->registerXRobotsTag($page);

        return $this->render($template, [
            'page' => $page,
        ]);
    }

    /**
     * Find page by primary key or by slug
     *
     * @param int|string $identify
     * @return array
     * @throws NotFoundHttpException
     */
    public function findByIdOrSlug($identify): array
    {
        $query = Page::find()
            ->asArray();

        if (\is_integer($identify)) {
            $query->where(['page_id' => $identify]);
        } else {
            $query->where(['slug' => $identify]);
        }

        $page = $query
            ->andWhere(['enabled' => 1])
            ->one();

        if (null === $page) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        return $page;
    }

    /**
     * Регистрирует заголовок для запрета индексации
     * или запрета перехода по ссылкам страницы
     *
     * @param array $page
     * @throws InvalidConfigException
     * @throws NotInstantiableException
     */
    protected function registerXRobotsTag(array $page)
    {
        $response = $this->get(Response::class);

        $crawlerRestrictionTypes = [];
        if (true === (bool) $page['noindex']) {
            $crawlerRestrictionTypes[] = 'noindex';
        }

        if (true === (bool) $page['nofollow']) {
            $crawlerRestrictionTypes[] = 'nofollow';
        }

        if (!empty($crawlerRestrictionTypes)) {
            $headers = $response->getHeaders();
            $headers->add('X-Robots-Tag', \implode(',', $crawlerRestrictionTypes));
        }
    }

    /**
     * Get instance by tag name form DI container
     *
     * @param string $name
     * @return object
     * @throws InvalidConfigException
     * @throws NotInstantiableException
     */
    protected function get(string $name): object
    {
        return Yii::$container->get($name);
    }

    /**
     * Detect user is mobile device
     *
     * @return bool
     * @throws InvalidConfigException
     * @throws NotInstantiableException
     */
    protected function isMobile(): bool
    {
        $deviceDetect = $this->get('device.detect');

        return $deviceDetect->isMobile();
    }
}
