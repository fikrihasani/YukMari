<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
      'web/css/site.css',
      'web/css/flickity.css',
      'web/css/bootstrap.css',
      'web/css/dataTables.bootstrap.css',
      // 'css/owl.carousel.css'
    ];
    public $js = [
      // 'js/owl_carousel.js',
		  'web/js/site.js',
		  'web/js/flickity.js',
      'web/js/bootstrap.min.js',
      'web/js/jquery.dataTables.js',
      'web/js/dataTables.bootstrap.js',
      // 'js/jquery-3.0.0.min.js'
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\web\JqueryAsset',
        '\rmrevin\yii\fontawesome\AssetBundle',
    ];
}
