<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <fieldset>
        <legend>Загрузить изображение</legend>
        <?= $form->field($model, 'img')->fileInput(); ?>
        <?php
        if (!empty($model->img)) {
            $img = Yii::getAlias('@webroot') . '/images/products/source/' .  $model->img;
            if (is_file($img)) {
                $url = Yii::getAlias('@web') . '/images/products/source/' .  $model->img;
                echo 'Уже загружено <br> ', ' <img src="/images/products/small/'. html::encode($model->img) . '" alt="">';
                echo $form->field($model,'remove')->checkbox();
            }
        }
        ?>
    </fieldset>

    <div class="form-group">
        <?= Html::submitButton('Создать товар', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
