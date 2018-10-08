<?php

namespace backend\controllers;

use common\models\Templates;
use common\models\TemplatesSearch;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\{Url, Json};
use Yii;
use yii\web\ServerErrorHttpException;

class TemplatesController extends Controller
{
    public $layout = 'main';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update', 'delete', 'view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'index' => ['GET'],
                    'create' => ['GET', 'POST'],
                    'update' => ['GET', 'PATCH', 'POST'],
                    'view' => ['GET'],
                    'delete' => ['DELETE'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * @return string
     * @throws BadRequestHttpException
     * @throws ServerErrorHttpException
     * @throws \yii\base\InvalidConfigException
     */
    public function actionCreate()
    {
        $model = new Templates();
        if (Yii::$app->request->isGet) {
            return $this->render('edit', ['model' => $model]);
        }

        $this->edit($model);

        return $this->redirect(Url::toRoute(['templates/view', 'id' => $model->id]));
    }

    /**
     * @param int $id
     * @return string
     * @throws NotFoundHttpException
     * @throws \Exception
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete(int $id)
    {
        $model = Templates::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException('Template not found');
        }

        $model->delete();

        Yii::$app->session->addFlash('errors', 'Template is removed');

        return $this->redirect(Url::to('index'));
    }

    /**
     * @param int $id
     * @return string|\yii\web\Response
     * @throws BadRequestHttpException
     * @throws NotFoundHttpException
     * @throws ServerErrorHttpException
     * @throws \yii\base\InvalidConfigException
     */
    public function actionUpdate(int $id)
    {
        $model = Templates::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException('Template not found');
        }

        if (Yii::$app->request->isGet) {
            return $this->render('edit', ['model' => $model]);
        }

        $this->edit($model);

        return $this->redirect(Url::toRoute(['templates/view', 'id' => $model->id]));
    }

    /**
     * @param $template
     * @throws BadRequestHttpException
     * @throws ServerErrorHttpException
     * @throws \yii\base\InvalidConfigException
     */
    private function edit($template)
    {
        $template->load(Yii::$app->request->getBodyParams());
        if (!$template->validate()) {
            throw new BadRequestHttpException('Bat parameters: ' . Json::encode($template->getErrors()));
        }

        $data = Yii::$app->request->getBodyParams()[$template->formName()];

        if (isset($data['template'])) {
            $template->template = $data['template'];
        }

        if (!$template->save()) {
            throw new ServerErrorHttpException('Error save template');
        }
    }

    public function actionIndex()
    {
        $model = new TemplatesSearch();
        $dataProvider = $model->search(Yii::$app->request->queryParams);
        return $this->render('@common/views/templates/index', ['searchModel' => $model, 'dataProvider' => $dataProvider]);
    }

    /**
     * @param int $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView(int $id)
    {
        $model = Templates::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException('Template not found');
        }

        return $this->render('@common/views/templates/view', ['model' => $model]);
    }

}
