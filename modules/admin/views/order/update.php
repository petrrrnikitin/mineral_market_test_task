<?php

use app\models\OrderItem;
use yii\bootstrap4\ActiveForm;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = 'Update Order: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="order-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    <div class="card w-50 my-3">
        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                data-target="#addProduct" aria-expanded="true" aria-controls="addProduct">
            Добавить новый товар в заказ
        </button>
        <div id="addProduct" class="collapse" aria-labelledby="addProduct">
            <div class="card-body">
                <?php
                $item = new OrderItem();

                $form = ActiveForm::begin([
                    'action' => '/admin/order-item/create'
                ]); ?>
                <?= Html::hiddenInput('OrderItem[order_id]', $model->id) ?>


                <?= $form->field($item, 'product_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Product::find()->all(), 'id', 'name')) ?>


                <?= $form->field($item, 'quantity')->textInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

    <?= GridView::widget([
        'dataProvider' => $items,
        'summary' => false,
        'columns' => [
            ['attribute' => 'product_id',
                'value' => function ($model) {
                    return $model->product->name;
                }
            ],
            [
                'attribute' => 'Цена',
                'content' => function ($model) {
                    return $model->getPrice();
                }
            ],
            'quantity',

            ['class' => 'yii\grid\ActionColumn',
                'urlCreator' => function ($action, $model ) {
                    return Url::to(['order-item/' . $action, 'id' => $model->id]);
                },
                'contentOptions' => ['class' => 'd-flex'],
                'buttons' => [
                    'update' => function ($url, $items) {
                        return Html::a('<svg class="bi bi-pencil mx-1" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M11.293 1.293a1 1 0 0 1 1.414 0l2 2a1 1 0 0 1 0 1.414l-9 9a1 1 0 0 1-.39.242l-3 1a1 1 0 0 1-1.266-1.265l1-3a1 1 0 0 1 .242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z"/>
  <path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 0 0 .5.5H4v.5a.5.5 0 0 0 .5.5H5v.5a.5.5 0 0 0 .5.5H6v-1.5a.5.5 0 0 0-.5-.5H5v-.5a.5.5 0 0 0-.5-.5H3z"/>
</svg>', $url, [
                            'title' => Yii::t('app', 'update')
                        ]);
                    },
                    'delete' => function ($url, $items) {
                        return Html::a('<svg class="bi bi-trash mx-1" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
</svg>', $url, [
                            'title' => Yii::t('app', 'delete'),
                            'data' => [
                                'confirm' => 'Вы уверены что хотите удалить данный товар из заказа ?',
                                'method' => 'post',
                            ],
                        ]);
                    }
                ]
            ],
        ],
    ]); ?>

</div>
