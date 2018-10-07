<?php

namespace backend\controllers;

use common\models\Templates;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use Yii;
use yii\web\ServerErrorHttpException;

class TemplatesController extends \yii\web\Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'edit', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['GET'],
                    'create' => ['GET', 'POST'],
                    'edit' => ['GET', 'PATCH'],
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
     * @throws \yii\base\InvalidConfigException
     * @throws BadRequestHttpException
     * @throws ServerErrorHttpException
     */
    public function actionCreate()
    {
        $model = new Templates();
        if (Yii::$app->request->isGet) {
            return $this->render('edit', ['model' => $model]);
        }

        $model->load(Yii::$app->request->getBodyParams());
        if (!$model->validate()) {
            throw new BadRequestHttpException('Bat parameters: ' . implode(',', $model->getErrors()));
        }

        if (!$model->save()) {
            throw new ServerErrorHttpException('Error save template');
        }

        return $this->redirect(Url::toRoute(['templates/view', 'id' => $model->id]));
    }

    public function actionDelete()
    {
        return $this->render('delete');
    }

    public function actionEdit(int $id)
    {
        $model = Templates::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException('Template not found');
        }

        return $this->render('edit');
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionView()
    {
        return $this->render('view');
    }

}
