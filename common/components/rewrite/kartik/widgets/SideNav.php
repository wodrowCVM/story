<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 2017/7/9
 * Time: 10:18
 */

namespace common\components\rewrite\kartik\widgets;


use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

class SideNav extends \kartik\sidenav\SideNav
{
    protected function renderItem($item)
    {
        $this->validateItems($item);
        $template = ArrayHelper::getValue($item, 'template', $this->linkTemplate);
        $url = Url::to(ArrayHelper::getValue($item, 'url', '#'));
        if (empty($item['top'])) {
            if (empty($item['items'])) {
                $template = str_replace('{icon}', $this->indItem . '{icon}', $template);
            } else {
                $template = isset($item['template']) ? $item['template'] :'<a href="{url}" class="kv-toggle">{icon}{label}</a>';
                $openOptions = ($item['active']) ? ['class' => 'opened'] : ['class' => 'opened', 'style' => 'display:none'];
                $closeOptions = ($item['active']) ? ['class' => 'closed', 'style' => 'display:none'] : ['class' => 'closed'];
                $indicator = Html::tag('span', $this->indMenuOpen, $openOptions) . Html::tag('span', $this->indMenuClose, $closeOptions);
                $template = str_replace('{icon}', $indicator . '{icon}', $template);
            }
        }
        $icon = empty($item['icon']) ? '' : '<span class="' . $this->iconPrefix . $item['icon'] . '"></span> &nbsp;';
        unset($item['icon'], $item['top']);
        return strtr($template, [
            '{url}' => $url,
            '{label}' => $item['label'],
            '{icon}' => $icon
        ]);
    }
}