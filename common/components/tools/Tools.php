<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 17-7-3
 * Time: 下午2:37
 */

namespace common\components\tools;


use yii\base\Component;

class Tools extends Component
{
    /**
     * 调试输出|调试模式下
     * @param  mixed $test 调试变量
     * @param  int $style 模式
     * @param  int $stop 是否停止
     * @return void       浏览器输出
     * @author wodrow <wodrow451611cv@gmail.com | 1173957281@qq.com>
     */
    public static function _vp($test, $stop = 0, $style = 0)
    {
        $outDir = \Yii::getAlias('@runtime');
        switch ($style) {
            case 0:
                echo "<pre>";
                echo "<br><hr>";
                var_dump($test);
                echo "</pre>";
                break;
            case 1:
                echo "<pre>";
                echo "<br><hr>";
                var_dump($test);
                echo "<hr/>";
                for ($i = 0; $i < 100; $i++) {
                    echo $i . "<hr/>";
                }
                echo "</pre>";
                break;
            case 2:
                file_put_contents($outDir . '/OUT.md', "\r" . date("Y-m-d H:i:s")."\n".var_export($test, true));
                break;
            case 3:
                file_put_contents($outDir . '/OUT.md', "\r\r" . date("Y-m-d H:i:s")."\n".var_export($test, true), FILE_APPEND);
                break;
        }
        if ($stop != 0) {
            exit("<hr/>");
        }
    }
}