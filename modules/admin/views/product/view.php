<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить товар', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить товара', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить данный товар ?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php
    if (!empty($model->img)) {
        $img = Yii::getAlias('@webroot') . '/images/products/source/' .  $model->img;
        if (is_file($img)) {
            $url = Yii::getAlias('@web') . '/images/products/source/' .  $model->img;
            echo  '<img src="/images/products/small/'. html::encode($model->img) . '" alt="">';
        } else {
            echo '<img width="240" height="320" class="mb-3" src=" ' .html::encode($model->img) .'" alt="'.html::encode($model->name) .'">';
        }
    }
    ?>



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description',
            'price',
            'amount',
            [
                'attribute' => 'created_at',
                'value' => $model->getCreatedAt()
            ],
            [
                'attribute' => 'updated_at',
                'value' => $model->getUpdatedAt()
            ]

        ],
    ]) ?>

</div>
