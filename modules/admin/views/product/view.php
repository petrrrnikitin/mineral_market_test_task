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
    <img src="<?=html::encode($model->img)?>" alt="">
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
