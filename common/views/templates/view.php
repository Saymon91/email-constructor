<?php
/* @var $this yii\web\View */
/* @var $template common\models\Templates*/

use yii\widgets\DetailView;
?>
<h1>templates/view</h1>

<p>
    <?= DetailView::widget([
    'model' => $template,
    'attributes' => [
        'title',
        'filename',
        'created_at:datetime',
        'updated_at:datetime',
        'template:html',
    ],
]); ?>
</p>
