<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\models\Templates */
/* @var $form ActiveForm */
?>
<div class="templates-edit">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'title') ?>
        <?= $form->field($model, 'filename') ?>
        <?= $form->field($model, 'template')->widget(CKEditor::className(), [
            'options' => ['rows' => 12],
            'preset' => 'basic'
        ]) ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- templates-edit -->
