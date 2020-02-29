<?php
namespace Adx\PagesModule\Controller;

use Adx\PagesModule\Model\Page;
use Yii;
use yii\base\ViewContextInterface;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * MainController
 */
class MainController extends Controller implements ViewContextInterface
{
    /**
     * Переопределяет дефолтный путь шаблонов модуля.
     * Путь задается в конфиге модуля, в компонентах приложения.
     *
     * @return string
     */
    public function getViewPath()
    {
        return $this->module->getViewPath();
    }

    /**
     * View one custom page.
     *
     * @return mixed
     */
    public function actionIndex($id = 0, $slug = '')
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
     *
     * @return Page
     *
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
     * @return void
     */
    protected function registerXRobotsTag(array $page)
    {
        $response = Yii::$container->get(Response::class);

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
}
