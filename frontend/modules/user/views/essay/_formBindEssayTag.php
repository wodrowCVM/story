<div class="form-group" id="add-bind-essay-tag">
    <?php
    use kartik\grid\GridView;
    use kartik\builder\TabularForm;
    use yii\data\ArrayDataProvider;
    use yii\helpers\Html;
    $dataProvider = new ArrayDataProvider([
        'allModels' => $row,
        'pagination' => [
            'pageSize' => -1
        ]
    ]);
    echo TabularForm::widget([
        'dataProvider' => $dataProvider,
        'formName' => 'BindEssayTag',
        'checkboxColumn' => false,
        'actionColumn' => false,
        'attributeDefaults' => [
            'type' => TabularForm::INPUT_TEXT,
        ],
        'attributes' => [
//        'id' => ['type' => TabularForm::INPUT_HIDDEN, 'visible' => false],
            'tag_id' => [
                'label' => '标签',
                'type' => TabularForm::INPUT_WIDGET,
                'widgetClass' => \common\components\rewrite\kartik\widgets\Select2::className(),
                'options' => [
                    'language' => Yii::$app->language,
                    'options' => ['placeholder' => '请选择或输入'],
                    'initValueText' => [
                        'c' => \common\models\Tag::className(),
                        'k' => 'name',
                    ],
                    'pluginOptions' => [
                        'tags' => true,
                        'tokenSeparators' => [',', ' '],
                        'maximumInputLength' => 10,
                        'allowClear' => true,
                        'language' => [
                            'errorLoading' => new \yii\web\JsExpression("function () { return '等待结果'; }"),
                        ],
                        'ajax' => [
                            'url' => \yii\helpers\Url::to(['/site/ajax-tag-search']),
                            'dataType' => 'json',
                            'data' => new \yii\web\JsExpression('function(params) { return {name:params.term}; }')
                        ],
                        'escapeMarkup' => new \yii\web\JsExpression('function (markup) { return markup; }'),
                        'templateResult' => new \yii\web\JsExpression('function(tag) { return tag.text; }'),
                        'templateSelection' => new \yii\web\JsExpression('function (tag) { return tag.text; }'),
                    ],
                ],
                'columnOptions' => ['width' => '200px'],
            ],
            'del' => [
                'type' => 'raw',
                'label' => '',
                'value' => function ($model, $key) {
//                Yii::trace($dataProvider, 'wodrow');
                    return Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' => 'Delete', 'onClick' => 'delRowBindEssayTag(' . $key . '); return false;', 'id' => 'bind-essay-tag-del-btn']);
                },
            ],
        ],
        'gridSettings' => [
            'panel' => [
                'heading' => false,
                'type' => GridView::TYPE_DEFAULT,
                'before' => false,
                'footer' => false,
                'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . '添加标签', ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowBindEssayTag()']),
            ]
        ]
    ]);
    ?>
</div>
