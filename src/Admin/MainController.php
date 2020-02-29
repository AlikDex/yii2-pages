<?php
namespace Adx\PagesModule\Admin;

use Adx\PagesModule\Form\Admin\PageForm;
use Adx\PagesModule\Model\Page;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * MainController implements the CRUD actions for Page model.
 */
class MainController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                    'batch-delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @param \yii\base\Action $action
     *
     * @return bool
     */
    public function beforeAction($action)
    {
        if (in_array($action->id, ['index'], true)) {
            Url::remember('', 'actions-redirect');
        }

        return parent::beforeAction($action);
    }

    /**
     * Lists all Pages models.
     *
     * @return mixed
     */
    public function actionIndex($page = 1)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Page::find(),
        ]);

        $dataProvider->prepare(true);

        return $this->render('index', [
            'page' => (int) $page,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Page model.
     *
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $page = $this->findById($id);

        return $this->render('view', [
            'page' => $page,
        ]);
    }

    /**
     * Creates a new Page model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $page = new Page;
        $pageForm = new PageForm;
        $pageForm->setAttributes($page->getAttributes());

        if ($pageForm->load(Yii::$app->request->post()) && $pageForm->validate()) {
            $currentDatetime = gmdate('Y-m-d H:i:s');

            $page->setAttributes($pageForm->getAttributes());
            $page->generateSlug($pageForm->slug);
            $page->updated_at = $currentDatetime;
            $page->created_at = $currentDatetime;

            if ($page->save()) {
                return $this->redirect(Url::previous('actions-redirect'));
            }
        }

        return $this->render('create', [
            'page' => $page,
            'pageForm' => $pageForm,
        ]);
    }

    /**
     * Updates an existing Page model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $page = $this->findById($id);
        $pageForm = new PageForm;
        $pageForm->setAttributes($page->getAttributes());

        if ($pageForm->load(Yii::$app->request->post()) && $pageForm->validate()) {
            $currentDatetime = gmdate('Y-m-d H:i:s');

            $page->setAttributes($pageForm->getAttributes());
            $page->generateSlug($pageForm->slug);
            $page->updated_at = $currentDatetime;

            if ($page->save()) {
                return $this->redirect(Url::previous('actions-redirect'));
            }
        }

        return $this->render('update', [
            'page' => $page,
            'pageForm' => $pageForm,
        ]);
    }

    /**
     * Deletes an existing Page model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $page = $this->findById($id);

        $page->delete();

        return $this->redirect(Url::previous('actions-redirect'));
    }

    /**
     * Finds the Page model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     * @return Page the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findById($id)
    {
        $page = Page::findOne($id);

        if (null === $page) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        return $page;
    }
}
