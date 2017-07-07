<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 17-7-6
 * Time: 下午7:03
 */

namespace common\components\rewrite\kartik\widgets;


use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\JsExpression;

class Select2 extends \kartik\select2\Select2
{
    public function renderWidget()
    {
        $this->initI18N(__DIR__);
        $this->pluginOptions['theme'] = $this->theme;
        $multiple = ArrayHelper::getValue($this->pluginOptions, 'multiple', false);
        unset($this->pluginOptions['multiple']);
        $multiple = ArrayHelper::getValue($this->options, 'multiple', $multiple);
        $this->options['multiple'] = $multiple;
        if (!empty($this->addon) || empty($this->pluginOptions['width'])) {
            $this->pluginOptions['width'] = '100%';
        }
        if ($this->hideSearch) {
            $this->pluginOptions['minimumResultsForSearch'] = new JsExpression('Infinity');
        }
        $this->initPlaceholder();
        if (!isset($this->data)) {
            if (!isset($this->value) && !isset($this->initValueText)) {
                $this->data = [];
            } else {
                if ($multiple) {
                    $key = isset($this->value) && is_array($this->value) ? $this->value : [];
                } else {
                    $key = isset($this->value) ? $this->value : '';
                }
                $val = isset($this->initValueText) ? $this->initValueText : $key;
                if (isset($this->value)&&isset($this->initValueText)&&is_array($this->initValueText)){
                    $x = $this->initValueText;
                    $c = "\\".$x['c'];
                    $m = new $c;
                    $_data = $m::findOne($key);
                    $k = $x['k'];
                    $val = $_data->$k;
                }
                $this->data = $multiple ? array_combine($key, $val) : [$key => $val];
            }
        }
        Html::addCssClass($this->options, 'form-control');
        $this->initLanguage('language', true);
        $this->renderToggleAll();
        $this->registerAssets();
        $this->renderInput();
    }
}