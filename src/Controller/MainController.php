<?php
namespace Adx\PagesModule\Controller;

use yii\web\Controller;
use Adx\PagesModule\Model\Page;
use yii\base\ViewContextInterface;
use yii\web\NotFoundHttpException;

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
    public function findByIdOrSlug($identify)
    {
        $query = Page::find()
            ->asArray();

        if (is_integer($identify)) {
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
}
