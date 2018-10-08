<?php
/* @var $this yii\web\View */

/* @var $model common\models\Templates */

use yii\helpers\Html;
use yii\widgets\DetailView;

?>
<h1>templates/view</h1>

<div class="template">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'filename',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]); ?>

    <div class="template-view">
    <?= Html::decode($model->template) ?>
    </div>

</div>
