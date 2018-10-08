<?php

use yii\grid\{GridView, ActionColumn};

/* @var $this yii\web\View */
/* @var $searchModel common\models\TemplatesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Templates list';
?>
<div class="templates">
    <?= GridView::widget([
      'dataProvider' => $dataProvider,
      'filterModel' => $searchModel,
      'columns' => [
          'id',
          'title',
          'filename',
          'created_at:datetime',
          'updated_at:datetime',
          [
              'class' => ActionColumn::class
          ]
      ]
    ]); ?>
</div>
